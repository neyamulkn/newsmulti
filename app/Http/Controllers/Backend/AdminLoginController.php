<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

class AdminLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin', ['except' => ['logout']]);
    }

 	public function LoginForm()
    {
      return view('backend.login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request,[
        'emailOrMobile' => 'required',
        'password' => 'required',
        ]);

        $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        // Attempt to log the admin in
        if(Auth::guard('admin')->attempt(array($fieldType => $request->emailOrMobile, 'password' => $request->password, 'role_id' => 'admin', 'status' => 'active')))
        {
            Toastr::success('Logged in success.');
            return redirect()->intended(route('admin.dashboard'));
        }else {
            return back()->withInput()->with('error', $fieldType. ' or password is invalid.');
        }
    }

  public function logout()
  {
      Auth::guard('admin')->logout();
      Toastr::success('Just Logged Out!');
      return redirect()->route('adminLoginForm');
    }
  }
