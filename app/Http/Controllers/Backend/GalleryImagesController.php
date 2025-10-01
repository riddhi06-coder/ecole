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
use App\Models\GalleryImages;

class GalleryImagesController extends Controller
{

    public function index()
    {
        return view('backend.campus.gallery_images.index');
    }

    public function create(Request $request)
    {
        return view('backend.campus.gallery_images.create');
    }
}