<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Commercial;
use App\Models\Disinfection;
use App\Models\Residential;
use App\Models\Factory;
use App\Models\Cleaning;

class ServiceController extends Controller
{
    public function commercial()
    {
        $information = Information::first();
        $commercial = Commercial::first();

        return view('arima.service', [
            'information' => $information,
            'item' => $commercial,
            'title' => optional($commercial)->title ?? 'Commercial Protection',
            'lang' => 'id',
        ]);
    }

    public function residential()
    {
        $information = Information::first();
        $residential = Residential::first();

        return view('arima.service', [
            'information' => $information,
            'item' => $residential,
            'title' => optional($residential)->title ?? 'Residential Protection',
            'lang' => 'id',
        ]);
    }

    public function industrial()
    {
        $information = Information::first();
        $factory = Factory::first();

        return view('arima.service', [
            'information' => $information,
            'item' => $factory,
            'title' => optional($factory)->title ?? 'Industrial Protection',
            'lang' => 'id',
        ]);
    }

    public function disinfection(){
        $information = Information::first();
        $disinfection = Disinfection::first();

        return view('arima.service', [
            'information' => $information,
            'item' => $disinfection,
            'title' => optional($disinfection)->title ?? 'Disinfection Protection',
            'lang' => 'id',
        ]);
    }

    public function cleaning(){
        $information = Information::first();
        $cleaning = Cleaning::first();

        return view('arima.service', [
            'information' => $information,
            'item' => $cleaning,
            'title' => optional($cleaning)->title ?? 'Cleaning Service',
            'lang' => 'id',
        ]);
    }

    public function commercial_eng()
    {
        $information = Information::first();
        $commercial = Commercial::first();

        return view('arima.service', [
            'information' => $information,
            'item' => $commercial,
            'title' => optional($commercial)->title ?? 'Commercial Protection',
            'lang' => 'en',
        ]);
    }

    public function residential_eng()
    {
        $information = Information::first();
        $residential = Residential::first();

        return view('arima.service', [
            'information' => $information,
            'item' => $residential,
            'title' => optional($residential)->title ?? 'Residential Protection',
            'lang' => 'en',
        ]);
    }

    public function industrial_eng()
    {
        $information = Information::first();
        $factory = Factory::first();

        return view('arima.service', [
            'information' => $information,
            'item' => $factory,
            'title' => optional($factory)->title ?? 'Industrial Protection',
            'lang' => 'en',
        ]);
    }

    public function disinfection_eng(){
        $information = Information::first();
        $disinfection = Disinfection::first();

        return view('arima.service', [
            'information' => $information,
            'item' => $disinfection,
            'title' => optional($disinfection)->title ?? 'Disinfection Protection',
            'lang' => 'en',
        ]);
    }

    public function cleaning_eng(){
        $information = Information::first();
        $cleaning = Cleaning::first();

        return view('arima.service', [
            'information' => $information,
            'item' => $cleaning,
            'title' => optional($cleaning)->title ?? 'Cleaning Service',
            'lang' => 'en',
        ]);
    }
}
