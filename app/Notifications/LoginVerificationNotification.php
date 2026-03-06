<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginVerificationNotification extends Notification
{
    use Queueable;

    /**
     * The gym name to include in the email.
     */
    protected string $gymName;
    
    /**
     * The verification code.
     */
    protected string $verificationCode;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $gymName = 'GymCenter', string $verificationCode = '')
    {
        $this->gymName = $gymName;
        $this->verificationCode = $verificationCode;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject("Verify your login to {$this->gymName}")
            ->greeting("Welcome to {$this->gymName}!")
            ->line('We noticed a login attempt to your account.')
            ->line('Use the verification code below to verify your login:');
        
        // Add the 6-digit code prominently
        if ($this->verificationCode) {
            $mail->line('')
                ->line('')
                ->line('')
                ->subject("Your verification code: {$this->verificationCode}")
                ->line('')
                ->line('');
            
            // Render the code in a larger format
            $mail = $mail->view('emails.verification-code', [
                'code' => $this->verificationCode,
                'gymName' => $this->gymName
            ]);
        }
        
        return $mail
            ->line('This code will expire in 10 minutes.')
            ->line('If you did not attempt to log in, please secure your account immediately.')
            ->salutation("Best regards,\n{$this->gymName}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
