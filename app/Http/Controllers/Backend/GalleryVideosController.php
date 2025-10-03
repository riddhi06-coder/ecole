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
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Models\User;
use App\Models\GalleryVideo;

class GalleryVideosController extends Controller
{

    public function index()
    {
        $galleryVideos = GalleryVideo::wherenull('deleted_by')->get();
        return view('backend.campus.gallery_video.index', compact('galleryVideos'));
    }

    public function create(Request $request)
    {
        return view('backend.campus.gallery_video.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $request->validate([
                'title'      => 'required|string|max:255',
                'video_url'  => 'required|url|max:500',
                'video_iframe_url'  => 'required|url|max:500',
            ], [
                'title.required'     => 'Please enter a Title.',
                'title.string'       => 'Title must be a valid text.',
                'title.max'          => 'Title must not exceed 255 characters.',
                'video_url.required' => 'Please enter a Video URL.',
                'video_url.url'      => 'Please enter a valid URL.',
                'video_url.max'      => 'Video URL must not exceed 500 characters.',

                'video_iframe_url.required' => 'Please enter a Video URL.',
                'video_iframe_url.url'      => 'Please enter a valid URL.',
                'video_iframe_url.max'      => 'Video URL must not exceed 500 characters.',
            ]);

            // ✅ Store data
            $gallery = new GalleryVideo(); // Assuming your model is GalleryImage
            $gallery->title     = $request->title;
            $gallery->video_url = $request->video_url;
            $gallery->video_iframe_url = $request->video_iframe_url;
            $gallery->inserted_by = Auth::id();
            $gallery->inserted_at = Carbon::now();
            $gallery->save();

            return redirect()->route('manage-gallery-videos.index')
                            ->with('message', 'Record added successfully!');
        } catch (\Illuminate\Validation\ValidationException $ve) {
            // Let Laravel handle validation errors
            throw $ve;
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

}