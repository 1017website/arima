<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bug;
use App\Models\Contact;
use App\Models\HomeClient;
use App\Models\News;
use App\Models\Pest;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [
            ['label' => 'Slider', 'value' => Slider::count(), 'url' => '/admin/slider', 'icon' => 'bi-images'],
            ['label' => 'News', 'value' => News::count(), 'url' => '/admin/news', 'icon' => 'bi-newspaper'],
            ['label' => 'Pest Content', 'value' => Pest::count(), 'url' => '/admin/pest', 'icon' => 'bi-journal-text'],
            ['label' => 'Bugs', 'value' => Bug::count(), 'url' => '/admin/bug', 'icon' => 'bi-grid-3x3-gap'],
            ['label' => 'Contact Leads', 'value' => Contact::count(), 'url' => '/admin/contact', 'icon' => 'bi-inbox'],
            ['label' => 'Home Clients', 'value' => HomeClient::count(), 'url' => '/admin/home-client', 'icon' => 'bi-buildings'],
        ];

        return view('admin-home', compact('user', 'stats'));
    }
}
