<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $data;

    public function __construct($reservation)
    {
        $this->data = [
            'id' => $reservation->id,
            'no' => $reservation->no,
            'identity_number' => $reservation->customers->identity_number,
            'customer' => $reservation->customers->name,
            'email' => $reservation->customers->email,
            'phone' => $reservation->customers->phone_number,
            'address' => $reservation->customers->address,
            'branch' => $reservation->branches->name,
            'date' => Carbon::parse($reservation->request_date)->isoFormat('D MMMM YYYY'),
            'time' => Carbon::parse($reservation->request_time)->format('H:i'),
            'cs' => $reservation->branches->phone_number,
            'service' => $reservation->treatments->name
        ];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Konfirmasi Reservasi Beaudent',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'reservation-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
