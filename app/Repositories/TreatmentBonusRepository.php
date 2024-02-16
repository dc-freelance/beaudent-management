<?php

namespace App\Repositories;

use App\Interfaces\TreatmentBonusInterface;
use App\Models\TreatmentBonus;

class TreatmentBonusRepository implements TreatmentBonusInterface
{
    private $treatmentBonus;

    public function __construct(TreatmentBonus $treatmentBonus)
    {
        $this->treatmentBonus = $treatmentBonus;
    }

    public function get()
    {
        return $this->treatmentBonus->with('treatment', 'doctorCategory')->get();
    }

    public function getById($id)
    {
        return $this->treatmentBonus->with('treatment', 'doctorCategory')->find($id);
    }

    public function store($data)
    {
        return $this->treatmentBonus->create($data);
    }

    public function update($id, $data)
    {
        return $this->treatmentBonus->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->treatmentBonus->find($id)->delete();
    }
}
