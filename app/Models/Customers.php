<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';

    protected $guarded = [];

    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'customer_id', 'id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'customer_id', 'id');
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class, 'customer_id', 'id');
    }
}
