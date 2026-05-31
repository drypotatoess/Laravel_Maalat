<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
 
class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile');
    }
 
    public function update(Request $request)
    {
        $user = auth()->user();
 
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
 
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->gender  = $request->gender;
        $user->contact = $request->contact;
        $user->address = $request->address;
 
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
 
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $user->profile_picture = $path;
        }
 
        $user->save();
 
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}