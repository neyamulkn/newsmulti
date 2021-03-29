<?php

namespace App\Http\Controllers;

use App\Models\Deshjure;
use App\Models\MediaGallery;
use App\Models\SubCategory;
use App\Models\Area;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Course;
use App\Models\Order;
use App\Models\Page;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use App\Models\ProductVariationDetails;
use App\Models\State;
use App\Traits\CreateSlug;
use App\User;
use App\Vendor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Str;

class AjaxController extends Controller
{
    use CreateSlug;

     public function get_subcategoryBy_id($id)
    {
        $output = '';
        $get_subcategory= Category::find($id)->subcategory;
        if(count($get_subcategory)>0){
            $output .= '<div class="form-group">
                           <select onchange="get_district(this.value)" name="subcategory" id="subcategory" class="form-control custom-select">
                                <option selected value="0">Sub category</option>';
            foreach($get_subcategory as $show_subcategory){
                $output .='<option value="'.$show_subcategory->id.'">'.$show_subcategory->subcategory_bd.'</option>';
            }
            $output .=  ' </select>
                        </div>';
        }

        echo $output;
    }

    public function get_district($id=null)
    {
        $output = '';
        $get_districts = Deshjure::where('parent_id', $id)->where('cat_type', 1)->get();
        if(count($get_districts)>0){
            $output .= '<div class="form-group">
                            <select onchange="get_upzilla(this.value)" name="district" id="district" class="form-control custom-select">
                                <option selected value="0">'.__('lang.zilla').'</option>';
            foreach($get_districts as $get_district){
                $output .='<option value="'.$get_district->id.'">'.$get_district->name_bd.'</option>';
            }
            $output .=  ' </select>
                        </div>';
        }
        echo $output;
    }


    public function get_upzilla($id=null)
    {
        $output = '';
        $get_upzilla= Deshjure::where('parent_id', $id)->where('cat_type', 2)->get();
        if(count($get_upzilla)>0){
            $output .= '<div class="form-group">
                            <select name="upzilla" id="upzilla" class="form-control custom-select"><option selected value="0">'.__('lang.upzilla').'</option>';
            foreach($get_upzilla as $show_upzilla){
                $output .='<option value="'.$show_upzilla->id.'">'.$show_upzilla->name_bd.'</option>';
            }
            $output .=  '</select>
                    </div>';
        }
        echo $output;
    }


   //deshjure search route  // for home page and sitebar

   public function deshjure_district($slug)
    {
        $output = '';
        $get_districts = DB::table('deshjures')->join('sub_categories', 'deshjures.parent_id', 'sub_categories.id')->where('sub_categories.subcat_slug_en', $slug)->where('deshjures.cat_type', 1)->get();
        if(count($get_districts)>0){
            $output .= '<div class="form-group">
                            <select onchange="get_upzilla(this.value)" name="district" id="district" class="form-control custom-select">
                                <option selected value="0">'.__('lang.zilla').'</option>';
            foreach($get_districts as $get_district){
                $output .='<option value="'.$get_district->slug_en.'">'.$get_district->name_bd.'</option>';
            }
            $output .=  ' </select>
                        </div>';
        }
        echo $output;
    }


    public function deshjure_upzilla($slug)
    {
        $output = '';
        $zilla = Deshjure::where('slug_en', $slug)->first();

        $get_upzilla= DB::table('deshjures')->where('parent_id', $zilla->id)->where('deshjures.cat_type', 2)->get();
        if(count($get_upzilla)>0){
            $output .= '<div class="form-group">
                            <select name="upzilla" id="upzilla" class="form-control custom-select"><option selected value="0">'.__('lang.upzilla').'</option>';
            foreach($get_upzilla as $show_upzilla){
                $output .='<option value="'.$show_upzilla->name_en.'">'.$show_upzilla->name_bd.'</option>';
            }
            $output .=  '</select>
                    </div>';
        }
        echo $output;
    }

    // get image for news upload page under model
    public function imageGallery(Request $request){
        $images = MediaGallery::orderBy('id', 'DESC')->paginate(24);
        $output = '';
        if($images){
            foreach ($images as $image){
            $output .= '<div class="col-md-2 col-6 col-sm-3">
                    <div class="gallery-card">
                        <div class="gallery-card-body" onclick="image_details(\''.$image->source_path.'\',\''.$image->title.'\')">
                            <label class="block-check">
                                <img src="'.asset('upload/images/thumb_img/'.$image->source_path).'" class="img-responsive" />
                                <input value="'.$image->id.'" type="radio" name="imageId">
                                <span class="checkmark"></span>
                            </label>
                            <div class="mycard-footer">
                                <a href="#" class="card-link">'.Str::limit($image->title, 8).'</a>
                            </div>
                        </div>
                    </div>
                </div>';
            }        }
        return $output;
    }

    public function videoGallery(){

    }
    public function changeProfileImage(Request $request){
        $this->validate($request, [
            'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
        $user = User::find(Auth::id());
        //profile image
        if ($request->hasFile('profileImage')) {
            //delete image from folder
            $getimage_path = public_path('upload/images/users/'. $user->photo);
            if(file_exists($getimage_path) && $user->photo){
                unlink($getimage_path);
            }
            $image = $request->file('profileImage');
            $new_image_name = $this->uniqueImagePath('users', 'photo', $image->getClientOriginalName());
            $image->move(public_path('upload/images/users'), $new_image_name);
            $user->photo = $new_image_name;
            $user->save();
            Toastr::success('Your profile image update success.');
            return back();
        }
        Toastr::error('Please select any image');
        return back();
    }
    //get sub category by category
    public function get_subcategory($cat_id){
        $subcategories = Category::where('parent_id', $cat_id)->get();
        $output = '';
        if(count($subcategories)>0){
            $output .= '<option value="">Select Subcategory</option>';
            foreach($subcategories as $subcategory){
                $output .='<option '. (Session::get("subcategory_id") == $subcategory->id ? "selected" : "" ).' value="'.$subcategory->id.'">'.$subcategory->name.'</option>';
            }
        }
        echo $output;
    }

    // get childcategory by category
    public function get_subchild_category($subcat_id){
        $subchildcategories = Category::where('subcategory_id', $subcat_id)->get();
        $output = '';
        if(count($subchildcategories)>0){
            $output .= '<option value="">Select child category</option>';
            foreach($subchildcategories as $subchildcategory){
                $output .='<option '. (Session::get("childcategory_id") == $subchildcategory->id ? "selected" : "" ).' value="'.$subchildcategory->id.'">'.$subchildcategory->name.' ('.count($subchildcategory->productsByChildCategory).')</option>';
            }
        }
        echo $output;
    }


    // check unique fielde
    public function checkField(Request $request){

        if($request->field == 'email' && !filter_var($request->value, FILTER_VALIDATE_EMAIL)){
            $output = [
                'status' => false,
                'msg' =>  $request->value ." is invalid email."
            ];
            return response()->json($output);
        }

        $check = DB::table($request->table)->where($request->field, $request->value)->first();
        if($check){
            $output = [
                'status' => false,
                'msg' =>  $request->field ." allready used."
            ];
        }else{
            $output = [
                'status' => true,
                'msg' =>  $request->field ." is available."
            ];
        }

        return response()->json($output);

    }

    // delete Data Common
    public function deleteDataCommon(Request $request)
    {
        $field = ($request->field) ? $request->field : 'id';
        $delete = DB::table($request->table)->where($field, $request->id)->delete();
        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Data deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Data cannot deleted.'
            ];
        }
        return response()->json($output);
    }


    // Status change function
    public function satusActiveDeactive(Request $request){
        $status = DB::table($request->table)->where('id', $request->id)->first();
        $field =  ($request->field) ? $request->field : 'status';
        //check number(1) or string(active)
        $value_type =  is_numeric($status->$field)  ? 1 : 'active';

        if(is_numeric($status->$field)){
            $value =  ($status->$field == 1)  ? 0 : 1;
        }else{
            $value =  ($status->$field == 'active')  ? 'deactive' : 'active';
        }
        if($status){
            if($status->$field == $value_type){
                DB::table($request->table)->where('id', $request->id)->update([$field => $value]);
            }else{
                DB::table($request->table)->where('id', $request->id)->update([$field => $value]);
            }
            $output = array( 'status' => true, 'message' => $field. ' update successful.');
        }else{
            $output = array( 'status' => false, 'message' => $field. ' can\'t update.!');
        }
        return response()->json($output);
    }

    // Status approve Unapprove function
    public function approveUnapprove(Request $request){
        $status = DB::table($request->table)->where('id', $request->id)->first();

        $field =  ($request->field) ? $request->field : 'status';
        //check number(1) or string(active)
        $value_type =  is_numeric($status->$field)  ? 1 : 'active';

        if(is_numeric($status->$field)){
            $value =  ($status->$field == 1)  ? 0 : 1;
        }else{
            $value =  ($status->$field == 'active')  ? 'pending' : 'active';
        }
        if($status){
            if($status->$field == $value_type){
                DB::table($request->table)->where('id', $request->id)->update([$field => $value]);
            }else{
                DB::table($request->table)->where('id', $request->id)->update([$field => $value]);
            }
            $output = array( 'status' => true, 'message' => ' Published successful.');
        }else{
            $output = array( 'status' => false, 'message' => 'Sorry can\'t published.!');
        }
        return response()->json($output);
    }

    //position sorting
    public function positionSorting(Request $request){

        for($i=0; $i<count($request->ids); $i++)
        {
            $sorting = DB::table($request->table);
            if(isset($request->field)){
                $sorting->where($request->field, $request->value);
            }
            $sorting->where('id', str_replace('item', '', $request->ids[$i]))->update(['position' => $i]);
        }
        echo 'Position sorting has been updated';
    }


    public function createUniqueSlug(Request $request, $slug){
        return $this->createSlug($request->table, $slug, $request->field);
    }

}
