<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use App\Models\HomepageSection;
use App\Models\Page;
use App\Models\read_later;
use App\Models\SubCategory;
use App\Models\Deshjure;
use App\Models\Setting;
use App\User;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;
use Session;
use Response;
use Intervention\Image\Facades\Image;
class HomeController extends Controller
{

    public function index(Request $request)
    {

        $data = [];

        //get all homepage section
            $data['sections'] = HomepageSection::where('status', 1)->orderBy('position', 'asc')->paginate(5);

            //check ajax request
            if ($request->ajax()) {
                $data['ajaxLoad'] = true;
                $view = view('frontend.homepage.homesection', $data)->render();
                return response()->json(['html'=>$view]);
            }
            return view('frontend.index2')->with($data);


        if(!Session::get('locale')){
           return view('frontend.index2')->with($data);

        }else{  $folder = 'frontend.en.'; }

      
        
        $data['recent_section_news'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('news.breaking_news', 1)
            ->limit(9)
            ->orderBy('news.id', 'DESC')
            ->where('news.status', '=', 1);

            if(Session::get('locale')){
                $data['recent_section_news'] = $data['recent_section_news']->where('news.lang', '=', 2);
            }else{
                $data['recent_section_news'] = $data['recent_section_news']->where('news.lang', '=', 1);
            }
            $data['recent_section_news'] = $data['recent_section_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['crime_posts'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('categories.cat_slug_en', 'crime')
            ->limit(5)
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);

            if(Session::get('locale')){
                $data['crime_posts'] = $data['crime_posts']->where('news.lang', '=', 2);
            }else{
                $data['crime_posts'] = $data['crime_posts']->where('news.lang', '=', 1);
            }
            $data['crime_posts'] = $data['crime_posts']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['sidebar_news_first'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(9)
            ->inRandomOrder()
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);

            if(Session::get('locale')){
                $data['sidebar_news_first'] = $data['sidebar_news_first']->where('news.lang', '=', 2);
            }else{
                $data['sidebar_news_first'] = $data['sidebar_news_first']->where('news.lang', '=', 1);
            }
            $data['sidebar_news_first'] = $data['sidebar_news_first']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['special_reports'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('categories.cat_slug_en', 'discussed')
            ->limit(7)
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
            if(Session::get('locale')){
                $data['special_reports'] = $data['special_reports']->where('news.lang', '=', 2);
            }else{
                $data['special_reports'] = $data['special_reports']->where('news.lang', '=', 1);
            }
            $data['special_reports'] = $data['special_reports']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['get_national_news'] =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(6)
            ->where('categories.cat_slug_en', 'national')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
            if(Session::get('locale')){
                $data['get_national_news'] = $data['get_national_news']->where('news.lang', '=', 2);
            }else{
                $data['get_national_news'] = $data['get_national_news']->where('news.lang', '=', 1);
            }
            $data['get_national_news'] = $data['get_national_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['get_sport_news'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(9)
            ->where('categories.cat_slug_en', 'sports')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['get_sport_news'] = $data['get_sport_news']->where('news.lang', '=', 2);
            }else{
                $data['get_sport_news'] = $data['get_sport_news']->where('news.lang', '=', 1);
            }
            $data['get_sport_news'] = $data['get_sport_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['crime_posts'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
             ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->where('categories.cat_slug_en', 'crime')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['crime_posts'] = $data['crime_posts']->where('news.lang', '=', 2);
            }else{
                $data['crime_posts'] = $data['crime_posts']->where('news.lang', '=', 1);
            }
            $data['crime_posts'] = $data['crime_posts']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

       // $data['slider_box_news'] = DB::table('news')
       //      ->join('categories', 'news.category', '=', 'categories.id')
       //      ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
       //      ->limit(5)
       //      ->inRandomOrder()
       //      ->select('news.*','categories.category_bd', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['entertainment_news'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->where('categories.cat_slug_en', 'entertainment')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
            if(Session::get('locale')){
                $data['entertainment_news'] = $data['entertainment_news']->where('news.lang', '=', 2);
            }else{
                $data['entertainment_news'] = $data['entertainment_news']->where('news.lang', '=', 1);
            }
            $data['entertainment_news'] = $data['entertainment_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['get_technology_news'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->where('categories.cat_slug_en', 'technology')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
            if(Session::get('locale')){
                $data['get_technology_news'] = $data['get_technology_news']->where('news.lang', '=', 2);
            }else{
                $data['get_technology_news'] = $data['get_technology_news']->where('news.lang', '=', 1);
            }
            $data['get_technology_news'] = $data['get_technology_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['get_accidente_news'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->where('categories.cat_slug_en', 'accidente')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['get_accidente_news'] = $data['get_accidente_news']->where('news.lang', '=', 2);
            }else{
                $data['get_accidente_news'] = $data['get_accidente_news']->where('news.lang', '=', 1);
            }
            $data['get_accidente_news'] = $data['get_accidente_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['get_education_news'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->where('categories.cat_slug_en', 'education')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['get_education_news'] = $data['get_education_news']->where('news.lang', '=', 2);
            }else{
                $data['get_education_news'] = $data['get_education_news']->where('news.lang', '=', 1);
            }

        $data['get_education_news'] = $data['get_education_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['get_health_news'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->where('categories.cat_slug_en', 'health')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['get_health_news'] = $data['get_health_news']->where('news.lang', '=', 2);
            }else{
                $data['get_health_news'] = $data['get_health_news']->where('news.lang', '=', 1);
            }
            $data['get_health_news'] = $data['get_health_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['desh_jure_news'] = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(10)
            ->where('categories.cat_slug_en', 'deshjure')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['desh_jure_news'] = $data['desh_jure_news']->where('news.lang', '=', 2);
            }else{
                $data['desh_jure_news'] = $data['desh_jure_news']->where('news.lang', '=', 1);
            }
            $data['desh_jure_news'] = $data['desh_jure_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();


        $data['get_world_news'] =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(7)
            ->where('categories.cat_slug_en', 'international')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['get_world_news'] = $data['get_world_news']->where('news.lang', '=', 2);
            }else{
                $data['get_world_news'] = $data['get_world_news']->where('news.lang', '=', 1);
            }
            $data['get_world_news'] = $data['get_world_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

         $data['get_picture_voice'] =  DB::table('news')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(9)
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['get_picture_voice'] = $data['get_picture_voice']->where('news.lang', '=', 2);
            }else{
                $data['get_picture_voice'] = $data['get_picture_voice']->where('news.lang', '=', 1);
            }
            $data['get_picture_voice'] = $data['get_picture_voice']->select('news.*', 'media_galleries.source_path', 'media_galleries.title')->get();
         
        $data['get_visual_gallery'] =  DB::table('news')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1)
            ->where('news.type', '3');
             if(Session::get('locale')){
                $data['get_visual_gallery'] = $data['get_visual_gallery']->where('news.lang', '=', 2);
            }else{
                $data['get_visual_gallery'] = $data['get_visual_gallery']->where('news.lang', '=', 1);
            }
            $data['get_visual_gallery'] = $data['get_visual_gallery']->select('news.*', 'media_galleries.source_path', 'media_galleries.title')->get();


         $data['get_life_style'] =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->where('categories.cat_slug_en', 'life-style')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['get_life_style'] = $data['get_life_style']->where('news.lang', '=', 2);
            }else{
                $data['get_life_style'] = $data['get_life_style']->where('news.lang', '=', 1);
            }
            $data['get_life_style'] = $data['get_life_style']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['get_recipe'] =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->where('categories.cat_slug_en', 'recipe')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['get_recipe'] = $data['get_recipe']->where('news.lang', '=', 2);
            }else{
                $data['get_recipe'] = $data['get_recipe']->where('news.lang', '=', 1);
            }
            $data['get_recipe'] = $data['get_recipe']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['get_live_tv'] =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->where('categories.cat_slug_en', 'live-tv')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['get_live_tv'] = $data['get_live_tv']->where('news.lang', '=', 2);
            }else{
                $data['get_live_tv'] = $data['get_live_tv']->where('news.lang', '=', 1);
            }
            $data['get_live_tv'] = $data['get_live_tv']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['get_politics'] =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5)
            ->where('categories.cat_slug_en', 'politics')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['get_politics'] = $data['get_politics']->where('news.lang', '=', 2);
            }else{
                $data['get_politics'] = $data['get_politics']->where('news.lang', '=', 1);
            }
            $data['get_politics'] = $data['get_politics']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        $data['get_provash_news'] =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('categories.cat_slug_en', 'expatriate')
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1)
            ->limit(5);
             if(Session::get('locale')){

                $data['get_provash_news'] = $data['get_provash_news']->where('news.lang', '=', 2);
            }else{
                $data['get_provash_news'] = $data['get_provash_news']->where('news.lang', '=', 1);
            }
            $data['get_provash_news'] = $data['get_provash_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

         $data['religion_news'] =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('categories.cat_slug_en', 'religion-and-life')
            ->limit(5)
            ->orderBy('news.id', 'DESC')->where('news.status', '=', 1);
             if(Session::get('locale')){
                $data['religion_news'] = $data['religion_news']->where('news.lang', '=', 2);
            }else{
                $data['religion_news'] = $data['religion_news']->where('news.lang', '=', 1);
            }
            $data['religion_news'] = $data['religion_news']->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();

        return view($folder.'index')->with($data);
    }

    public function category(Request $request)
    {

        $data = [];
        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }

        $data['category'] = Category::where('cat_slug_en', $request->category)->first();
        if($data['category']){

            $data['subcategory'] = Subcategory::where('subcat_slug_en', $request->subcategory)->first();
            $data['child_cat'] = Deshjure::where('slug_en', $request->district)->where('cat_type', 1)->first();
            $data['subchild_cat'] = Deshjure::where('slug_en', $request->upzilla)->where('cat_type', 2)->first();

            $categories = News::with(['subcategoryList', 'image'])
                ->where('category', '=', $data['category']->id)
                ->where('status', '=', 1);

                if($request->subcategory != null){
                    $categories = $categories->where('subcategory', '=',  $data['subcategory']->id);
                }
                if($data['child_cat'] != null){
                    $categories = $categories->where('child_cat', '=',  $data['child_cat']->id);
                }
                if($data['subchild_cat'] != null){
                    $categories = $categories->where('subchild_cat', '=',  $data['subchild_cat']->id);
                }

                if(Session::get('locale')){
                   $categories = $categories->where('news.lang', '=', 2);
                }else{
                   $categories = $categories->where('news.lang', '=', 1);
                }

            $data['categories'] =  $categories->orderBy('id', 'DESC')->paginate(21);
             if($request->category == 'deshjure' && $request->subcategory == null ){
                 return view($folder.'deshjure')->with($data);
             }

            return view($folder.'category')->with($data);
        }
        else{
            return view($folder.'404');
        }
    }

    public  function news_details($slug){
        $data = [];
        $get_news = News::with(['image','reporter', 'attachFiles'])->where('news_slug', $slug);
        if(!Auth::check() || Auth::user()->role_id == 3){
        $get_news->where('status', 1);
        }
        $data['get_news'] = $get_news->first();
      
        if($data['get_news']){
            

            $lang = 1;
            if($data['get_news']->lang == 2){
                $lang = 2;
                Session::put('locale', 'en');
                $folder = 'frontend.en.'; 
            }else{
                Session::forget('locale');
                $folder = 'frontend.';
            }

            $data['comments'] = Comment::where('news_id', $data['get_news']->id)->where('type', 1)->orderBy('id', 'ASC')->paginate(5);

            $data['get_news']->increment('view_counts'); // news view count

            $data['more_news'] =News::with(['categoryList', 'subcategoryList', 'image'])
                ->where('news.id', '!=', $data['get_news']->id)
                ->where('news.category', $data['get_news']->category)
                ->where('news.lang', '=', $lang)
                ->where('news.status', '=', 'active')
                ->orderBy('id', 'DESC')
                ->take(8)->get();
            return view($folder.'news-details')->with($data);
        }else{
            return view('frontend.404');
        }
    }

    //use jquery plugin not work proper
    public function watermark($path){

        return view('frontend/watermark')->with(compact('path'));
    }

    public function page($url){
        $data = [];
        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }
        $data['find_page'] = Page::where('page_slug', $url)->first();
        $data['get_page'] = view($folder.'layouts.page')->with($data);

       
        if($data['find_page']){
            return view($folder.'page')->with($data);
        }else{
            return view($folder.'404');
        }

    }
    public function reporter_details($username){
        $data = [];

        $data['reporter'] = User::with('userinfo')->where('username', $username)->first();

        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }
        if($data['reporter']){
            $data['get_news'] = News::with(['categoryList', 'subcategoryList', 'image'])->where('user_id', $data['reporter']->id)->where('status', '=', 1)
                ->orderBy('id', 'DESC')->paginate(24);
            return view($folder.'reporter-details')->with($data);
        }else{
            return view($folder.'404');
        }

    }
    public function user_profile($username){
        $data = [];
        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }
        $data['user_details'] = User::where('username', $username)->first();
        if($data['user_details']){
            $data['total_Bdnews'] = News::where('user_id',  $data['user_details']->id)->where('lang', 1)->count();
            $data['total_Engnews'] = News::where('user_id',  $data['user_details']->id)->where('lang', 2)->count();
            $data['read_laters'] = read_later::where('user_id',  $data['user_details']->id)->count();
            return view($folder.'user-profile')->with($data);
        }else{
            return view($folder.'404');
        }

    
    }

    public function search_news(Request $request){
        $output = '';
        $search_news = News::leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')->where('news_title', 'LIKE', '%'. $request->src_key .'%')
        ->orWhere('keywords', 'like', '%' . $request->src_key . '%')
        ->where('news.status', 1)
        ->take(7)->orderBy('news.id', 'desc')->select('news.news_title','news.news_slug','news.publish_date','news.news_slug', 'media_galleries.source_path')->get();

      
        if(count($search_news)>0){

            $output = '<ul class="list-posts">';
            foreach ($search_news as $news) {

                $output .= '<li><a href="'.route('search_result').'?q='.$request->src_key.'">
                                <img src="'.asset('upload/images/thumb_img/'.$news->source_path).'" alt="" width="80">
                                </a> <a href="'.route('news_details', $news->news_slug).'">'.Str::limit($news->news_title, 80).'
                                    <span class="post-content">
                                    <ul class="post-tags">
                                        <li><i class="fa fa-clock-o"></i>'.Carbon::parse($news->publish_date)->diffForHumans().'</li>
                                    </ul>
                                </span>
                                </a>
                            </li>';
            }
            $output .= (count($search_news)>2 ) ? '<li><a href="'.route('search_result').'?q='.$request->src_key.'">See All Results</a></li>': '' .'</ul>';

            echo $output;
       }
    }

    public function search_result(Request $request){

        $search_results = News::leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')->where('news_title', 'LIKE', '%'. $request->q .'%')
        ->orWhere('keywords', 'like', '%' . $request->q . '%')
        ->where('news.status', 1)
        ->take(7)->orderBy('news.id', 'desc')->select('news.news_title','news.news_slug','news.publish_date','news.news_slug', 'media_galleries.source_path')->paginate(20);
        // dd($search_results );
        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }
        if($search_results){
            return view( $folder.'search-result')->with(compact('search_results'));
        }else{
            return view($folder.'404');
        }
    }

    public function video(){
        $data = [];
        $data['categories'] = Category::where('status', 1)->orderBy('serial', 'ASC')->paginate(12);

        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }
        if($data['categories']){
             return view($folder.'news-videos')->with($data);
        }else{
            return view($folder.'404');
        }

    }

    public function video_watch($slug){

       $data = [];
        $data['get_news'] = News::with(['image','reporter'])->where('news_slug', $slug)->first();
        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }


        if($data['get_news']){
            $data['comments'] = Comment::where('news_id', $data['get_news']->id)->where('type', 1)->orderBy('id', 'DESC')->paginate(5);

            $data['get_news']->increment('view_counts'); // news view count

            $data['more_news'] =News::with(['categoryList', 'subcategoryList', 'image'])
                ->where('news.id', '!=', $data['get_news']->id)
                ->where('news.category', $data['get_news']->category);
                if(Session::get('locale')){
                   $data['more_news'] = $data['more_news']->where('news.lang', '=', 2);
                }else{
                   $data['more_news'] = $data['more_news']->where('news.lang', '=', 1);
                }

                $data['more_news'] = $data['more_news']->orderBy('id', 'DESC')->where('status', '=', 1)
                ->take(8)->get();
            return view($folder.'news-details')->with($data);
        }else{
            return view($folder.'404');
        }
    }

    public function gallery(){
        $data = [];
        $data['categories'] = Category::where('status', 1)->orderBy('serial', 'ASC')->paginate(12);
        //dd($data['category']);
        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }
        return view($folder.'news-gallery')->with($data);
    }

    public function gallery_view($category, $slug){

        $data = [];
        $data['get_news'] = News::with(['image','reporter'])->where('news_slug', $slug)->first();
         if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }
        if($data['get_news']){
            $data['more_news'] = DB::table('news')
                ->join('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
                ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
                ->where('news.id', '!=', $data['get_news']->id)
                ->where('news.category', $data['get_news']->category)
                ->select('news.*', 'sub_categories.subcategory_bd', 'media_galleries.source_path')
                ->orderBy('news.id', 'DESC')->where('news.status', '=', 1)
                ->take(15)->get();

           return view($folder.'news-details')->with($data);
        }else{
           return view($folder.'404');
        }
    }

    public function error(){
        if(Session::get('locale')){ $folder = 'frontend.en.'; }else{  $folder = 'frontend.'; }
        return view($folder.'404');
    }

    public function feed(){
        $setting = Setting::first();
      
        $get_feeds = News::with(['image:id,source_path','reporter:id,name'])->take(1000)->where('status', 1)->orderBy('id', 'DESC')->get();
        
        return Response::view('frontend.feed',  ['get_feeds' => $get_feeds])->header('Content-Type', 'text/xml');
    }

}
