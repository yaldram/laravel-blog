<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

use App\User;

class SettingsController extends Controller
{
    public function index() 
    {
    	return view('admin.settings');
    }

    public function updateProfile(Request $request) 
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'email' => 'required',
    		'image' => 'required|image'
    	]);

    	$image = $request->file('image');
    	$slug = str_slug($request->name);
    	$user = User::findOrFail(Auth::id());
    	if(isset($image)) 
    	{
    		$currentDate = Carbon::now()->toDateString();
    		$imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

    		if(Storage::disk('public')->exists('profile'))
    		{
    			Storage::disk('public')->makeDirectory('profile');
    		}

    		//delete old profile image
    		if(Storage::disk('public')->exists('profile/'.$user->image))
    		{
    			Storage::disk('public')->delete('profile/'.$user->image);
    		}

    		$profileImage = Image::make($image)->resize(500, 500)->save($imagename);

    		Storage::disk('public')->put('profile/' .$imagename, $profileImage);

    	} else {
    		$imagename = $user->image;
    	}

    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->image = $imagename;
    	$user->about = $request->about;
    	$user->save();
    	Toastr::success('Profile Updated Successfully :)', 'Success');

    	return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
    	$this->validate($request, [
    		'old_password' => 'required',
    		'password' => 'required|confirmed',
    	]);

    	$hashedPassword =Auth::user()->password;
    	if(Hash::check($request->old_password, $hashedPassword))
    	{
    		if(!Hash::check($request->password, $hashedPassword))
    		{
    			$user = User::find(Auth::id());
    			$user->password = Hash::make($request->password);
    			$user->save();
    			Toastr::success('Password Updated Successfully :)', 'Success');
    			Auth::logout();
    			return redirect()->back();
    		} else {
    			Toastr::error('New Password Cannot Be Same As Old', 'Error');
    			return redirect()->back();
    		}
    	} else {
    		Toastr::error('Your Password Does Not Match', 'Error');
    			return redirect()->back();
    	}
    }
}
