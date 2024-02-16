<?php

namespace App\Repositories;

use App\Interfaces\TreatmentInterface;
use App\Models\Treatment;

class TreatmentRepository implements TreatmentInterface
{
    private $treatment;

    public function __construct(Treatment $treatment)
    {
        $this->treatment = $treatment;
    }

    public function get()
    {
        return $this->treatment->get();
    }

    public function getParentNull()
    {
        return $this->treatment->where('parent_id', null)->get();
    }

    public function getById($id)
    {
        return $this->treatment->find($id);
    }

    public function create($data)
    {
        return $this->treatment->create($data);
    }

    public function update($id, $data)
    {
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