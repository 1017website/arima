<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disinfection;
use Illuminate\Support\Facades\File;

class DisinfectionController extends Controller
{

    public function index()
    {
        $disinfection = Disinfection::first();

        return view('service_solution.disinfection.index', compact('disinfection'));
    }

    public function edit(Disinfection $disinfection)
    {
        return view('service_solution.disinfection.update', compact('disinfection'));
    }

    public function update(Request $request, Disinfection $disinfection)
    {
        $request->validate([
            'title' => 'required|max:255',
            'background' => ($request->hasFile('background') || !$disinfection->background) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
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

        // $input['list_type'] = $request->input('list_type');

        if (!empty($disinfection->background) && $request->hasFile('background')) {
            $imagePath = $disinfection->background;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($background = $request->file('background')) {
            $destinationPath = 'images/disinfection/';
            $profileImage = "disinfection" . "-" . date('YmdHis') . "." . $background->getClientOriginalExtension();
            $background->move($destinationPath, $profileImage);
            $input['background'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('background') && !$disinfection->background) {
            unset($input['background']);
        }

        $disinfection->update($input);

        return redirect()->route('admin.disinfection.index')
            ->with('success', 'Disinfection updated successfully');
    }
}
