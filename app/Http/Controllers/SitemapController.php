<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Page;
class SitemapController extends Controller
{
	public function index() {
		return response()->view('frontend.sitemap.index')->header('Content-Type', 'text/xml');
	}

	public function articles() {
		$articles = News::join('media_galleries', 'news.thumb_image', 'media_galleries.id')->orderBy("news.id", "desc")->take(1000)->select(["news_slug", "source_path", "publish_date"])->get();
		return response()->view('frontend.sitemap.article', [
		'articles' => $articles,
		])->header('Content-Type', 'text/xml');
	}

	public function categories() {
		$categories = Category::with('subcategory')->orderBy("id", "desc")->get();
		$pages = Page::orderBy("id", "desc")->select(['updated_at','page_slug'])->get();
		
		return response()->view('frontend.sitemap.category', [
		'categories' => $categories,
		'pages' => $pages,
		])->header('Content-Type', 'text/xml');
	}
}
