<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ConfigShiftInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConfigShiftController extends Controller
{
    private $configShift;

    public function __construct(ConfigShiftInterface $configShift)
    {
        $this->configShift = $configShift;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->configShift->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('start_time', function ($data) {
                    return Carbon::parse($data->start_time)->format('H:i') . ' WIB';
                })
                ->addColumn('end_time', function ($data) {
                    return Carbon::parse($data->end_time)->format('H:i') . ' WIB';
                })
                ->addColumn('action', function ($data) {
                    return view('admin.config-shift.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.config-shift.index');
    }

    public function getById($id)
    {
        return response()->json($this->configShift->getById($id));
    }

    public function create()
    {
        return view('admin.config-shift.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'start_time' => 'required',
            'end_time'   => 'required',
        ]);

        try {
            $this->configShift->store($request->all());
            return redirect()->route('admin.config-shift.index')->with('success', 'Konfigurasi shift berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->route('admin.config-shift.index')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->configShift->getById($id);
        return view('admin.config-shift.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'start_time' => 'required',
            'end_time'   => 'required',
        ]);

        try {
            $this->configShift->update($id, $request->all());
            return redirect()->route('admin.config-shift.index')->with('success', 'Konfigurasi shift berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('admin.config-shift.index')->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->configShift->delete($id);
            return response()->json(['status' => 'success', 'message' => 'Konfigurasi shift berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
