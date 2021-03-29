<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
class UserAdminController extends Controller
{
    public function userList(Request $request, $status= ''){
        $user  = User::where('role_id', 3);
        if($status){
            
            if($status == 'active'){
                $get_news->where('news.status', 1);
            }if($status == 'pending'){
                $get_news->where('news.status', 2);
            }if($status == 'inactive'){
                $get_news->where('news.status', 0);
            }
        }
        if(!$status && $request->status && $request->status != 'all'){
            $user->where('status', $request->status);
        }
        if($request->name && $request->name != 'all'){
            $keyword = $request->name;
            $user->where(function ($query) use ($keyword) {
                $query->orWhere('name', 'like', '%' . $keyword . '%');
                $query->orWhere('phone', 'like', '%' . $keyword . '%');
                $query->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
        $perPage = 15;
        if($request->show){
            $perPage = $request->show;
        } 
        $users  = $user->orderBy('id', 'desc')->paginate($perPage);
     
        return view('backend.user.user')->with(compact('users'));
    }

    public function userProfile($username){
        $user  = User::where('username', $username)->first();
        return view('admin.user.profile')->with(compact('user'));
    }

    public function userecretLogin($id)
    {

        $user = User::findOrFail(decrypt($id));

        auth()->guard('web')->login($user, true);

        Toastr::success('user panel login success.');
        return redirect()->route('user.dashboard');

    }

    public function delete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            $output = [
                'status' => true,
                'msg' => 'User deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'User cannot deleted.'
            ];
        }
        return response()->json($output);
    }
}
