<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commercial;
use Illuminate\Support\Facades\File;

class CommercialController extends Controller
{
    public function index()
    {
        $commercial = Commercial::first();

        return view('service_solution.commercial.index', compact('commercial'));
    }

    public function edit(Commercial $commercial)
    {
        return view('service_solution.commercial.update', compact('commercial'));
    }

    public function update(Request $request, Commercial $commercial)
    {
        $request->validate([
            'title' => 'required|max:255',
            'background' => ($request->hasFile('background') || !$commercial->background) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
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

        if (!empty($commercial->background) && $request->hasFile('background')) {
            $imagePath = $commercial->background;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($background = $request->file('background')) {
            $destinationPath = 'images/commercial/';
            $profileImage = "commercial" . "-" . date('YmdHis') . "." . $background->getClientOriginalExtension();
            $background->move($destinationPath, $profileImage);
            $input['background'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('background') && !$commercial->background) {
            unset($input['background']);
        }

        $commercial->update($input);

        return redirect()->route('admin.commercial.index')
            ->with('success', 'Commercial updated successfully');
    }
}
