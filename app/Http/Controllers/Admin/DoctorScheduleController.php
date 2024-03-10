<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorScheduleInterface;
use App\Interfaces\DoctorInterface;
use App\Interfaces\BranchInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\DoctorSchedule;

class DoctorScheduleController extends Controller
{
    private $doctorSchedule;
    private $doctor;
    private $branch;

    public function __construct(DoctorScheduleInterface $doctorSchedule, DoctorInterface $doctor, BranchInterface $branch)
    {
        $this->doctorSchedule = $doctorSchedule;
        $this->doctor = $doctor;
        $this->branch = $branch;
    }

    public function index(Request $request)
    {
        $datas = $this->doctorSchedule->get();
        if ($request->ajax()) {
            return datatables()
                ->of($datas)
                ->addColumn('doctor', function ($data) {
                    return $data->doctor ? $data->doctor->name : '-';
                })
                ->addColumn('branch', function ($data) {
                    return $data->branch ? $data->branch->name : '-';
                })
                ->addColumn('date', function ($data) {
                    return Carbon::parse($data->date)->format('Y-m-d');
                })
                ->addColumn('shift', function ($data) {
                    return $data->shift;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.doctor-schedule.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.doctor-schedule.index');
    }

    public function getById($id)
    {
        return $this->doctorSchedule->getById($id);
    }

    public function create()
    {
        $doctor = $this->doctor->get();
        $branch = $this->branch->get();

        return view('admin.doctor-schedule.create', compact('doctor', 'branch'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'branch_id' => 'required',
            'date' => 'required',
            'shift' => 'required',
        ]);

        try {
            $this->doctorSchedule->store($request->all());

            return redirect()->route('admin.doctor-schedule.index')->with('success', 'Data berhasil ditambah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.doctor-schedule.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->doctorSchedule->getById($id);
        $doctor = $this->doctor->get();
        $branch = $this->branch->get();

        return view('admin.doctor-schedule.edit', compact('data', 'doctor', 'branch'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required',
            'branch_id' => 'required',
            'date' => 'required',
            'shift' => 'required',
        ]);

        try {
            $this->doctorSchedule->update($id, $request->all());

            return redirect()->route('admin.doctor-schedule.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.doctor-schedule.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->doctorSchedule->delete($id);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function createMultiple(Request $request)
    {
        // dd($request);
        $inputData = $request->all();
        $dataToInsert = [];

        foreach ($inputData['shift'] as $shiftName => $shiftData) {
            $date = $inputData['date'];
            if (strpos($shiftName, '_day_') !== false) {
                $dayNumber = intval(substr($shiftName, strpos($shiftName, '_day_') + 5, 1) - 1);
                $date = date('Y-m-d', strtotime("+$dayNumber day", strtotime($inputData['date'])));
                
                if ($dayNumber > 1) {
                    $date = date('Y-m-d', strtotime("+$dayNumber day", strtotime($inputData['date'])));
                }
            }

            $doctorIds = $shiftData["'doctor_id'"];
            foreach ($doctorIds as $doctorId) {
                $dataToInsert[] = [
                    'doctor_id' => $doctorId,
                    'branch_id' => $inputData['branch_id'],
                    'date' => $date,
                    'shift' => $shiftData["'shift_time'"],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        try {

            DB::beginTransaction();
            DoctorSchedule::insert($dataToInsert);
            DB::commit();

            return redirect()->route('admin.doctor-schedule.index')->with('success', 'Data berhasil ditambah');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('admin.doctor-schedule.index')->with('error', $th->getMessage());
        }
    }
}
