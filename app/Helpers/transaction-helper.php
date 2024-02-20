<?php

namespace App\Helpers;

use App\Models\Branch;
use App\Models\Sequence;

/**
 * generate transaction code
    $branch = Branch::first();
    $code = 'PCH';
    $year = date('Y');
    $month = date('m');
    $branchId = $branch->id;

    generateTransactionCode($code, $year, $month, $branchId);
 */
if (! function_exists('generateTransactionCode')) {
    function generateTransactionCode($transactionCode, $year, $month, $branch_id)
    {
        $lastNoOfSequence = Sequence::where('code', $transactionCode)
            ->where('year', $year)
            ->where('month', $month)
            ->where('branch_id', $branch_id)
            ->orderBy('no', 'desc')
            ->first();

        $no = 1;

        if ($lastNoOfSequence) {
            $no = $lastNoOfSequence->no + 1;
        }

        $branchCode = Branch::find($branch_id)->code;

        return $transactionCode.'-'.$branchCode.'-'.$year.'-'.$month.'-'.str_pad($no, 3, '0', STR_PAD_LEFT);
    }
}
