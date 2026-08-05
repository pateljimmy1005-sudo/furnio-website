<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Order;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        
        $totalOrders = Order::where('user_id', $user->id)->count();
        $recentOrders = Order::with(['items.product.featuredImage', 'legacyProduct.featuredImage'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        
        return view('profile.edit', [
            'user' => $user,
            'totalOrders' => $totalOrders,
            'recentOrders' => $recentOrders
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        $validated = $request->validated();
        
        if ($request->boolean('remove_photo')) {
            if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
                unlink(public_path($user->profile_photo));
            }
            $validated['profile_photo'] = null;
        } elseif ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
                unlink(public_path($user->profile_photo));
            }
            
            $image = $request->file('profile_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/users'), $imageName);
            $validated['profile_photo'] = 'uploads/users/' . $imageName;
        }
        
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's profile photo.
     */
    public function destroyPhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
            unlink(public_path($user->profile_photo));
        }

        $user->profile_photo = null;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-photo-deleted');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
