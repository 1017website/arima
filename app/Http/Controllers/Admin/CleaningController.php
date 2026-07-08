<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cleaning;
use Illuminate\Support\Facades\File;

class CleaningController extends Controller
{
    //
    public function index()
    {
        $cleaning = Cleaning::first();

        return view('service_solution.cleaning.index', compact('cleaning'));
    }

    public function edit(Cleaning $cleaning)
    {
        return view('service_solution.cleaning.update', compact('cleaning'));
    }

    public function update(Request $request, Cleaning $cleaning)
    {
        $request->validate([
            'title' => 'required|max:255',
            'background' => ($request->hasFile('background') || !$cleaning->background) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
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

        if (!empty($cleaning->background) && $request->hasFile('background')) {
            $imagePath = $cleaning->background;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($background = $request->file('background')) {
            $destinationPath = 'images/cleaning/';
            $profileImage = "cleaning" . "-" . date('YmdHis') . "." . $background->getClientOriginalExtension();
            $background->move($destinationPath, $profileImage);
            $input['background'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('background') && !$cleaning->background) {
            unset($input['background']);
        }

        $cleaning->update($input);

        return redirect()->route('admin.cleaning.index')
            ->with('success', 'Cleaning updated successfully');
    }
}
