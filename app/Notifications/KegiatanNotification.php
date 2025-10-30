<?php

namespace App\Notifications;

use App\Models\Kegiatan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KegiatanNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Kegiatan $kegiatan)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Kegiatan TPQ: '.$this->kegiatan->nama)
            ->line('Assalamu’alaikum, berikut informasi kegiatan TPQ:')
            ->line('Nama: '.$this->kegiatan->nama)
            ->line('Tanggal: '.$this->kegiatan->tanggal)
            ->line('Lokasi: '.($this->kegiatan->lokasi ?: '-'))
            ->line('Deskripsi: '.($this->kegiatan->deskripsi ?: '-'))
            ->line('Terima kasih.');
    }
}
