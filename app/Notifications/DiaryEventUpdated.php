<?php

namespace App\Notifications;

use App\Models\Diary;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DiaryEventUpdated extends Notification
{
    use Queueable;

    public function __construct(public Diary $diary) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $diary = $this->diary;

        return (new MailMessage)
            ->subject("Updated: {$diary->event_type} on your diary")
            ->greeting("Hi {$diary->assigned_to},")
            ->line('An event on your diary has been updated.')
            ->line("Type: {$diary->event_type}")
            ->line('Date: '.$diary->event_date->format('F j, Y'))
            ->line('Time: '.$diary->startsAt->format('g:i A'))
            ->when($diary->notes, fn ($mail) => $mail->line("Notes: {$diary->notes}"))
            ->line('Please check the CRM for full details.');
    }
}