<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Social;
use App\Models\Upzilla;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class GeneralSettingController extends Controller
{
    use CreateSlug;
    public function __construct()
    {
        $setting = GeneralSetting::first();
        if(!$setting){
            GeneralSetting::create([
                'site_name' => $_SERVER['SERVER_NAME'],
                'date_format' => 'M j, Y'
            ]);
        }
    }

    //general Setting edit
    public function generalSetting()
    {
        $setting = GeneralSetting::first();
        return view('backend.setting.general-setting')->with(compact('setting'));
    }

    //general Setting update
    public function generalSettingUpdate(Request $request, $id)
    {

        dd($request->all());
        
        $setting = GeneralSetting::where('id', $id)->first();
        Session::put('updateTab', $request->updateTab);
        if(!$request->updateTab || !$setting){
            Toastr::error('Sorry something went wrong try again.');
            return back();
        }

        //update general Setting
        if($request->updateTab == 'generalSetting'){
            $setting->site_name = $request->site_name;
            $setting->site_owner = $request->site_owner;
            $setting->phone = $request->phone;
            $setting->email = $request->email;
            $setting->date_format = $request->date_format;
            $setting->about = $request->about;
        }
        //update header footer
        if($request->updateTab == 'headerFooter'){
            $setting->header = $request->header;
            $setting->header_no = $request->header_no;
            $setting->footer = $request->footer;
            $setting->footer_no = $request->footer_no;
            $setting->header_bg_color = $request->header_bg_color;
            $setting->header_text_color = $request->header_text_color;
            $setting->footer_bg_color = $request->footer_bg_color;
            $setting->footer_text_color = $request->footer_text_color;
            $setting->address = $request->address;
            $setting->copyright_text = $request->copyright_text;
            $setting->copyright_bg_color = $request->copyright_bg_color;
            $setting->copyright_text_color = $request->copyright_text_color;
        }
        //update reCaptcha
        if($request->updateTab == 'reCaptcha'){
            $setting->recaptcha_site_key = $request->recaptcha_site_key;
            $setting->recaptcha_secret_key = $request->recaptcha_secret_key;
        }

        //update analytics
        if($request->updateTab == 'analytics'){
            $setting->google_analytics = $request->google_analytics;
            $setting->google_adsense = $request->google_adsense;
        }
        //update social Login
        if($request->updateTab == 'facebook_login'){
            $setting->facebook_login = ($request->facebook_login) ? 1 : 0;
            $setting->facebook_client_id = $request->facebook_client_id;
            $setting->facebook_client_secret = $request->facebook_client_secret;
        }
        if($request->updateTab == 'google_login'){
             $setting->google_login = ($request->google_login) ? 1 : 0;
            $setting->google_client_id = $request->google_client_id;
            $setting->google_client_secret = $request->google_client_secret;
        }
        if($request->updateTab == 'twitter_login'){
            $setting->twitter_login = ($request->twitter_login) ? 1 : 0;
            $setting->twitter_client_id = $request->twitter_client_id;
            $setting->twitter_client_secret = $request->twitter_client_secret;
        }
        //update seo setting
        if($request->updateTab == 'seoSetting'){
         
            $setting->title = $request->title;
            $setting->meta_keywords = ($request->meta_keywords) ? implode(',', $request->meta_keywords) : null;
            $setting->description = $request->description;
            //if  meta_image set
            if ($request->hasFile('meta_image')) {
                //delete previous meta_image
                $meta_image = public_path('upload/images/logo/'. $setting->meta_image);
                if(file_exists($meta_image) && $setting->meta_image){
                    unlink($meta_image);
                }
                $image = $request->file('meta_image');
                $new_image_name = $this->uniqueImagePath('general_settings', 'meta_image', $image->getClientOriginalName());
                $image->move(public_path('upload/images/logo/'), $new_image_name);
                $setting->meta_image = $new_image_name;
            }
        }

        $setting->save();
        Toastr::success('Setting update success.');
        return back();
    }


    public function logoSetting()
    {
        $setting = GeneralSetting::selectRaw('id, logo,footer_logo,favicon')->first();
        return view('backend.setting.logo')->with(compact('setting'));
    }

    public function logoSettingUpdate(Request $request, $id)
    {
        $setting = GeneralSetting::find($id);

        //if  logo set
        if ($request->hasFile('logo')) {
            //delete previous logo
            $get_logo = public_path('upload/images/logo/'. $setting->logo);
            if($setting->logo && file_exists($get_logo) ){
                unlink($get_logo);
            }
            $image = $request->file('logo');
            $new_image_name = $this->uniqueImagePath('general_settings', 'logo', $image->getClientOriginalName());

            $image_path = public_path('upload/images/logo/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(300, 80);
            $image_resize->save($image_path);
            $setting->logo = $new_image_name;
        }

          //if invoice logo set
        if ($request->hasFile('footer_logo')) {
            //delete previous logo
            $footer_logo = public_path('upload/images/logo/'. $setting->footer_logo);
            if($setting->footer_logo && file_exists($footer_logo)){
                unlink($footer_logo);
            }
            $image = $request->file('footer_logo');
            $new_image_name = $this->uniqueImagePath('general_settings', 'footer_logo', $image->getClientOriginalName());

            $image_path = public_path('upload/images/logo/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(300, 100);
            $image_resize->save($image_path);
            $setting->footer_logo = $new_image_name;
        }
      
        //if favicon set
        if ($request->hasFile('favicon')) {
            //delete previous logo
            $get_favicon = public_path('upload/images/logo/'. $setting->favicon);
            if($setting->favicon && file_exists($get_favicon)){
                unlink($get_favicon);
            }
            $image = $request->file('favicon');
            $new_image_name = 'favicon-'.$this->uniqueImagePath('general_settings', 'favicon', $image->getClientOriginalName());

            $image_path = public_path('upload/images/logo/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(32, 32);
            $image_resize->save($image_path);
            $setting->favicon = $new_image_name;
        }

        $setting->save();
        Toastr::success('Logo update sucess');
        return back();

    }
    
    public function googleSetting()
    {

        return view('backend.setting.google-config');
    }

}
