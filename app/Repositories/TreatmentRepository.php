<?php

namespace App\Repositories;

use App\Interfaces\TreatmentInterface;
use App\Models\Treatment;
use App\Models\TreatmentCategories;

class TreatmentRepository implements TreatmentInterface
{
    private $treatment, $treatment_categories;

    public function __construct(Treatment $treatment, TreatmentCategories $treatment_categories)
    {
        $this->treatment = $treatment;
        $this->treatment_categories = $treatment_categories;
    }

    public function get()
    {
        return $this->treatment->get();
    }

    public function getParentNull()
    {
        return $this->treatment->where('parent_id', null)->get();
    }

    public function getTreatmentCategories()
    {
        return $this->treatment_categories->all();
    }

    public function getById($id)
    {
        return $this->treatment->find($id);
    }

    public function create($data)
    {
        $data['price'] = str_replace('.', '', $data['price']);
        return $this->treatment->create($data);
    }

    public function update($id, $data)
    {
        $data['price'] = str_replace('.', '', $data['price']);
        return $this->treatment->find($id)->update($data);
    }

    public function delete($id)
    {
        $treatment = $this->treatment->find($id);
        if ($treatment->parent_id == null) {
            $this->treatment->where('parent_id', $treatment->id)->delete();
        }

        return $treatment->delete();
    }
}
