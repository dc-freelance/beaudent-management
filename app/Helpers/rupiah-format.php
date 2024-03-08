<?php

namespace App\Helpers;

if (!function_exists('rupiahFormat')) {
    function rupiahFormat($number)
    {
        return 'Rp ' . number_format(explode('.', $number)[0], 2, ',', '.');
    }
}
