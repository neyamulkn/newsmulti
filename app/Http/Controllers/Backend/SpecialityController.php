<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Speciality;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialityController extends Controller
{
    public function index()
    {
        $get_speciality = Speciality::all();
        return view('backend.speciality-list')->with(compact('get_speciality'));
    }


    public function create()
    {
         return view('backend.speciality');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'speciality_name' => 'required',
            'status' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $speciality_slug = str_slug($request->speciality_name);
        $data = array_merge($request->all(), ['user_id' => $user_id, 'speciality_slug' => $speciality_slug]);

        $insert = Speciality::create($data);
        Toastr::success('Speciality created.');
        return back();
    }

    public function show(Speciality $speciality)
    {
        //
    }

    public function edit($id)
    {
        $data = Speciality::find($id);
        echo view('backend.edit-form.specialnews-edit')->with(compact('data'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'speciality_name' => 'required',
            'status' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $speciality_slug = str_slug($request->speciality_name);
        $request_data = $request->except(['_token']);
        $data = array_merge($request_data, ['user_id' => $user_id, 'speciality_slug' => $speciality_slug]);
        $update = Speciality::where('id', $request->id)->update($data);
        if($update){
            Toastr::success('Speciality update successfully.');
        }else{
            Toastr::success('Sorry speciality can\'t updated.');
        }

        return back();
    }

    public function delete($id)
    {
        $delete =  Speciality::find($id)->delete();
        if($delete){
            echo 'Speciality delete successfully.';
        }else{
            echo 'Sorry speciality can\'t deleted.';
        }
    }
}
