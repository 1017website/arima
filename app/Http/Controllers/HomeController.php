<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\HomeClient;
use App\Models\HomeContent;
use App\Models\HomeIso;
use App\Models\Information;
use App\Models\Slider;
use App\Models\Commercial;
use App\Models\Factory;
use App\Models\Disinfection;
use App\Models\Residential;
use Illuminate\Support\Facades\Mail;
use App\Models\PestManagement;
use App\Models\PestManagementImage;
use App\Mail\ContactMail;
use App\Mail\TestEmail;
use App\Models\News;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        return view('arima.index', $this->homePayload('id'));
    }

    public function index_eng()
    {
        return view('arima.index', $this->homePayload('en'));
    }

    private function homePayload(string $locale): array
    {
        $information = $this->tableExists('information') ? Information::first() : null;
        $homeContent = $this->tableExists('home_contents') ? HomeContent::first() : null;
        $clients = $this->tableExists('home_clients')
            ? HomeClient::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get()
            : collect();
        $homeIsos = $this->tableExists('home_isos')
            ? HomeIso::where('is_active', true)->orderBy('sort_order')->orderBy('title')->get()
            : collect();

        $fallbackClients = collect([
            ['name' => 'BKD', 'subtitle' => 'Jatim', 'subtitle_eng' => 'East Java'],
            ['name' => 'DISHUB', 'subtitle' => 'Surabaya', 'subtitle_eng' => 'Surabaya'],
            ['name' => 'Sidoarjo', 'subtitle' => 'Pesona Delta', 'subtitle_eng' => 'Pesona Delta'],
            ['name' => 'DJP', 'subtitle' => 'Direktorat Jenderal Pajak', 'subtitle_eng' => 'Directorate General of Taxes'],
            ['name' => 'DISHUB', 'subtitle' => 'Kota Probolinggo', 'subtitle_eng' => 'Probolinggo City'],
            ['name' => 'BKN', 'subtitle' => 'Badan Kepegawaian Negara', 'subtitle_eng' => 'National Civil Service Agency'],
            ['name' => 'BKN II', 'subtitle' => 'Surabaya', 'subtitle_eng' => 'Surabaya'],
            ['name' => 'Aston', 'subtitle' => 'Madiun', 'subtitle_eng' => 'Madiun'],
            ['name' => 'Dompet', 'subtitle' => 'Dhuafa', 'subtitle_eng' => 'Dhuafa'],
            ['name' => 'Klinik Mata', 'subtitle' => 'Utama', 'subtitle_eng' => 'Utama'],
            ['name' => 'Gangsar', 'subtitle' => 'Legend Since 1931', 'subtitle_eng' => 'Legend Since 1931'],
            ['name' => 'Dinkes', 'subtitle' => 'Kesehatan', 'subtitle_eng' => 'Health Office'],
        ])->map(fn ($client) => (object) $client);

        if ($clients->isEmpty()) {
            $clients = $fallbackClients;
        }

        $primaryClients = $clients;
        $secondaryClients = $clients->reverse()->values();
        $isEnglish = $locale === 'en';

        $seoTitle = $this->localized($homeContent, 'seo_title', $locale)
            ?: ($isEnglish ? 'ARIMA Indonesia | Green Pest Control Since 1998' : 'ARIMA Indonesia | Green Pest Control sejak 1998');
        $seoDescription = $this->localized($homeContent, 'seo_description', $locale)
            ?: ($isEnglish
                ? 'ARIMA Indonesia provides pest management, disinfection, fumigation, termite baiting, and cleaning services since 1998.'
                : 'ARIMA Indonesia menyediakan pest management, disinfection, fumigation, termite baiting, dan cleaning service sejak 1998.');

        return [
            'locale' => $locale,
            'isEnglish' => $isEnglish,
            'information' => $information,
            'homeContent' => $homeContent,
            'clients' => $clients,
            'homeIsos' => $homeIsos,
            'primaryClients' => $primaryClients,
            'secondaryClients' => $secondaryClients,
            'seo' => [
                'title' => $seoTitle,
                'description' => $seoDescription,
                'keywords' => $this->localized($homeContent, 'seo_keywords', $locale),
                'og_image' => $homeContent?->og_image,
                'canonical' => $isEnglish ? url('/eng') : url('/'),
                'alternate' => $isEnglish ? url('/') : url('/eng'),
            ],
        ];
    }

    private function localized(?HomeContent $content, string $field, string $locale): ?string
    {
        if (!$content) {
            return null;
        }

        $localizedField = $locale === 'en' ? "{$field}_eng" : $field;

        return $content->{$localizedField} ?: $content->{$field};
    }

    private function tableExists(string $table): bool
    {
        try {
            return Schema::hasTable($table);
        } catch (\Throwable) {
            return false;
        }
    }
}
