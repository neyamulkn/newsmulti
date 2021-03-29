<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Addvertisement;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddvertisementController extends Controller
{

    public function index(){
        $advertisements = Addvertisement::orderBy('id', 'DESC')->get();
        return view('backend.addvertisement-list')->with(compact('advertisements'));
    }
 
    public function create()
    {
        return view('backend.addvertisement');
    }

    public function store(Request $request)
    {

        $request->validate([
            'adsType' => 'required',
            'page' => 'required',
            'position' => 'required'
        ]);

        $image_name = null;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/ads'), $image_name);

        }
        $created_by = Auth::user()->id;

        $data = [
            'ads_name' => $request->ads_name,
            'adsType' => $request->adsType,
            'page' => $request->page,
            'position' => $request->position,
            'image' => $image_name,
            'redirect_url' => $request->redirect_url,
            'clickBtn' => $request->clickBtn,
            'add_code' =>  $request->add_code,
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];
        $insert = Addvertisement::create($data);
        Toastr::success('Addvertisement Created Successfully.');
        return back();
    }

    public function edit($id)
    {  
        $data = Addvertisement::find($id);
        return view('backend.addvertisement-edit')->with(compact('data'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'adsType' => 'required',
            'page' => 'required',
            'position' => 'required'
        ]);


        $updated_by = Auth::user()->id;

        $data = [
            'ads_name' => $request->ads_name,
            'adsType' => $request->adsType,
            'page' => $request->page,
            'position' => $request->position,
            'redirect_url' => $request->redirect_url,
            'clickBtn' => $request->clickBtn,
            'add_code' =>  $request->add_code,
            'updated_by' => $updated_by,
            'status' => ($request->status) ? '1' : '0',
        ];


        if($request->hasFile('image')) {
            $get_ads = Addvertisement::find($id);
            //delete from store folder
            if ($get_ads->image){
                $image_path = public_path('upload/ads/' . $get_ads->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                } 
            }
           
            $image = $request->file('image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/ads'), $image_name);

            $data = array_merge(['image' => $image_name], $data );
        }

        $insert = Addvertisement::where('id', $id)->update($data);
        Toastr::success('Addvertisement updated Successfully.');
        return back();
    }



    public function delete($id)
    {
        $get_ads = Addvertisement::find($id);
        

        if($get_ads){
            //delete from store folder
            if ($get_ads->image){
                $image_path = public_path('upload/ads/' . $get_ads->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                } 
            }
            $get_ads->delete();
            $output = [
                'status' => true,
                'msg' => 'Ads deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Ads cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    public function status($status){
        $status = Addvertisement::find($status);
        if($status->status == 1){
            $status->update(['status' => 0]);
            $output = array( 'status' => 'unpublish',  'message'  => 'Advertisement Unpublished');
        }else{
            $status->update(['status' => 1]);
            $output = array( 'status' => 'publish',  'message'  => 'Advertisement Published');
        }

        return response()->json($output);
    }
}
