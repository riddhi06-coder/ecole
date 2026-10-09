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
use App\Models\BulletinCategory;

class BulletinListingController extends Controller
{

    // public function index()
    // {
    //     $categories = BulletinCategory::whereHas('listings', function($query) {
    //             $query->whereNull('deleted_by');
    //             $query->orderBy('id', 'desc');
    //         })
    //         ->with(['listings' => function($query) {
    //             $query->whereNull('deleted_by')
    //                 ->orderBy('id', 'desc');
    //         }])
    //         ->orderBy('category')
    //         ->get();

    //     return view('backend.bulletin.listing.index', compact('categories'));
    // }
    
        
    public function index()
    {
        $categories = BulletinCategory::whereHas('listings', function ($query) {
                $query->whereNull('deleted_by');
            })
            ->with(['listings' => function ($query) {
                $query->whereNull('deleted_by')
                      ->orderBy('inserted_at', 'desc'); // or id desc
            }])
            ->orderByDesc(
                BulletinListing::select('inserted_at')
                    ->whereColumn('bulletin_listing.category_id', 'bulletin_category.id')
                    ->whereNull('deleted_by')
                    ->orderBy('inserted_at', 'desc')
                    ->limit(1)
            )
            ->get();
    
        return view('backend.bulletin.listing.index', compact('categories'));
    }
    
    
    public function toggleHighlight(Request $request)
    {
        BulletinListing::where('id', $request->id)->update([
            'is_highlight' => $request->has('is_highlight') ? 1 : 0
        ]);
    
        return redirect()->route('manage-bulletin-listing.index')->with('message', 'Status updated successfully.');
    }




    public function create()
    {
        $categories = BulletinCategory::orderBy('category')->wherenull('deleted_by')->get();
        return view('backend.bulletin.listing.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'category' => 'required|exists:bulletin_category,id',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'thumbnail_video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:3072',
            'article_name' => 'required|string|max:255',
            'article_date' => 'required|date',
            'article_author' => 'nullable|string|max:255',
            'special_tags' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
        ], [
            'category.required' => 'Please select a Category.',
            'category.exists' => 'Selected category is invalid.',
            'thumbnail_image.required' => 'Please upload a Thumbnail image.',
            'thumbnail_image.image' => 'The file must be an image.',
            'thumbnail_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'thumbnail_image.max' => 'The image size must be less than 2MB.',
            'thumbnail_video.mimetypes' => 'Only MP4, WEBM, or OGG video formats are allowed.',
            'thumbnail_video.max' => 'The video size must be less than 3MB.',
            'article_name.required' => 'Please enter an Article Name.',
            'article_date.required' => 'Please enter the Article Date.',
            'article_date.date' => 'Please enter a valid date.',
            'article_author.required' => 'Please enter an Article Author.',
            'short_desc.required' => 'Please enter a Short Description.',
        ]);


        // Ensure at least one (image or video) is uploaded
        if (!$request->hasFile('thumbnail_image') && !$request->hasFile('thumbnail_video')) {
            return back()->withErrors(['thumbnail_image' => 'Please upload either a Thumbnail Image or a Thumbnail Video.'])->withInput();
        }


        $thumbnailImage = null;
        if ($request->hasFile('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $thumbnailImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bulletin'), $thumbnailImage);
        }
        
        $thumbnailVideo = null;
        if ($request->hasFile('thumbnail_video')) {
            $video = $request->file('thumbnail_video');
            $thumbnailVideo = time() . rand(1000, 9999) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/bulletin/videos'), $thumbnailVideo);
        }
    

        $listing = new BulletinListing();
        $listing->category_id = $validatedData['category'];
        $listing->thumbnail_image = $thumbnailImage;
        $listing->thumbnail_video = $thumbnailVideo;
        $listing->article_name = $validatedData['article_name'];
        $listing->article_date = $validatedData['article_date'];
        $listing->article_author = $validatedData['article_author'];
        $listing->special_tags = $validatedData['special_tags'] ?? null;
        $listing->short_desc = $validatedData['short_desc'];
        $listing->slug = Str::slug($validatedData['article_name']);

        $count = BulletinListing::where('slug', 'like', $listing->slug . '%')->count();
        if ($count > 0) {
            $listing->slug .= '-' . ($count + 1);
        }

        $listing->inserted_by = Auth::id();
        $listing->inserted_at = Carbon::now();
        $listing->save();

        return redirect()->route('manage-bulletin-listing.index')->with('message', 'Bulletin listing added successfully.');
    }

    public function edit($id)
    {
        $category = BulletinListing::findOrFail($id);
        $categories = BulletinCategory::orderBy('category')->wherenull('deleted_by')->get();
        return view('backend.bulletin.listing.edit', compact('category','categories'));
    }

    public function update(Request $request, $id)
    {
        $listing = BulletinListing::findOrFail($id);

        // ✅ Validate inputs
        $validatedData = $request->validate([
            'category' => 'required|exists:bulletin_category,id',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // 3MB
            'thumbnail_video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:3072', // 3MB
            'article_name' => 'required|string|max:255',
            'article_date' => 'required|date',
            'article_author' => 'nullable|string|max:255',
            'special_tags' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
        ], [
            'category.required' => 'Please select a Category.',
            'category.exists' => 'Selected category is invalid.',
            'thumbnail_image.image' => 'The file must be an image.',
            'thumbnail_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'thumbnail_image.max' => 'The image size must be less than 2MB.',
            'thumbnail_video.mimetypes' => 'Only MP4, WEBM, or OGG formats are allowed.',
            'thumbnail_video.max' => 'The video size must be less than 3MB.',
            'article_name.required' => 'Please enter an Article Name.',
            'article_date.required' => 'Please enter the Article Date.',
            'article_date.date' => 'Please enter a valid date.',
            'article_author.required' => 'Please enter an Article Author.',
            'short_desc.required' => 'Please enter a Short Description.',
        ]);


        // ✅ If both image and video are uploaded -> show validation error
        if ($request->hasFile('thumbnail_image') && $request->hasFile('thumbnail_video')) {
            return back()->withErrors(['thumbnail_image' => 'Please upload either an image or a video, not both.'])->withInput();
        }
    
        // ✅ Handle image upload
        if ($request->hasFile('thumbnail_image')) {
            // Delete old image if exists
            if ($listing->thumbnail_image && file_exists(public_path('uploads/bulletin/' . $listing->thumbnail_image))) {
                unlink(public_path('uploads/bulletin/' . $listing->thumbnail_image));
            }
    
            // Delete video if switching from video to image
            if ($listing->thumbnail_video && file_exists(public_path('uploads/bulletin/videos/' . $listing->thumbnail_video))) {
                unlink(public_path('uploads/bulletin/videos/' . $listing->thumbnail_video));
                $listing->thumbnail_video = null;
            }
    
            $image = $request->file('thumbnail_image');
            $imageName = 'image' . time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bulletin'), $imageName);
            $listing->thumbnail_image = $imageName;
        }
    
        // ✅ Handle video upload
        if ($request->hasFile('thumbnail_video')) {
            // Delete old video if exists
            if ($listing->thumbnail_video && file_exists(public_path('uploads/bulletin/videos/' . $listing->thumbnail_video))) {
                unlink(public_path('uploads/bulletin/videos/' . $listing->thumbnail_video));
            }
    
            // Delete image if switching from image to video
            if ($listing->thumbnail_image && file_exists(public_path('uploads/bulletin/' . $listing->thumbnail_image))) {
                unlink(public_path('uploads/bulletin/' . $listing->thumbnail_image));
                $listing->thumbnail_image = null;
            }
    
            $video = $request->file('thumbnail_video');
            $videoName = 'videos' . time() . rand(10, 999) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/bulletin/videos'), $videoName);
            $listing->thumbnail_video = $videoName;
        }

        // ✅ Update other fields
        $listing->category_id = $validatedData['category'];
        $listing->article_name = $validatedData['article_name'];
        $listing->article_date = $validatedData['article_date'];
        $listing->article_author = $validatedData['article_author'];
        $listing->short_desc = $validatedData['short_desc'];
        $listing->special_tags = $validatedData['special_tags'] ?? null;

        // ✅ Update slug if article name changed
        // $newSlug = Str::slug($validatedData['article_name']);
        // if ($newSlug !== $listing->slug) {
        //     $count = BulletinListing::where('slug', 'like', $newSlug . '%')->where('id', '!=', $listing->id)->count();
        //     if ($count > 0) {
        //         $newSlug .= '-' . ($count + 1);
        //     }
        //     $listing->slug = $newSlug;
        // }


                // ✅ Check if article name changed before updating
        if ($validatedData['article_name'] !== $listing->article_name) {
            $newSlug = Str::slug($validatedData['article_name']);
    
            $count = BulletinListing::where('slug', 'like', $newSlug . '%')
                ->where('id', '!=', $listing->id)
                ->count();
    
            if ($count > 0) {
                $newSlug .= '-' . ($count + 1);
            }
            dd($newSlug);
            $listing->slug = $newSlug;
        }


        $listing->modified_by = Auth::id();
        $listing->modified_at = Carbon::now();
        $listing->save();

        return redirect()->route('manage-bulletin-listing.index')->with('message', 'Bulletin listing updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = BulletinListing::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-bulletin-listing.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}