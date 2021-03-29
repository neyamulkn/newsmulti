<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;
use App\User;
use App\Models\Reporter;
use Auth;
use Redirect;
class DashboardController extends Controller
{

    public function dashboard(){
    	$data['reporters'] = User::with('userinfo')->where('role_id', 2)->orWhere('role_id', 4)->count();
    	$data['pending_news'] = News::where('status', 0)->count();
    	$data['news'] = News::count();
    	$data['category'] = Category::count();
    	if(Auth::user()->role_id != 3){
    		return view('backend.index')->with($data);
    	}else{
    		return Redirect::route('404');
    	}
       
    }
}
