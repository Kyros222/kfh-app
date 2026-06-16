<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function show(): View
    {
        $services = Service::query()->active()->get();

        return view('services', compact('services'));
    }
}
