<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
class SubCategoryController extends Controller
{
    public function index()
    {
        $get_data = SubCategory::all();
        return view('backend.subcategory-list')->with(compact('get_data'));
    }
    public function create()
    {
        $get_category = Category::all();
        return view('backend.subcategory')->with(compact('get_category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subcategory_bd' => 'required',
            'subcategory_en' => 'required',
            'category_id' => 'required',
        ]);
        $creator_id = Auth::user()->id;
        $subcat_slug_en = Str::slug($request->subcategory_en);
        $subcat_slug_bd = preg_replace('/\s+/u', '-', trim($request->subcategory_bd));
        $data = [
            'subcategory_bd' => $request->subcategory_bd,
            'subcat_slug_bd' => $subcat_slug_bd,
            'subcategory_en' => $request->subcategory_en,
            'subcat_slug_en' => $subcat_slug_en,
            'category_id' => $request->category_id,
            'creator_id' => $creator_id,
            'status' => ($request->status) ? '1' : '0',
        ];
        $insert = SubCategory::create($data);
        Toastr::success('SubCategory Created Successfully.');
        return back();
    }

    public function edit($id)
    {   $get_category = Category::all();
        $data = SubCategory::find($id);
        echo view('backend.edit-form.subcategory-edit')->with(compact('data', 'get_category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'subcategory_bd' => 'required',
            'subcategory_en' => 'required',
            'category_id' => 'required',
        ]);
        $creator_id = Auth::user()->id;
       
        $data = [
            'subcategory_bd' => $request->subcategory_bd,
           
            'subcategory_en' => $request->subcategory_en,
           
            'category_id' => $request->category_id,
          
            'status' => ($request->status) ? '1' : '0',
        ];
        $update = SubCategory::where('id', $request->id)->update($data);
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
                'msg' => 'Category delete successfull.'
            ];
        }else{
            $output = [
                'status' => true,
                'msg' => 'Sorry category not deleted.'
            ];
           
        }
        return response()->json($output);
    }

}
