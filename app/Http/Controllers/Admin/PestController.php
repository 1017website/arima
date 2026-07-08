<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pest;
use Illuminate\Support\Facades\File;

class PestController extends Controller
{
    public function index()
    {
        $pest = Pest::first();

        return view('pest.index', compact('pest'));
    }

    public function edit(Pest $pest)
    {
        return view('pest.update', compact('pest'));
    }

    public function update(Request $request, Pest $pest)
    {
        $request->validate([
            'title' => 'required|max:255',
            'header_image' => ($request->hasFile('header_image') || !$pest->header_image) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',

        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title should not exceed 255 characters.',
            'header_image.required' => 'Header Image is required.',
        ]);

        $input = $request->except(['_token', '_method']);

        if (!empty ($pest->header_image) && $request->hasFile('header_image')) {
            $imagePath = $pest->header_image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($header_image = $request->file('header_image')) {
            $destinationPath = 'images/pest/';
            $profileImage = "pest" . "-" . date('YmdHis') . "." . $header_image->getClientOriginalExtension();
            $header_image->move($destinationPath, $profileImage);
            $input['header_image'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('header_image') && !$pest->header_image) {
            unset($input['header_image']);
        }

        $pest->update($input);

        return redirect()->route('admin.pest.index')
            ->with('success', 'Pest updated successfully');
    }
}
