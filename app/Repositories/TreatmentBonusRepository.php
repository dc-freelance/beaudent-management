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

    private function setBonusRate($bonusType, $bonusRate)
    {
        if ($bonusType == 'nominal') {
            return str_replace('.', '', $bonusRate);
        }

        return $bonusRate;
    }

    public function store($data)
    {
        // $data['bonus_rate'] = $this->setBonusRate($data['bonus_type'], $data['bonus_rate']);
        return $this->treatmentBonus->create($data);
    }

    public function update($id, $data)
    {
        // $data['bonus_rate'] = $this->setBonusRate($data['bonus_type'], $data['bonus_rate']);
        return $this->treatmentBonus->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->treatmentBonus->find($id)->delete();
    }
}
