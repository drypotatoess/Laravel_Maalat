<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
 
class AuthController extends Controller
{
    // REGISTER
    public function showRegister()
    {
        return view('register');
    }
 
    public function register(Request $request)
    {
        $request->validate([
            'fullname'        => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ], [
            'fullname.required'        => 'Full name is required.',
            'email.required'           => 'Email is required.',
            'email.email'              => 'Please enter a valid email.',
            'email.unique'             => 'This email is already registered.',
            'password.required'        => 'Password is required.',
            'password.min'             => 'Password must be at least 6 characters.',
            'confirmPassword.required' => 'Please confirm your password.',
            'confirmPassword.same'     => 'Passwords do not match.',
        ]);
 
        User::create([
            'name'     => $request->fullname,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
 
        return redirect()->route('register')->with('success', 'Account registered successfully!');
    }
 

    // LOGIN
    public function showLogin()
    {
        return view('login');
    }
 
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email is required.',
            'email.email'       => 'Please enter a valid email.',
            'password.required' => 'Password is required.',
        ]);
 
        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
 
        return redirect()->route('login')->with('error', 'Invalid email or password.');
    }
 
    // LOGOUT

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}