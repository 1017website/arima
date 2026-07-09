<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeContentController extends Controller
{
    public function index()
    {
        $homeContent = HomeContent::firstOrCreate([], $this->defaults());

        return view('home-content.index', compact('homeContent'));
    }

    public function update(Request $request, HomeContent $homeContent)
    {
        $validated = $request->validate([
            'hero_video' => 'nullable|file|mimes:mp4,webm,ogg|max:51200',
            'hero_video_url' => 'nullable|string',
            'hero_poster' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'hero_poster_url' => 'nullable|string',
            'hero_eyebrow' => 'nullable|string|max:255',
            'hero_eyebrow_eng' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_title_eng' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_description_eng' => 'nullable|string',
            'hero_primary_cta' => 'nullable|string|max:255',
            'hero_primary_cta_eng' => 'nullable|string|max:255',
            'hero_secondary_cta' => 'nullable|string|max:255',
            'hero_secondary_cta_eng' => 'nullable|string|max:255',
            'client_kicker' => 'nullable|string|max:255',
            'client_kicker_eng' => 'nullable|string|max:255',
            'client_title' => 'nullable|string|max:255',
            'client_title_eng' => 'nullable|string|max:255',
            'client_description' => 'nullable|string',
            'client_description_eng' => 'nullable|string',
            'iso_is_active' => 'nullable|boolean',
            'iso_kicker' => 'nullable|string|max:255',
            'iso_kicker_eng' => 'nullable|string|max:255',
            'iso_title' => 'nullable|string|max:255',
            'iso_title_eng' => 'nullable|string|max:255',
            'iso_description' => 'nullable|string',
            'iso_description_eng' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_title_eng' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_description_eng' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'seo_keywords_eng' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'analytics_head' => 'nullable|string',
            'analytics_body' => 'nullable|string',
        ]);

        $validated['iso_is_active'] = $request->boolean('iso_is_active');

        foreach (['hero_video', 'hero_poster', 'og_image'] as $field) {
            if (!$request->hasFile($field)) {
                unset($validated[$field]);
                continue;
            }

            $this->deleteOldFile($homeContent->{$field});
            $validated[$field] = $this->storeFile($request->file($field), $field);
        }

        $homeContent->update($validated);

        return redirect()->route('admin.home-content.index')->with('success', 'Home content updated successfully.');
    }

    private function defaults(): array
    {
        return [
            'hero_eyebrow' => 'Since 1998',
            'hero_eyebrow_eng' => 'Since 1998',
            'hero_title' => 'ARIMA Indonesia',
            'hero_title_eng' => 'ARIMA Indonesia',
            'hero_description' => 'ARIMA Indonesia berdiri sejak tahun 1998 adalah perusahaan jasa di bidang utama pest control yaitu pengendalian hama dengan konsep green pest control.',
            'hero_description_eng' => 'ARIMA Indonesia has provided green pest control, pest management, disinfection, fumigation, termite baiting, and cleaning services since 1998.',
            'hero_primary_cta' => 'Konsultasi WhatsApp',
            'hero_primary_cta_eng' => 'Request Consultation',
            'hero_secondary_cta' => 'Service Solution',
            'hero_secondary_cta_eng' => 'Service Solution',
            'client_kicker' => 'Client & Partner',
            'client_kicker_eng' => 'Clients & Partners',
            'client_title' => 'Klien dan Mitra Kami',
            'client_title_eng' => 'Our Clients and Partners',
            'client_description' => 'Dipercaya oleh institusi, bisnis, dan fasilitas operasional di berbagai sektor.',
            'client_description_eng' => 'Trusted by institutions, businesses, and operational facilities across sectors.',
            'iso_is_active' => true,
            'iso_kicker' => 'Sertifikasi',
            'iso_kicker_eng' => 'Certification',
            'iso_title' => 'Standar Mutu & Sertifikasi ISO',
            'iso_title_eng' => 'Quality Standard & ISO Certification',
            'iso_description' => 'Komitmen ARIMA Indonesia terhadap standar mutu, keselamatan, dan layanan profesional yang terdokumentasi.',
            'iso_description_eng' => 'ARIMA Indonesia is committed to documented quality, safety, and professional service standards.',
            'seo_title' => 'ARIMA Indonesia | Green Pest Control sejak 1998',
            'seo_title_eng' => 'ARIMA Indonesia | Green Pest Control Since 1998',
            'seo_description' => 'ARIMA Indonesia menyediakan pest management, disinfection, fumigation, termite baiting, dan cleaning service sejak 1998.',
            'seo_description_eng' => 'ARIMA Indonesia provides pest management, disinfection, fumigation, termite baiting, and cleaning services since 1998.',
        ];
    }

    private function storeFile($file, string $field): string
    {
        $destinationPath = "images/home/{$field}/";
        $fileName = $field . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        return $destinationPath . $fileName;
    }

    private function deleteOldFile(?string $path): void
    {
        if ($path && !str_starts_with($path, 'http') && File::exists($path)) {
            File::delete($path);
        }
    }
}
