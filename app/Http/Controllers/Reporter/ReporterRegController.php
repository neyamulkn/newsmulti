<?php

namespace App\Http\Controllers\Reporter;

use App\Models\Deshjure;
use App\Models\Notification;
use App\Models\State;
use App\Traits\CreateSlug;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting as GS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ReporterRegController extends Controller
{
    use CreateSlug;

    public function __construct()
    {
        $this->middleware('guest:reporter', ['except' => ['logout']]);
    }

    public function registerForm() {
        $data['states'] = Deshjure::where('cat_type', 1)->get();
        $data['user_details'] = [];
        if(Auth::check()){
            $data['user_details'] = User::where('id', Auth::id())->first();
        }
        return view('reporter.register')->with($data);
    }

    public function register(Request $request) {

        $gs = GS::first();
        if ($gs->registration == 0) {
          Toastr::error('alert', 'Registration is closed by Admin');
          return back();
        }

        Session::put('state', $request->state);
        Session::put('city', $request->city);
        Session::put('area', $request->area);

        $validatedRequest = $request->validate([
            'shop_name' => 'required',
            'reporter_name' => 'required',
            'mobile' => 'required|min:11|numeric|regex:/(01)[0-9]/|unique:reporters',
            'password' => 'required|confirmed|min:6'
        ]);

        if($request->email){
            $request->validate([
               'email' => ['required', 'string', 'email', 'max:255', 'unique:reporters'],
            ]);
        }

        $mobile = trim($request->mobile);
        $email = trim($request->email);
        $password = trim($request['password']);

        $username = explode(' ', trim($request->shop_name))[0];
        $reporter = new reporter;
        $reporter->shop_name = $request->shop_name;
        $reporter->slug = $this->createSlug('reporters', $request->shop_name);
        $reporter->reporter_name = $request->reporter_name;
        $reporter->username = $this->createSlug('reporters', $username, 'username');
        $reporter->email = $email;
        $reporter->mobile = $mobile;
        $reporter->country = $request->country;
        $reporter->state = $request->state;
        $reporter->city = $request->city;
        $reporter->area = ($request->area) ? $request->area : null;
        $reporter->address = $request->address;
        $reporter->email_verification_token = $gs->email_verification == 0 ? rand(1000, 9999):NULL;
        $reporter->mobile_verification_token = $gs->sms_verification == 0 ? rand(1000, 9999):NULL;

        $reporter->status = 'pending';
        $reporter->password = Hash::make($password);;
        $success = $reporter->save();

        if($success) {

            $emailOrMobile = ($request->email ? $request->email : $request->mobile);

            Cookie::queue('reporterEmailOrMobile',$mobile, time() + (86400));
            Cookie::queue('reporterPassword', $password, time() + (86400));

            //insert notification in database
            Notification::create([
                'type' => 'reporter-register',
                'fromUser' => $reporter->id,
                'toUser' => 0,
                'item_id' => $reporter->id,
                'notify' => 'register new seller',
            ]);
            Toastr::success('Registration in success.');
            return back()->with('success', $request->reporter_name. ', your information will be reviewed by Admin. We will let you know about the update (after review) through Phone\Email once it\'s been checked!');

        }else{
            Toastr::error('Registration failed try again.');
            return back()->withInput();
        }

        Toastr::error('Registration failed try again.');
        return back()->withInput();
    }


}
