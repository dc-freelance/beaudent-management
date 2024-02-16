<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'customers';

    protected $fillable = [
        'name', 'date_of_birth',
        'place_of_birth',
        'identity_number',
        'gender',
        'occupation',
        'phone_number',
        'religion',
        'email',
        'marrital_status',
        'oral_issues',
        'note',
        'instagram',
        'youtube',
        'facebook',
        'source_of_information',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'customer_id', 'id');
    }
}
