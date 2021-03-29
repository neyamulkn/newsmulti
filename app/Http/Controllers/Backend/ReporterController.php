<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Reporter;


use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ReporterController extends Controller
{

    public function index()
    {
        $get_reporter = User::with('userinfo')->where('role_id', 2)->orWhere('role_id', 4)->orWhere('role_id', 5)->get();
        return view('backend.reporter-list')->with(compact('get_reporter'));
    }

    public function create()
    {
        return view('backend.reporter');
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        $user_id = Auth::user()->id;

        $image_name = 'author-image.png';
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name =  time().$image->getClientOriginalName();
            $image_path = public_path('upload/images/users/thumb_image/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $image_path = public_path('upload/images/users/'.$image_name );
            Image::make($image)->save($image_path);
        }

        $insert = User::create([
            'name' => $request->reporter_name,
            'username' =>$request->username,
            'phone' =>$request->phone,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'image' => $image_name,
            'creator_id' => $user_id,
            'password' => Hash::make($request->password),
            'status' => ($request->status) ? '1' : '0',
        ]);

        if($insert){
            $data = [
                'user_id' => $insert->id,
                'designation' => $request->designation,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'present_address' => $request->present_address,
                'permanent_address' => $request->permanent_address,
                'appointed_date' => $request->appointed_date,
                'national_id' => $request->national_id,
            ];
            Reporter::create($data);
            Toastr::success('Reporter Created Successfully.');
        }else{
            Toastr::error('Reporter Cann\'t Created.');
        }
        return back();
    }

    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $data = [];

        $reporter = Reporter::where('user_id', $id);
        if(Auth::user()->role_id != 1){
            $reporter =  $reporter->where('id', $user_id);
        }
        $data['reporter'] =  $reporter->first();

        if($data['reporter']){
            return view('backend.reporter-edit')->with($data);
        }else{
            Toastr::error('Sorry invalid user try again!.');
            return back();
        }
    }

    public function update(Request $request, $reporter_id)
    {
//        dd($request->all());

        $user_id = Auth::user()->id;
        $user_data = [
            'name' => $request->reporter_name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'creator_id' => $user_id,
            'status' => ($request->status) ? '1' : '0',
        ];
        $image_name = 'author-image.png';
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
        if($request->password){
            $user_data = array_merge($user_data, ['password' => Hash::make($request->password)]);
        }
        $update = User::where('id', $reporter_id)->update($user_data);

        if($update){
            $data = [
                'designation' => $request->designation,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'present_address' => $request->present_address,
                'permanent_address' => $request->permanent_address,
                'appointed_date' => $request->appointed_date,
                'national_id' => $request->national_id,
            ];
            Reporter::where('user_id', $reporter_id)->update($data);
            Toastr::success('Reporter Updated Successfully.');

        }else{
            Toastr::error('Reporter Cann\'t Updated.');
        }
        return back();
    }


    public function reporterStatus($status)
    {
        $status = User::find($status);
        if($status->status == 1){
            $status->update(['status' => 0]);
            $output = array( 'status' => 'unpublish',  'message'  => 'Reporter DeActive');
        }else{
            $status->update(['status' => 1]);
            $output = array( 'status' => 'publish',  'message'  => 'Reporter Active Successfully');
        }

        return response()->json($output);
    }

    public  function delete($id){
        $check = User::find($id);

        if($check){
            // reporter from make user
            $delete = $check->update(['role_id' => env('USERS')]);
            Reporter::where('user_id', $id)->update(['status' => 2]);

            $fromUser = User::where('role_id', env('ADMIN'))->first();
            $notify = [
                'fromUser' => $fromUser->id,
                'toUser' => $check->id,
                'type' => env('REPORTER_NOTIFY'),
                'notify' => 'Reporter request rejected.',
            ];
            Notification::create($notify);
        

            $output = [
                'status' => true,
                'msg' => 'Reporter successfully deleted.'
            ];

        }else{
            $output = [
                'status' => false,
                'msg' => 'Sorry reporter delete failed.'
            ];
        }
        return response()->json($output);
    }

    public function manage_request(){
        $get_reporter = Reporter::with('user')->where('status', 0)->get();
        return view('backend.reporter-request-list')->with(compact('get_reporter'));
    }

    public function rejectedList(){
        $get_reporter = Reporter::with('user')->where('status', 2)->get();
        return view('backend.reporter-rejected-list')->with(compact('get_reporter'));
    }

    public function statusAcceptReject($user_id)
    {
        $status = Reporter::where('user_id', $user_id)->first();
        if($status->status == 1){
            $status->update(['status' => 2]); // rejected
            user::where('id', $user_id)->update(['role_id' => env('USERS')]); // change role id
            $output = array( 'status' => 'Rejected',  'message'  => 'Reporter Request Rejected');
        }else{
            $status->update(['status' => 1, 'appointed_date' => date('Y-m-d')]); // accepted
            user::where('id', $user_id)->update(['role_id' => env('GENERAL_REPORTER')]); // change role id
            $fromUser = User::where('role_id', env('ADMIN'))->first();
            $notify = [
                'fromUser' => $fromUser->id,
                'toUser' => $user_id,
                'type' => env('REPORTER_NOTIFY'),
                'notify' => 'Reporter request accepted.',
            ];
            Notification::create($notify);
            $output = array( 'status' => 'Accepted',  'message'  => 'Reporter Request Accepted');
        }

        return response()->json($output);
    }
}
