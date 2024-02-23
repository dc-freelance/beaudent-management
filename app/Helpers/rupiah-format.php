<?php

namespace App\Helpers;

if (!function_exists('rupiahFormat')) {
    function rupiahFormat($number)
    {
        $rupiah = '';

        $split = implode('', array_reverse(str_split(explode('.', $number)[0])));
        for ($i = 0; $i < strlen($number); $i += 3) {
            $rupiah .= substr($split, $i, $i + 3) . '.';

            if ($i >= strlen($number) - 3) {
                $removeDot = implode('', array_reverse(str_split($rupiah)));
                str_split($removeDot)[1] == '.' ? $rupiah = substr($removeDot, 2, strlen($removeDot)) : $rupiah = substr($removeDot, 1, strlen($removeDot));
            };
        };

        return 'Rp ' . $rupiah . ',00';
    }
}
