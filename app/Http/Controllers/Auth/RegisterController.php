<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

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

        $email = $mobile = null;
        if (filter_var($data['mobile_or_email'], FILTER_VALIDATE_EMAIL)) {
            $email = $data['mobile_or_email'];
            $check= User::select('username')->where('email', $email)->first();
            Toastr::error('Sorry email already exists.');
        }else{
            $mobile = $data['mobile_or_email'];
            $check = User::select('username')->where('mobile', $mobile)->first();
            Toastr::error('Sorry mobile already exists.');
        }

        if($check){
            return back();
            exit();
        }
        return User::create([
            'name' => $data['name'],
            'username' => $this->createSlug($data['name']),
            'email' => $email,
            'mobile' => $mobile,
            'role_id' => 'user',
            'created_by' => 0,
            'password' => Hash::make($data['password']),
            'status' => 'active',
        ]);

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
                if (!$check_slug->contains('news_slug', $newSlug)) {
                    return $newSlug;
                }
            }
        }else{ return $slug; }
    }
}
