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
                $query->orderBy('id','desc'); 
            }])
            ->orderBy('category')
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.bulletin.details.index', compact('categories'));
    }

    public function create()
    {
        $categories = BulletinCategory::orderBy('id')->wherenull('deleted_by')->get();
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
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'thumbnail_video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:3072',
            'location' => 'nullable|string|max:255',
            'article_time_from' => ['nullable', 'regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i'],
            'article_time_to' => ['nullable', 'regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i'],
            'title' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
        ], [
            'article_time_from.regex' => 'Start time must be in 12-hour format (e.g., 9:00 AM).',
            'article_time_to.regex' => 'End time must be in 12-hour format (e.g., 11:30 AM).',
            'thumbnail_video.mimetypes' => 'Only MP4, WEBM, or OGG video formats are allowed.',
            'thumbnail_video.max' => 'The video size must be less than 3MB.',
        ]);
        
        
        // Ensure at least one (image or video) is uploaded
        if (!$request->hasFile('thumbnail_image') && !$request->hasFile('thumbnail_video')) {
            return back()->withErrors(['thumbnail_image' => 'Please upload either a Thumbnail Image or a Thumbnail Video.'])->withInput();
        }


        // Initialize variables
        $thumbnailImage = null;
        $thumbnailVideo = null;
    
        // ✅ Handle image upload
        if ($request->hasFile('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $thumbnailImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bulletin'), $thumbnailImage);
        }
    
        // ✅ Handle video upload
        if ($request->hasFile('thumbnail_video')) {
            $video = $request->file('thumbnail_video');
            $thumbnailVideo = time() . rand(1000, 9999) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/bulletin/videos'), $thumbnailVideo);
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
        $bulletinDetails->thumbnail_image = $thumbnailImage;
        $bulletinDetails->thumbnail_video = $thumbnailVideo;
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
                    ->orderBy('id')
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
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // 3MB
            'thumbnail_video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:3072', // 3MB
            'location' => 'nullable|string|max:255',
            'article_time_from' => ['nullable', 'regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i'],
            'article_time_to' => ['nullable', 'regex:/^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i'],
            'title' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
        ], [
            'article_time_from.regex' => 'Start time must be in 12-hour format (e.g., 9:00 AM).',
            'article_time_to.regex' => 'End time must be in 12-hour format (e.g., 11:30 AM).',
            'thumbnail_video.mimetypes' => 'Only MP4, WEBM, or OGG formats are allowed.',
            'thumbnail_video.max' => 'The video size must be less than 3MB.',
        ]);
        
        
        // ✅ If both image and video are uploaded -> show validation error
        if ($request->hasFile('thumbnail_image') && $request->hasFile('thumbnail_video')) {
            return back()->withErrors(['thumbnail_image' => 'Please upload either an image or a video, not both.'])->withInput();
        }
        

        // ✅ Handle image upload
        if ($request->hasFile('thumbnail_image')) {
            // Delete old image if exists
            if ($bulletinDetails->thumbnail_image && file_exists(public_path('uploads/bulletin/' . $bulletinDetails->thumbnail_image))) {
                unlink(public_path('uploads/bulletin/' . $bulletinDetails->thumbnail_image));
            }
    
            // Delete video if switching from video to image
            if ($bulletinDetails->thumbnail_video && file_exists(public_path('uploads/bulletin/videos/' . $bulletinDetails->thumbnail_video))) {
                unlink(public_path('uploads/bulletin/videos/' . $bulletinDetails->thumbnail_video));
                $bulletinDetails->thumbnail_video = null;
            }
    
            $image = $request->file('thumbnail_image');
            $imageName = 'image' . time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bulletin'), $imageName);
            $bulletinDetails->thumbnail_image = $imageName;
        }
    
        // ✅ Handle video upload
        if ($request->hasFile('thumbnail_video')) {
            // Delete old video if exists
            if ($bulletinDetails->thumbnail_video && file_exists(public_path('uploads/bulletin/videos/' . $bulletinDetails->thumbnail_video))) {
                unlink(public_path('uploads/bulletin/videos/' . $bulletinDetails->thumbnail_video));
            }
    
            // Delete image if switching from image to video
            if ($bulletinDetails->thumbnail_image && file_exists(public_path('uploads/bulletin/' . $bulletinDetails->thumbnail_image))) {
                unlink(public_path('uploads/bulletin/' . $bulletinDetails->thumbnail_image));
                $bulletinDetails->thumbnail_image = null;
            }
    
            $video = $request->file('thumbnail_video');
            $videoName = 'videos' . time() . rand(10, 999) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/bulletin/videos'), $videoName);
            $bulletinDetails->thumbnail_video = $videoName;
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