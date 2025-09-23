<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\User;
use App\Models\BulletinBoard;

class BulletinBoardController extends Controller
{

    public function index()
    {
        $bulletins = BulletinBoard::wherenull('deleted_by')->get();
        return view('backend.home.bulletin_board.index', compact('bulletins'));
    }

    public function create(Request $request)
    {
        return view('backend.home.bulletin_board.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate the form
        $validatedData = $request->validate([
            'section_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'bulletin_description' => 'required|string',
        ], [
            'section_title.string' => 'Section Title must be valid text.',
            'section_title.max' => 'Section Title must not exceed 255 characters.',

            'description.string' => 'Description must be valid text.',

            'bulletin_description.required' => 'Description is required.',
            'bulletin_description.string' => 'Description must be valid text.',

            'image.required' => 'Image is required.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'image.max' => 'Image size must not exceed 2MB.',

            'title.required' => 'Title is required.',
            'title.string' => 'Title must be valid text.',
            'title.max' => 'Title must not exceed 255 characters.',

            'date.required' => 'Date is required.',
            'date.date' => 'Please select a valid date.',
        ]);

        // ✅ Handle Image Upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/home'), $imageName);
        }

        $slug = Str::slug($validatedData['title']);

        // ✅ Save to DB
        $bulletin = new BulletinBoard();
        $bulletin->section_title = $validatedData['section_title'] ?? null;
        $bulletin->description = $validatedData['description'];
        $bulletin->bulletin_description = $validatedData['bulletin_description'];
        $bulletin->image = $imageName;
        $bulletin->title = $validatedData['title'];
        $bulletin->slug = $slug; // Save slug
        $bulletin->date = $validatedData['date'];
        $bulletin->inserted_by = Auth::id();
        $bulletin->inserted_at = Carbon::now();
        $bulletin->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-bulletin-board.index')->with('message', 'Bulletin Board entry added successfully!');
    }

    public function edit($id)
    {
        $bulletin_board = BulletinBoard::findOrFail($id);
        return view('backend.home.bulletin_board.edit', compact('bulletin_board'));
    }


    public function update(Request $request, $id)
    {
        $bulletin = BulletinBoard::findOrFail($id);

        // ✅ Validate the form
        $validatedData = $request->validate([
            'section_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'bulletin_description' => 'required|string',
        ], [
            'section_title.string' => 'Section Title must be valid text.',
            'section_title.max' => 'Section Title must not exceed 255 characters.',

            'description.string' => 'Description must be valid text.',

            'bulletin_description.required' => 'Description is required.',
            'bulletin_description.string' => 'Description must be valid text.',

            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'image.max' => 'Image size must not exceed 2MB.',

            'title.required' => 'Title is required.',
            'title.string' => 'Title must be valid text.',
            'title.max' => 'Title must not exceed 255 characters.',

            'date.required' => 'Date is required.',
            'date.date' => 'Please select a valid date.',
        ]);

        // ✅ Handle Image Upload (replace if new uploaded)
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($bulletin->image && file_exists(public_path('uploads/home/' . $bulletin->image))) {
                unlink(public_path('uploads/home/' . $bulletin->image));
            }

            $file = $request->file('image');
            $imageName = time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/home'), $imageName);
            $bulletin->image = $imageName;
        }

        // ✅ Update slug from title
        $bulletin->slug = Str::slug($validatedData['title']);

        // ✅ Update other fields
        $bulletin->section_title = $validatedData['section_title'] ?? null;
        $bulletin->description = $validatedData['description'];
        $bulletin->bulletin_description = $validatedData['bulletin_description'];
        $bulletin->title = $validatedData['title'];
        $bulletin->date = $validatedData['date'];
        $bulletin->modified_by = Auth::id();
        $bulletin->modified_at = Carbon::now();

        $bulletin->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-bulletin-board.index')->with('message', 'Bulletin Board entry updated successfully!');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = BulletinBoard::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-bulletin-board.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}