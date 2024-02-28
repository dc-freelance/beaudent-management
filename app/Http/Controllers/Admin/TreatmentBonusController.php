<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorCategoryInterface;
use App\Interfaces\TreatmentBonusInterface;
use App\Interfaces\TreatmentInterface;
use Illuminate\Http\Request;

class TreatmentBonusController extends Controller
{
    private $treatment;

    private $doctorCategory;

    private $treatmentBonus;

    public function __construct(TreatmentInterface $treatment, DoctorCategoryInterface $doctorCategory, TreatmentBonusInterface $treatmentBonus)
    {
        $this->treatment = $treatment;
        $this->doctorCategory = $doctorCategory;
        $this->treatmentBonus = $treatmentBonus;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->treatmentBonus->get())
                ->addColumn('treatment', function ($data) {
                    return $data->treatment->name;
                })
                ->addColumn('doctor_category', function ($data) {
                    return $data->doctorCategory->name;
                })
                ->addColumn('bonus_type', function ($data) {
                    return $data->bonus_type;
                })
                ->addColumn('bonus_rate', function ($data) {
                    if ($data->bonus_type == 'percentage') {
                        return number_format($data->bonus_rate, 0, ',', '.') . '%';
                    } else {
                        return 'Rp ' . number_format($data->bonus_rate, 0, ',', '.');
                    }
                })
                ->addColumn('action', function ($data) {
                    return view('admin.treatment-bonus.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.treatment-bonus.index');
    }

    public function create()
    {
        $treatments = $this->treatment->get();
        $doctorCategories = $this->doctorCategory->get();

        return view('admin.treatment-bonus.create', compact('treatments', 'doctorCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'treatment_id' => 'required|exists:treatments,id',
            'doctor_category_id' => 'required|exists:doctor_categories,id',
            'bonus_type' => 'required|in:percentage,nominal',
            'bonus_rate' => 'required',
        ]);

        try {
            $request->merge([
                'bonus_rate' => str_replace(['Rp.', '.', ','], '', $request->input('bonus_rate'))
            ]);
            $this->treatmentBonus->store($request->all());

            return redirect()->route('admin.treatment-bonus.index')->with('success', 'Bonus layanan berhasil dibuat');
        } catch (\Throwable $th) {
            return redirect()->route('admin.treatment-bonus.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->treatmentBonus->getById($id);
        $treatments = $this->treatment->get();
        $doctorCategories = $this->doctorCategory->get();

        return view('admin.treatment-bonus.edit', compact('data', 'treatments', 'doctorCategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'treatment_id' => 'required|exists:treatments,id',
            'doctor_category_id' => 'required|exists:doctor_categories,id',
            'bonus_type' => 'required|in:percentage,nominal',
            'bonus_rate' => 'required',
        ]);

        try {
            $request->merge([
                'bonus_rate' => str_replace(['Rp.', '.', ','], '', $request->input('bonus_rate'))
            ]);
            $this->treatmentBonus->update($id, $request->all());

            return redirect()->route('admin.treatment-bonus.index')->with('success', 'Bonus layanan berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.treatment-bonus.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->treatmentBonus->delete($id);

            return response()->json(['status' => 'success', 'message' => 'Bonus layanan berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
