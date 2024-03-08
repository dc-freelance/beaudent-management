<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DiscountTreatmentInterface;
use App\Interfaces\DiscountInterface;
use App\Interfaces\TreatmentInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountTreatmentController extends Controller
{
    private $discount_treatment, $data_discount, $data_treatment;

    public function __construct(DiscountTreatmentInterface $discount_treatment, DiscountInterface $data_discount, TreatmentInterface $data_treatment)
    {
        $this->discount_treatment = $discount_treatment;
        $this->data_discount = $data_discount;
        $this->data_treatment = $data_treatment;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->discount_treatment->get())
                ->addColumn('discount_id', function ($data) {
                    return $data->discounts->name;
                })
                ->addColumn('treatment_id', function ($data) {
                    return $data->discount_treatments->name;
                })
                ->addColumn('discount_type', function ($data) {
                    return $data->discount_type === 'Percentage' ? 'Percentage' : 'Nominal';
                })
                ->addColumn('discount', function ($data) {
                    if ($data->discount_type == 'Percentage') {
                        return number_format($data->discount, 1, ',', '.') . '%';
                    } else {
                        return 'Rp ' . number_format($data->discount, 0, ',', '.');
                    }
                })
                ->addColumn('action', function ($data) {
                    return view('admin.discount_treatment.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.discount_treatment.index');
    }

    public function getById($id)
    {
        return $this->discount_treatment->getById($id);
    }

    public function create()
    {
        $data_discount = $this->data_discount->get();
        $data_treatment = $this->data_treatment->get();

        if($data_treatment->isEmpty()) {
            return redirect()->route('admin.discount_treatment.index')->with('error', 'Silahkan tambahkan layanan terlebih dahulu');
        }
        elseif($data_discount->isEmpty()) {
            return redirect()->route('admin.discount_treatment.index')->with('error', 'Silahkan tambahkan diskon terlebih dahulu');
        }

        return view('admin.discount_treatment.create', compact('data_discount', 'data_treatment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'discount_id' => 'required',
            'treatment_id' => 'required',
            'discount_type' => 'required',
            'discount' => 'required'
        ]);

        try {
            $discount_treatment = $request->input('discount');

            if ($request->input('discount_type') === 'nominal') {
                // Menghilangkan simbol mata uang dan karakter tidak valid
                $discount_treatment = str_replace(['Rp.', '.', ','], '', $discount_treatment);
            } else {
                // Mengonversi nilai discount ke tipe data numerik jika discount_type adalah 'nominal'
                $discount_treatment = (float) $discount_treatment;
            }

            $request->merge([
                'discount' => $discount_treatment
            ]);

            $this->discount_treatment->create($request->all());

            return redirect()->route('admin.discount_treatment.index')->with('success', 'Diskon Layanan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.discount_treatment.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->discount_treatment->getById($id);
        $discount_treatment = $this->discount_treatment->get();
        $data_discount = $this->data_discount->get();
        $data_treatment = $this->data_treatment->get();

        return view('admin.discount_treatment.edit', compact('data', 'discount_treatment', 'data_treatment', 'data_discount'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'discount_id' => 'required',
            'treatment_id' => 'required',
            'discount_type' => 'required',
            'discount' => 'required'
        ]);

        try {
            $discount_treatment = $request->input('discount');


            if ($request->input('discount_type') === 'Nominal') {
                // Menghilangkan simbol mata uang dan karakter tidak valid
                $discount_treatment = str_replace(['Rp.', '.', ','], '', $discount_treatment);
            } else {
                // Mengonversi nilai discount ke tipe data numerik jika discount_type adalah 'nominal'
                $discount_treatment = (float) $discount_treatment;
            }

            $request->merge([
                'discount' => $discount_treatment
            ]);

            $this->discount_treatment->update($id, $request->all());

            return redirect()->route('admin.discount_treatment.index')->with('success', 'Diskon Layanan berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.discount_treatment.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->discount_treatment->delete($id);

            return response()->json(['status' => 'success', 'message' => 'Diskon Layanan berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
