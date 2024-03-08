<?php

namespace App\Repositories;

use App\Interfaces\PaymentMethodsInterface;
use App\Models\PaymentMethods;

class PaymentMethodsRepository implements PaymentMethodsInterface
{
    private $payment_methods;

    public function __construct(PaymentMethods $payment_methods)
    {
        $this->payment_methods = $payment_methods;
    }

    public function get()
    {
        return $this->payment_methods->get();
    }

    public function getById($id)
    {
        return $this->payment_methods->find($id);
    }

    public function create($data)
    {
        return $this->payment_methods->create($data);
    }

    public function update($id, $data)
    {
        return $this->payment_methods->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->payment_methods->find($id)->delete();
    }
}
