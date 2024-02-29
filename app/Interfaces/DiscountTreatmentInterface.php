<?php

namespace App\Interfaces;

interface DiscountTreatmentInterface
{
    public function get();

    public function getById($id);

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}
