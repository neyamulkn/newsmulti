<?php

namespace App\Http\Controllers\Reporter;

use App\Http\Controllers\Controller;

use App\Models\News;
use Illuminate\Support\Facades\Auth;


class ReporterController extends Controller
{

    public function dashboard(){
    	$user_id = Auth::guard('reporter')->id();
        $data['pending_news'] = News::where('user_id', $user_id)->where('status', 'pending')->count();
        $data['news'] = News::where('user_id', $user_id)->count();
        return view('reporter.dashboard')->with($data);


    }

}
