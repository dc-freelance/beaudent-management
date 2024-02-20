<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'join_date',
        'password',
        'category_id',
    ];

    public function doctorCategory()
    {
        return $this->belongsTo(DoctorCategory::class, 'category_id');
    }

    public function doctorSchedule()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }
}
