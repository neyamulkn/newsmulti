<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Toastr;
use Auth;
class CategoryController extends Controller
{

    public function index()
    {
        $get_category = Category::all();
        return view('backend.category-list')->with(compact('get_category'));
    }


    public function create()
    {
        return view('backend.category');
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'status' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $category_slug = str_slug($request->category_name);
        $data = array_merge($request->all(), ['user_id' => $user_id, 'category_slug' => $category_slug]);

        $insert = Category::create($data);
        Toastr::success('Category created.');
        return back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = Category::find($id);
        echo view('backend.edit-form.category-edit')->with(compact('data'));
    }

    public function update(Request $request)
    {

        $user_id = Auth::user()->id;
        $request->validate([
            'category_name' => 'required',
            'status' => 'required',
        ]);

        $data = [
                'category_name' => $request->category_name,
                'category_slug' => str_slug($request->category_name),
                'user_id' => $user_id,
                'status' => $request->status,
            ];

        $update = Category::where('id', $request->id)->update($data);
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
            echo 'Category delete successfull.';
        }else{
            echo 'Sorry category not deleted.';
        }
    }

    public function select(Request $request){
        //echo $request->q;
        $get_category = Category::select('id', 'name')->get();
        echo json_encode($get_category);
    }
}
