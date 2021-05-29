<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

use App\User;
class UserAdminController extends Controller
{
    public function userList(Request $request, $status= ''){
        $user  = User::where('role_id', 'user');
        if($status){
            $user->where('status', $status);
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
        $data['user']  = User::where('username', $username)->first();
        $data['transactions'] = Transaction::with(['user:id,name,username,mobile', 'addedBy'])
            ->where('user_id', $data['user']->id)
            ->whereIn('type', ['wallet', 'withdraw'])
            ->orderBy('id', 'desc')->paginate(15);
        return view('backend.user.profile')->with($data);
    }

    public function userSecretLogin($id)
    {

        $user = User::findOrFail(decrypt($id));

        auth()->guard('web')->login($user, true);

        Toastr::success('User panel login success.');
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
