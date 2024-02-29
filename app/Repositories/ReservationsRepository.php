<?php

namespace App\Repositories;

use App\Interfaces\ReservationsInterface;
use App\Models\Reservations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\rupiahFormat;

class ReservationsRepository implements ReservationsInterface
{
    private $reservations;

    public function __construct(Reservations $reservations)
    {
        $this->reservations = $reservations;
    }

    // public function reservation_confirmation($num, $status, $reservation)
    // {
    //     $curl = curl_init();

    //     $data = [
    //         'title' => '',
    //         'no' => $reservation->no,
    //         'action' => '',
    //         'date' => Carbon::parse($reservation->request_date)->isoFormat('D MMMM YYYY'),
    //         'time' => Carbon::parse($reservation->request_time)->format('H:i'),
    //         'note' => '',
    //         'cta' => '',
    //         'cs' => $reservation->branches->phone_number
    //     ];

    //     if ($status === true) {
    //         $data['title'] = 'Reservasi Dikonfirmasi';
    //         $data['action'] = 'mengonfirmasi';
    //         $data['note'] = 'Jika terdapat kesalahan data reservasi atau perubahan waktu kunjungan, harap menghubungi layanan pelanggan Beaudent melalui kontak tertera dibawah';

    //         if ($reservation->is_control === 0) {
    //             $data['cta'] = 'Berikutnya harap melakukan pembayaran deposit sebelum tanggal kunjungan anda dengan mengakses tautan ini : https://dev-beaudent.baratech.co.id/credential?creds=' . urlencode(base64_encode($reservation->customers->email));
    //         } else {
    //             $data['cta'] = 'Reservasi anda telah berhasil dan akan berakhir setelah tanggal kunjungan anda. Anda dapat melihat kembali detail reservasi dengan mengakses tautan ini : https://dev-beaudent.baratech.co.id/credential?creds=' . urlencode(base64_encode($reservation->customers->email));
    //         };
    //     } else {
    //         $data['title'] = 'Reservasi Dibatalkan';
    //         $data['action'] = 'membatalkan';
    //         $data['note'] = 'Jika anda membutuhkan informasi lebih lanjut mengenai pembatalan ini, harap menghubungi layanan pelanggan Beaudent melalui kontak tertera dibawah ini';
    //     };

    //     $post = array(
    //         'appkey' => 'a099da47-8105-4cd5-8862-a98a083b5685',
    //         'authkey' => '2GuoDijnXxzS52ahvkDzCAKUkFGlL2uYEsirRJ2VHbG2K4D5xs',
    //         'to' => '62' . $num,
    //         'template_id' => '222c63ab-1b89-45f6-80f5-867150488c97',
    //         'variables' => array(
    //             '{title}' => $data['title'],
    //             '{no}' => $data['no'],
    //             '{action}' => $data['action'],
    //             '{branch}' => $reservation->branches->name,
    //             '{date}' => $data['date'],
    //             '{time}' => $data['time'],
    //             '{treatment}' => $reservation->treatments->name,
    //             '{note}' => $data['note'],
    //             '{cta}' => $data['cta'],
    //             '{branch_cs}' => str_split($data['cs'])[0] == '0' ? substr($data['cs'], 1) : $data['cs']
    //         )
    //     );

    //     $post_to_send = http_build_query($post);

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://app.saungwa.com/api/create-message',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => $post_to_send
    //     ));

    //     curl_exec($curl);

    //     curl_close($curl);
    // }

    // public function deposit_confirmation($num, $reservation)
    // {
    //     $curl = curl_init();

    //     $data = [
    //         'title' => '',
    //         'no' => $reservation->no,
    //         'action' => '',
    //         'transfer' => Carbon::parse($reservation->transfer_date)->isoFormat('D MMMM YYYY'),
    //         'note' => '',
    //         'cta' => '',
    //         'cs' => $reservation->branches->phone_number
    //     ];

    //     $data['title'] = 'Pembayaran Dikonfirmasi';
    //     $data['action'] = 'mengonfirmasi';
    //     $data['note'] = 'Jika terdapat kesalahan dalam pembayaran deposit, harap menghubungi layanan pelanggan Beaudent melalui kontak tertera dibawah';
    //     $data['cta'] = 'Reservasi anda telah berhasil dan akan berakhir setelah tanggal kunjungan anda. Anda dapat melihat kembali detail reservasi dengan mengakses tautan ini : https://dev-beaudent.baratech.co.id/credential?creds=' . urlencode(base64_encode($reservation->customers->email));

    //     $post = array(
    //         'appkey' => 'a099da47-8105-4cd5-8862-a98a083b5685',
    //         'authkey' => '2GuoDijnXxzS52ahvkDzCAKUkFGlL2uYEsirRJ2VHbG2K4D5xs',
    //         'to' => '62' . $num,
    //         'template_id' => '3e923658-9740-4738-946d-813c3901a82a',
    //         'variables' => array(
    //             '{title}' => $data['title'],
    //             '{no}' => $data['no'],
    //             '{action}' => $data['action'],
    //             '{branch}' => $reservation->branches->name,
    //             '{deposit}' => rupiahFormat($reservation->deposit),
    //             '{rek}' => $reservation->customer_bank_account,
    //             '{transfer}' => $data['transfer'],
    //             '{note}' => $data['note'],
    //             '{cta}' => $data['cta'],
    //             '{branch_cs}' => str_split($data['cs'])[0] == '0' ? substr($data['cs'], 1) : $data['cs']
    //         )
    //     );

    //     $post_to_send = http_build_query($post);

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://app.saungwa.com/api/create-message',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => $post_to_send
    //     ));

    //     curl_exec($curl);

    //     curl_close($curl);
    // }

    // public function reschedule_confirmation($num, $reservation, $request)
    // {
    //     $curl = curl_init();

    //     $data = [
    //         'title' => 'Penjadwalan Ulang Dikonfirmasi',
    //         'no' => $reservation->no,
    //         'transfer' => Carbon::parse($reservation->transfer_date)->isoFormat('D MMMM YYYY'),
    //         'note' => 'Jika terdapat kesalahan data reservasi atau perubahan waktu kunjungan, harap menghubungi layanan pelanggan Beaudent melalui kontak tertera dibawah',
    //         'cta' => '',
    //         'cs' => $reservation->branches->phone_number
    //     ];

    //     if ($reservation->is_control === 0 && $reservation->status == 'Waiting Deposit') {
    //         $data['cta'] = 'Berikutnya harap melakukan pembayaran deposit sebelum tanggal kunjungan anda dengan mengakses tautan dibawah ini : https://dev-beaudent.baratech.co.id/credential?creds=' . urlencode(base64_encode($reservation->customers->email));
    //     };

    //     $post = array(
    //         'appkey' => 'a099da47-8105-4cd5-8862-a98a083b5685',
    //         'authkey' => '2GuoDijnXxzS52ahvkDzCAKUkFGlL2uYEsirRJ2VHbG2K4D5xs',
    //         'to' => '62' . $num,
    //         'template_id' => '022c0758-998c-46c2-900f-89316a9a2011',
    //         'variables' => array(
    //             '{title}' => $data['title'],
    //             '{no}' => $data['no'],
    //             '{branch}' => $reservation->branches->name,
    //             '{treatment}' => $reservation->treatments->name,
    //             '{date}' => Carbon::parse($request['request_date'])->isoFormat('D MMMM YYYY'),
    //             '{time}' => Carbon::parse($request['request_time'])->format('H:i'),
    //             '{note}' => $data['note'],
    //             '{cta}' => $data['cta'],
    //             '{reason}' => $request['reasons'],
    //             '{branch_cs}' => str_split($data['cs'])[0] == '0' ? substr($data['cs'], 1) : $data['cs']
    //         )
    //     );

    //     $post_to_send = http_build_query($post);

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://app.saungwa.com/api/create-message',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => $post_to_send
    //     ));

    //     curl_exec($curl);

    //     curl_close($curl);
    // }

    public function datatable_reservations($date = null, $status = null)
    {
        $query = null;
        Auth::user()->branch_id == null ?
            $query = $this->reservations->where('status', $status)
            ->whereDate('request_date', $date)
            ->orderBy('request_date', 'asc')
            ->orderBy('request_time', 'asc')->get()
            :
            $query = $this->reservations->where('branch_id', Auth::user()->branch_id)
            ->where('status', $status)
            ->whereDate('request_date', $date)
            ->orderBy('request_date', 'asc')
            ->orderBy('request_time', 'asc')->get();

        if ($query) {
            foreach ($query as $reservation) {
                if ($reservation->deposit != null) {
                    $reservation->deposit = rupiahFormat($reservation->deposit);
                };
            };
        };

        return $query;
    }


    public function getById($id)
    {
        return $this->reservations->find($id);
    }

    public function deposit($id, $data)
    {
        return $this->reservations->find($id)->update([
            'deposit' => $data['deposit'],
            'status' => 'Pending Deposit',
            'deposit_receipt' => $data['deposit_receipt'],
            'customer_bank_account' => $data['customer_bank_account'],
            'customer_bank' => $data['customer_bank'],
            'customer_bank_account_name' => $data['customer_bank_account_name'],
            'transfer_date' => $data['transfer_date']
        ]);
    }

    public function reschedule($id, $data)
    {
        return $this->reservations->find($id)->update([
            'reasons' => $data['reasons'],
            'request_time' => $data['request_time'],
            'request_date' => $data['request_date']
        ]);
    }

    public function cancel($id)
    {
        return $this->reservations->find($id)->update([
            'status' => 'Cancel'
        ]);
    }

    public function confirm($id)
    {
        $reservation = $this->reservations->find($id);

        $reservation->is_control == 1 ?
            $reservation->update([
                'status' => 'Confirm'
            ])
            :
            $reservation->update([
                'status' => 'Waiting Deposit'
            ]);
    }

    public function deposit_confirm($id)
    {
        return $this->reservations->find($id)->update([
            'status' => 'Confirm'
        ]);
    }

    public function delete($id)
    {
        return $this->reservations->find($id)->delete();
    }

    public function list_billing($branch)
    {
        return $this->reservations->with('branches', 'customers', 'treatments')
            ->where('status', 'Billing')
            ->where('branch_id', $branch)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function detail_reservation($id)
    {
        return $this->reservations->with('branches', 'customers', 'treatments')->find($id);
    }
}
