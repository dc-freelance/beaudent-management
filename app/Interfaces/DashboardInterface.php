<?php

namespace App\Interfaces;

interface DashboardInterface
{
    public function earnings();
    public function year_earnings($year);
    public function reservation();
    public function treatments();
    public function patient();
    public function doctor();
    public function branch();
}
