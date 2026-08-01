<?php

namespace App\Support;

use Illuminate\Support\Str;

class Highlighter
{
    /**
     * Bungkus tiap kemunculan $keyword di $safeHtml (yang sudah aman/di-escape)
     * pakai <mark>. Case-insensitive. $safeHtml WAJIB sudah di-escape sebelumnya
     * (via e()) — fungsi ini cuma nambah tag <mark>, gak nge-escape apa-apa.
     */
    public static function mark(string $safeHtml, string $keyword): string
    {
        $keyword = trim($keyword);
        if ($keyword === '') {
            return $safeHtml;
        }

        $pattern = '/' . preg_quote($keyword, '/') . '/iu';

        $result = preg_replace(
            $pattern,
            '<mark class="search-highlight">$0</mark>',
            $safeHtml
        );

        return $result ?? $safeHtml;
    }

    /**
     * Ambil potongan teks polos (tag HTML di-strip) di sekitar kemunculan
     * pertama $keyword di $html, dikasih "…" kalau kepotong di ujung, lalu
     * di-escape dan kata kuncinya di-mark. Dipakai buat nampilin "kenapa
     * artikel ini match" pas keyword-nya cuma ketemu di content, bukan title.
     */
    public static function snippet(string $html, string $keyword, int $radius = 90): string
    {
        $plain = trim(preg_replace('/\s+/', ' ', strip_tags($html)) ?? '');
        $keyword = trim($keyword);

        $position = $keyword !== '' ? mb_stripos($plain, $keyword) : false;

        if ($position === false) {
            return e(Str::limit($plain, $radius * 2));
        }

        $start = max(0, $position - $radius);
        $length = mb_strlen($keyword) + ($radius * 2);
        $excerpt = mb_substr($plain, $start, $length);

        if ($start > 0) {
            $excerpt = '…'.ltrim($excerpt);
        }
        if ($start + $length < mb_strlen($plain)) {
            $excerpt = rtrim($excerpt).'…';
        }

        return self::mark(e($excerpt), $keyword);
    }
}
