<?php

namespace App\Http\Controllers\Reporter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ReporterLoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:reporter', ['except' => ['logout']]);
    }

    public function loginForm() {

      return view('reporter.login');
    }

    public function login(Request $request) {


      $this->validate($request, [
            'emailOrMobile' => 'required',
            'password' => 'required',
        ]);

        $emailOrMobile = trim($request->emailOrMobile);
        $password = trim($request->password);
        //remember credentials
        Cookie::queue('reporterEmailOrMobile', $emailOrMobile, time() + (86400));
        Cookie::queue('reporterPassword', $password, time() + (86400));

        $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

      if(Auth::guard('reporter')->attempt(array($fieldType => $emailOrMobile, 'password' => $password)))
      {
          if (Auth::guard('reporter')->user()->status != 'active') {
              Auth::guard('reporter')->logout();
              Toastr::error('Your account is deactivated');
              return back()->with('error', 'Your account is deactivated');
          }
          Toastr::success('Logged in success.');
          return redirect()->intended(route('reporter.dashboard'));
      }
      else {
        Toastr::error( $fieldType. ' or password is invalid.');
        return back()->withInput();
      }
    }

    public function logout() {
      Auth::guard('reporter')->logout();
      Toastr::success('Just Logged Out!');
      return redirect()->route('reporterLogin');
    }
}
