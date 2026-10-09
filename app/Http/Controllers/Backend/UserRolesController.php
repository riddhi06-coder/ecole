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
use App\Models\Roles;

class UserRolesController extends Controller
{

    public function index()
    {
        $roles = Roles::whereNull('deleted_by')->get(); 
        return view('backend.roles.index', compact('roles'));
    }
    
    public function create(Request $request)
    {
        return view('backend.roles.create');
    }
    
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,role_name',
        ], [
            'role_name.required' => 'Role Name is required.',
            'role_name.string'   => 'Role Name must be a valid string.',
            'role_name.max'      => 'Role Name cannot be more than 255 characters.',
            'role_name.unique'   => 'This Role Name already exists.',
        ]);
    
        try {
            // Save to database
            $role = new Roles();
            $role->role_name = $validated['role_name'];
            $role->inserted_by = Auth::id();
            $role->inserted_at = Carbon::now();
            $role->save();
    
            return redirect()->route('manage-roles.index')
                             ->with('message', 'Role created successfully.');
    
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! Please try again.')
                         ->withInput();
        }
    }
    
    public function edit($id)
    {
        $role = Roles::findOrFail($id);
        return view('backend.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,role_name,' . $id,
        ], [
            'role_name.required' => 'Role Name is required.',
            'role_name.string'   => 'Role Name must be a valid string.',
            'role_name.max'      => 'Role Name cannot be more than 255 characters.',
            'role_name.unique'   => 'This Role Name already exists.',
        ]);
    
        try {
            // Find and update record
            $role = Roles::findOrFail($id);
            $role->role_name = $validated['role_name'];
            $role->modified_by = Auth::id();
            $role->modified_at = Carbon::now();
            $role->save();
    
            return redirect()->route('manage-roles.index')
                             ->with('message', 'Role updated successfully.');
    
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! Please try again.')
                         ->withInput();
        }
    }
    
    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Roles::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-roles.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }



}