<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'join_date',
        'password',
        'category_id'
    ];

    public function doctorCategory()
    {
        return $this->belongsTo(DoctorCategory::class, 'category_id');
    }
}
