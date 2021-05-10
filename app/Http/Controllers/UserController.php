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

        // editing only the "about" part at the moment
        if ($request->has('about_update')) {
            User::where('id', $user_id)->update(['about' => $request->about_update]);
        }
        
        if ($request->file('profileimage')) {
            $file = $request->file('profileimage');

            $newFileName = ".jpg";

            // Upload file
            // $file->move(base_path('public\assets\profile_photos'), "$user_id".$newFileName);
            // TODO not working without hardcoding for John Doe in specific cuz his user_id isnt the same as the image name
            $file->move(base_path('public\assets\profile_photos'), "17".$newFileName);

            // dd($file);
        }

        else {
            dd('no :(');
            
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
