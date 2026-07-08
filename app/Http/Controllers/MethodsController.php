<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fumigation;
use App\Models\TermiteBaiting;
use App\Models\GeneralPest;
use App\Models\Information;

class MethodsController extends Controller
{
    public function fumigation()
    {
        $information = Information::first();
        $fumigation = Fumigation::first();

        return view('arima.method', [
            'information' => $information,
            'item' => $fumigation,
            'title' => optional($fumigation)->title ?? 'Fumigation',
            'lang' => 'id',
        ]);
    }


    public function generalpest()
    {
        $information = Information::first();
        $generalpest = GeneralPest::first();

        return view('arima.method', [
            'information' => $information,
            'item' => $generalpest,
            'title' => optional($generalpest)->title ?? 'General Pest',
            'lang' => 'id',
        ]);
    }


    public function termitebaiting()
    {
        $information = Information::first();
        $termitebaiting = TermiteBaiting::first();

        return view('arima.method', [
            'information' => $information,
            'item' => $termitebaiting,
            'title' => optional($termitebaiting)->title ?? 'Termite Baiting',
            'lang' => 'id',
        ]);
    }

    public function fumigation_eng()
    {
        $information = Information::first();
        $fumigation = Fumigation::first();

        return view('arima.method', [
            'information' => $information,
            'item' => $fumigation,
            'title' => optional($fumigation)->title ?? 'Fumigation',
            'lang' => 'en',
        ]);
    }


    public function generalpest_eng()
    {
        $information = Information::first();
        $generalpest = GeneralPest::first();

        return view('arima.method', [
            'information' => $information,
            'item' => $generalpest,
            'title' => optional($generalpest)->title ?? 'General Pest',
            'lang' => 'en',
        ]);
    }


    public function termitebaiting_eng()
    {
        $information = Information::first();
        $termitebaiting = TermiteBaiting::first();

        return view('arima.method', [
            'information' => $information,
            'item' => $termitebaiting,
            'title' => optional($termitebaiting)->title ?? 'Termite Baiting',
            'lang' => 'en',
        ]);
    }
}
