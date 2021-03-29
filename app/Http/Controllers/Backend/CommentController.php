<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;
class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allComments(Request $request)
    {
        $get_comments = Comment::join('news', 'comments.news_id', 'news.id');
        if(Auth::user()->role_id != env('ADMIN')){
            $get_comments->where('comments.user_id', Auth::user()->id);
        }
        if($request->title){
            $keyword = $request->title;
            $get_comments->where(function ($query) use ($keyword) {
                $query->orWhere('comments', 'like', '%' . $keyword . '%');
                $query->orWhere('news.news_title', 'like', '%' . $keyword . '%');
            });
        }
        $perPage = 15;
        if($request->show){
            $perPage = $request->show;
        }
        $get_comments = $get_comments->orderBy('comments.id', 'desc')->selectRaw('comments.*, news.news_title, news.news_slug')->paginate($perPage);
        return view('backend.comments')->with(compact('get_comments'));
    }

    public function commentUpdate(Request $request){
    	$update = Comment::where(function($query){
    		if(Auth::user()->role_id != env('ADMIN')){
	    		$query->where('user_id', Auth::user()->id);
	    	}
    	})->where('id', $request->id)->update(['comments' => $request->comment]);
    	if($update){
    		echo $request->comment;
    	}else{
    		echo "Sorry comment cannot update.";
    	}
      
    }
}
