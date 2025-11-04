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
use App\Models\Grades;

class GradesController extends Controller
{

    public function index()
    {
        $faqs = Grades::whereNull('deleted_by')->get();
        return view('backend.grades.index', compact('faqs'));
    }

    public function create(Request $request)
    {
        return view('backend.grades.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate inputs
            $validated = $request->validate([
                'grade'        => 'required|string|max:500',
            ], [
                'grade.required' => 'FAQ Question is required.',
            ]);

            // ✅ Save FAQ to database
            $grade = new Grades(); 

            $grade->grade        = $request->grade;
            $grade->inserted_by    = Auth::id();
            $grade->inserted_at    = Carbon::now();
            $grade->save();

            return redirect()->route('manage-grades.index')
                            ->with('message', 'Grade added successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve;
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $grades = Grades::findOrFail($id);
        return view('backend.grades.edit', compact('grades'));
    }

    public function update(Request $request, $id)
    {
        try {
            // ✅ Validate inputs
            $validated = $request->validate([
                'grade'        => 'required|string|max:500',
            ], [
                'grade.required' => 'Grade is required.',
            ]);

            // ✅ Find existing FAQ
            $grade = Grades::findOrFail($id);


            // ✅ Update other fields
            $grade->grade        = $request->grade;
            $grade->modified_by     = Auth::id();
            $grade->modified_at     = Carbon::now();
            $grade->save();

            return redirect()->route('manage-grades.index')
                            ->with('message', 'Grades updated successfully.');

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
            $industries = Grades::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-grades.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}