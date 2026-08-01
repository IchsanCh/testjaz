<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'message', 'is_read'])]
class ContactSubmission extends Model
{
    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    // Link mailto: standar, recipient + subject udah keisi otomatis
    public function getEmailUrlAttribute(): string
    {
        $subject = 'Re: Pesan Anda ke AL HIJAZ';
        $body = "Halo {$this->name},\n\nTerima kasih sudah menghubungi kami.\n\n---\nPesan Anda:\n{$this->message}";

        return 'mailto:'.$this->email.'?subject='.rawurlencode($subject).'&body='.rawurlencode($body);
    }
}
