<?php

namespace App\Interfaces;

interface SupplierInterface
{
    public function get();

    public function getById($id);

    public function store($data);

    public function update($id, $data);

    public function delete($id);
}
