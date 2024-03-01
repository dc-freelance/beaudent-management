<?php

namespace App\Repositories;

use App\Interfaces\TreatmentReportInterface;
use App\Models\ExaminationTreatment;
use App\Models\Reservations;
use Illuminate\Support\Facades\DB;

class TreatmentReportRepository implements TreatmentReportInterface
{
    private $ExaminationTreatment;

    public function __construct(ExaminationTreatment $ExaminationTreatment)
    {
        $this->ExaminationTreatment = $ExaminationTreatment;
    }

    public function getGeneral()
    {
        $results = $this->ExaminationTreatment
                ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                    $query->where('created_at', '>=', request('start_date'))
                        ->where('created_at', '<=', request('end_date') . ' 23:59:59');
                })
                ->with('examination', 'treatment')
                ->select('examination_treatments.treatment_id',
                        'examination_treatments.examination_id',
                        DB::raw('SUM(examination_treatments.qty) as total_qty'),
                        DB::raw('SUM(examination_treatments.sub_total) as total_sub_total'))
                ->groupBy('treatment_id')
                ->orderBy('total_sub_total', 'desc')
                ->get();
        $results->transform(function ($value) {
            $branch_id = Reservations::find($value->examination->id)->branch_id;
            $value->branch_id = $branch_id;
            return $value;
        });
        $collection = collect($results);
        if (request()->has('branch_id') || request()->filled('branch_id')) {
            if ( request()->get('branch_id') == null) {
                return $collection;
            }
            return $collection->where('branch_id',request('branch_id'));
        }


    }

    public function exportGeneral()
    {
        $results = $this->ExaminationTreatment
                ->when(request()->filled('start_date') && request()->filled('end_date'), function ($query) {
                    $query->where('created_at', '>=', request('start_date'))
                        ->where('created_at', '<=', request('end_date') . ' 23:59:59');
                })
                ->with('examination', 'treatment')
                ->select('examination_treatments.treatment_id',
                        'examination_treatments.examination_id',
                        DB::raw('SUM(examination_treatments.qty) as total_qty'),
                        DB::raw('SUM(examination_treatments.sub_total) as total_sub_total'))
                ->groupBy('treatment_id')
                ->orderBy('total_sub_total', 'desc')
                ->get();
        $results->transform(function ($value) {
            $branch_id = Reservations::find($value->examination->id)->branch_id;
            $value->branch_id = $branch_id;
            return $value;
        });
        $collection = collect($results);
        if (request()->has('branch_id') || request()->filled('branch_id')) {
           $resultsData =  $collection->where('branch_id',request('branch_id'));
        }
        $resultsData = $collection;

        return $resultsData->map(function ($data) {
            return [
                'nama_layanan' => $data->treatment->name,
                'jumlah_transaksi' => $data->total_qty,
                'total_transaksi' => $data->total_sub_total,
            ];
        });
    }
}
