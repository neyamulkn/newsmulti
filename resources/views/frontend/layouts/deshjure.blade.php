
    <?php   $get_subcategory = App\Models\SubCategory::where('category_id', 14)->get(); ?>
    <form action="{{route('category', ['deshjure'])}}" method="get">
        <div class="row">
            <div class="col-sm-6">
                <select name="subcategory" required onchange="get_district(this.value)" id="subcategory" class="form-control custom-select">
                    <option value="0">{{__('lang.division')}}</option>
                    @foreach($get_subcategory as $subcategory)
                        <option value="{{$subcategory->subcat_slug_en}}">{{$subcategory->subcategory_bd}}</option>
                    @endforeach
                </select>
            </div> 
           
            <div class="col-sm-6">
                <span id="getdistrict">
                    <div class="form-group">
                       <select onchange="get_upzilla(this.value)" name="district" id="district" class="form-control custom-select">
                            <option selected value="0">{{__('lang.zilla')}}</option>'
                        </select>
                    </div>
                </span>
            </div>
            <div class="col-sm-6">
                <span id="getupzilla">
                    <div class="form-group">
                       <select name="upzilla" id="upzilla" class="form-control custom-select">
                            <option selected value="0">{{__('lang.upzilla')}}</option>'
                        </select>
                    </div>
                </span>
            </div>
        
            <div class="col-sm-6">
                <button type="submit" class="btn btn-danger btn-block">অনুসন্ধান
                    করুন
                </button>
            </div>
        </div>
    </form>


    <script type="text/javascript">

    function get_district(id=0){
        var  url = '{{route("deshjure_district", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#getdistrict").html(data);
                    $("#district").focus();
                    document.getElementById('upzilla').innerHTML = "";
                }else{
                    document.getElementById('district').innerHTML = "";
                    document.getElementById('upzilla').innerHTML = "";
                }
            }
        });
    }

    function get_upzilla(id=0){
        var  url = '{{route("deshjure_upzilla", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#getupzilla").html(data);
                     $("#upzilla").focus();
                }else{
                    $("#upzilla").html('');
                }
            }
        });
    }


</script>

