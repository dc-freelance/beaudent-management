<?php

namespace App\Repositories;

use App\Interfaces\CustomerInterface;
use App\Models\Customers;

class CustomerRepository implements CustomerInterface
{
    private $customer;

    public function __construct(Customers $customer)
    {
        $this->customer = $customer;
    }

    public function get()
    {
        return $this->customer->all()->sortBy('id');
    }

    public function getById($id)
    {
        return $this->customer->find($id);
    }

    public function store($data)
    {
        $this->customer->create($data);
    }

    public function update($id, $data)
    {
        $customer = $this->customer->find($id);
        $customer->update($data);
    }

    public function delete($id)
    {
        $customer = $this->customer->find($id);
        $customer->delete();
    }
}