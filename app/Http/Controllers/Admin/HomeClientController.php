<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeClientController extends Controller
{
    public function index()
    {
        $clients = HomeClient::orderBy('sort_order')->orderBy('name')->paginate(12);

        return view('home-client.index', compact('clients'));
    }

    public function create()
    {
        return view('home-client.create', ['client' => new HomeClient()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeLogo($request);
        }

        HomeClient::create($validated);

        return redirect()->route('admin.home-client.index')->with('success', 'Client saved successfully.');
    }

    public function edit(HomeClient $homeClient)
    {
        return view('home-client.update', ['client' => $homeClient]);
    }

    public function update(Request $request, HomeClient $homeClient)
    {
        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            if ($homeClient->logo && File::exists($homeClient->logo)) {
                File::delete($homeClient->logo);
            }

            $validated['logo'] = $this->storeLogo($request);
        }

        $homeClient->update($validated);

        return redirect()->route('admin.home-client.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(HomeClient $homeClient)
    {
        if ($homeClient->logo && File::exists($homeClient->logo)) {
            File::delete($homeClient->logo);
        }

        $homeClient->delete();

        return redirect()->route('admin.home-client.index')->with('success', 'Client deleted successfully.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'subtitle_eng' => 'nullable|string|max:255',
            'logo' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg|max:4096',
            'url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }

    private function storeLogo(Request $request): string
    {
        $logo = $request->file('logo');
        $destinationPath = 'images/home/clients/';
        $fileName = 'client-' . date('YmdHis') . '.' . $logo->getClientOriginalExtension();
        $logo->move($destinationPath, $fileName);

        return $destinationPath . $fileName;
    }
}
