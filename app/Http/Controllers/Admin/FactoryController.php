<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factory;
use Illuminate\Support\Facades\File;

class FactoryController extends Controller
{
    public function index()
    {
        $factory = Factory::first();

        return view('service_solution.factory.index', compact('factory'));
    }

    public function edit(Factory $factory)
    {
        return view('service_solution.factory.update', compact('factory'));
    }

    public function update(Request $request, Factory $factory)
    {
        $request->validate([
            'title' => 'required|max:255',
            'background' => ($request->hasFile('background') || !$factory->background) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
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

        if (!empty($factory->background) && $request->hasFile('background')) {
            $imagePath = $factory->background;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($background = $request->file('background')) {
            $destinationPath = 'images/factory/';
            $profileImage = "factory" . "-" . date('YmdHis') . "." . $background->getClientOriginalExtension();
            $background->move($destinationPath, $profileImage);
            $input['background'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('background') && !$factory->background) {
            unset($input['background']);
        }

        $factory->update($input);

        return redirect()->route('admin.factory.index')
            ->with('success', 'Factory updated successfully');
    }
}
