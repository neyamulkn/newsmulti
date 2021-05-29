<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Deshjure;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DeshjureController extends Controller
{
    public function division()
    {
        $data = [];
        $data['get_category'] = Category::orderBy('serial', 'ASC')->get();
        $data['get_data'] = Deshjure::where('cat_type', 1)->orderBy('serial', 'ASC')->get();
        return view('backend.location.division')->with($data);
    }

    public function division_store(Request $request)
    {

        $request->validate([
             'name_bd' => 'required',
             'name_en' => 'required',
             'parent_id' => 'required',
        ]);

        $created_by = Auth::user()->id;
        $slug_bd = preg_replace('/\s+/u', '-', trim($request->name_bd));
        $data = [
            'name_bd' => $request->name_bd,
            'slug_bd' => $this->createSlugBd($slug_bd),
            'name_en' => $request->name_en,
            'slug_en' => $this->createSlugEn($request->name_en),
            'parent_id' => $request->parent_id,
            'cat_type' => 1,
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];
        $insert = Deshjure::create($data);
        Session::flash('submitType', $request->submit);
        Toastr::success('Divistion Created Successfully.');
        return back();
    }

    public function division_edit($id)
    {   $get_category = Category::all();
        $data = Deshjure::find($id);
        echo view('backend.location.edit-form.division')->with(compact('data', 'get_category'));
    }

    public function division_update(Request $request)
    {
        $request->validate([
            'name_bd' => 'required',
            'name_en' => 'required',
            'parent_id' => 'required',
        ]);
        $created_by = Auth::user()->id;
      $slug_bd = preg_replace('/\s+/u', '-', trim($request->name_bd));
        $data = [
            'name_bd' => $request->name_bd,
            'slug_bd' => $this->createSlugBd($slug_bd),
            'name_en' => $request->name_en,
            'slug_en' => $this->createSlugEn($request->slug_en),
            'parent_id' => $request->parent_id,
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];

        $update = Deshjure::where('id', $request->id)->update($data);
        if($update){
            Toastr::success('Deshjure update successfull.');
        }else{
            Toastr::success('Sorry Deshjure can\'t update.');
        }
        return back();
    }

    public function division_delete($id)
    {
        $delete =  Deshjure::find($id)->delete();
        if($delete){
            echo 'Deshjure delete successfull.';
        }else{
            echo 'Sorry Deshjure can\'t deleted.';
        }
    }

    public function district()
    {
        $data = [];
        $data['get_category'] = SubCategory::where('category_id', 14)->orderBy('id', 'ASC')->get();
        $data['get_data'] = Deshjure::where('cat_type', 1)->orderBy('serial', 'ASC')->get();
        return view('backend.location.district')->with($data);
    }

    public function district_store(Request $request)
    {

        $request->validate([
             'name_bd' => 'required',
             'name_en' => 'required',
             'parent_id' => 'required',
        ]);

        $created_by = Auth::user()->id;

        $slug_bd = preg_replace('/\s+/u', '-', trim($request->name_bd));
        $data = [
            'name_bd' => $request->name_bd,
            'slug_bd' => $this->createSlugBd($slug_bd),
            'name_en' => $request->name_en,
            'slug_en' => $this->createSlugEn($request->name_en),
            'parent_id' => $request->parent_id,
            'cat_type' => 1,
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];
        $insert = Deshjure::create($data);
        Session::flash('submitType', $request->submit);
        Toastr::success('Divistion Created Successfully.');
        return back();
    }

    public function district_edit($id)
    {   $get_category = SubCategory::where('category_id', 14)->orderBy('id', 'ASC')->get();
        $data = Deshjure::find($id);
        echo view('backend.location.edit-form.district')->with(compact('data', 'get_category'));
    }

    public function district_update(Request $request)
    {

        $request->validate([
            'name_bd' => 'required',
            'name_en' => 'required',
            'parent_id' => 'required',
        ]);
        $created_by = Auth::user()->id;
        $slug_bd = preg_replace('/\s+/u', '-', trim($request->name_bd));
        $data = [
            'name_bd' => $request->name_bd,
            'name_en' => $request->name_en,
            'parent_id' => $request->parent_id,
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];

        $update = Deshjure::where('id', $request->id)->update($data);
        if($update){
            Toastr::success('Deshjure update successfull.');
        }else{
            Toastr::success('Sorry Deshjure can\'t update.');
        }
        return back();
    }

    public function district_delete($id)
    {
        $delete =  Deshjure::find($id)->delete();
        if($delete){
            echo 'Deshjure delete successfull.';
        }else{
            echo 'Sorry Deshjure can\'t deleted.';
        }
    }

    public function upzilla()
    {
        $data = [];
        $data['get_category'] = Deshjure::where('cat_type', 1)->orderBy('serial', 'ASC')->get();
        $data['get_data'] = Deshjure::where('cat_type', 2)->orderBy('serial', 'ASC')->get();
        return view('backend.location.upzilla')->with($data);
    }

    public function upzilla_store(Request $request)
    {

        $request->validate([
             'name_bd' => 'required',
             'name_en' => 'required',
             'parent_id' => 'required',
        ]);

        $created_by = Auth::user()->id;
        $slug_bd = preg_replace('/\s+/u', '-', trim($request->name_bd));
        $data = [
            'name_bd' => $request->name_bd,
            'slug_bd' => $this->createSlugBd($slug_bd),
            'name_en' => $request->name_en,
            'slug_en' => $this->createSlugEn($request->name_en),
            'parent_id' => $request->parent_id,
            'cat_type' => 2,
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];
        $insert = Deshjure::create($data);
        Session::flash('submitType', $request->submit);
        Toastr::success('Divistion Created Successfully.');
        return back();
    }

    public function upzilla_edit($id)
    {   $get_category = Deshjure::where('cat_type', 1)->get();
        $data = Deshjure::find($id);
        echo view('backend.location.edit-form.upzilla')->with(compact('data', 'get_category'));
    }

    public function upzilla_update(Request $request)
    {
        $request->validate([
            'name_bd' => 'required',
            'name_en' => 'required',
            'parent_id' => 'required',
        ]);
        $created_by = Auth::user()->id;
        $slug_bd = preg_replace('/\s+/u', '-', trim($request->name_bd));
        $data = [
            'name_bd' => $request->name_bd,
            'name_en' => $request->name_en,
            'parent_id' => $request->parent_id,
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];

        $update = Deshjure::where('id', $request->id)->update($data);
        if($update){
            Toastr::success('Deshjure update successfull.');
        }else{
            Toastr::success('Sorry Deshjure can\'t update.');
        }
        return back();
    }

    public function upzilla_delete($id)
    {
        $delete =  Deshjure::find($id)->delete();
        if($delete){
            echo 'Deshjure delete successfull.';
        }else{
            echo 'Sorry Deshjure can\'t deleted.';
        }
    }

    public function createSlugBd($slug)
    {
        //$slug = Str::slug($slug);

        $check_slug = Deshjure::select('slug_bd')->where('slug_bd', 'like', $slug.'%')->get();

        if (count($check_slug)>0){
            //find slug until find not used.
            for ($i = 1; $i <= count($check_slug); $i++) {
                $newSlug = $slug.'-'.$i;
                if (!$check_slug->contains('slug_bd', $newSlug)) {
                    return $newSlug;
                }
            }
        }else{ return $slug; }
    }


    public function createSlugEn($slug)
    {
        $slug = Str::slug($slug);

        $check_slug = Deshjure::select('slug_en')->where('slug_en', 'like', $slug.'%')->get();

        if (count($check_slug)>0){
            //find slug until find not used.
            for ($i = 1; $i <= count($check_slug); $i++) {
                $newSlug = $slug.'-'.$i;
                if (!$check_slug->contains('slug_en', $newSlug)) {
                    return $newSlug;
                }
            }
        }else{ return $slug; }
    }

}
