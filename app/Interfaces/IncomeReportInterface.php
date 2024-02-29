<?php

namespace App\Interfaces;

interface IncomeReportInterface
{
    public function getGeneral();
    public function exportGeneral();
    public function getDoctor();
    public function exportDoctor();
}
