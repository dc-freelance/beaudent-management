<?php

namespace App\Interfaces;

interface ReservationsInterface
{
    public function datatable_reservations($date, $status);

    public function getById($id);

    public function deposit($id, $data);

    public function reschedule($id, $data);

    public function cancel($id);

    public function confirm($id);

    public function deposit_confirm($id);

    public function delete($id);

    public function list_billing($branch);

    public function detail_reservation($id);
}
