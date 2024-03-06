<?php

use App\Models\ConfigShift;
use Carbon\Carbon;

function checkSession(){
    $getTimeNow = Carbon::now()->format('H:i:s');
    $checkShiftNow = ConfigShift::where('start_time', '<=', $getTimeNow)
                                ->where('end_time', '>=', $getTimeNow)
                                ->first();
    return $checkShiftNow;
}