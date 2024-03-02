<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BranchInterface;
use App\Interfaces\ExaminationInterface;
use App\Interfaces\OdontogramResultInterface;
use App\Interfaces\TransactionInterface;
use Illuminate\Http\Request;

class ExaminationHistoryController extends Controller
{
    private $examination;
    private $odontogramResult;
    private $transaction;
    private $branch;

    public function __construct(ExaminationInterface $examination, OdontogramResultInterface $odontogramResult, TransactionInterface $transaction, BranchInterface $branch)
    {
        $this->examination      = $examination;
        $this->odontogramResult = $odontogramResult;
        $this->transaction      = $transaction;
        $this->branch           = $branch;
    }

    public function index(Request $request)
    {
        $results = $this->examination->getAll();

        if (auth()->user()->hasRole('admin_cabang')) {
            $results = $results->where('reservation.branch_id', auth()->user()->branch_id);
        }

        if ($request->ajax()) {
            return view('admin.examination-history.tables.examination', compact('results'))->render();
        }

        $branches = $this->branch->get()->where('name', '!=', 'Pusat');
        return view('admin.examination-history.index', compact('branches'));
    }

    public function show($id)
    {
        $data                  = $this->examination->getById($id);
        $transaction = $this->transaction->getByExaminationId($id);
        $examinationHistories  = $this->examination->getExaminationByCustomerId($data->customer->id)->examinations;
        $odontogramResults     = $this->odontogramResult->getByExaminationId($id);
        $odontogramGroup       = $this->odontogramResult->groupOdontogramResults($odontogramResults);
        $odontogramForTable    = $this->odontogramResult->groupOdontogramResultsForTable($odontogramGroup);
        $examinationItems      = $this->transaction->getExaminationItems($id);
        $examinationAddons     = $this->transaction->getExaminationAddons($id);
        $examinationTreatments = $this->transaction->getExaminationTreatments($id);
        $transactionSummary    = $this->transaction->getTransactionSummary($id);

        return view('admin.examination-history.show', compact('data', 'examinationHistories', 'odontogramResults', 'odontogramGroup', 'odontogramForTable', 'examinationItems', 'examinationAddons', 'examinationTreatments', 'transactionSummary', 'transaction'));
    }
}
