<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralPest;
use Illuminate\Support\Facades\File;

class GeneralPestController extends Controller
{
    public function index()
    {
        $generalPest = GeneralPest::first();

        return view('method.generalPest.index', compact('generalPest'));
    }

    public function edit(GeneralPest $generalPest)
    {
        return view('method.generalPest.update', compact('generalPest'));
    }

    public function update(Request $request, GeneralPest $generalPest)
    {
        $request->validate([
            'title' => 'required|max:255',
            'header_image' => ($request->hasFile('header_image') || !$generalPest->header_image) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
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

        if (!empty($generalPest->header_image) && $request->hasFile('header_image')) {
            $imagePath = $generalPest->header_image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($header_image = $request->file('header_image')) {
            $destinationPath = 'images/generalPest/';
            $profileImage = "generalPest" . "-" . date('YmdHis') . "." . $header_image->getClientOriginalExtension();
            $header_image->move($destinationPath, $profileImage);
            $input['header_image'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('header_image') && !$generalPest->header_image) {
            unset($input['header_image']);
        }

        $generalPest->update($input);

        return redirect()->route('admin.general_pest.index')
            ->with('success', 'GeneralPest updated successfully');
    }
}
