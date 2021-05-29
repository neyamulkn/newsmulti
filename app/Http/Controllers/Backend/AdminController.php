<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{

    public function profileEdit(){
	    return view('backend.setting.profile');
    }
    //profile update
    public function profileUpdate(Request $request){

	    $admin_id  = Auth::id();
	    $request->validate([
	        'name' => 'required',
	        'mobile' => ['required','unique:users,mobile,'.$admin_id],
	        'email' => ['email','unique:users,email,'.$admin_id],
        ]);

	    $profile = User::find($admin_id);
        $profile->name = $request->name;
        $profile->mobile = $request->mobile;
        $profile->email = $request->email;

        if ($request->hasFile('image')) {
            //delete image from folder
            $image_path = public_path('upload/images/users/thumb_image/'. $profile->photo);
            if(file_exists($image_path) && $profile->photo){
                unlink($image_path);
            }
            $image = $request->file('image');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image_path = public_path('upload/images/users/thumb_image/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(250, 250);
            $image_resize->save($image_path);
            $profile->photo = $new_image_name;
        }
        $profile->save();
	    Toastr::success('Profile update success');
	    return back();
    }

    //change Password
    public function passwordChange(Request $request){
        return view('backend.setting.change-password');
    }

    //password update
    public function passwordUpdate(Request $request){
        $user_id  = Auth::id();
        $check = User::find($user_id);
        if($check) {
            $this->validate($request, [
                'old_password' => 'required',
                'password' => 'required|confirmed:min:6'
            ]);

            $old_password = $check->password;
            if (Hash::check($request->old_password, $old_password)) {
                if (!Hash::check($request->password, $old_password)) {
                    $user = User::find($user_id);
                    $user->password = Hash::make($request->password);
                    $user->save();
                    Toastr::success('Password successfully change.', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('New password cannot be the same as old password.', 'Error');
                    return redirect()->back();
                }
            } else {
                Toastr::error('Old password not match', 'Error');
                return redirect()->back();
            }
        }else{
            Toastr::error('Sorry your password can\'t change.', 'Error');
            return redirect()->back();
        }
    }

}
