<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketStatusNotification extends Notification
{
    use Queueable;
    protected $ticket;
    protected $type;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket, $type)
    {
        $this->ticket = $ticket;
        $this->type = $type; // "created" or "closed"
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'ticket_code' => $this->ticket->ticket_code,
            'status' => $this->type === 'Open' ? 'Open' : 'Closed',
            'message' => $this->type === 'Open'
                ? "A new ticket has been created.Ticket ID: #{$this->ticket->ticket_code}."
                : "The Ticket ID: #{$this->ticket->ticket_code} has been closed.",
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'ticket_id' => $this->ticket->id,
            'ticket_code' => $this->ticket->ticket_code,
            'status' => $this->type === 'Open' ? 'Open' : 'Closed',
            'message' => $this->type === 'Open'
                ? "A new ticket has been created.Ticket ID: #{$this->ticket->ticket_code}."
                : "The Ticket ID: #{$this->ticket->ticket_code} has been closed.",
        ];
    }

}
