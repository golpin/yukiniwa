<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function myprofile()
    {
        $profile = Profile::where('user_id',Auth::id());

        return view('user.profile.myprofile',compact('profile'));
    }

    public function edit($id )
    {

    }

    public function update(Request $request, Profile $profile)
    {
        //
    }

    public function destroy(Profile $profile)
    {
        //
    }
}
