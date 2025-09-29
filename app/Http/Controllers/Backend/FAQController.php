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
use App\Models\Faqs;

class FAQController extends Controller
{

    public function index()
    {
        $faqs = Faqs::whereNull('deleted_by')->get();
        return view('backend.admission.faq.index', compact('faqs'));
    }

    public function create(Request $request)
    {
        return view('backend.admission.faq.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate inputs
            $validated = $request->validate([
                'banner_heading' => 'nullable|string|max:255',
                'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'faq_qts'        => 'required|string|max:500',
                'faq_ans'        => 'required|string|max:5000',
            ], [
                'faq_qts.required' => 'FAQ Question is required.',
                'faq_ans.required' => 'FAQ Answer is required.',
                'image.image'      => 'Please upload a valid image file.',
                'image.mimes'      => 'Only jpg, jpeg, png, webp, svg files are allowed.',
                'image.max'        => 'Image must not be larger than 2MB.',
            ]);

            // ✅ Handle banner image upload
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admissions'), $imageName);
            }

            // ✅ Save FAQ to database
            $faq = new Faqs(); 
            $faq->banner_heading = $request->banner_heading;
            $faq->banner_image   = $imageName;
            $faq->faq_qts        = $request->faq_qts;
            $faq->faq_ans        = $request->faq_ans;
            $faq->inserted_by    = Auth::id();
            $faq->inserted_at    = Carbon::now();
            $faq->save();

            return redirect()->route('manage-faqs.index')
                            ->with('message', 'FAQ added successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve;
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $faq = Faqs::findOrFail($id);
        return view('backend.admission.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        try {
            // ✅ Validate inputs
            $validated = $request->validate([
                'banner_heading' => 'nullable|string|max:255',
                'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'faq_qts'        => 'required|string|max:500',
                'faq_ans'        => 'required|string|max:5000',
            ], [
                'faq_qts.required' => 'FAQ Question is required.',
                'faq_ans.required' => 'FAQ Answer is required.',
                'image.image'      => 'Please upload a valid image file.',
                'image.mimes'      => 'Only jpg, jpeg, png, webp, svg files are allowed.',
                'image.max'        => 'Image must not be larger than 2MB.',
            ]);

            // ✅ Find existing FAQ
            $faq = Faqs::findOrFail($id);

            // ✅ Handle banner image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($faq->banner_image && file_exists(public_path('uploads/admissions/' . $faq->banner_image))) {
                    unlink(public_path('uploads/admissions/' . $faq->banner_image));
                }

                $image = $request->file('image');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admissions'), $imageName);

                $faq->banner_image = $imageName;
            }

            // ✅ Update other fields
            $faq->banner_heading = $request->banner_heading;
            $faq->faq_qts        = $request->faq_qts;
            $faq->faq_ans        = $request->faq_ans;
            $faq->modified_by     = Auth::id();
            $faq->modified_at     = Carbon::now();
            $faq->save();

            return redirect()->route('manage-faqs.index')
                            ->with('message', 'FAQ updated successfully.');

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
            $industries = Faqs::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-faqs.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}