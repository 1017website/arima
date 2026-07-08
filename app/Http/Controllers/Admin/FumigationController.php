<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fumigation;
use Illuminate\Support\Facades\File;

class FumigationController extends Controller
{
    public function index()
    {
        $fumigation = Fumigation::first();

        return view('method.fumigation.index', compact('fumigation'));
    }

    public function edit(Fumigation $fumigation)
    {
        return view('method.fumigation.update', compact('fumigation'));
    }

    public function update(Request $request, Fumigation $fumigation)
    {
        $request->validate([
            'title' => 'required|max:255',
            'header_image' => ($request->hasFile('header_image') || !$fumigation->header_image) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
            'description' => 'required',
            'description_eng' => 'required',

        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title should not exceed 255 characters.',
            'header_image.required' => 'Header Image is required.',
            'description.required' => 'Description is required.',
            'description_eng.required' => 'Description is required.',
        ]);

        $input = $request->except(['_token', '_method']);

        if (!empty($fumigation->header_image) && $request->hasFile('header_image')) {
            $imagePath = $fumigation->header_image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($header_image = $request->file('header_image')) {
            $destinationPath = 'images/fumigation/';
            $profileImage = "fumigation" . "-" . date('YmdHis') . "." . $header_image->getClientOriginalExtension();
            $header_image->move($destinationPath, $profileImage);
            $input['header_image'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('header_image') && !$fumigation->header_image) {
            unset($input['header_image']);
        }

        $fumigation->update($input);

        return redirect()->route('admin.fumigation.index')
            ->with('success', 'Fumigation updated successfully');
    }
}
