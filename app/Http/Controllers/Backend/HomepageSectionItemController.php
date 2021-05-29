<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\News;
use App\Models\Addvertisement;
use App\Models\HomepageSection;
use App\Models\HomepageSectionItem;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class HomepageSectionItemController extends Controller
{
    use CreateSlug;


    public function index($slug)
    {

        $data['section'] = HomepageSection::where('slug', $slug)->first();

        $sectionItems = HomepageSectionItem::where('section_id', $data['section']->id);
        if($data['section']->section_type == 'news'){
            $sectionItems->with('news');
        }
        if($data['section']->section_type == 'category'){
            $sectionItems->with('category');

            //get caregories
            $data['categories'] = Category::with('subcategory')->where('parent_id', null)->orderBy('category_en', 'asc')->get();
        }
        if($data['section']->section_type == 'ads'){
            $sectionItems->with('ads_details');
            //get Addvertisement
            $data['allAds'] = Addvertisement::orderBy('id', 'desc')->where('status', 1)->paginate(15);
        }
        $data['sectionItems'] = $sectionItems->orderBy('position', 'asc')->get();


        return view('backend.homepage.sectionItem.'.$data['section']->section_type)->with($data);
    }

    //get all Items by anyone field
    public function getAllItems(Request $request){
        $data['items_id'] = HomepageSectionItem::where('section_id', $request->section_id)->get()->pluck('item_id')->toArray();

        $item = News::where('news.status', 1)->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id');
        if ($request->item) {
            $keyword = $request->item;
            $item->Where('news_title', 'like', '%' . $keyword . '%');
        }


        if ($request->category && $request->category != 'all') {
            $item->where('category_id', $request->category);
        }
        $data['allItems'] = $item->orderBy('news_title', 'asc')->select('news.*','media_galleries.source_path')->paginate(25);

        return view('backend.homepage.sectionItem.getItems')->with($data);
    }

    //get all banner by anyone field
    public function getAllbanners(Request $request){
        $data['items_id'] = HomepageSectionItem::where('section_id', $request->section_id)->get()->pluck('item_id')->toArray();

        $item = Banner::where('status', 1);
        if ($request->item) {
            $keyword = $request->item;
            $item->where('title', 'like', '%' . $keyword . '%');
        }

        $data['allBanners'] = $item->orderBy('title', 'asc')->paginate(25);

        return view('backend.homepage.sectionItem.getBanner')->with($data);
    }

    //added section single news
    public function sectionSingleItemStore(Request $request)
    {
        $section = HomepageSection::where('id', $request->section_id)->first();
        if($section){
            $sectionItem = HomepageSectionItem::where('section_id', $request->section_id)->where('item_id', $request->item_id)->first();
            if(!$sectionItem) {
                $sectionItem = new HomepageSectionItem();
                $sectionItem->section_id = $request->section_id;
                $sectionItem->item_id = $request->item_id;
                $sectionItem->approved = 1;
                $sectionItem->status = 'active';
                $sectionItem->save();
                $output = [
                    'status' => true,
                    'msg' => 'Item added success.'
                ];
            }else{
                $output = [
                    'status' => false,
                    'msg' => 'This Item already added.'
                ];
            }
        }
        return response()->json($output);
    }

    //added section multi news
    public function sectionMultiItemStore(Request $request){

        if($request->item_id){
            foreach ($request->item_id as $item_id => $value) {
                $sectionItem = HomepageSectionItem::where('section_id', $request->section_id)->where('item_id', $item_id)->first();
                if(!$sectionItem){
                    $sectionItem = new HomepageSectionItem();
                    $sectionItem->section_id = $request->section_id;
                    $sectionItem->item_id = $item_id;
                    $sectionItem->approved = 1;
                    $sectionItem->status = 'active';
                    $sectionItem->save();
                }else{
                    Toastr::error('Item already added.');
                }
            }
        }else{
            Toastr::error('Item added failed, Please select any item');
        }
        return back();
    }

    public function store(Request $request)
    {

        if($request->section_type == 'category'){
            $request->validate([
                'category_id' => 'required',
            ]);
        }
        if($request->section_type == 'ads'){
            $request->validate([
                'adsSourch' => 'required',
            ]);
        }

        $section = new HomepageSectionItem();
        $section->item_title = ($request->item_title) ? $request->item_title : null;
        $section->item_sub_title = ($request->item_sub_title) ? $request->item_sub_title : null;
        $section->section_id = $request->section_id;
        $section->background_color = $request->background_color;
        $section->text_color = $request->text_color;
        $section->is_feature = ($request->is_feature ? 1 : 0);

        if($request->section_type == 'category'){
            $section->item_id = $request->category_id;
        }
        if($request->section_type == 'ads'){
            if($request->adsSourch == 'new'){
                //new ads store
                $ads = new Addvertisement();
                $ads->ads_name = $request->item_title;
                $ads->adsType = $request->adsType;
                $ads->page = 'home';
                $ads->add_code = ($request->add_code) ? $request->add_code : null;
                $ads->redirect_url = $request->redirect_url;
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $new_image_name = $this->uniqueImagePath('addvertisements', 'image', $image->getClientOriginalName());
                    $image->move(public_path('upload/ads'), $new_image_name);
                    $ads->image = $new_image_name;
                }
                $ads->save();

                $item_id = $ads->id;
            }else{
                $item_id = $request->ads_id;
            }

            $section->item_id = $item_id;
        }


        $section->status = ($request->status ? 1 : 0);
        $store = $section->save();

        if($store){
            Toastr::success('Section '.$request->section_type.' added successfully.');
        }else{
            Toastr::error('Section '.$request->section_type.' can\'t added.');
        }

        return back();
    }


    public function edit($id)
    {

        $data['section'] = HomepageSectionItem::where('id', $id)->first();
        $data['categories'] = Category::with('subcategory')->where('parent_id', null)->orderBy('category_en', 'asc')->get();
        return view('backend.homepage.sectionItem.category_edit')->with($data);

    }

    public function update(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
        ]);

        $section = HomepageSectionItem::find($request->id);
        $section->item_title = $request->item_title;
        $section->item_sub_title = ($request->item_sub_title) ? $request->item_sub_title : null;
        $section->item_id = $request->category_id;
        $section->background_color = $request->background_color;
        $section->text_color = $request->text_color;
        $section->status = ($request->status ? 1 : 0);
        $update = $section->save();
        if($update){
            Toastr::success('Section update successfully.');
        }else{
            Toastr::error('Section can\'t update.');
        }

        return back();
    }

    public function itemRemove($id)
    {
        $section = HomepageSectionItem::find($id);
        if($section){
            $section->delete();
            $output = [
                'status' => true,
                'msg' => 'Section item remove successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Section item cannot remove.'
            ];
        }
        return response()->json($output);
    }

}
