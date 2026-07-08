<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Pest;
use App\Models\Bug;
use App\Models\DetailBugs;

class PestController extends Controller
{
    public function index()
    {
        $information = Information::first();
        $pest = Pest::first();
        $bugs = Bug::where('types', 0)->get();
        return view('arima.pest-index', [
            'information' => $information,
            'pest' => $pest,
            'bugs' => $bugs,
            'title' => 'Bugs',
            'lang' => 'id',
        ]);
    }

    public function other()
    {
        $information = Information::first();
        $pest = Pest::first();
        $bugs = Bug::where('types', 1)->get();
        return view('arima.pest-index', [
            'information' => $information,
            'pest' => $pest,
            'bugs' => $bugs,
            'title' => 'Other Pest',
            'lang' => 'id',
        ]);
    }

    public function show($id)
    {
        $bug = Bug::findOrFail($id);
        $bug->load('detailBugs');
        $information = Information::first();
        return view('arima.pest-detail', [
            'bug' => $bug,
            'information' => $information,
            'lang' => 'id',
        ]);
    }

    public function otherpest($id)
    {
        $bug = Bug::findOrFail($id);
        $bug->load('detailBugs');
        $information = Information::first();
        return view('arima.pest-detail', [
            'bug' => $bug,
            'information' => $information,
            'lang' => 'id',
        ]);
    }
    public function index_eng()
    {
        $information = Information::first();
        $pest = Pest::first();
        $bugs = Bug::where('types', 0)->get();
        return view('arima.pest-index', [
            'information' => $information,
            'pest' => $pest,
            'bugs' => $bugs,
            'title' => 'Bugs',
            'lang' => 'en',
        ]);
    }

    public function other_eng()
    {
        $information = Information::first();
        $pest = Pest::first();
        $bugs = Bug::where('types', 1)->get();
        return view('arima.pest-index', [
            'information' => $information,
            'pest' => $pest,
            'bugs' => $bugs,
            'title' => 'Other Pest',
            'lang' => 'en',
        ]);
    }

    public function show_eng($id)
    {
        $bug = Bug::findOrFail($id);
        $bug->load('detailBugs');
        $information = Information::first();
        return view('arima.pest-detail', [
            'bug' => $bug,
            'information' => $information,
            'lang' => 'en',
        ]);
    }

    public function otherpest_eng($id)
    {
        $bug = Bug::findOrFail($id);
        $bug->load('detailBugs');
        $information = Information::first();
        return view('arima.pest-detail', [
            'bug' => $bug,
            'information' => $information,
            'lang' => 'en',
        ]);
    }
}
