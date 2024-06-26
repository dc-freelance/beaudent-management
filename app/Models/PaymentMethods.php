<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethods extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payment_methods';
    protected $guarded = [];

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'payment_method_id', 'id');
    }
}
