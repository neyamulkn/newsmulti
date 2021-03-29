<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MediaGallery;
use App\Models\News;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MediaGalleryController extends Controller
{

     public function phato_list(){
        $user_id = Auth::user()->id;
        $get_data = MediaGallery::where('type', 1);
        if(Auth::user()->role_id != env('ADMIN')){
            $get_data->where('user_id', $user_id);
        }
         $get_data =  $get_data->orderBy('id', 'DESC')->paginate(25);
        return view('backend.phato-gallery')->with(compact('get_data'));
    }

    public function phato_upload(Request $request){
        $rules = array(
            'phato'  => 'mimes:jpeg,jpg,png,gif|required|max:2024'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $user_id = Auth::user()->id;
        $image_name = null;
        if($request->hasFile('phato')){
            $image = $request->file('phato');
            $image_name = $this->uniquePath($image->getClientOriginalName());
            $image_path = public_path('upload/images/thumb_img/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(200, 115);
            $image_resize->save($image_path);


            // Add water mark in image
            $img = Image::make($image->getRealPath());
            //facebook size
            $img->resize(600, 315);
            $watermark =  Image::make(public_path('frontend/watermark.png'));
            $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
            $watermarkSize = $img->width() / 1; //half of the image size (2 dele half)
            $resizePercentage = 0;//0% less then an actual image (play with this value)
            $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
            // resize watermark width keep height auto
            $watermark->resize($watermarkSize, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            //insert resized watermark to image center aligned
            $img->insert($watermark, 'bottom-center');
            //overrite image or new name choose
            $img->save(public_path('upload/images/watermark/'. $image_name));


            $image_path = public_path('upload/images/thumb_img_box/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(420, 275);
            $image_resize->save($image_path);

            $image_path = public_path('upload/images/'.$image_name );
            Image::make($image)->save($image_path);
        }

        $data = [
            'title' => $request->title,
            'source_path' => $image_name,
            'type' => 1,
            'user_id' => $user_id,
        ];
        $insert = MediaGallery::create($data);
        $output = array(
             'success' => $insert->id,
             'image'  => '<input class="dropify" id="input-file-disable-remove" data-show-remove="false" data-default-file="'.asset('upload/images/'.$image_name).'">'
            );
       return response()->json($output);
    }

    public function phato_edit($id)
    {
        $data = MediaGallery::find($id);
        echo view('backend.edit-form.phato-edit')->with(compact('data'));
    }

    public function phato_update(Request $request)
    {
        $check = MediaGallery::find($request->id);
        if($check){
            $user_id = Auth::user()->id;
            $image_name = null;
            if($request->hasFile('phato')){
                $image = $request->file('phato');
                $image_name = $this->uniquePath($image->getClientOriginalName());

                $image_path = public_path('upload/images/thumb_img/'.$image_name );
                $image_resize = Image::make($image);
                $image_resize->resize(200, 115);
                $image_resize->save($image_path);

                // Add water mark in image
                $img = Image::make($image->getRealPath());
                $watermark =  Image::make(public_path('frontend/watermark.png'));
                $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                $watermarkSize = $img->width() / 1; //half of the image size (2 dele half)
                $resizePercentage = 0;//0% less then an actual image (play with this value)
                $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
                // resize watermark width keep height auto
                $watermark->resize($watermarkSize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                //insert resized watermark to image center aligned
                $img->insert($watermark, 'bottom-center');
                //overrite image or new name choose
                $img->save(public_path('upload/images/watermark/'. $image_name));


                $image_path = public_path('upload/images/thumb_img_box/'.$image_name );
                $image_resize = Image::make($image);
                $image_resize->resize(420, 275);
                $image_resize->save($image_path);

                $image_path = public_path('upload/images/'.$image_name );
                Image::make($image)->save($image_path);

                $data = [
                    'title' => $request->title,
                    'source_path' => $image_name,
                    'type' => 1,
                    'user_id' => $user_id,
                ];

                $source_path = public_path('upload/images/'.$check->source_path);
                if(file_exists($source_path)){ //If it exits, delete it from folder
                    unlink($source_path);
                    unlink(public_path('upload/images/thumb_img/'.$check->source_path));
                }
            }else{
                $data = [
                    'title' => $request->title,
                    'user_id' => $user_id,
                ];
            }

            $update = MediaGallery::where('id', $request->id)->update($data);
            if($update){
                Toastr::success('Image update successfully.');
            }else{
                Toastr::success('Sorry image cann\'t updated.');
            }

        }else{
            Toastr::error('Sorry image cann\'t updated.');
        }

        return back();

    }

    public function phato_delete($id)
    {
        $check = MediaGallery::find($id);
        if($check){
            $source_path = public_path('upload/images/'.$check->source_path);
            if(file_exists($source_path)){ //If it exits, delete it from folder
                unlink($source_path);
                unlink(public_path('upload/images/thumb_img/'.$check->source_path));
            }
            $delete =  $check->delete();
           
            $output = [
                'status' => true,
                'msg' => 'Phato deleted successfully.'
            ];

        }else{
            $output = [
                'status' => false,
                'msg' => 'Sorry Phato cann\'t deleted.'
            ];
        }
        return response()->json($output);
    }

 
     // upload  desciption inner phato CKEditor 

    public function phato_uploadCKEditor(Request $request){

        $user_id = Auth::user()->id;
        $image_name = $message = $url = null;
        $function_number = $request->input('CKEditorFuncNum');

        $rules = array(
            'upload'  => 'mimes:jpeg,jpg,png,gif|required|max:2024'
        );

        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            $message = 'Invalid image selected.';
            return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
        }
        
       
        if($request->hasFile('upload')){
            $image = $request->file('upload');
            $image_name = $this->uniquePath($image->getClientOriginalName());
            $image_path = public_path('upload/images/thumb_img/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(200, 115);
            $image_resize->save($image_path);

            $image_path = public_path('upload/images/thumb_img_box/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(420, 275);
            $image_resize->save($image_path);

            $image_path = public_path('upload/images/'.$image_name );
            Image::make($image)->save($image_path);

            // CKEditor url
            $url = asset('upload/images/'.$image_name );

            $data = [
                'title' => $request->title,
                'source_path' => $image_name,
                'type' => 1,
                'user_id' => $user_id,
            ];
            $insert = MediaGallery::create($data);
           
        }else{
            $message = 'No image uploaded.';
        }

        return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
 
    }


    public function video_list(){
        $user_id = Auth::user()->id;
        $get_data = MediaGallery::where('type', 2)->where('user_id', $user_id)->get();
        return view('backend.video-gallery')->with(compact('get_data'));
    }

    public function video_upload(Request $request){


// dd($request->all());
        $user_id = Auth::user()->id;

        $rules = array(
            'video' => 'required|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,wmv',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->hasFile('video')){
            $video = $request->file('video');
            $video_path = time().rand('123456', '999999').".".$video->getClientOriginalExtension();
            $path = public_path('upload/videos/'); // video upload ar time a path seperate dete hoy
            $video->move($path, $video_path);
        }
        $data = [
            'title' => $request->title,
            'source_path' => $video_path,
            'type' => 2,
            'user_id' => $user_id,
        ];
        $insert = MediaGallery::create($data);
        $output = array(
             'success' => '<input type="hidden" name="video" value="'.$insert->id.'">',
             'image'  => '<video width="100%" height="157" controls><source src="'.asset('upload/videos/'.$video_path).'" type="video/mp4"></video>'
            );
       return response()->json($output);
    }

    public function video_edit($id)
    {
        $data = MediaGallery::find($id);
        echo view('backend.edit-form.video-edit')->with(compact('data'));
    }

    public function video_update(Request $request)
    {
        $check = MediaGallery::find($request->id);
        if($check){
            $user_id = Auth::user()->id;
            $request->validate([
                'video' => 'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv',
            ]);

            if($request->hasFile('video')){
                $video = $request->file('video');
                $video_path = time().rand('123456', '999999').".".$video->getClientOriginalExtension();
                $path = public_path('upload/videos/'); // video upload ar time a path seperate dete hoy
                $video->move($path, $video_path);

                $data = [
                    'title' => $request->title,
                    'source_path' => $video_path,
                    'user_id' => $user_id,
                ];

                $source_path = public_path('upload/videos/'.$check->source_path);
                if(file_exists($source_path)){ //If it exits, delete it from folder
                    unlink($source_path);
                }
            }else{
                $data = [
                    'title' => $request->title,
                    'user_id' => $user_id,
                ];
            }

            $update = MediaGallery::where('id', $request->id)->update($data);
            if($update){
                Toastr::success('video update successfully.');
            }else{
                Toastr::success('Sorry video cann\'t updated.');
            }

        }else{
            Toastr::error('Sorry video cann\'t updated.');
        }

        return back();

    }

    public function video_delete($id)
    {
        $check = MediaGallery::find($id);
        if($check){
            $source_path = public_path('upload/videos/'.$check->source_path);
            if(file_exists($source_path)){ //If it exits, delete it from folder
                unlink($source_path);
            }
            $delete =  $check->delete();
            echo 'video deleted successfully.';

        }else{
           echo 'Sorry video cann\'t deleted.';
        }
    }

    public function uniquePath($path)
    {

        $check_path = MediaGallery::select('source_path')->where('source_path', 'like', '%'.$path)->get();

        if (count($check_path)>0){
            //find slug until find not used.
            for ($i = 1; $i <= count($check_path); $i++) {
                $newPath = $i.'-'.$path;
                if (!$check_path->contains('source_path', $newPath)) {
                    return $newPath;
                }
            }
        }else{ return $path; }
    }

//    public function createSlug($slug)
//    {
//        $slug = Str::slug($slug);
//        $check_slug = News::select('product_url')->where('product_url', 'like', $slug.'%')->get();
//
//        if (count($check_slug)>0){
//            //find slug until find not used.
//            for ($i = 1; $i <= count($check_slug); $i++) {
//                $newSlug = $slug.'-'.$i;
//                if (!$check_slug->contains('product_url', $newSlug)) {
//                    return $newSlug;
//                }
//            }
//        }else{ return $slug; }
//    }
}
