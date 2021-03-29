<?php

namespace App\Http\Controllers;

use App\Models\read_later;
use App\Models\Reporter;
use App\Models\Notification;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Redirect;
class UserController extends Controller
{
    public function registration(Request $request)
    {

    	$request->validate([
			'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if(config('siteSetting.reCaptcha_login') == 1){
            $secretKey = config('siteSetting.recaptcha_secret_key');
            $captcha = $_POST['g-recaptcha-response'];
            
            if(!$captcha){
                Toastr::error('Please check the robot check.');
                return back();
            }
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
            $responseKeys = json_decode($response,true);


            if(intval($responseKeys["success"]) !== 1) {
                Toastr::error('Please check the robot check.');
                return back();
            }
        }
        $email = $phone = null;
        if (filter_var($request['mobile_or_email'], FILTER_VALIDATE_EMAIL)) {
            $email = $request['mobile_or_email'];
            $check = User::select('username')->where('email', $email)->first();
            $msg = 'Sorry email already exists.';
        }else{
        	$phone = $request['mobile_or_email'];

			if(!is_numeric($phone) OR strlen($phone)<10){

			    Toastr::error('Invalid mobile number or email.');
			    return back();
			}

            $check = User::select('username')->where('phone', $phone)->first();
            $msg = 'Sorry mobile number already exists.';
        }

        if($check){
        	Toastr::error($msg);
            return back();
            exit();
        }
        $success = User::create([
            'name' => $request['name'],
            'username' => $this->createSlug($request['name']),
            'email' => $email,
            'phone' => $phone,
            'role_id' => 3,
            'creator_id' => 0,
            'password' => Hash::make($request['password']),
            'status' => '1',
        ]);

        if($success){
            // if(Auth::attempt(['email' => $request['mobile_or_email'], 'password' => $request->password]) || Auth::attempt(['phone' => $request['mobile_or_email'], 'password' => $request->password])) {
            // }
        	Toastr::success('Your registration successful.');
        	return Redirect::route('login');
        }else{
            Toastr::error('Sorry registration failed.');
        	return back();
        }

    }

    public function update_profile(Request $request){
       // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'max:15'],
            'gender' => ['required'],
        ]);
        $user_id = Auth::user()->id;
        $email = $phone = null;

            $email = $request['email'];
            $email_check = User::select('username')->where('email', '=', $email)->first();
//            if($email_check){
//                if($email_check->email != $email){
//                    Toastr::error('Sorry email already exists.');
//                }
//            }

            $phone = $request['phone'];
            if(!is_numeric($phone) OR strlen($phone)<10){
                Toastr::error('Invalid mobile number.');
                return back();
            }

        $data = [
            'name' => $request['name'],
            'email' => $email,
            'phone' => $phone,
            'gender' => $request['gender'],
            'birthday' => $request['birthday'],
        ];

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().$image->getClientOriginalName();
            $image_path = public_path('upload/images/users/thumb_image/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $image_path = public_path('upload/images/users/'.$image_name );
            Image::make($image)->save($image_path);
            $success = User::where('id', $user_id)->update(['image' => $image_name ]);

            $data = array_merge($data, ['image' => $image_name]);
        }

        $success = User::where('id', $user_id)->update($data);

        if($success){
            Toastr::success('Your updatee successful.');
            return back();
        }else{
            Toastr::error('Sorry updatee failed.');
            return back();
        }
    }

    public function insert_request_reporter(Request $request){
           $request->validate([
            'name' => ['required'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'max:16', ],
            'gender' => ['required'],
            'birthday' => ['required'],
            'present_address' => ['required'],
            'permanent_address' => ['required'],
            'profession' => ['required'],

        ]);

        $user_id = Auth::user()->id;
        $user_data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
        ];

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().$image->getClientOriginalName();
            $image_path = public_path('upload/images/users/thumb_image/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $image_path = public_path('upload/images/users/'.$image_name );
            Image::make($image)->save($image_path);

            $user_data = array_merge($user_data, ['image' => $image_name]);
        }

        $update = User::where('id', $user_id)->update($user_data);

        if($update){
            $data = [
                'user_id' => $user_id,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'present_address' => $request->present_address,
                'permanent_address' => $request->permanent_address,
                'national_id' => $request->national_id,
                'profession' => $request->profession,
                'status' => 0,
            ];

            if($request->hasFile('resume')){
                $resume = $request->file('resume');
                $resume_name = time().$resume->getClientOriginalName();
                $resume->move(public_path('upload/attach/resume'), $resume_name);

                $data = array_merge($data, ['resume' => $resume_name]);
            }

            $check = Reporter::updateOrCreate(['user_id' => $user_id], $data);
            if($check){
                $toUser = User::where('role_id', env('ADMIN'))->first();
                $notify = [
                    'fromUser' => $user_id,
                    'toUser' => $toUser->id,
                    'type' => env('REPORTER_NOTIFY'),
                    'notify' => 'sending reporter request',
                 ];
                Notification::create($notify);
            }
            Toastr::success('Reporter request submited successfully.');
        }else{
            Toastr::error('Reporter request submited failed.');
        }
        return back();
    }

    public function readLater(Request $request){
        $user_id = Auth::user()->id;
        $check_exist = read_later::where('news_id', $request->news_id)->where('user_id', $user_id)->first();
        if(!$check_exist){
            $insert = read_later::create(['news_id' => $request->news_id, 'user_id' => $user_id]);
            echo 'সংবাদ রিড লেটার বক্সে সেভ হয়েছে ।';
        }else
        {
            echo 'এই খবর ইতিমধ্যে লেটার বক্সে সেভ আছে ।';
        }
    }
    public function viewReadLater($username){
         if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }
        $data['user'] = User::where('username', $username)->first();
        if($data['user']){
            $data['read_later_news'] = read_later::where('user_id',  $data['user']->id)->paginate(21);
            return view($folder.'readLater')->with($data);
        }else{
           return view($folder.'.404');
        }


    }


    public function createSlug($slug)
    {
        $slug = strTolower(preg_replace('/[\s-]+/', '-', trim($slug)));
        $slug = (preg_replace('/[?.]+/', '', $slug));
        $check_slug = User::select('username')->where('username', 'like', $slug.'%')->get();

        if (count($check_slug)>0){
            //find slug until find not used.
            for ($i = 1; $i <= count($check_slug); $i++) {
                $newSlug = $slug.'-'.$i;
                if (!$check_slug->contains('username', $newSlug)) {
                    return $newSlug;
                }
            }
        }else{ return $slug; }
    }

    public function login(){
        return view('auth.login');
    }

    // login from comment form
    public function userlogin(Request $request){
        $request->validate([
            'mobile_or_email' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt(['email' => $request['mobile_or_email'], 'password' => $request->password]) || Auth::attempt(['phone' => $request['mobile_or_email'], 'password' => $request->password])) {
                Toastr::success('login successfull');
                return Redirect()->back();

        }else{
            Session::flash('submitType', 'openmodel');
            Toastr::error('Invalid mobile or email address');
            return Redirect()->back();
        }
    }
}
