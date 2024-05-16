<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function show($name)
    {
        $user = User::where('name', $name)->with(['stores', 'products', 'profile'])->first();
        return view(
            "dashboard.profile.show",
            [
                'user' => $user,
            ]
        );
    }
    public function edit()
    {
        $profile = profile::where('user_id', Auth::user()->id)->first();
        return view(
            "dashboard.profile.edite ",
            [
                'profile' => $profile,
                'user' => Auth::user(),
                'countries' => Countries::getNames('ar'),
                'locales' => Languages::getNames('ar'),
            ]
        );
    }
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female'],
            'country' => ['required', 'string'],
            // 'local' => ['required','size:2']

        ]);
        if ($request->has('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('/profile'), $filename);
            $request->merge([
                'profile_image' => $filename,
            ]);
        }
        $request->merge([
            'user_id' => Auth::user()->id,

        ]);
        if ($request->image !== null && Auth::user()->profile->profile_image !== null) {
            File::delete(public_path('profile/' . Auth::user()->profile->profile_image));
        }

        $user = $request->user();
        Auth::user()->profile->fill($request->all())->save();
        $user->update([
            'phone_number' => $request->phone_number
        ]);
        return redirect(route('profile.show', $user->name));
    }
}