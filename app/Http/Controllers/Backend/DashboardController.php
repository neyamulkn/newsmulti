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
    	$data['reporters'] = Reporter::with('userinfo')->count();
    	$data['pending_news'] = News::where('status', 'pending')->count();
    	$data['news'] = News::count();
    	$data['category'] = Category::count();
    	return view('backend.dashboard')->with($data);


    }
}
