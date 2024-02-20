<?php

namespace App\Repositories;

use App\Interfaces\ReservationsInterface;
use App\Models\Reservations;

class ReservationsRepository implements ReservationsInterface
{
    private $reservations;

    public function __construct(Reservations $reservations)
    {
        $this->reservations = $reservations;
    }

    public function datatable_reservations()
    {
        return $this->reservations->where('status', 'Reservation')->orderBy('created_at', 'desc')->get();
    }

    public function datatable_cancel_reservations()
    {
        return $this->reservations->where('status', 'Cancel')->orderBy('updated_at', 'desc')->get();
    }

    public function datatable_confirm_reservations($date = null)
    {
        $query = $this->reservations->where('status', 'Done')
            ->orderBy('request_date', 'asc')
            ->orderBy('request_time', 'asc')
            ->orderBy('updated_at', 'asc');

        if ($date) {
            $query->whereDate('request_date', $date);
        }

        return $query->get();
    }


    public function getById($id)
    {
        return $this->reservations->find($id);
    }

    public function reschedule($id, $data)
    {
        return $this->reservations->find($id)->update([
            'alasan' => $data['alasan'],
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
        return $this->reservations->find($id)->update([
            'status' => 'Done'
        ]);
    }

    public function delete($id)
    {
        return $this->reservations->find($id)->delete();
    }
}