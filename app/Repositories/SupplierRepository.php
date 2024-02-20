<?php

namespace App\Repositories;

use App\Interfaces\SupplierInterface;
use App\Models\Supplier;

class SupplierRepository implements SupplierInterface
{
    private $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function get()
    {
        return $this->supplier->get()->sortByDesc('id');
    }

    public function getById($id)
    {
        return $this->supplier->find($id);
    }

    public function store($data)
    {
        return $this->supplier->create($data);
    }

    public function update($id, $data)
    {
        return $this->supplier->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->supplier->find($id)->delete();
    }
}
