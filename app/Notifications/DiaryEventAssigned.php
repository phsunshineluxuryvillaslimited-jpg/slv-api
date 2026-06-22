<?php

namespace App\Notifications;

use App\Models\Diary;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DiaryEventAssigned extends Notification
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
            ->subject("New {$diary->event_type} scheduled for you")
            ->greeting("Hi {$diary->assigned_to},")
            ->line('A new event has been added to your diary.')
            ->line("Type: {$diary->event_type}")
            ->line('Date: '.$diary->event_date->format('F j, Y'))
            ->line('Time: '.$diary->startsAt->format('g:i A'))
            ->line('Please check the CRM for full details.');
    }
}