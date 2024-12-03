<?php

namespace App\Models;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PelamarAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pelamar;

    public function __construct(Pelamar $pelamar)
    {
        $this->pelamar = $pelamar;
    }

    public function build()
    {
        return $this->subject('Selamat! Anda Diterima')
            ->view('emails.pelamar_accepted')
            ->with([
                'name' => $this->pelamar->name,
                'kategori_id' => $this->pelamar->kategoriloker ? $this->pelamar->kategoriloker->name : 'Tidak Diketahui'
            ]);
    }
}

// PelamarRejectedMail.php
class PelamarRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pelamar;

    public function __construct(Pelamar $pelamar)
    {
        $this->pelamar = $pelamar;
    }
    public function build()
    {
        return $this->subject('Informasi Lamaran Anda')
            ->view('emails.pelamar_rejected')
            ->with([
                'name' => $this->pelamar->name,
                'kategori_id' => $this->pelamar->kategoriloker ? $this->pelamar->kategoriloker->name : 'Tidak Diketahui'
            ]);
    }
}
