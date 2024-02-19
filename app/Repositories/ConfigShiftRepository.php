<?php

namespace App\Repositories;

use App\Interfaces\ConfigShiftInterface;
use App\Models\ConfigShift;

class ConfigShiftRepository  implements ConfigShiftInterface
{
    private $configShift;

    public function __construct(ConfigShift $configShift)
    {
        $this->configShift = $configShift;
    }

    public function get()
    {
        return $this->configShift->get();
    }

    public function getById($id)
    {
        return $this->configShift->find($id);
    }

    public function store($data)
    {
        return $this->configShift->create($data);
    }

    public function update($id, $data)
    {
        return $this->configShift->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->configShift->find($id)->delete();
    }
}
