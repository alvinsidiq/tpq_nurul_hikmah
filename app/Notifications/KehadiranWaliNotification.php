<?php

namespace App\Notifications;

use App\Models\Santri;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KehadiranWaliNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Santri $santri,
        protected string $status,
        protected string $tanggal,
        protected ?string $keterangan = null
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $kelasNama = $this->santri->kelas?->nama_kelas ?? '-';
        $statusLabel = [
            'H' => 'Hadir',
            'I' => 'Izin',
            'S' => 'Sakit',
            'A' => 'Alpa',
        ][$this->status] ?? $this->status;

        return (new MailMessage)
            ->subject('Kehadiran Santri — '.$this->santri->nama_lengkap)
            ->greeting('Assalamu\'alaikum, '.$notifiable->name)
            ->line('Data kehadiran terbaru untuk anak:')
            ->line('Nama: '.$this->santri->nama_lengkap)
            ->line('Kelas: '.$kelasNama)
            ->line('Tanggal: '.$this->tanggal)
            ->line('Status: '.$statusLabel)
            ->line('Catatan: '.($this->keterangan ?: '-'))
            ->line('Mohon pantau perkembangan santri. Terima kasih.');
    }
}
