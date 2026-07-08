<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $information = Information::first();
        $news = News::paginate(6);
        return view('arima.news-index', [
            'information' => $information,
            'news' => $news,
            'lang' => 'id',
        ]);
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        $latest_news = News::all();
        $information = Information::first();
        return view('arima.news-show', [
            'news' => $news,
            'information' => $information,
            'latest_news' => $latest_news,
            'lang' => 'id',
        ]);
    }

    public function index_eng()
    {
        $information = Information::first();
        $news = News::paginate(6);
        return view('arima.news-index', [
            'information' => $information,
            'news' => $news,
            'lang' => 'en',
        ]);
    }

    public function show_eng($id)
    {
        $news = News::findOrFail($id);
        $latest_news = News::all();
        $information = Information::first();
        return view('arima.news-show', [
            'news' => $news,
            'information' => $information,
            'latest_news' => $latest_news,
            'lang' => 'en',
        ]);
    }
}
