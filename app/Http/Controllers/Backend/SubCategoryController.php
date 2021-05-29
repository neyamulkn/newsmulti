<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    use createSlug;
    public function index()
    {
        $get_data = SubCategory::orderBy('position')->get();
        $get_category = Category::all();
        return view('backend.category.subcategory')->with(compact('get_data','get_category'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'subcategory_bd' => 'required',
            'subcategory_en' => 'required',
            'category_id' => 'required',
        ]);
        $creator_id = Auth::id();

        $category = new SubCategory();
        $category->subcategory_bd = $request->subcategory_bd;
        $category->subcat_slug_bd = $this->createSlug('sub_categories', $request->subcategory_bd, 'subcat_slug_bd');
        $category->subcategory_en = $request->subcategory_en;
        $category->subcat_slug_en = $this->createSlug('sub_categories', $request->subcategory_en, 'subcat_slug_en');;

        $category->category_id = $request->category_id;
        $category->creator_id = $creator_id;
        $category->status = ($request->status) ? '1' : '0';

        $category->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $category->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
        $category->meta_tags = ($request->meta_tags) ? implode(',', $request->meta_tags) : '';
        $category->meta_description = $request->meta_description;
        $category->save();
        Toastr::success('SubCategory Created Successfully.');
        return back();
    }

    public function edit($id)
    {   $get_category = Category::all();
        $data = SubCategory::find($id);
        echo view('backend.category.edit.subcategory')->with(compact('data', 'get_category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'subcategory_bd' => 'required',
            'subcategory_en' => 'required',
            'category_id' => 'required',
        ]);
        $category = new SubCategory();
        $category->subcategory_bd = $request->subcategory_bd;
        $category->subcategory_en = $request->subcategory_en;
        $category->category_id = $request->category_id;
        $category->status = ($request->status) ? '1' : '0';
        $category->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $category->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
        $category->meta_tags = ($request->meta_tags) ? implode(',', $request->meta_tags) : '';
        $category->meta_description = $request->meta_description;
        $update = $category->save();

        if($update){
            Toastr::success('SubCategory update successfull.');
        }else{
            Toastr::success('Sorry SubCategory can\'t update.');
        }
        return back();
    }

    public function delete($id)
    {
        $delete =  SubCategory::find($id)->delete();
        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Sub category delete successful.'
            ];
        }else{
            $output = [
                'status' => true,
                'msg' => 'Sorry subcategory deleted failed.'
            ];

        }
        return response()->json($output);
    }

}
