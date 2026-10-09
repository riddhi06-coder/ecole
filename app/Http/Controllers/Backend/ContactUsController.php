<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;

use App\Models\ContactUs;


class ContactUsController extends Controller
{
    /** Folder (inside /public) where announcement attachments are stored */
    private const ANNOUNCEMENT_DIR = 'uploads/announcements';

    public function index()
    {
        $contactDetails = ContactUs::whereNull('deleted_by')->get();
        return view('backend.contact.index', compact('contactDetails'));
    }

    public function create(Request $request)
    {
        return view('backend.contact.create');
    }

    /**
     * Shared validation rules.
     */
    private function rules(bool $isUpdate = false): array
    {
        return [
            'banner_heading'          => 'required|string|max:255',
            'banner'                  => ($isUpdate ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
            'email'                   => 'required|email|max:255',
            'other_email'             => 'required|email|max:255',
            'url'                     => 'required|url|max:500',
            'contact_number'          => ['required'],
            'other_contact_number'    => ['nullable'],
            'i_frame'                 => 'required|string|max:2000',
            'address'                 => 'required|string|max:2000',
            'desc'                    => 'required|string|max:2000',
            'announcements'           => 'nullable|array',
            'announcements.*.title'   => 'required|string|max:500',
            'announcements.*.file'    => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:2048',
            'announcements.*.existing_file' => 'nullable|string|max:255',
            'announcements.*.remove_file'   => 'nullable|in:1',
            'social_media.*.platform' => 'required|string',
            'social_media.*.link'     => 'required|url',
        ];
    }

    private function messages(): array
    {
        return [
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
            'i_frame.required'          => 'IFrame embed code is required.',
            'address.required'          => 'Address is required.',
            'desc.required'             => 'Short Description is required.',

            'announcements.*.title.required' => 'Announcement title is required.',
            'announcements.*.file.mimes'     => 'Announcement attachment must be pdf, doc, docx, jpg, jpeg, png or webp.',
            'announcements.*.file.max'       => 'Announcement attachment must not be larger than 2MB.',

            'social_media.*.platform.required' => 'Social Media Platform is required.',
            'social_media.*.link.required'     => 'Social Media Link is required.',
            'social_media.*.link.url'          => 'Please enter a valid URL for Social Media Link.',
        ];
    }

    /**
     * Build the announcements array: [ ['title' => ..., 'file' => 'name.pdf' | null], ... ]
     *
     * @param array $old  Previously saved announcements (for update), used to keep / clean up old files.
     */
    private function buildAnnouncements(Request $request, array $old = []): array
    {
        $oldFiles = collect($old)->pluck('file')->filter()->values()->all();
        $keptFiles = [];
        $result = [];

        foreach ((array) $request->input('announcements', []) as $index => $row) {
            $title = trim($row['title'] ?? '');
            if ($title === '') {
                continue;
            }

            $fileName = null;

            // Only trust an existing file name if it really belonged to this record
            $existing = $row['existing_file'] ?? null;
            if ($existing && in_array($existing, $oldFiles, true) && empty($row['remove_file'])) {
                $fileName = $existing;
            }

            // New upload replaces the existing file
            if ($request->hasFile("announcements.$index.file")) {
                $file = $request->file("announcements.$index.file");
                $fileName = time() . rand(100, 999) . '_' . $index . '.' . strtolower($file->getClientOriginalExtension());
                $file->move(public_path(self::ANNOUNCEMENT_DIR), $fileName);
            }

            if ($fileName) {
                $keptFiles[] = $fileName;
            }

            $result[] = [
                'title' => $title,
                'file'  => $fileName,
            ];
        }

        // Delete old files that are no longer used (row removed, file replaced or removed)
        foreach (array_diff($oldFiles, $keptFiles) as $unused) {
            $path = public_path(self::ANNOUNCEMENT_DIR . '/' . $unused);
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        return $result;
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(false), $this->messages());

        try {
            // Banner image upload
            $bannerImage = null;
            if ($request->hasFile('banner')) {
                $image = $request->file('banner');
                $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/contact'), $bannerImage);
            }

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

            $contactDetails->announcements      = json_encode($this->buildAnnouncements($request));
            $contactDetails->social_media_links = json_encode($request->social_media);

            $contactDetails->inserted_by = Auth::id();
            $contactDetails->inserted_at = Carbon::now();
            $contactDetails->save();

            return redirect()->route('manage-contact-us.index')->with('message', 'Contact Details saved successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())->withInput();
        }
    }


    public function edit($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact_details = $contact->social_media_links ? json_decode($contact->social_media_links, true) : [];
        $announcements   = $contact->announcements ? json_decode($contact->announcements, true) : [];

        return view('backend.contact.edit', compact('contact', 'contact_details', 'announcements'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->rules(true), $this->messages());

        try {
            $contactDetails = ContactUs::findOrFail($id);

            // Banner image (optional on update)
            if ($request->hasFile('banner')) {
                $image = $request->file('banner');
                $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/contact'), $bannerImage);

                if ($contactDetails->banner_image && file_exists(public_path('uploads/contact/' . $contactDetails->banner_image))) {
                    unlink(public_path('uploads/contact/' . $contactDetails->banner_image));
                }

                $contactDetails->banner_image = $bannerImage;
            }

            $contactDetails->banner_heading       = $request->banner_heading;
            $contactDetails->email                = $request->email;
            $contactDetails->other_email          = $request->other_email;
            $contactDetails->map_url              = $request->url;
            $contactDetails->contact_number       = $request->contact_number;
            $contactDetails->other_contact_number = $request->other_contact_number;
            $contactDetails->i_frame              = $request->i_frame;
            $contactDetails->address              = $request->address;
            $contactDetails->desc                 = $request->desc;

            $oldAnnouncements = $contactDetails->announcements ? (json_decode($contactDetails->announcements, true) ?: []) : [];
            $contactDetails->announcements      = json_encode($this->buildAnnouncements($request, $oldAnnouncements));
            $contactDetails->social_media_links = json_encode($request->social_media);

            $contactDetails->modified_by = Auth::id();
            $contactDetails->modified_at = Carbon::now();
            $contactDetails->save();

            return redirect()->route('manage-contact-us.index')->with('message', 'Contact Details updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())->withInput();
        }
    }


    public function destroy(string $id)
    {
        try {
            $contact = ContactUs::findOrFail($id);
            $contact->update([
                'deleted_by' => Auth::id(),
                'deleted_at' => Carbon::now(),
            ]);

            return redirect()->route('manage-contact-us.index')->with('message', 'Data deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}