<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\CreateSlug;
use Illuminate\Http\Request;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use createSlug;

    public function index()
    {
        $get_category = Category::orderBy('position', 'asc')->get();
        return view('backend.category.category')->with(compact('get_category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_bd' => 'required',
            'category_en' => 'required',
        ]);
        $creator_id = Auth::id();

        $category = new Category();
        $category->category_bd = $request->category_bd;
        $category->cat_slug_bd = $this->createSlug('categories', $request->category_bd, 'cat_slug_bd');
        $category->category_en = $request->category_en;
        $category->cat_slug_en = $this->createSlug('categories', $request->category_en, 'cat_slug_en');;
        $category->creator_id = $creator_id;
        $category->status = ($request->status) ? '1' : '0';

        $category->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $category->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
        $category->meta_tags = ($request->meta_tags) ? implode(',', $request->meta_tags) : '';
        $category->meta_description = $request->meta_description;
        $category->save();

        Toastr::success('Category created.');
        return back();
    }

    public function edit($id)
    {
        $data = Category::find($id);
        echo view('backend.category.edit.category')->with(compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'category_bd' => 'required',
            'category_en' => 'required',
        ]);

        $category = Category::find($request->id);
        $category->category_bd = $request->category_bd;
        $category->category_en = $request->category_en;

        $category->status = ($request->status) ? '1' : '0';

        $category->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $category->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
        $category->meta_tags = ($request->meta_tags) ? implode(',', $request->meta_tags) : '';
        $category->meta_description = $request->meta_description;
        $update = $category->save();
        if($update){
            Toastr::success('Category update successfull.');
        }else{
            Toastr::success('Sorry category can\'t updated.');
        }

        return back();
    }


    public function delete($id)
    {
        $delete =  Category::find($id)->delete();
        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Category delete successful.'
            ];
        }else{
            $output = [
                'status' => true,
                'msg' => 'Sorry category not deleted.'
            ];

        }
        return response()->json($output);
    }

    public function select(Request $request){
        //echo $request->q;
        $get_category = Category::select('id', 'name')->get();
        echo json_encode($get_category);
    }
}
