<?php

namespace App\Interfaces;

interface ReservationsInterface
{
    public function datatable_reservations();

    public function datatable_cancel_reservations();

    public function datatable_confirm_reservations();

    public function getById($id);

    public function deposit($id, $data);

    public function reschedule($id, $data);

    public function cancel($id);

    public function confirm($id);

    public function delete($id);
}
