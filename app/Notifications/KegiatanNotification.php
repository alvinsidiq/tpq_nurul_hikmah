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
            ->subject('Informasi Kegiatan TPQ: '.$this->kegiatan->nama)
            ->greeting('Assalamu’alaikum, '.$notifiable->name)
            ->line('Berikut informasi kegiatan terbaru di TPQ:')
            ->line('Judul: '.$this->kegiatan->nama)
            ->line('Tanggal: '.optional($this->kegiatan->tanggal)->format('d F Y'))
            ->line('Lokasi: '.$this->kegiatan->lokasi)
            ->line('Penanggung Jawab: '.($this->kegiatan->penanggung_jawab ?? '-'))
            ->line('Deskripsi:')
            ->line($this->kegiatan->deskripsi ?: '-')
            ->action('Lihat Kegiatan', url('/'))
            ->line('Terima kasih atas perhatian dan dukungannya.');
    }
}
