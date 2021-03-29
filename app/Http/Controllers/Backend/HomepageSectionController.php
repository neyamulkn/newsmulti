<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Course;
use App\Models\HomepageSection;
use App\Models\HomepageSectionItem;
use App\Models\Product;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class HomepageSectionController extends Controller
{
    use CreateSlug;
    public function index()
    {
        $data['homepageSections'] = HomepageSection::orderBy('position', 'asc')->get();
        return view('backend.homepage.index')->with($data);
    }

    public function store(Request $request)
    {
        $section = new HomepageSection();
        $section->title = $request->title;
        $section->sub_title = $request->sub_title;
        $section->slug = $this->createSlug('homepage_sections', $request->title);
        $section->section_layout = $request->section_layout;
        $section->section_type = $request->section_type;
        $section->item_number = $request->item_number;
        
        $section->section_box_desktop = ($request->section_box_desktop) ? $request->section_box_desktop : 5;
        $section->section_box_mobile = ($request->section_box_mobile) ? $request->section_box_mobile : 2;
        $section->section_number =  ($request->section_number ?  $request->section_number: null);
        $section->layout_width = ($request->layout_width == 'full') ? 'full' : 'box';
        $section->background_color = $request->background_color;
        $section->text_color = $request->text_color;
        $section->status = ($request->status ? 1 : 0);
        $section->image_position = $request->image_position;
        if ($request->hasFile('thumb_image')) {
            $image = $request->file('thumb_image');
            $new_image_name = $this->uniqueImagePath('homepage_sections', 'thumb_image', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->thumb_image = $new_image_name;
        }
        if ($request->hasFile('background_image')) {
            $image = $request->file('background_image');
            $new_image_name = $this->uniqueImagePath('homepage_sections', 'background_image', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->background_image = $new_image_name;
        }
        $store = $section->save();
        if($store){
            Toastr::success('Homepage section added successfully.');
        }else{
            Toastr::error('Homepage section cann\'t added.');
        }

        return back();
    }

    public function edit($id)
    {

        $data['section'] = HomepageSection::with('sectionItem')->where('id', $id)->first();
       
        //get caregories
        $data['categories'] = Category::where('parent_id', null)->orderBy('category_en', 'asc')->get();
        return view('backend.homepage.edit')->with($data);

    }

    public function update(Request $request)
    {
        //dd($request->all());

        $section = HomepageSection::find($request->id);
        $section->title = $request->title;
        $section->sub_title = $request->sub_title;
        if($request->section_layout){
            $section->section_layout = $request->section_layout;
        }
        $section->item_number = $request->item_number;
        $section->section_box_desktop = ($request->section_box_desktop) ? $request->section_box_desktop : 5;
        $section->section_box_mobile = ($request->section_box_mobile) ? $request->section_box_mobile : 2;
        $section->section_number =  ($request->section_number ?  $request->section_number: null);
        $section->layout_width = ($request->layout_width == 'full') ? 'full' : 'box';
        $section->background_color = $request->background_color;
        $section->text_color = $request->text_color;
        $section->status = ($request->status ? 1 : 0);
        $section->image_position = $request->image_position;

        if ($request->hasFile('thumb_image')) {
            //delete image from folder
            $image_path = public_path('upload/images/homepage/'. $section->thumb_image);
            if(file_exists($image_path) && $section->thumb_image){
                unlink($image_path);
            }
            $image = $request->file('thumb_image');
            $new_image_name = $this->uniqueImagePath('homepage_sections', 'thumb_image', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->thumb_image = $new_image_name;
        }

        if ($request->hasFile('background_image')) {
            //delete image from folder
            $image_path = public_path('upload/images/homepage/'. $section->background_image);
            if(file_exists($image_path) && $section->background_image){
                unlink($image_path);
            }
            $image = $request->file('background_image');
            $new_image_name = $this->uniqueImagePath('homepage_sections', 'background_image', $image->getClientOriginalName());
            $image->move(public_path('upload/images/homepage'), $new_image_name);
            $section->background_image = $new_image_name;
        }
        $store = $section->save();
        if($store){
            //update section item category id
            if($request->category_id){
                $sectionItem = HomepageSectionItem::where('section_id', $request->id)->first();
               
                $sectionItem->item_id = $request->category_id;
                $sectionItem->save();
                
            }


            Toastr::success('Homepage section update successfully.');
        }else{
            Toastr::error('Homepage section update failed.');
        }

        return back();
    }

    public function delete($id)
    {
        $section = HomepageSection::find($id);

        if($section){
            $section->delete();
            $output = [
                'status' => true,
                'msg' => 'Home section deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Home section cannot deleted.'
            ];
        }
        return response()->json($output);
    }


    public function HomepageSectionSorting (Request $request){
        for($i=0; $i<count($request->sectionIds); $i++)
        {
            HomepageSection::where('id', str_replace('item', '', $request->sectionIds[$i]))->update(['position' => $i]);
        }
        echo 'Section Order has been updated';
    }
}
