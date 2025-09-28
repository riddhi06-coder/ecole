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
use App\Models\ContactUs;


class ContactUsController extends Controller
{

    public function index()
    {
        $contactDetails = ContactUs::wherenull('deleted_by')->get();
        return view('backend.contact.index', compact('contactDetails'));
    }

    public function create(Request $request)
    {
        return view('backend.contact.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'banner_heading'        => 'required|string|max:255',
                'banner'                => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                'email'                 => 'required|email|max:255',
                'other_email'           => 'required|email|max:255',
                'url'                   => 'required|url|max:500',
                'contact_number'        => ['required'],
                'other_contact_number'  => ['required'],
                'i_frame'               => 'required|string|max:2000', 
                'address'               => 'required|string|max:2000',
                'desc'                  => 'required|string|max:2000',
                'announcements.*.title' => 'required|string|max:500',
                'social_media.*.platform' => 'required|string',
                'social_media.*.link'     => 'required|url',
            ], [
                'banner_heading.required'   => 'Banner Heading is required.',
                'banner.required'           => 'Banner image is required.',
                'banner.image'              => 'Please upload a valid image file.',
                'banner.mimes'              => 'Only jpg, jpeg, png, webp are allowed.',
                'banner.max'                => 'Image must not be larger than 2MB.',

                'email.required'            => 'Email is required.',
                'email.email'               => 'Please enter a valid email address.',
                'other_email.required'      => 'Other Email is required.',
                'other_email.email'         => 'Please enter a valid Other Email.',
                'url.required'              => 'Gmap URL is required.',
                'url.url'                   => 'Please enter a valid Gmap URL.',
                'contact_number.required'   => 'Contact Number is required.',
                'contact_number.digits_between' => 'Please enter a valid Contact Number (8–15 digits).',
                'other_contact_number.required' => 'Other Contact Number is required.',
                'other_contact_number.digits_between' => 'Please enter a valid Other Contact Number (8–15 digits).',
                'i_frame.required'          => 'IFrame embed code is required.',
                'address.required'          => 'Address is required.',
                'desc.required'             => 'Short Description is required.',

                'announcements.*.title.required' => 'Announcement title is required.',
                'social_media.*.platform.required' => 'Social Media Platform is required.',
                'social_media.*.link.required'     => 'Social Media Link is required.',
                'social_media.*.link.url'          => 'Please enter a valid URL for Social Media Link.',
            ]);

            // ✅ Handle banner image upload
            $bannerImage = null;
            if ($request->hasFile('banner')) {
                $image = $request->file('banner');
                $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/contact'), $bannerImage);
            }

            // ✅ Store in database
            $contactDetails = new ContactUs();
            $contactDetails->banner_heading       = $request->banner_heading;
            $contactDetails->banner_image         = $bannerImage;
            $contactDetails->email                = $request->email;
            $contactDetails->other_email          = $request->other_email;
            $contactDetails->map_url              = $request->url;
            $contactDetails->contact_number       = $request->contact_number;
            $contactDetails->other_contact_number = $request->other_contact_number;
            $contactDetails->i_frame              = $request->i_frame;
            $contactDetails->address              = $request->address;
            $contactDetails->desc                 = $request->desc;

            // ✅ JSON encode announcements & social media links
            $contactDetails->announcements       = json_encode($request->announcements);
            $contactDetails->social_media_links  = json_encode($request->social_media);

            $contactDetails->inserted_by = Auth::id();
            $contactDetails->inserted_at = Carbon::now();
            $contactDetails->save();

            return redirect()->route('manage-contact-us.index')->with('message', 'Contact Details saved successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; 
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong! '.$e->getMessage())
                        ->withInput();
        }
    }


    public function edit($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact_details = $contact->social_media_links ? json_decode($contact->social_media_links, true) : [];
        $announcements = $contact->announcements ? json_decode($contact->announcements, true) : [];

        return view('backend.contact.edit', compact('contact', 'contact_details','announcements'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'banner_heading'        => 'required|string|max:255',
                'banner'                => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'email'                 => 'required|email|max:255',
                'other_email'           => 'required|email|max:255',
                'url'                   => 'required|url|max:500',
                'contact_number'        => ['required'],
                'other_contact_number'  => ['required'],
                'i_frame'               => 'required|string|max:2000',
                'address'               => 'required|string|max:2000',
                'desc'                  => 'required|string|max:2000',
                'announcements.*.title' => 'required|string|max:500',
                'social_media.*.platform' => 'required|string',
                'social_media.*.link'     => 'required|url',
            ], [
                'banner_heading.required'   => 'Banner Heading is required.',

                'banner.image'              => 'Please upload a valid image file.',
                'banner.mimes'              => 'Only jpg, jpeg, png, webp are allowed.',
                'banner.max'                => 'Image must not be larger than 2MB.',

                'email.required'            => 'Email is required.',
                'email.email'               => 'Please enter a valid email address.',
                'other_email.required'      => 'Other Email is required.',
                'other_email.email'         => 'Please enter a valid Other Email.',

                'url.required'              => 'Gmap URL is required.',
                'url.url'                   => 'Please enter a valid Gmap URL.',

                'contact_number.required'   => 'Contact Number is required.',
                'other_contact_number.required' => 'Other Contact Number is required.',

                'i_frame.required'          => 'IFrame embed code is required.',
                'address.required'          => 'Address is required.',
                'desc.required'             => 'Short Description is required.',

                'announcements.*.title.required' => 'Announcement title is required.',
                'social_media.*.platform.required' => 'Social Media Platform is required.',
                'social_media.*.link.required'     => 'Social Media Link is required.',
                'social_media.*.link.url'          => 'Please enter a valid URL for Social Media Link.',
            ]);


            // ✅ Fetch existing contact record
            $contactDetails = ContactUs::findOrFail($id);

            // ✅ Handle banner image upload (optional update)
            if ($request->hasFile('banner')) {
                $image = $request->file('banner');
                $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/contact'), $bannerImage);

                // Delete old image if exists
                if ($contactDetails->banner_image && file_exists(public_path('uploads/contact/' . $contactDetails->banner_image))) {
                    unlink(public_path('uploads/contact/' . $contactDetails->banner_image));
                }

                $contactDetails->banner_image = $bannerImage;
            }

            // ✅ Update fields
            $contactDetails->banner_heading       = $request->banner_heading;
            $contactDetails->email                = $request->email;
            $contactDetails->other_email          = $request->other_email;
            $contactDetails->map_url              = $request->url;
            $contactDetails->contact_number       = $request->contact_number;
            $contactDetails->other_contact_number = $request->other_contact_number;
            $contactDetails->i_frame              = $request->i_frame;
            $contactDetails->address              = $request->address;
            $contactDetails->desc                 = $request->desc;

            // ✅ JSON encode announcements & social media links
            $contactDetails->announcements       = json_encode($request->announcements);
            $contactDetails->social_media_links  = json_encode($request->social_media);

            $contactDetails->modified_by = Auth::id();
            $contactDetails->modified_at = Carbon::now();
            $contactDetails->save();

            return redirect()->route('manage-contact-us.index')->with('message', 'Contact Details updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve;
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ContactUs::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-contact-us.index')->with('message', 'Data deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}