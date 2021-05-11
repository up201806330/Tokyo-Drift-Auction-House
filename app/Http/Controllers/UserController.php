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
            return redirect()->back();
        }

        // editing only the "about" part
        if ($request->has('about_update')) {
            User::where('id', $user_id)->update(['about' => $request->about_update]);
        }
        
        // editing only the profile image
        if ($request->file('profileimage')) {
            $file = $request->file('profileimage');

            $fileNameExtension = ".jpg";

            // Upload file
            $file->move(base_path('public\assets\profile_photos'), User::find($user_id)->profileimage . $newFileName);
        }

        // editing profile information
        else {
            User::where('id', $user_id)->update(
                [
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'username' => $request->username,
                    'location' => $request->location
                ]
            );
        }

        return redirect()->back()->withSuccess('Updated successfully');
    }

    public function showPhoto(Request $request, $user_id)
    {
        $user = User::find($user_id);
        return redirect('assets/'.$user->getImage()->path);
    }
}
