<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    // Login Page
    public function create(): View
    {
        return view('auth.login');
    }

    // Login Check
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
       
        $key = Str::lower($request->email).'|'.$request->ip();
             
if (RateLimiter::tooManyAttempts($key, 5)) {

    $seconds = RateLimiter::availableIn($key);
    $minutes = ceil($seconds / 60);

    return back()->withErrors([
        'email' => "Too many login attempts. Please try again after {$minutes} minutes.",
    ]);
}


        if (Auth::attempt($credentials, $request->remember)) {

             RateLimiter::clear($key);

            $request->session()->regenerate();
                     
                if (Auth::user()->status == 'blocked') {
                Auth::logout();

                 return back()->withErrors([
            'email' => 'Your account has been blocked.',
           ]);
            }

                // LAST LOGIN SAVE 
        Auth::user()->update([
        'last_login' => now()
         ]);

        // Merge Guest Cart
        $sessionCart = session()->get('cart', []);
        if (!empty($sessionCart)) {
            foreach ($sessionCart as $productId => $item) {
                $cart = \App\Models\Cart::where('user_id', Auth::id())
                    ->where('product_id', $item['product_id'])
                    ->first();
                if ($cart) {
                    $cart->quantity += $item['quantity'];
                    $cart->save();
                } else {
                    \App\Models\Cart::create([
                        'user_id' => Auth::id(),
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity']
                    ]);
                }
            }
            session()->forget('cart');
        }
 
          // Admin Login
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome Admin');
}

          // User Login 
          return redirect()->route('home')
            ->with('success', 'Login Successful');
        }

            RateLimiter::clear($key);

        return back()->withErrors([
            'email' => 'Invalid Email or Password',
        ])->onlyInput('email');
    }

    // Logout
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}