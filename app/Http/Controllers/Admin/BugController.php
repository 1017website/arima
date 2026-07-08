<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bug;
use App\Models\DetailBugs;
use Illuminate\Support\Facades\File;

class BugController extends Controller
{
    public function index()
    {
        $bug = Bug::all();
        $bug = Bug::paginate(8);
        return view('pest.bug.index', compact('bug'));
    }

    public function create()
    {
        return view('pest.bug.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'types' => 'required',
            'title' => 'required|max:255',
            'title_eng' => 'required|max:255',
            'icon' => 'required|image|mimes:jpeg,jpg,png',
            'header_image' => 'required|image|mimes:jpeg,jpg,png',
            'ekosistem' => 'required',
            'ekosistem_eng' => 'required',
            'funfact' => 'required|max:255',
            'funfact_eng' => 'required|max:255',
            'penanggulangan' => 'required',
            'penanggulangan_eng' => 'required',
        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title should not exceed 255 characters.',
            'title_eng.required' => 'Title (English Version) is required.',
            'title_eng.max' => 'Title (English Version) should not exceed 255 characters.',
            'icon.required' => 'Icon is required.',
            'header_image.required' => 'Header Image is required.',
            'ekosistem.required' => 'Ekosistem (IDN Version) is required.',
            'ekosistem_eng.required' => 'Ekosistem (ENG Version) is required.',
            'funfact.required' => 'Fun Fact is required.',
            'funfact.max' => 'Fun Fact should not exceed 255 characters.',
            'funfact_eng.required' => 'Fun Fact (English Version) is required.',
            'funfact_eng.max' => 'Fun Fact (English Version) should not exceed 255 characters.',
            'penanggulangan.required' => 'Penanggulangan (IDN Version) is required.',
            'penanggulangan_eng.required' => 'Penanggulangan (ENG Version) is required.',
        ]);

        $input = $request->all();

        $input['ekosistem'] = $request->input('ekosistem');
        $input['ekosistem_eng'] = $request->input('ekosistem_eng');
        $input['penanggulangan'] = $request->input('penanggulangan');
        $input['penanggulangan_eng'] = $request->input('penanggulangan_eng');

        if ($icon = $request->file('icon')) {
            $destinationPath = 'images/bug/icon/';
            $profileImage = "bug" . "-" . date('YmdHis') . "." . $icon->getClientOriginalExtension();
            $icon->move($destinationPath, $profileImage);
            $input['icon'] = $destinationPath . $profileImage;
        }

        if ($header_image = $request->file('header_image')) {
            $destinationPath2 = 'images/bug/header_image/';
            $profileImage2 = "bug" . "-" . date('YmdHis') . "." . $header_image->getClientOriginalExtension();
            $header_image->move($destinationPath2, $profileImage2);
            $input['header_image'] = $destinationPath2 . $profileImage2;
        }

        $bug = Bug::create($input);

        if ($request->filled('title_bugs') && $request->filled('latin_title') && $request->hasFile('image')) {
            $bugTypesInput = [];
            $bugTypeTitles = $request->input('title_bugs');
            $bugTypeLatinTitles = $request->input('latin_title');
            $bugTypeImages = $request->file('image');

            foreach ($bugTypeTitles as $key => $title_bugs) {
                if (isset($bugTypeLatinTitles[$key]) && isset($bugTypeImages[$key])) {
                    $destinationPath = 'images/bug/bug_types/';
                    $profileImage = "bug" . "-" . date('YmdHis') . "-" . $key . "." . $bugTypeImages[$key]->getClientOriginalExtension();
                    $bugTypeImages[$key]->move($destinationPath, $profileImage);

                    $bugTypeInput = [
                        'title_bugs' => $title_bugs,
                        'latin_title' => $bugTypeLatinTitles[$key],
                        'image' => $destinationPath . $profileImage,
                        'id_pest_bugs' => $bug->id,
                    ];
                    $bugTypesInput[] = $bugTypeInput;
                }
            }

            if (!empty($bugTypesInput)) {
                DetailBugs::insert($bugTypesInput);
            }
        }

        return redirect()->route('admin.bug.index')->with(['success' => 'Data successfully saved!']);
    }

    public function show(string $id)
    {
        $bug = Bug::findOrFail($id);
        $bugTypes = DetailBugs::where('id_pest_bugs', $id)->get();

        return view('pest.bug.show', compact('bug', 'bugTypes'));
    }

    public function edit(Bug $bug)
    {
        return view('pest.bug.update', compact('bug'));
    }

    public function update(Request $request, Bug $bug)
    {
        $this->validate($request, [
            'types' => 'required',
            'title' => 'required|max:255',
            'title_eng' => 'required|max:255',
            'icon' => ($request->hasFile('icon') || !$bug->icon) ? 'file|mimes:jpeg,jpg,png|max:2048' : '',
            'header_image' => ($request->hasFile('header_image') || !$bug->header_image) ? 'file|mimes:jpeg,jpg,png' : '',
            'ekosistem' => 'required',
            'ekosistem_eng' => 'required',
            'funfact' => 'required|max:255',
            'funfact_eng' => 'required|max:255',
            'penanggulangan' => 'required',
            'penanggulangan_eng' => 'required',
        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title should not exceed 255 characters.',
            'title_eng.required' => 'Title is required.',
            'title_eng.max' => 'Title should not exceed 255 characters.',
            'icon.image' => 'Icon must be an image.',
            'icon.mimes' => 'Icon must be a file of type: jpeg, jpg, png.',
            'header_image.image' => 'Header Image must be an image.',
            'header_image.mimes' => 'Header Image must be a file of type: jpeg, jpg, png.',
            'ekosistem.required' => 'Ekosistem (IDN Version) is required.',
            'ekosistem_eng.required' => 'Ekosistem (ENG Version) is required.',
            'funfact.required' => 'Fun Fact is required.',
            'funfact.max' => 'Fun Fact should not exceed 255 characters.',
            'funfact_eng.required' => 'Fun Fact is required.',
            'funfact_eng.max' => 'Fun Fact should not exceed 255 characters.',
            'penanggulangan.required' => 'Penanggulangan (IDN Version) is required.',
            'penanggulangan_eng.required' => 'Penanggulangan (ENG Version) is required.',
        ]);

        $input = $request->all();

        $input['ekosistem'] = $request->input('ekosistem');
        $input['ekosistem_eng'] = $request->input('ekosistem_eng');
        $input['penanggulangan'] = $request->input('penanggulangan');
        $input['penanggulangan_eng'] = $request->input('penanggulangan_eng');

        if (!empty($bug->icon) && $request->hasFile('icon')) {
            $imagePath = $bug->icon;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if (!empty($bug->header_image) && $request->hasFile('header_image')) {
            $imagePath2 = $bug->header_image;

            if (File::exists($imagePath2)) {
                File::delete($imagePath2);
            }
        }

        if ($icon = $request->file('icon')) {
            $destinationPath = 'images/bug/icon/';
            $profileImage = "bug" . "-" . date('YmdHis') . "." . $icon->getClientOriginalExtension();
            $icon->move($destinationPath, $profileImage);
            $input['icon'] = $destinationPath . $profileImage;
        }

        if ($header_image = $request->file('header_image')) {
            $destinationPath2 = 'images/bug/header_image/';
            $profileImage2 = "bug" . "-" . date('YmdHis') . "." . $header_image->getClientOriginalExtension();
            $header_image->move($destinationPath2, $profileImage2);
            $input['header_image'] = $destinationPath2 . $profileImage2;
        }

        $bug->update($input);

        // Update Existed Type Bugs
        if ($request->filled('title_bugs') || $request->filled('latin_title')) {
            $bugTypesInput = [];
            $bugTypeTitles = $request->input('title_bugs');
            $bugTypeLatinTitles = $request->input('latin_title');
            $bugTypeImages = $request->file('image');

            $existingBugTypeIds = $bug->detailBugs->pluck('id')->toArray(); // Get IDs of existing bug types

            foreach ($bugTypeTitles as $key => $title_bugs) {
                if (isset($bugTypeLatinTitles[$key])) {
                    $bugTypeInput = [
                        'title_bugs' => $title_bugs,
                        'latin_title' => $bugTypeLatinTitles[$key],
                        'id_pest_bugs' => $bug->id,
                    ];

                    // Update image only if image file is provided
                    if (isset($bugTypeImages[$key])) {
                        $existingImage = DetailBugs::find($existingBugTypeIds[$key])->image;
                        $imagePath = $existingImage;

                        if (File::exists($imagePath)) {
                            File::delete($imagePath);
                        }

                        $destinationPath = 'images/bug/bug_types/';
                        $profileImage = "bug" . "-" . date('YmdHis') . "-" . $key . "." . $bugTypeImages[$key]->getClientOriginalExtension();

                        $bugTypeImages[$key]->move($destinationPath, $profileImage);

                        $bugTypeInput['image'] = $destinationPath . $profileImage;
                    }

                    if (isset($existingBugTypeIds[$key])) {
                        DetailBugs::find($existingBugTypeIds[$key])->update($bugTypeInput);
                    } else {
                        DetailBugs::create($bugTypeInput);
                    }
                }
            }
        }

        return redirect()->route('admin.bug.index')->with(['success' => 'Data successfully updated!']);
    }


    public function destroy(Bug $bug)
    {
        if (!empty($bug->icon)) {
            $imagePath = $bug->icon;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if (!empty($bug->header_image)) {
            $imagePath2 = $bug->header_image;

            if (file_exists($imagePath2)) {
                unlink($imagePath2);
            }
        }

        foreach ($bug->detailBugs as $gambar) {
            $imagePath = $gambar->image;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $gambar->delete();
        }

        $bug->delete();

        return redirect()->route('admin.bug.index')
            ->with('success', 'Bug deleted successfully');
    }
}
