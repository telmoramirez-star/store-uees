<?php

namespace App\Modules\Logs\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Logs\Models\Log;
use Illuminate\View\View;

class LogController extends Controller
{
    public function index(): View
    {
        $logs = Log::with('user')->latest()->paginate(20);

        return view('logs.index', compact('logs'));
    }
}
