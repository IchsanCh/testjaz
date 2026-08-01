<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Support\Highlighter;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtikelController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->query('q', ''));
        $selectedCategories = array_filter((array) $request->query('kategori', []));

        // Satu query buat semua kategori + jumlah artikel published-nya masing-masing
        // (withCount = 1 query pakai subquery, bukan query terpisah per kategori).
        $categories = ArticleCategory::query()
            ->withCount(['articles as published_articles_count' => fn ($q) => $q->published()])
            ->orderBy('name')
            ->get();

        $articles = Article::query()
            ->published()
            ->with('category') // eager load — cegah N+1 pas nampilin nama kategori di tiap card
            ->when($keyword !== '', fn ($q) => $q->where(
                fn ($sub) => $sub->where('title', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%")
            ))
            ->when(
                count($selectedCategories) > 0,
                fn ($q) => $q->whereHas(
                    'category',
                    fn ($cat) => $cat->whereIn('slug', $selectedCategories)
                )
            )
            ->latest()
            ->paginate(9)
            ->withQueryString();

        // Highlight kata kunci di title, dan kalau title-nya sendiri gak match
        // (match-nya dari content), siapin cuplikan teks di sekitar kata yang
        // ketemu biar user tau kenapa artikel itu muncul di hasil pencarian.
        if ($keyword !== '') {
            $articles->getCollection()->each(function (Article $article) use ($keyword) {
                $titleMatches = mb_stripos($article->title, $keyword) !== false;

                $article->title_highlighted = Highlighter::mark(e($article->title), $keyword);
                $article->search_snippet = $titleMatches
                    ? null
                    : Highlighter::snippet((string) $article->content, $keyword);
            });
        }

        $view = $request->ajax() ? 'artikel.partials.grid' : 'artikel.index';

        return view($view, [
            'articles' => $articles,
            'categories' => $categories,
            'keyword' => $keyword,
            'selectedCategories' => $selectedCategories,
        ]);
    }

    public function show(Article $article): View
    {
        abort_unless($article->status === 'published', 404);

        $article->load('category'); // 1 query, bukan lazy-load per akses di view

        $related = Article::query()
            ->published()
            ->with('category')
            ->where('article_category_id', $article->article_category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('artikel.show', [
            'article' => $article,
            'related' => $related,
        ]);
    }
}
