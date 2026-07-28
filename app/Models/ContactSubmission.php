<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'whatsapp_number', 'email', 'message', 'is_read'])]
class ContactSubmission extends Model
{
    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    // Nomor WA disimpan apa adanya (bisa 08xx atau +62xx), ini nyamain ke format wa.me (62xx)
    public function getWhatsappUrlAttribute(): string
    {
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp_number);

        if (str_starts_with($number, '0')) {
            $number = '62'.substr($number, 1);
        }

        $message = "Halo {$this->name}, terima kasih sudah menghubungi AL HIJAZ. ";

        return 'https://wa.me/'.$number.'?text='.urlencode($message);
    }

    // Link compose Gmail otomatis, recipient & subject udah keisi. Null kalau email gak diisi
    public function getEmailUrlAttribute(): ?string
    {
        if (blank($this->email)) {
            return null;
        }

        $subject = 'Re: Pesan Anda ke AL HIJAZ';
        $body = "Halo {$this->name},\n\nTerima kasih sudah menghubungi kami.\n\n---\nPesan Anda:\n{$this->message}";

        return 'https://mail.google.com/mail/?view=cm&fs=1'
            .'&to='.urlencode($this->email)
            .'&su='.urlencode($subject)
            .'&body='.urlencode($body);
    }
}
