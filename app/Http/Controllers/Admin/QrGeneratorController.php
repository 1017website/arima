<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class QrGeneratorController extends Controller
{
    public function index(): View
    {
        return view('qr-generator.index');
    }
}
