<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Reservations extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reservations';

    protected $guarded = [];

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

    public function treatments()
    {
        return $this->belongsTo(Treatment::class, 'treatment_id', 'id');
    }

    public function getTanggalReservasiTextAttribute()
    {
        return Carbon::parse($this->request_date)->locale('id')->isoFormat('LL');
    }

    public function getTanggalTransferTextAttribute()
    {
        return Carbon::parse($this->transfer_date)->locale('id')->isoFormat('LL');
    }

    public function getWaktuReservasiTextAttribute()
    {
        return Carbon::parse($this->request_time)->locale('id')->isoFormat('LT');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'reservation_id', 'id');
    }
}