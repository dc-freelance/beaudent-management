<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Reschedule extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $data;

    public function __construct($reservation)
    {
        $cta = '';

        if ($reservation->is_control === 0 && $reservation->deposit_status == null) {
            $cta = '<p>
                         Berikutnya harap melakukan pembayaran deposit sebelum tanggal kunjungan anda dengan mengakses tombol dibawah ini
                    </p>
                    <a class="as-btn" href="https://dev-beaudent.baratech.co.id/credential?creds=' . $reservation->customers->email . '">Lakukan Pembayaran</a>
                ';
        };

        $this->data = [
            'id' => $reservation->id,
            'no' => $reservation->no,
            'title' => 'Penjadwalan Ulang Dikonfirmasi',
            'note' => 'Jika terdapat kesalahan data reservasi atau perubahan waktu kunjungan, harap menghubungi layanan
            pelanggan Beaudent melalui kontak tertera dibawah',
            'cta' => $cta,
            'identity_number' => $reservation->customers->identity_number,
            'customer' => $reservation->customers->name,
            'email' => $reservation->customers->email,
            'phone' => $reservation->customers->phone_number,
            'address' => $reservation->customers->address,
            'branch' => $reservation->branches->name,
            'date' => Carbon::parse($reservation->request_date)->isoFormat('D MMMM YYYY'),
            'time' => Carbon::parse($reservation->request_time)->format('H:i'),
            'cs' => $reservation->branches->phone_number,
            'reason' => $reservation->reasons,
            'service' => $reservation->treatments->name
        ];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Penjadwalan Ulang',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email-confirmation.reschedule',
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
