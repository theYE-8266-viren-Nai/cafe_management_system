<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }
    public function register (){
        return view('register');
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function authenticate(){

        if (Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }
        else {
            return redirect()->route('user.orderMenu');
        }
    }
    public function viewChangePassword(){
        return view('admin.changePassword');
    }
    public function changePassword(request $request){
        $this->passwordValidationCheck($request);
        // $this->passwordValidationCheck($request);
        $user = Auth::user();
        $old_password = $user->password;
        $new_password = $request->toArray()['new_password'];
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $user->password = $new_password;

        // Save the changes to the database
        $user->save();
        session()->flash('update_password', 'Password updated successfully!');
        // $user->password = Hash::make($request->new_password);


        return redirect()->route('category#list');

    }
    public function account_view(){
        // Get the authenticated user's ID
        $user_id = Auth::user()->id;

        // Retrieve user data for the given ID
        $user_data = User::where('id', $user_id)->select('*')->first();
        // dd($user_data->toArray());
        // Pass 'user_data' to the view using 'compact'
        return view('account.detail', compact('user_data'));
    }
    //edit
    public function editProfile (){
        $user_id = Auth::user()->id;

        // Retrieve user data for the given ID
        $user = User::where('id', $user_id)->select('*')->first();
        return view('account.editProfile',compact('user'));
    }
    public function editProfileData(Request $request)
{
    $user = Auth::user(); // Get the authenticated user

    // Update the user's name, email, phone, and address
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone; // Update phone if provided
    $user->address = $request->address; // Update address if provided

    // Handle profile picture upload
    if ($request->hasFile('image')) {
        // Check if the user already has a profile picture
        if ($user->profile_photo_path) {
            // Delete the existing profile image from storage
            Storage::delete('public/' . $user->profile_photo_path);
        }

        // Generate a unique name for the new image
        $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();

        // Store the new profile image in the 'public/profile_pictures' folder
        $request->file('image')->storeAs('public/profile_pictures', $fileName);

        // Update the user's profile picture path
        $user->profile_photo_path = 'profile_pictures/' . $fileName; // Save the file path with the folder name
    }

    // If a new password is provided, update it
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Save the user's changes
    $user->save();

    // Redirect with a success message
    return redirect()->route('category#list')->with('success', 'Your profile has been updated successfully.');
}
    //adminList
    public function viewAdminList(){
        $admin = User::where('role', 'admin') // Filter by role
        ->when(request('key'), function($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(4);

    return view('admin.adminList', compact('admin'));
    }
    public function deleteAdmin($id){
        $adminId = Auth::user()->id;
        if($id == $adminId){
            return back()->with('delSuccess', 'You cannot delete you own account !');
        }
        else {
            User::where('id' , $id)->delete();
           return back()->with('delSuccess', 'Admin deleted successfully!');
        }
    }
    public function roleChange ($id){
        $adminId = Auth::user()->id;
        if($id == $adminId){
            return back()->with('delSuccess', 'You cannot change the role of your own account !');
        }
        else {
            $user = User::findOrFail($id);
            $userRole = $user->role;
            if($userRole == 'user') {
                $user->role = 'admin';
                $user->save();
                return back()->with('success', 'Role has been changed successfully !');
            }
            else {
                $user->role = 'user';
                $user->save();
                return back()->with('success', 'Role has been changed successfully !');
            }
        }
    }
    //

    private function passwordValidationCheck($request)
    {
        // Validate all fields are required and passwords match the criteria
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:new_password',
        ], [
            'old_password.required' => 'Old password is required',
            'new_password.required' => 'New password is required and must be at least 6 characters',
            'confirm_password.required' => 'Confirm password is required and must match the new password',
            'confirm_password.same' => 'New password and confirm password must match',
        ]);

        // Check if old password matches the one in the database
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            // If old password doesn't match, throw an error
            return back()->withErrors(['old_password' => 'The old password is incorrect']);
        }
    }

}
