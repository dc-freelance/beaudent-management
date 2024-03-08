<?php

namespace App\Interfaces;

interface TreatmentCategoriesInterface
{
    public function get();

    public function getById($id);

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}
