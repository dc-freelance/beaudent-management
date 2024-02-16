<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $table = 'treatments';

    protected $fillable = [
        'name',
        'parent_id',
        'is_control',
        'price',
        'branch_id',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'treatment_id', 'id');
    }

    public function treatmentBonus()
    {
        return $this->hasMany(TreatmentBonus::class, 'treatment');
    }

    public function getTreatment()
    {
        return $this->whereNull('parent_id')->get();
    }

    public function discount_treatments()
    {
        return $this->hasMany(Discount_Treatments::class, 'treatment_id', 'id');
    }

    public function getTreatmentById($id)
    {
        return $this->where('id', $id)->first();
    }
}