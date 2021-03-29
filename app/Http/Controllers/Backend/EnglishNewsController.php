<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Deshjure;
use App\Models\News;
use App\Models\Notification;
use App\Models\SubCategory;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnglishNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request, $status='')
    {
        $user_id = Auth::user()->id;

        $get_news = News::orderBy('news.id', 'desc')->join('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('lang','=', 'en')->groupBy('news.id');
        if($status){
            if($status == 'image-missing'){
                $get_news->where('thumb_image', null);
            }
            if($status == 'active'){
                $get_news->where('news.status', 1);
            }if($status == 'pending'){
                $get_news->where('news.status', 0);
            }if($status == 'draft'){
                $get_news->where('news.status', 2);
            }if($status == 'breaking'){
                $get_news->where('news.breaking_news', 1);
            }
        }

        if(!$status && $request->status && $request->status != 'all'){
            $get_news->where('news.status', $request->status);
        }
        if($request->category && $request->category != 'all'){
            $get_news->where('category', $request->category);
        }
        if($request->reporter && $request->reporter != 'all'){
            $get_news->where('news.user_id', $request->reporter);
        }

        if($request->title){
            $get_news->where('news_title', 'LIKE', '%'. $request->title .'%');
        }

        $perPage = 15;
        if($request->show){
            $perPage = $request->show;
        }
        if(Auth::user()->role_id != env('ADMIN') && Auth::user()->role_id != env('EDITOR')){
            $get_news->where('news.user_id', $user_id);
        }

        $data['get_news'] = $get_news->selectRaw('news.*, users.name, users.username,categories.category_bd,categories.category_en, sub_categories.subcategory_bd,media_galleries.source_path')->paginate($perPage);

        $data['all_news'] = News::where('lang','=', 2)->count();
      
        $data['active_news'] = News::where('status', 1)->where('lang','=', 2)->count();
        $data['draft_news'] = News::where('status', 2)->where('lang','=', 2)->count();
        $data['pending_news'] = News::where('status', 0)->where('lang','=', 2)->count();
        $data['breaking'] = News::where('breaking_news', 1)->where('lang','=', 2)->count();
        $data['image_missing'] = News::where('thumb_image', null)->where('lang','=', 2)->count();

        $data['categories'] = Category::where('status', 1)->get();
        $data['reporters'] = User::where('role_id', 2)->orWhere('role_id', 4)->orWhere('role_id', 5)->get();

      
        return view('backend.english-news-list')->with($data);
    }

    public function pending()
    {
        $user_id = Auth::user()->id;
//        $get_news = News::with(['category', 'reporter', 'image']);
        $get_news = DB::table('news')
            ->join('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('lang', '=',2)
            ->where('news.status', '=',0);
            if(Auth::user()->role_id != env('ADMIN') && Auth::user()->role_id != env('EDITOR')){
                $get_news = $get_news->where('news.user_id', $user_id);
            }
        $get_news = $get_news->select('news.*','users.name','users.username', 'categories.category_bd', 'categories.category_en', 'sub_categories.subcategory_bd', 'media_galleries.source_path')
            ->orderBy('news.created_at', 'DESC')->paginate(25);
        return view('backend.english-news-list')->with(compact('get_news'));
    }

    public function draft()
    {
        $user_id = Auth::user()->id;
//        $get_news = News::with(['category', 'reporter', 'image']);
        $get_news = DB::table('news')
            ->join('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('lang', '=',2)
            ->where('news.status', '=',2);
            if(Auth::user()->role_id != env('ADMIN') && Auth::user()->role_id != env('EDITOR')){
                $get_news = $get_news->where('news.user_id', $user_id);
            }
        $get_news = $get_news->select('news.*','users.name','users.username', 'categories.category_bd', 'categories.category_en', 'sub_categories.subcategory_bd', 'media_galleries.source_path')
            ->orderBy('news.created_at', 'DESC')->paginate(25);
        return view('backend.english-news-list')->with(compact('get_news'));
    }

    public function create()
    {
        $data = [];
        $data['categories'] = Category::where('status', 1)->orderBy('serial', 'ASC')->get();
        $data['reporters'] = User::where('role_id', env('REPORTER'))->orWhere('role_id', env('GENERAL_REPORTER'))->orWhere('role_id', env('ADMIN'))->get();
       
        return view('backend.english-news')->with($data);
    }


    public function edit($news_slug)
    {
        $user_id = Auth::user()->id;
        $data = [];
        $data['categories'] = Category::where('status', 1)->get();
        $data['reporters'] = User::where('role_id', env('REPORTER'))->orWhere('role_id', env('GENERAL_REPORTER'))->orWhere('role_id', env('ADMIN'))->get();

        $find_news = News::with(['image'])->where('news_slug', $news_slug);
        if(Auth::user()->role_id != env('ADMIN') && Auth::user()->role_id != env('EDITOR')){
            $find_news =  $find_news->where('user_id', $user_id);
        }
        $data['get_news'] =  $find_news->first();

        if($find_news){
            $data['get_subcategories'] = SubCategory::where('category_id',  $data['get_news']->category)->get();
            $data['get_districts'] = Deshjure::where('parent_id',  $data['get_news']->subcategory)->where('cat_type', 1)->get();
            $data['get_upzillas'] = Deshjure::where('parent_id',  $data['get_news']->child_cat)->where('cat_type', 2)->get();

            return view('backend.news-edit')->with($data);
        }else{
            Toastr::error('Sorry news not found.');
            return back();
        }
    }

    // update news in NewsController( bangla  and english news same)

}
