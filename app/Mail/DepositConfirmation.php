<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DepositConfirmation extends Mailable
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
            $title = 'Pembayaran Dikonfirmasi';
            $action = 'mengonfirmasi';
            $note = 'Jika terdapat kesalahan dalam pembayaran deposit, harap menghubungi layanan
            pelanggan Beaudent melalui kontak tertera dibawah';
            $cta = '<p>
                        Reservasi anda telah berhasil dan akan berakhir setelah tanggal kunjungan anda. Anda dapat melihat kembali detail reservasi dengan mengakses tombol dibawah ini
                    </p>
                    <a class="as-btn" href="https://dev-beaudent.baratech.co.id/credential">Lihat Detail</a>
                ';
        } else {
            $title = 'Pembayaran Dibatalkan';
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
            'count' => $reservation->deposit,
            'rek' => $reservation->customer_bank_account,
            'transfer' => Carbon::parse($reservation->transfer_date)->isoFormat('D MMMM YYYY'),
            'cs' => $reservation->branches->phone_number,
        ];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Deposit Beaudent',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'deposit-confirmation',
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
