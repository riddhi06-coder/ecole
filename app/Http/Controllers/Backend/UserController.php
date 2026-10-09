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

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('role')->whereNull('deleted_by')->get();
        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Roles::all();
        return view('backend.users.create', compact('roles'));
    }
    
    public function store(Request $request)
    {
        // Validation Rules
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
    
            'user_name' => 'required|string|max:255',
    
            'email' => 'required|email|unique:users,email',
    
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/',
            ],
    
            'password_confirmation' => 'required|same:password',
        ], [
            'role_id.required' => 'Please select a role.',
            'role_id.exists'   => 'Invalid role selection.',
    
            'user_name.required' => 'User Name is required.',
    
            'email.required' => 'Email is required.',
            'email.email'    => 'Email must be a valid email address.',
            'email.unique'   => 'This email is already registered.',
    
            'password.required' => 'Password is required.',
            'password.min'      => 'Password must be at least 8 characters.',
            'password.regex'    => 'Password must contain uppercase, lowercase, number, and symbol.',
    
            'password_confirmation.required' => 'Confirm Password is required.',
            'password_confirmation.same'     => 'Passwords do not match.',
        ]);
    
        try {
    
            // Save User
            $user = new User();
            $user->role_id   = $validated['role_id'];
            $user->name = $validated['user_name'];
            $user->status = 1;
            $user->email     = $validated['email'];
            $user->password  = bcrypt($validated['password']);
            $user->created_at = Carbon::now();
            $user->save();
    
            return redirect()
                    ->route('manage-users.index')
                    ->with('message', 'User created successfully.');
    
        } catch (\Exception $e) {
            return back()
                    ->with('error', 'Something went wrong! Please try again.')
                    ->withInput();
        }
    }
    
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
    
        $user->status = !$user->status; 
        $user->save();
    
        return back()->with('success', 'User status updated successfully.');
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Roles::all();
    
        return view('backend.users.edit', compact('user', 'roles'));
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validation Rules
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
    
            'user_name' => 'required|string|max:255',
    
            'email' => 'required|email|unique:users,email,' . $user->id,
    
            // Password is OPTIONAL during edit
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/',
            ],
    
            'password_confirmation' => 'nullable|same:password',
    
        ], [
            'role_id.required' => 'Please select a role.',
            'role_id.exists'   => 'Invalid role selection.',
    
            'user_name.required' => 'User Name is required.',
    
            'email.required' => 'Email is required.',
            'email.email'    => 'Email must be a valid email address.',
            'email.unique'   => 'This email is already registered.',
    
            'password.min'      => 'Password must be at least 8 characters.',
            'password.regex'    => 'Password must contain uppercase, lowercase, number, and symbol.',
    
            'password_confirmation.same' => 'Passwords do not match.',
        ]);
    
        try {
    
            // Update fields
            $user->role_id = $validated['role_id'];
            $user->name    = $validated['user_name'];
            $user->email   = $validated['email'];
    
            // Update password only if provided
            if (!empty($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }
    
            $user->updated_at = now();
            $user->save();
    
            return redirect()
                ->route('manage-users.index')
                ->with('message', 'User updated successfully.');
    
        } catch (\Exception $e) {
    
            return back()
                ->with('error', 'Something went wrong! Please try again.')
                ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = User::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-users.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }




    
}