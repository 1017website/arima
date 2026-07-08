<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Residential;
use Illuminate\Support\Facades\File;

class ResidentialController extends Controller
{
    public function index()
    {
        $residential = Residential::first();

        return view('service_solution.residential.index', compact('residential'));
    }

    public function edit(Residential $residential)
    {
        return view('service_solution.residential.update', compact('residential'));
    }

    public function update(Request $request, Residential $residential)
    {
        $request->validate([
            'title' => 'required|max:255',
            'background' => ($request->hasFile('background') || !$residential->background) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
            'description' => 'required',
            'description_eng' => 'required',

        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title should not exceed 255 characters.',
            'background.required' => 'Background is required.',
            'description.required' => 'Description is required.',
            'description_eng.required' => 'Description is required.',
        ]);

        $input = $request->except(['_token', '_method']);

        $input['list_type'] = $request->input('list_type');

        if (!empty($residential->background) && $request->hasFile('background')) {
            $imagePath = $residential->background;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($background = $request->file('background')) {
            $destinationPath = 'images/residential/';
            $profileImage = "residential" . "-" . date('YmdHis') . "." . $background->getClientOriginalExtension();
            $background->move($destinationPath, $profileImage);
            $input['background'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('background') && !$residential->background) {
            unset($input['background']);
        }

        $residential->update($input);

        return redirect()->route('admin.residential.index')
            ->with('success', 'Residential updated successfully');
    }
}
