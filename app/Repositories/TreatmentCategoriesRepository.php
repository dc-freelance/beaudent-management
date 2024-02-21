<?php

namespace App\Repositories;

use App\Interfaces\TreatmentCategoriesInterface;
use App\Models\TreatmentCategories;

class TreatmentCategoriesRepository implements TreatmentCategoriesInterface
{
    private $treatment_categories;

    public function __construct(TreatmentCategories $treatment_categories)
    {
        $this->treatment_categories = $treatment_categories;
    }

    public function get()
    {
        return $this->treatment_categories->get();
    }

    public function getById($id)
    {
        return $this->treatment_categories->find($id);
    }

    public function create($data)
    {
        return $this->treatment_categories->create($data);
    }

    public function update($id, $data)
    {
        return $this->treatment_categories->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->treatment_categories->find($id)->delete();
    }
}
