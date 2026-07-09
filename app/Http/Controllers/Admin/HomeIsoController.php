<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeIso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeIsoController extends Controller
{
    public function index()
    {
        $isos = HomeIso::orderBy('sort_order')->orderBy('title')->paginate(12);

        return view('home-iso.index', compact('isos'));
    }

    public function create()
    {
        return view('home-iso.create', ['iso' => new HomeIso(['is_active' => true, 'sort_order' => 0])]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['image'] = $this->resolveImage($request);
        unset($validated['image_url']);

        HomeIso::create($validated);

        return redirect()->route('admin.home-iso.index')->with('success', 'ISO content saved successfully.');
    }

    public function edit(HomeIso $homeIso)
    {
        return view('home-iso.update', ['iso' => $homeIso]);
    }

    public function update(Request $request, HomeIso $homeIso)
    {
        $validated = $this->validated($request, $homeIso);
        $validated['is_active'] = $request->boolean('is_active');

        $newImage = $this->resolveImage($request, $homeIso);
        if ($newImage !== null) {
            $validated['image'] = $newImage;
        }
        unset($validated['image_url']);

        $homeIso->update($validated);

        return redirect()->route('admin.home-iso.index')->with('success', 'ISO content updated successfully.');
    }

    public function destroy(HomeIso $homeIso)
    {
        $this->deleteOldFile($homeIso->image);
        $homeIso->delete();

        return redirect()->route('admin.home-iso.index')->with('success', 'ISO content deleted successfully.');
    }

    private function validated(Request $request, ?HomeIso $homeIso = null): array
    {
        return $request->validate([
            'title' => 'nullable|string|max:255',
            'title_eng' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'image_url' => 'nullable|string',
            'url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }

    private function resolveImage(Request $request, ?HomeIso $homeIso = null): ?string
    {
        if ($request->hasFile('image')) {
            $this->deleteOldFile($homeIso?->image);

            $image = $request->file('image');
            $destinationPath = 'images/home/iso/';
            File::ensureDirectoryExists($destinationPath);
            $fileName = 'iso-' . date('YmdHis') . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $fileName);

            return $destinationPath . $fileName;
        }

        $imageUrl = trim((string) $request->input('image_url'));
        if ($imageUrl !== '') {
            if ($imageUrl !== $homeIso?->image) {
                $this->deleteOldFile($homeIso?->image);
            }

            return $imageUrl;
        }

        return null;
    }

    private function deleteOldFile(?string $path): void
    {
        if ($path && !str_starts_with($path, 'http') && File::exists($path)) {
            File::delete($path);
        }
    }
}
