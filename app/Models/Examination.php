<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'medical_record_id',
        'customer_id',
        'examination_date',
        'systolic_blood_pressure',
        'diastolic_blood_pressure',
        'blood_type',
        'heart_disease',
        'diabetes',
        'blood_clotting_disorder',
        'hepatitis',
        'digestive_diseases',
        'other_diseases',
        'allergies_to_medicines',
        'medications', // if allergies to medicines fill this
        'allergies_to_food',
        'foods', // if alergies to food fill this
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function odontogramResults()
    {
        return $this->hasMany(OdontogramResult::class);
    }
}
