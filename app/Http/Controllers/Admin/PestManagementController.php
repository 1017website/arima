<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PestManagement;
use App\Models\PestManagementImage;
use Illuminate\Support\Facades\File;

class PestManagementController extends Controller
{
    public function index()
    {
        $pestManagement = PestManagement::all();
        $pestManagement = PestManagement::with('logoPest')->paginate(8);
        $pestManagementCount = PestManagement::count();
        $pestLogo = PestManagementImage::all();

        return view('pestManagement.index', compact('pestManagement', 'pestManagementCount', 'pestLogo'));
    }

    public function create()
    {
        return view('pestManagement.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'title_eng' => 'required|max:255',
            'description' => 'required',
            'description_eng' => 'required',
        ], [
            'title.required' => 'Name is required.',
            'title.max' => 'Name should not exceed 255 characters.',
            'title_eng.required' => 'Name is required.',
            'title_eng.max' => 'Name should not exceed 255 characters.',
            'description.required' => 'Detail is required.',
            'description.max' => 'Detail should not exceed 255 characters.',
            'description_eng.required' => 'Detail is required.',
            'description_eng.max' => 'Detail should not exceed 255 characters.',
        ]);
        $input = $request->all();

        $pm = PestManagement::create($input);

        if ($request->hasFile('logo')) {
            $pestInputs = [];
            $pestLogos = $request->file('logo');

            foreach ($pestLogos as $key => $logo) {
                if (isset($pestLogos[$key])) {
                    $destinationPath = 'images/pestLogo/';
                    $profileImage = "logo" . "-" . date('YmdHis') . "-" . $key . "." . $logo->getClientOriginalExtension();
                    $logo->move($destinationPath, $profileImage);

                    $pestInput = [
                        'logo' => $destinationPath . $profileImage,
                        'id_management' => $pm->id,
                    ];
                    $pestInputs[] = $pestInput;
                }
            }

            if (!empty($pestInputs)) {
                PestManagementImage::insert($pestInputs);
            }
        }

        return redirect()->route('admin.pestManagement.index')->with(['success' => 'Data successfully saved!']);
    }

    public function show(string $id)
    {
        $pestManagement = PestManagement::findOrFail($id);

        return view('pestManagement.show', compact('pestManagement'));
    }

    public function edit(PestManagement $pestManagement)
    {
        return view('pestManagement.update', compact('pestManagement'));
    }

    public function update(Request $request, PestManagement $pestManagement)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'title_eng' => 'required|max:255',
            'description' => 'required',
            'description_eng' => 'required',
        ], [
            'title.required' => 'Name is required.',
            'title.max' => 'Name should not exceed 255 characters.',
            'title_eng.required' => 'Name is required.',
            'title_eng.max' => 'Name should not exceed 255 characters.',
            'description.required' => 'Detail is required.',
            'description.max' => 'Detail should not exceed 255 characters.',
            'description_eng.required' => 'Detail is required.',
            'description_eng.max' => 'Detail should not exceed 255 characters.',
        ]);
        $input = $request->all();

        if ($request->hasFile('logo')) {
            $existingLogoPestIds = $pestManagement->logoPest->pluck('id')->toArray(); // Get IDs of existing bug types

            foreach ($request->file('logo') as $key => $logo) {
                if (isset($existingLogoPestIds[$key])) {
                    $existingImage = PestManagementImage::find($existingLogoPestIds[$key]);
                    $imagePath = $existingImage->logo;

                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }

                    $destinationPath = 'images/pestLogo/';
                    $profileImage = "logo" . "-" . date('YmdHis') . "-" . $key . "." . $logo->getClientOriginalExtension();
                    $logo->move($destinationPath, $profileImage);

                    $existingImage->update(['logo' => $destinationPath . $profileImage]);
                }
            }
        }

        $pestManagement->update($input);

        return redirect()->route('admin.pestManagement.index')->with(['success' => 'Data successfully updated!']);
    }



    public function destroy(PestManagement $pestManagement)
    {
        foreach ($pestManagement->logoPest as $image) {
            $imagePath = $image->logo;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $image->delete();
        }

        $pestManagement->delete();

        return redirect()->route('admin.pestManagement.index')
            ->with('success', 'PestManagement deleted successfully');
    }
}
