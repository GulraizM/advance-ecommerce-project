<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    public function Index()
    {
        return view('frontend.index');
    }

    public function userLogout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }

    public function userProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function userProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$user->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $user['profile_photo_path'] = $filename;
        }

        $user->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function userChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_change_password', compact('user'));
    }

    public function userPasswordUpdate(Request $request)
    {
        $validateData = $request->validate(
            [
                'oldpassword' => 'required',
                'password' => 'required|confirmed'
            ]);

            $id = Auth::user()->id;
            $user = User::find($id);
                
            $hashedPassword = User::find($id)->password;
            if (Hash::check($request->oldpassword,$hashedPassword)) {
                $user = User::find($id);
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect()->route('user.logout');
            } else {     
    
            return redirect()->back();
    
            }
    }





}
