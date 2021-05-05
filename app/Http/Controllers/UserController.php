<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;
use DB;


class UserController extends Controller
{

    public function showProfile($id)
    {
        $profileOwner = User::find($id);
        $profileImage = Image::find($profileOwner->profileimage);
        
        return view('pages.profile', [
            'profileOwner' => $profileOwner,
            'profileImage' => $profileImage
        ]);
    }

    /**
     * Update the specified resource in database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request, $user_id)
    {
        if (! Gate::allows('profileOwner', Auth::user())) {
            // abort(403);
            return redirect()->back();
        }

        // editing only the "about" part at the moment
        User::where('id', $user_id)->update(['about' => $request->about_update]);

        return redirect()->back()->withSuccess('Updated successfully');
    }
}
