<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogMonitorController extends Controller
{
    public function index() {
        $filepath = storage_path('logs/laravel.log');
        $fileContent = File::get($filepath); // Use File facade for simplicity
        $logLines = explode(PHP_EOL, $fileContent);
        return view('log.index',compact('logLines'));
    }
}
