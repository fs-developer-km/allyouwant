<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()    { return view('frontend.auth.login'); }
    public function showRegister() { return view('frontend.auth.register'); }
    public function showForgotPassword() { return view('frontend.auth.forgot'); }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)) {
            $request->session()->regenerate();
            if (Auth::user()->isAdmin()) return redirect()->route('admin.dashboard');
            return redirect()->intended(route('home'));
        }
        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:15',
            'password' => 'required|min:6|confirmed',
        ]);
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'customer',
            'is_active'=> true,
        ]);
        Auth::login($user);
        return redirect()->route('home')->with('success','Welcome to GroceryMart!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function dashboard()
    {
        $user   = Auth::user();
        $orders = $user->orders()->latest()->take(5)->get();
        return view('frontend.account.dashboard', compact('user','orders'));
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        return back()->with('status', 'Password reset link sent to your email!');
    }
}
