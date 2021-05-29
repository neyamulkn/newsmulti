<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\News;
use App\Models\Notification;
use App\Models\Reporter;

use App\Models\Transaction;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ReporterController extends Controller
{

    public function index(Request $request, $status= '')
    {
        $reporters = User::with('allnews')
            ->join('reporters', 'users.id', 'reporters.user_id');
        if($status){
            $reporters->where('users.status', $status);
        }
        if(!$status && $request->status && $request->status != 'all'){
            $reporters->where('users.status', $request->status);
        }
        if($request->reporter && $request->reporter != 'all'){
        $keyword = $request->reporter;
        $reporters->where(function ($query) use ($keyword) {
                $query->orWhere('name', 'like', '%' . $keyword . '%');
                $query->orWhere('mobile', 'like', '%' . $keyword . '%');
                $query->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }if($request->location && $request->location != 'all'){
            $reporters->where('working_zilla', $request->location);
        }

        $data['reporters'] = $reporters->where('reporters.status', 'active')
            ->selectRaw('users.*, reporters.designation')->paginate(15);
        $data['locations'] = City::orderBy('name', 'asc')->get();

        return view('backend.reporter.reporter-list')->with($data);
    }

    public function reporterProfile($username){
        $data['reporter']  = User::where('username', $username)->first();
        $data['get_news'] = News::orderBy('news.id', 'desc')
            ->join('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->groupBy('news.id')->selectRaw('news.*, users.name, users.username,categories.category_bd,categories.category_en, sub_categories.subcategory_bd,media_galleries.source_path')->paginate(15);
        $data['transactions'] = Transaction::with(['user:id,name,username,mobile', 'addedBy'])
            ->where('user_id', $data['reporter']->id)
            ->whereIn('type', ['wallet', 'withdraw'])
            ->orderBy('id', 'desc')->paginate(15);
        return view('backend.reporter.profile')->with($data);
    }
    public function create()
    {
        return view('backend.reporter.reporter');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required',  'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        $user_id = Auth::guard('admin')->user()->id;

        $image_name = null;
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
            'mobile' =>$request->mobile,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'photo' => $image_name,
            'created_by' => $user_id,
            'password' => Hash::make($request->password),
            'status' => ($request->status) ? 'active' : 'pending',
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
                'status' => 'active',
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

        $data = [];
        $reporter = User::with('reporter')->where('id', $id)->first();

        if($reporter){
            return view('backend.reporter.reporter-edit')->with(compact('reporter'));
        }else{
            Toastr::error('Sorry invalid user try again!.');
            return back();
        }
    }

    public function update(Request $request, $reporter_id)
    {
        $request->validate([
            'username' => ['required', 'unique:users,mobile,'.$reporter_id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$reporter_id],
        ]);

        $user_id = Auth::guard('admin')->user()->id;
        $user_data = [
            'name' => $request->reporter_name,
            'username' => $request->username,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'created_by' => $user_id,
            'status' => ($request->status) ? 'active' : 'pending',
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
            $user_data = array_merge($user_data, ['photo' => $image_name]);
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

    public  function delete($id){
        $check = User::find($id);

        if($check){
            // reporter from make user
            $delete = $check->update(['role_id' => 'user']);
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
        return view('backend.reporter.reporter-request-list')->with(compact('get_reporter'));
    }

    public function rejectedList(){
        $get_reporter = Reporter::with('user')->where('status', 2)->get();
        return view('backend.reporter.reporter-rejected-list')->with(compact('get_reporter'));
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

    public function reporterSecretLogin($id)
    {
        $reporter = User::findOrFail(decrypt($id));
        auth()->guard('reporter')->login($reporter, true);
        Toastr::success('Reporter panel login success');
        return redirect()->route('reporter.dashboard');
    }

}
