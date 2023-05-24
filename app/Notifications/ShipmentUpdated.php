<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShipmentUpdated extends Notification
{
    use Queueable;

    protected $shipment;

    protected $shipmentChanges;

    /**
     * Create a new notification instance.
     */
    public function __construct(object $shipment, array $shipmentChanges)
    {
        $this->shipment = $shipment;
        $this->shipmentChanges = $shipmentChanges;
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
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'shipment' => $this->shipment,
            'shipmentChanges' => $this->shipmentChanges,
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Shipment Updated')
            ->subject('Shipment '.$this->shipment->id.' has been updated')
            ->line('Shipment '.$this->shipment->id.' has been updated.')
            ->action('View Shipment', route('shipments.show', ['shipment' => $this->shipment->id]))
            ->line('Thank you for using our application!')
            ->salutation('Regards, '.config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
        ];
    }
}
