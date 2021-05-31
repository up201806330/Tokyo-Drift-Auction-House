<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function showProfile(int $id) : View
    {
        $profileOwner = User::findOrFail($id);
        $profileImage = Image::findOrFail($profileOwner->profileimage);
        
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
    public function editProfile(Request $request, int $user_id) : RedirectResponse
    {
        if (! Gate::allows('profileOwner', Auth::user())) {
            return redirect()->back();
        }

        // editing only the "about" part
        if ($request->has('about_update')) {
            User::where('id', $user_id)->update(['about' => $request->about_update]);
        }
        
        // editing only the profile image
        else if ($request->file('profileimage')) {
            $file = $request->file('profileimage');

            $fileNameExtension = ".jpg";

            // Upload file
            $file->move(base_path('public\assets\profile_photos'), User::findOrFail($user_id)->profileimage . $newFileName);
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

    public function showPhoto(Request $request, int $user_id) : RedirectResponse
    {
        $user = User::findOrFail($user_id);
        return redirect('assets/'.$user->getImage()->path);
    }

    private function ban(Request $request, int $user_id) : RedirectResponse
    {
        if (Auth::guest()) {
            return view('layouts.error');
        }
        if (!$user->moderator()){
            return view('layouts.error');
        }

        $ban = new Ban([
            'user_id' => $user_id,
            'createdBy' => Auth::id(), 
            'banType' => "AllBan", 
            'auction_id' => $request->get('auction'),
        ]);
        $ban->save();

        return redirect()->back()->withSuccess('User banned successfully');
    }

    public function changePermissions(Request $request, int $user_id) : RedirectResponse
    {
        if (Auth::guest()) {
            return view('layouts.error');
        }
        if (!$user->admin()->exists()){
            return view('layouts.error');
        }

        $user = User::find($user_id);

        $seller = ($request->get('seller') == 'on');
        if ($user->seller()->exists() != $seller){
            $user->seller = $seller;
        }

        $global = ($request->get('global') == 'on');
        if ($user->globalMod()->exists() != $global){
            $user->globalMod = $global;
        }

        $user->save();

        return redirect()->back()->withSuccess('Permissions updated successfully');
    }

    public function delete(Request $request, int $user_id) : RedirectResponse
    {
        if (Auth::guest()) {
            return view('layouts.error');
        }
        if (!$user->admin()->exists()){
            return view('layouts.error');
        }

        $user = User::find($user_id);

        $user->delete();

        return redirect('/')->with('message', 'User deleted successfully!');    }
}
