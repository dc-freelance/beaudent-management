<?php

namespace App\Repositories;

use App\Interfaces\DoctorCategoryInterface;
use App\Models\DoctorCategory;

class DoctorCategoryRepository implements DoctorCategoryInterface
{
    private $doctorCategory;

    public function __construct(DoctorCategory $doctorCategory)
    {
        $this->doctorCategory = $doctorCategory;
    }

    public function get()
    {
        return $this->doctorCategory->get()->sortBy('id');
    }

    public function getById($id)
    {
        return $this->doctorCategory->find($id);
    }

    public function store($data)
    {
        return $this->doctorCategory->create($data);
    }

    public function update($id, $data)
    {
        return $this->doctorCategory->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->doctorCategory->find($id)->delete();
    }
}
