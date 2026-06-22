<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DiaryEventDeleted extends Notification
{
    use Queueable;

    public function __construct(
        public string $assignedTo,
        public string $eventType,
        public string $eventDate,
        public string $eventTime,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Cancelled: {$this->eventType} removed from your diary")
            ->greeting("Hi {$this->assignedTo},")
            ->line('An event that was assigned to you has been removed.')
            ->line("Type: {$this->eventType}")
            ->line("Date: {$this->eventDate}")
            ->line("Time: {$this->eventTime}")
            ->line('Please check the CRM if you have any questions.');
    }
}