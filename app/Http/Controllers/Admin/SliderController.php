<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\File;


class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        $slider = Slider::paginate(8);
        $sliderCount = Slider::count();
        return view('slider.index', compact('slider', 'sliderCount'));
    }

    public function create()
    {
        return view('slider.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'detail' => 'required|max:255',
        ], [
            'name.required' => 'Name is required.',
            'name.max' => 'Name should not exceed 255 characters.',
            'image.required' => 'Image is required.',
            'detail.required' => 'Detail is required.',
            'detail.max' => 'Detail should not exceed 255 characters.',
        ]);
        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'images/slider/';
            $profileImage = "slider" . "-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $destinationPath . $profileImage;
        }

        Slider::create($input);

        return redirect()->route('admin.slider.index')->with(['success' => 'Data successfully saved!']);
    }

    public function show(string $id)
    {
        $slider = Slider::findOrFail($id);

        return view('slider.show', compact('slider'));
    }

    public function edit(Slider $slider)
    {
        return view('slider.update', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => ($request->hasFile('image') || !$slider->image) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
            'detail' => 'required|max:255',

        ], [
            'name.required' => 'Name is required.',
            'name.max' => 'Name should not exceed 255 characters.',
            'image.required' => 'Image is required.',
            'detail.required' => 'Detail is required.',
            'detail.max' => 'Detail should not exceed 255 characters.',
        ]);

        $input = $request->except(['_token', '_method']);

        if (!empty($slider->image) && $request->hasFile('image')) {
            $imagePath = $slider->image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($image = $request->file('image')) {
            $destinationPath = 'images/slider/';
            $profileImage = "slider" . "-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('image') && !$slider->image) {
            unset($input['image']);
        }

        $slider->update($input);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider updated successfully');
    }


    public function destroy(Slider $slider)
    {
        if (!empty($slider->image)) {
            $imagePath = $slider->image;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $slider->delete();

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider deleted successfully');
    }
}
