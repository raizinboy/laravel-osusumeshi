<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function create(Request $request)
    {
        $profile = new Profile();
        $profile->user_id = Auth::id(); 
        $profile->content = $request->input('content');
        $profile->save();

        return to_route('mypage', Auth::id());
    }

    public function update(Request $request)
    {
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $profile->user_id = Auth::user()->id;
        $profile->content = $request->input('content');
        $profile->update();
        
        return to_route('mypage', Auth::user()->id);
    }
}
