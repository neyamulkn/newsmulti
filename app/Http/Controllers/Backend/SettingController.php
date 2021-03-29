<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['get_data'] = Setting::first();
        return  view('backend.setting')->with($data);
    }
    public function setting_store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $check = Setting::first();

        $image_name = $check->logo;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image_name = $image->getClientOriginalName();
            $image_path = public_path('backend/images/' . $image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(250, 100);
            $image_resize->save($image_path);
        }
        $updated_by = Auth::user()->id;

        $data = [
            'title' => $request->title,
            'header_text' => $request->header_text,
            'language' => $request->language,
            'logo' => $image_name,
            'footer' => $request->footer,
            'date_format' => $request->date_format,
            'updated_by' => $updated_by,
            'status' => 1,
        ];

        if ($check){
            Setting::where('id', $check->id)->update($data);
            Toastr::success('Setting Updated Successfully.');
        }else{
            Setting::create($data);
            Toastr::success('Setting Created Successfully.');
        }

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
