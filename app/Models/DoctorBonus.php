<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorBonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'examination_treatment_id',
        'doctor_id',
        'bonus',
        'branch_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function examinationTreatment()
    {
        return $this->belongsTo(ExaminationTreatment::class);
    }
}
