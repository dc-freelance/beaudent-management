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

    public function __construct($reservation, $status)
    {
        $title = '';
        $action = '';
        $note = '';
        $cta = '';
        if ($status === true) {
            $title = 'Reservasi Dikonfirmasi';
            $action = 'mengonfirmasi';
            $note = 'Jika terdapat kesalahan data reservasi atau perubahan waktu kunjungan, harap menghubungi layanan
            pelanggan Beaudent melalui kontak tertera dibawah';

            if ($reservation->is_control === 0) {
                $cta = '<p>
                            Berikutnya harap melakukan pembayaran deposit sebelum tanggal kunjungan anda dengan mengakses tombol dibawah ini
                        </p>
                        <a class="as-btn" href="https://dev-beaudent.baratech.co.id/credential?creds=' . $reservation->customers->email . '">Lakukan Pembayaran</a>
                        ';
            } else {
                $cta = '<p>
                            Reservasi anda telah berhasil dan akan berakhir setelah tanggal kunjungan anda. Anda dapat melihat kembali detail reservasi dengan mengakses tombol dibawah ini
                        </p>
                        <a class="as-btn" href="https://dev-beaudent.baratech.co.id/credential?creds=' . $reservation->customers->email . '">Lihat Detail</a>
                    ';
            };
        } else {
            $title = 'Reservasi Dibatalkan';
            $action = 'membatalkan';
            $note = 'Jika anda membutuhkan informasi lebih lanjut mengenai pembatalan ini, harap menghubungi layanan
            pelanggan Beaudent melalui kontak tertera dibawah ini';
        };

        $this->data = [
            'id' => $reservation->id,
            'no' => $reservation->no,
            'title' => $title,
            'action' => $action,
            'note' => $note,
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
            'service' => $reservation->treatments->name
        ];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservasi Beaudent',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email-confirmation.reservation-confirmation',
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
