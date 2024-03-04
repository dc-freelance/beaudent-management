<?php

namespace App\Repositories;

use App\Interfaces\DoctorScheduleInterface;
use App\Models\DoctorSchedule;

class DoctorScheduleRepository implements DoctorScheduleInterface
{
    private $doctorSchedule;

    public function __construct(DoctorSchedule $doctorSchedule)
    {
        $this->doctorSchedule = $doctorSchedule;
    }

    public function get()
    {
        return $this->doctorSchedule->with('doctor', 'branch')->orderBy('created_at','desc')->get();
    }

    public function getById($id)
    {
        return $this->doctorSchedule->with('doctor', 'branch')->find($id);
    }

    public function store($data)
    {
        $existingSchedule = $this->doctorSchedule->where('doctor_id', $data['doctor_id'])
            ->where('date', $data['date'])
            ->where('shift', $data['shift'])
            ->exists();

        if ($existingSchedule) {
            return redirect()->route('admin.doctor-schedule.index')->with('error', 'Jadwal Dokter sudah ada');
        }

        $lengthDoctor = count($data['doctor_id']);
        $insertData   = [];

        for ($i = 0; $i < $lengthDoctor; $i++) {
            if ($data['doctor_id'][$i] != 'all') {
                $insertData[] = [
                    'doctor_id'  => $data['doctor_id'][$i],
                    'branch_id'  => $data['branch_id'],
                    'date'       => $data['date'],
                    'shift'      => $data['shift'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        return $this->doctorSchedule->insert($insertData);
    }

    public function update($id, $data)
    {
        $existingSchedule = $this->doctorSchedule->where('doctor_id', $data['doctor_id'])
            ->where('date', $data['date'])
            ->where('shift', $data['shift'])
            ->exists();

        if ($existingSchedule) {
            return redirect()->route('admin.doctor-schedule.index')->with('error', 'Jadwal Dokter sudah ada');
        }

        return $this->doctorSchedule->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->doctorSchedule->find($id)->delete();
    }
}
