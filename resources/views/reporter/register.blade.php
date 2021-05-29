@extends('frontend.layouts.master')
@section('title', 'Reporter Register  | '.Config::get('siteSetting.site_name'))
@section('css')
    <link href="{{asset('backend/css/pages/login-register-lock.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        @media (min-width: 1200px){
            .container {
                max-width: 1200px !important;
            }
        }
        .dropdown-toggle::after, .dropup .dropdown-toggle::after {
            content: initial !important;
        }
        .card-footer, .card-header {
            margin-bottom: 5px;
            border-bottom: 1px solid #ececec;
        }
        
        .error{color:red;}
        .registerArea{background: #fff; color:#000; border-radius: 5px;margin:10px 0;padding: 10px !important ;}
       
       
    </style>
@endsection
@section('content')
<?PHP
$get_ads = App\Models\Addvertisement::where('page', 'user_profile')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
       if($ads->position == 2){
            $top_head_right = $ads->add_code;
        }elseif($ads->position == 3){
            $topOfNews = $ads->add_code;
        }elseif($ads->position == 4){
            $middleOfNews = $ads->add_code;
        }elseif($ads->position == 5){
            $bottomOfNews = $ads->add_code;
        }elseif($ads->position == 6){
            $sitebarTop = $ads->add_code;
        }elseif($ads->position == 7){
            $sitebarMiddle = $ads->add_code;
        }elseif($ads->position == 8){
            $sitebarBottom = $ads->add_code;
        }else{
            echo '';
        }
}
function banglaDate($date){
    return Carbon\Carbon::parse($date)->format('d F, Y');
}
?>
    <section class="ticker-news category">
        <div class="container">
            <div class="category-title">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="category-title">
                            <span id="head-title">Application For Reporter </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="rightAds">
                            {!! $top_head_right !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section style="background: #f7f7f7;">
    <div class="container">
        
        <div class="row justify-content-md-center" >
           
            <div class="col-md-9 col-12 registerArea" id="sticky-conent" >
                <div class="card">

                   <div class="card-body">
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                          <strong>Success! </strong> {{Session::get('success')}}
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert alert-danger">
                          <strong>Error! </strong> {{Session::get('error')}}
                        </div>
                        @endif
                        <form data-parsley-validate action="{{route('reporterRegister')}}" method="post" >
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label required" for="fname">First Name</label>
                                      <input type="text" required name="fname" value="{{($user_details) ? $user_details->name : old('fname')}}" placeholder="Enter First Name" data-parsley-required-message = "Name is required" id="fname" class="form-control">
                                        @if ($errors->has('fname'))
                                            <span class="error" role="alert">
                                                {{ $errors->first('fname') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label required" for="lname">Last Name</label>
                                      <input type="text" required name="lname" value="{{ ($user_details) ? $user_details->lname : old('lname')}}" placeholder="Enter last name" data-parsley-required-message = "Last name is required" id="lname" class="form-control">
                                        @if ($errors->has('lname'))
                                            <span class="error" role="alert">
                                                {{ $errors->first('lname') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                           
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label required" for="mobile">Mobile Number</label>
                                      <input type="mobile" pattern="/(01)\d{9}/" required name="mobile" value="{{ ($user_details) ? $user_details->mobile : old('mobile')}}" onkeyup ="checkField(this.value, 'mobile')" placeholder="Enter Mobile Number" data-parsley-required-message = "Mobile number is required" class="form-control">
                                      <span id="mobile"></span>
                                        @if ($errors->has('mobile'))
                                            <span class="error" role="alert">
                                                {{ $errors->first('mobile') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label required" for="email">Email Address</label>
                                      <input type="email" name="email" value="{{ ($user_details) ? $user_details->email : old('email')}}" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" placeholder="Enter Email Address" id="email" class="form-control">
                                      @if ($errors->has('email'))
                                            <span class="error" role="alert">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select required name="gender"  id="gender" class="form-control custom-select">
                                            <option value="">Select Gender</option>
                                            <option value="1" {{ ($user_details && $user_details->gender ==1) ? 'selected' : '' }}>Male</option>
                                            <option value="2" {{ ($user_details &&$user_details->gender ==2) ? 'selected' : '' }}>Female</option>
                                            <option value="3" {{ ($user_details &&$user_details->gender ==3) ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Blood Group</label>
                                        <select required name="gender"  id="gender" class="form-control custom-select">
                                            <option value="">Select Blood</option>
                                            <option value="1" {{ ($user_details && $user_details->gender ==1) ? 'selected' : '' }}>Male</option>
                                            <option value="2" {{ ($user_details &&$user_details->gender ==2) ? 'selected' : '' }}>Female</option>
                                            <option value="3" {{ ($user_details &&$user_details->gender ==3) ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                </div>

                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthdate" class="control-label">Date of Birth</label>
                                        <input required name="birthday" value="{{ ($user_details) ? $user_details->birthdate : old('birthday') }}"  id="birthdate" type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profession">Current Profession</label>
                                        <input value="{{ ($user_details && $user_details->userinfo) ? $user_details->userinfo->profession : old('profession')}}" type="text" class="form-control @error('profession') is-invalid @enderror" name="profession" required id="profession" autofocus>

                                        @error('profession')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Fathers">Fathers Name</label>
                                        <input required type="text" value="{{ ($user_details && $user_details->userinfo) ? $user_details->userinfo->father_name :  old('father_name') }}"  name="father_name"  id="Fathers" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Mothers">Mothers Name</label>
                                        <input required type="text"   value="{{  ($user_details && $user_details->userinfo) ? $user_details->userinfo->mother_name : old('mother_name') }}" name="mother_name"  id="Mothers" class="form-control" >
                                    </div>
                                </div>

                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="national_id">NID/Passport/Driving Licence</label>
                                        <input value="{{ ($user_details && $user_details->userinfo) ? $user_details->userinfo->national_id : old('profession')}}" type="text" class="form-control @error('national_id') is-invalid @enderror" name="national_id" required id="national_id" autofocus>

                                        @error('profession')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="dropify_image_area">Upload NID/Passport/Driving Licence</label>
                                       
                                        <input type="file"  name="national_attach" />
                                        
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                            


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="dropify_image_area">Recent Photo</label>
                                        
                                            <input type="file" accept="image/*" @if($user_details && $user_details->photo) data-default-file="{{asset('upload/images/users/thumb_image/'. $user_details->photo)}}" @else required  @endif  name="image"  data-show-remove="false"  id="input-file-disable-remove" class="dropify" />
                                       
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="dropify_image_area">Attach Resume</label>
                                        <div class="">
                                            <input type="file" accept="application/pdf,.doc,.docx" name="national_attach" data-show-remove="false" @if($user_details && $user_details->userinfo) data-default-file="{{asset('upload/attach/'. $user_details->userinfo->national_attach)}}" @else required="" @endif id="input-file-disable-remove" class="dropify" name="resume" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12"><h3>Emergency Contact</h3></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emg_contact_name">Contact Name</label>
                                        <input required type="text"   value="{{  ($user_details && $user_details->userinfo) ? $user_details->userinfo->emg_contact_name : old('emg_contact_name') }}" name="emg_contact_name"  id="emg_contact_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emg_contact_phone">Contact phone</label>
                                        <input required type="text"   value="{{  ($user_details && $user_details->userinfo) ? $user_details->userinfo->emg_contact_phone : old('emg_contact_phone') }}" name="emg_contact_phone"  id="emg_contact_phone" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emg_contact_rel">Contact Relationship</label>
                                        <input required type="text"   value="{{  ($user_details && $user_details->userinfo) ? $user_details->userinfo->emg_contact_rel : old('emg_contact_rel') }}" name="emg_contact_rel"  id="emg_contact_rel" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emg_contact_addres">Contact Address</label>
                                        <input required type="text"   value="{{  ($user_details && $user_details->userinfo) ? $user_details->userinfo->emg_contact_addres : old('emg_contact_addres') }}" name="emg_contact_addres"  id="emg_contact_addres" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h3>Present Address</h3>
                                    <div class="form-group">
                                        <label  for="Present">Present Address</label>
                                        <textarea required name="present_address" id="Present"  class="form-control"  rows="1">{{ ($user_details && $user_details->userinfo) ? $user_details->userinfo->present_address : old('present_address') }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="required">Select Your Zilla</label>
                                    <select name="state" required onchange="getUpazila(this.value, 'PresentUpazila')"  id="state" data-parsley-required-message = "Zilla name is required" class="select2 form-control">
                                        <option value=""> --- Please Select --- </option>
                                        @foreach($states as $state)
                                        <option @if(Session::get('state') == $state->id) selected @endif value="{{$state->id}}"> {{$state->name_en}} </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="required">Upazila</label>
                                    <div class="form-group" id="PresentUpazila">
                                        
                                        <select name="city" required data-parsley-required-message = "City name is required" onchange="get_area(this.value)"  id="city" class="form-control select2">
                                            <option value=""> Select first zilla </option>
                                            
                                        </select>
                                    </div>
                                </div>

                                

                                <div class="col-md-12">
                                    <h3>Permanent Address</h3>
                                    <div class="form-group">
                                        <label  for="Permanent">Permanent  Address</label>
                                        <textarea required="" name="permanent_address" id="Permanent"  class="form-control"  rows="1">{{ ($user_details && $user_details->userinfo) ? $user_details->userinfo->permanent_address :  old('permanent_address') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="required">Select Your Zilla</label>
                                    <select name="state" required onchange="getUpazila(this.value, 'PermanentUpazila')"  id="state" data-parsley-required-message = "Zilla name is required" class="select2 form-control">
                                        <option value=""> --- Please Select --- </option>
                                        @foreach($states as $state)
                                        <option @if(Session::get('state') == $state->id) selected @endif value="{{$state->id}}"> {{$state->name_en}} </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="required">Upazila</label>
                                    <div class="form-group" id="PermanentUpazila">
                                        
                                        <select name="city" required data-parsley-required-message = "City name is required" onchange="get_area(this.value)"  id="city" class="form-control select2">
                                            <option value=""> Select first zilla </option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                     <h3>Working Area</h3>
                                 </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                    <label class="required">Select Your Zilla</label>
                                    <select name="state" required onchange="getUpazila(this.value, 'WorkingUpazila')"  id="state" data-parsley-required-message = "Zilla name is required" class="select2 form-control">
                                        <option value=""> --- Please Select --- </option>
                                        @foreach($states as $state)
                                        <option @if(Session::get('state') == $state->id) selected @endif value="{{$state->id}}"> {{$state->name_en}} </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="required">Upazila</label>
                                    <div class="form-group" id="WorkingUpazila">
                                        
                                        <select name="city" required data-parsley-required-message = "City name is required" onchange="get_area(this.value)"  id="city" class="form-control select2">
                                            <option value=""> Select first zilla </option>
                                            
                                        </select>
                                    </div>
                                </div>
                               
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label required" for="password">Password</label>
                                        <input type="password" value="{{old('password')}}" name="password" placeholder="Password" required id="password" data-parsley-required-message = "Password is required" minlength="6"  class="form-control">
                                        @if ($errors->has('password'))
                                            <span class="error" role="alert">
                                               {{ $errors->first('password') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label required" for="password">Confirm Password</label>
                                       <input type="password" placeholder="Retype password" data-parsley-equalto="#password" required="" value="{{old('password_confirmation')}}" name="password_confirmation" id="password2"  class="form-control">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="error" role="alert">
                                               {{ $errors->first('password_confirmation') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-12">
                                    <div style=" display: flex!important;" class="d-flex no-block align-items-center">
                                        <div style="display: inline-flex;" class="custom-control custom-checkbox">
                                            <input type="checkbox" data-parsley-required-message = "Terms & Conditions  is required" class="custom-control-input" id="agree" required> 
                                            <label style="margin: 0 5px;" class="custom-control-label" for="agree"> I've read and understood <a href="{{url('seller-policy')}}/" style="color: blue">Terms & Conditions </a></label>
                                        </div> 
                                        
                                    </div>
                                </div>
                        
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button id="submitBtn" class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="form-group m-t-20">
                    <div class="col-sm-12 text-center">
                        Already have an account?  <a href="{{route('reporterLogin')}}" class="text-info m-l-5"><b>Sign In</b></a>
                    </div>
                </div>  
                <div class="col-md-3 col-12"></div>     
            </div>

            <div class="col-sm-3 div_border" id="sticky-conent">
                    <div class="sidebar large-sidebar">
                        <div class="widget features-slide-widget">
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $sitebarTop !!}
                                </div>
                                
                            </div>
                        </div>
                        <!-- sidebar -->
                         @include('frontend.layouts.sitebar')

                        <div class="widget features-slide-widget">
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $sitebarBottom !!}
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </section>
@endsection

@section('js')
    <script src="{{asset('backend/assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>

    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
    });
    </script>
    <script type="text/javascript">
       
        function getUpazila(id, field){
         
            var  url = '{{route("get_upazila", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#"+field).html(data);
                        $(".select2").select2();
                        $("#"+field).focus();
                    }else{
                        $("#"+field).html('<option>Upazila not found.</option>');
                    }
                }
            });
        }    

    </script>

    <script type="text/javascript">
        function checkField(value, field){
            if(value != ""){
                $.ajax({
                    method:'get',
                    url:"{{ route('checkField') }}",
                    data:{table:'vendors', field:field, value:value},
                    success:function(data){
                        
                        if(data.status){
                            $('#'+field).html("<span style='color:green'><i class='fa fa-check'></i> "+data.msg+"</span>");
                            
                            $('#submitBtn').removeAttr('disabled');
                            $('#submitBtn').removeAttr('style', 'cursor:not-allowed');
                            
                        }else{
                            $('#'+field).html("<span style='color:red'><i class='fa fa-times'></i> "+data.msg+"</span>");
                            
                            $('#submitBtn').attr('disabled', 'disabled');
                            $('#submitBtn').attr('style', 'cursor:not-allowed');
                            
                        }
                    },
                    error: function(jqXHR, exception) {
                        toastr.error('Unexpected error occur.');
                    }
                });
            }else{
                $('#'+field).html("<span style='color:red'>"+field +" is required</span>");
                
                $('#submitBtn').attr('disabled', 'disabled');
                $('#submitBtn').attr('style', 'cursor:not-allowed');
                
            }
        }
   
    $(".select2").select2();

    </script>
@endsection


