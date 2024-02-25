<?php

namespace App\Repositories;

use App\Interfaces\ReservationsInterface;
use App\Models\Reservations;
use Carbon\Carbon;

use function App\Helpers\rupiahFormat;

class ReservationsRepository implements ReservationsInterface
{
    private $reservations;

    public function __construct(Reservations $reservations)
    {
        $this->reservations = $reservations;
    }

    public function datatable_reservations($date = null, $status = null)
    {
        $query = $this->reservations->where('status', $status)
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
}
