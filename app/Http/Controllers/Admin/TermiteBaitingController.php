<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermiteBaiting;
use Illuminate\Support\Facades\File;

class TermiteBaitingController extends Controller
{
    public function index()
    {
        $termiteBaiting = TermiteBaiting::first();

        return view('method.termiteBaiting.index', compact('termiteBaiting'));
    }

    public function edit(TermiteBaiting $termiteBaiting)
    {
        return view('method.termiteBaiting.update', compact('termiteBaiting'));
    }

    public function update(Request $request, TermiteBaiting $termiteBaiting)
    {
        $request->validate([
            'title' => 'required|max:255',
            'header_image' => ($request->hasFile('header_image') || !$termiteBaiting->header_image) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
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

        if (!empty($termiteBaiting->header_image) && $request->hasFile('header_image')) {
            $imagePath = $termiteBaiting->header_image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($header_image = $request->file('header_image')) {
            $destinationPath = 'images/termiteBaiting/';
            $profileImage = "termiteBaiting" . "-" . date('YmdHis') . "." . $header_image->getClientOriginalExtension();
            $header_image->move($destinationPath, $profileImage);
            $input['header_image'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('header_image') && !$termiteBaiting->header_image) {
            unset($input['header_image']);
        }

        $termiteBaiting->update($input);

        return redirect()->route('admin.termite_baiting.index')
            ->with('success', 'TermiteBaiting updated successfully');
    }
}
