<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class EmailVerificationOtp extends Notification
{
    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $otp = str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        $notifiable->forceFill([
            'email_verification_otp' => $otp,
            'email_verification_otp_sent_at' => now(),
        ])->save();

        return (new MailMessage)
            ->subject('Kod OTP Pengesahan Emel – Dapur Siswa MADANI UPSI')
            ->greeting('Salam Sejahtera,')
            ->line('Kod OTP anda untuk pengesahan emel adalah:')
            ->line('**'.$otp.'**')
            ->line('Sila masukkan kod ini di halaman pengesahan emel. Kod ini sah selama '.Config::get('auth.verification.otp_expire', 10).' minit.')
            ->line('Jika anda tidak memohon kod ini, tiada tindakan lanjut diperlukan.');
    }
}
