<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    public function editSeo()
    {
        return view('site-settings.meta-ads', [
            'information' => $this->information(),
        ]);
    }

    public function updateSeo(Request $request)
    {
        $validated = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_title_eng' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_description_eng' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_keywords_eng' => 'nullable|string',
            'meta_image' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'google_adsense_client_id' => 'nullable|string|max:255',
            'google_ads_head_script' => 'nullable|string',
            'google_ads_body_script' => 'nullable|string',
        ]);

        $information = $this->information();

        if ($request->hasFile('meta_image')) {
            $this->deleteOldFile($information->meta_image);
            $validated['meta_image'] = $this->storeFile($request->file('meta_image'), 'meta_image');
        } else {
            unset($validated['meta_image']);
        }

        $information->update($validated);

        return redirect()->route('admin.settings.meta-ads.edit')
            ->with('success', 'Meta and Google Ads settings updated successfully.');
    }

    public function editLogos()
    {
        return view('site-settings.logos', [
            'information' => $this->information(),
        ]);
    }

    public function updateLogos(Request $request)
    {
        $validated = $request->validate([
            'frontend_logo' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'frontend_favicon' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg,ico|max:2048',
            'cms_favicon' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg,ico|max:2048',
            'cms_sidebar_logo' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'cms_login_logo' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg|max:4096',
        ]);

        $information = $this->information();

        foreach (array_keys($validated) as $field) {
            if (! $request->hasFile($field)) {
                unset($validated[$field]);
                continue;
            }

            $this->deleteOldFile($information->{$field});
            $validated[$field] = $this->storeFile($request->file($field), $field);
        }

        $information->update($validated);

        return redirect()->route('admin.settings.logos.edit')
            ->with('success', 'Logo and favicon settings updated successfully.');
    }

    private function information(): Information
    {
        return Information::firstOrCreate([]);
    }

    private function storeFile($file, string $field): string
    {
        $destinationPath = "images/site/{$field}/";
        File::ensureDirectoryExists(public_path($destinationPath));

        $fileName = $field . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($destinationPath), $fileName);

        return $destinationPath . $fileName;
    }

    private function deleteOldFile(?string $path): void
    {
        if (! $path || str_starts_with($path, 'http')) {
            return;
        }

        $fullPath = public_path($path);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}
