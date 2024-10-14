<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Laravel\Facades\Image;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $merchant = Auth::user()->merchant;

        return view('dashboard.user_profile', [
            'title' => 'User Profile',
            'user' => $user,
            'merchant' => $merchant,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
        // ID Check
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);

        // Check data validation
        $validatedData = $request->validated();

        if ($request->hasFile('profile_picture')) {
            // Load the image
            $file = $request->file('profile_picture');
            $image = Image::read($file);

            // Make the image fit and convert to WEBP format
            $image->coverDown(900, 900);
            $image->encode(new WebpEncoder(quality: 90));
            $file_name = now()->timestamp.'.webp';

            // Save the resized image to storage
            Storage::put('public/user_profile/'.$file_name, (string) $image->encode());

            // Delete old profile picture
            if ($user->profile_picture) {
                $path = public_path('storage/user_profile/'.$user->profile_picture);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Put the data in the database
            $validatedData['profile_picture'] = $file_name;
        }

        // Update database
        $request->user()->update($validatedData);

        // Redirect or return response
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }

    // Remove user profile picture
    public function removeProfilePicture($userId)
    {
        $user = User::findOrFail($userId);

        // Delete avatar file
        if ($user->profile_picture) {
            $path = public_path('storage/user_profile/'.$user->profile_picture);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Clear avatar field in the database
        $user->profile_picture = null;
        $user->save();

        return back()->with('success', 'Profile picture deleted successfully!');
    }

    // Change user's password
    public function changePassword(ChangePasswordRequest $request)
    {
        $validatedData = $request->validated();

        if (! Hash::check($validatedData['current_password'], $request->user()->password)) {
            return back()->withErrors(['error' => 'The current password is incorrect.']);
        }

        $request->user()->update(['password' => Hash::make($validatedData['password'])]);

        return back()->with('success', 'Password changed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
