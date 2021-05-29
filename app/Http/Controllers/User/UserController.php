<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\ReadLater;
use App\Traits\CreateSlug;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function myProfile(){
        $data = [];
        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.users.'; }
        $user_id = Auth::id();
        $data['user_details'] = User::where('id', $user_id)->first();
        if($data['user_details']){
            return view($folder.'user-profile')->with($data);
        }else{
            return view($folder.'404');
        }
    }


    public function profileUpdate(Request $request){

        $user_id = Auth::user()->id;
        $request->validate([
            'name' => ['required', 'max:255'],
            'mobile' => ['required','unique:users,mobile,'.$user_id],
            'email' => ['email','unique:users,email,'.$user_id],
            'gender' => ['required'],
        ]);

        $user = User::find($user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        if($request->hasFile('image')){
            //delete image from folder
            $image_path = public_path('upload/images/users/'. $user->photo);
            if(file_exists($image_path) && $user->photo){
                unlink($image_path);
            }
            $image = $request->file('image');
            $image_name = time().$image->getClientOriginalName();
            $image_path = public_path('upload/images/users/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $user->photo = $image_name;
        }
        $update = $user->save();
        if($update){
            Toastr::success('Profile update successful.');
            return back();
        }else{
            Toastr::error('Sorry update failed.');
            return back();
        }
    }
    public function addedReadLater(Request $request){
        $user_id = Auth::user()->id;
        $check_exist = ReadLater::where('news_id', $request->news_id)->where('user_id', $user_id)->first();
        if(!$check_exist){
            $insert = ReadLater::create(['news_id' => $request->news_id, 'user_id' => $user_id]);
            echo 'সংবাদ রিড লেটার বক্সে সেভ হয়েছে ।';
        }else
        {
            echo 'এই খবর ইতিমধ্যে রিড লেটার বক্সে সেভ আছে ।';
        }
    }
    public function viewReadLater(){
         if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.users.'; }
        $user_id = Auth::user()->id;
        $data['user'] = User::where('id', $user_id)->first();
        if($data['user']){
            $data['read_later_news'] = ReadLater::where('user_id',  $data['user']->id)->paginate(21);
            return view($folder.'readLater')->with($data);
        }else{
           return view($folder.'.404');
        }

    }
}
