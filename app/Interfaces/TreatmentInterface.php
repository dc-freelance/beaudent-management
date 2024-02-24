<?php

namespace App\Interfaces;

interface TreatmentInterface
{
    public function get();

    public function getParentNull();

    public function getTreatmentCategories();

    public function getById($id);

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}
