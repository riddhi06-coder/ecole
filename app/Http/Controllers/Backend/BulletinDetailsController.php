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
use App\Models\BulletinListing;
use App\Models\BulletinDetails;
use App\Models\BulletinCategory;

class BulletinDetailsController extends Controller
{

    public function index()
    {
        $categories = BulletinCategory::whereHas('details')
            ->with(['details' => function($query) {
                $query->whereNull('deleted_by');
                $query->orderBy('id'); 
            }])
            ->orderBy('category')
            ->get();

        return view('backend.bulletin.details.index', compact('categories'));
    }

    public function create()
    {
        $categories = BulletinCategory::orderBy('category')->wherenull('deleted_by')->get();
        return view('backend.bulletin.details.create', compact('categories'));
    }

    public function getArticles($categoryId)
    {
        $articles = BulletinListing::where('category_id', $categoryId)
            ->whereNull('deleted_by')
            ->orderBy('article_name')
            ->get(['id', 'article_name']); 

        return response()->json($articles);
    }

    public function store(Request $request)
    {
        // Validate form inputs
        $validatedData = $request->validate([
            'category' => 'required|exists:bulletin_category,id',
            'article' => 'required|exists:bulletin_listing,id',
            'thumbnail_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'location' => 'nullable|string|max:255',
            'article_time_from' => ['nullable', 'regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i'],
            'article_time_to' => ['nullable', 'regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i'],
            'title' => 'nullable|string|max:255',
            'short_desc' => 'required|string',
        ], [
            'article_time_from.regex' => 'Start time must be in 12-hour format (e.g., 9:00 AM).',
            'article_time_to.regex' => 'End time must be in 12-hour format (e.g., 11:30 AM).',
        ]);

        // Handle image upload
        if ($request->hasFile('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bulletin'), $imageName);
            $validatedData['thumbnail_image'] = $imageName;
        }

        // Optional: Convert 12-hour times to 24-hour format before saving, only if provided
        $validatedData['article_time_from'] = !empty($validatedData['article_time_from'])
            ? date("H:i", strtotime($validatedData['article_time_from']))
            : null;

        $validatedData['article_time_to'] = !empty($validatedData['article_time_to'])
            ? date("H:i", strtotime($validatedData['article_time_to']))
            : null;

        // Map fields to your model
        $bulletinDetails = new BulletinDetails();
        $bulletinDetails->category_id = $validatedData['category'];
        $bulletinDetails->article_id = $validatedData['article'];
        $bulletinDetails->thumbnail_image = $validatedData['thumbnail_image'];
        $bulletinDetails->location = $validatedData['location'];
        $bulletinDetails->article_time_from = $validatedData['article_time_from'];
        $bulletinDetails->article_time_to = $validatedData['article_time_to'];
        $bulletinDetails->title = $validatedData['title'];
        $bulletinDetails->desc = $validatedData['short_desc'];
        $bulletinDetails->inserted_by = Auth::id();
        $bulletinDetails->inserted_at = Carbon::now();

        $bulletinDetails->save();

        return redirect()->route('manage-bulletin-details.index')->with('message', 'Bulletin details added successfully!');
    }

    public function edit($id)
    {
        $detail = BulletinDetails::findOrFail($id); // fetch selected detail
        $categories = BulletinCategory::whereNull('deleted_by')->orderBy('category')->get();

        // Fetch articles of selected category for populating "Article" dropdown
        $articles = BulletinListing::where('category_id', $detail->category_id)
                    ->orderBy('article_name')
                    ->get();

        return view('backend.bulletin.details.edit', compact('detail','categories','articles'));
    }

    public function update(Request $request, $id)
    {
        $bulletinDetails = BulletinDetails::findOrFail($id);

        // Validate form inputs
        $validatedData = $request->validate([
            'category' => 'required|exists:bulletin_category,id',
            'article' => 'required|exists:bulletin_listing,id',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'location' => 'nullable|string|max:255',
            'article_time_from' => ['nullable', 'regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i'],
            'article_time_to' => ['nullable', 'regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i'],
            'title' => 'nullable|string|max:255',
            'short_desc' => 'required|string',
        ], [
            'article_time_from.regex' => 'Start time must be in 12-hour format (e.g., 9:00 AM).',
            'article_time_to.regex' => 'End time must be in 12-hour format (e.g., 11:30 AM).',
        ]);

        // Handle image upload if a new file is provided
        if ($request->hasFile('thumbnail_image')) {
            // Delete old image if exists
            if ($bulletinDetails->thumbnail_image && file_exists(public_path('uploads/bulletin/' . $bulletinDetails->thumbnail_image))) {
                unlink(public_path('uploads/bulletin/' . $bulletinDetails->thumbnail_image));
            }

            $image = $request->file('thumbnail_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bulletin'), $imageName);
            $bulletinDetails->thumbnail_image = $imageName;
        }

        // Convert 12-hour times to 24-hour format
        $bulletinDetails->article_time_from = !empty($validatedData['article_time_from']) 
            ? date("H:i", strtotime($validatedData['article_time_from'])) 
            : null;

        $bulletinDetails->article_time_to = !empty($validatedData['article_time_to']) 
            ? date("H:i", strtotime($validatedData['article_time_to'])) 
            : null;

        // Update other fields
        $bulletinDetails->category_id = $validatedData['category'];
        $bulletinDetails->article_id = $validatedData['article'];
        $bulletinDetails->location = $validatedData['location'];
        $bulletinDetails->title = $validatedData['title'];
        $bulletinDetails->desc = $validatedData['short_desc'];
        $bulletinDetails->modified_by = Auth::id();
        $bulletinDetails->modified_at = Carbon::now();

        $bulletinDetails->save();

        return redirect()->route('manage-bulletin-details.index')
                        ->with('message', 'Bulletin details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = BulletinDetails::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-bulletin-details.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}