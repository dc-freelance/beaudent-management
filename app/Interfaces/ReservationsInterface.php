<?php

namespace App\Interfaces;

interface ReservationsInterface
{
    public function datatable_reservations();

    public function datatable_cancel_reservations();

    public function datatable_confirm_reservations();

    public function datatable_deposit();

    public function datatable_cancel_deposit();

    public function datatable_confirm_deposit();

    public function getById($id);

    public function deposit($id, $data);

    public function reschedule($id, $data);

    public function cancel($id);

    public function deposit_cancel($id);

    public function confirm($id);

    public function deposit_confirm($id);

    public function delete($id);
}
