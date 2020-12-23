@extends('layouts.app-user')

@section('content')
    <div class="row justify-content-center">
    <div class="col-lg-3">
 @include('layouts.sidebar');
</div>
<div class="col-lg-7" style="margin-top:20px">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
             <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Account Setting
        </a>
      </h4>

        </div>
        <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
            <form id = "update-account" method="post" action="{{url('/update-account')}}">
    
    <input type="hidden" value="{{csrf_token()}}" name="_token" />
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="name" value="{{$name}}"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">E-mail</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="email" value="{{$email}}" readonly/>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="phone" class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="phone" value="{{$phone}}"/>
            </div>
        </div>

         <div class="form-group row">
            <label for="dob" class="col-sm-3 col-form-label">Date of birth</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="dob" value="{{$dob}}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="description"> Description</label>
            <textarea cols="5" rows="5" class="form-control" name="description"></textarea>
        </div>
        <button type="button" class="btn btn-primary" id="update-acccount-btn">Save</button>
        </form>
        </div>
        </div>
    </div>
    <!--Work information Update !-->
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingFour">
             <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Work and Profession
        </a>
      </h4>

        </div>
        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
            <div class="panel-body">
            <form id = "update-work-detail" method="post" action="{{url('/update-work-detail')}}">
    
        <input type="hidden" value="{{csrf_token()}}" name="_token" />
        <div class="form-group row">
            <label for="job_title" class="col-sm-3 col-form-label">Job Title</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="job_title"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="job_id" class="col-sm-3 col-form-label">Job</label>
            <div class="col-sm-6">
            <select class="form-control" name="job_id">
                @foreach($jobs as $job)
                <option value="{{$job->id}}">{{$job->title}}</option>
                @endforeach
            </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="education_id" class="col-sm-3 col-form-label">Education</label>
            <div class="col-sm-6">
            <select class="form-control" name="education_id">
                @foreach($educations as $education)
                <option value="{{$education->id}}">{{$education->title}}</option>
                @endforeach
            </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="work_detail" class="col-sm-3 col-form-label">Work Detail</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="work_detail"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-sm-3 col-form-label">About Me</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="description"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="service_charge" class="col-sm-3 col-form-label">Charges</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="service_charge"/>
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="update-work-detail-btn">Save</button>
        </form>
            </div>
        </div>
    </div>

     <!--profile Update !-->
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
             <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Profile Setting
        </a>
      </h4>

        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
            <form id = "update-profile" method = "post" action = "{{url('/update-profile')}}">
    
    <input type="hidden" value="{{csrf_token()}}" name="_token" />

      <div class="form-group row">
            <label for="photo" class="col-sm-3 col-form-label">Photo</label>
            <div class="col-sm-6">
            <input type="file" class="form-control" name="photo" value=""/>
            </div>
        </div>
        <div class="form-group row">
            <label for="mobile" class="col-sm-3 col-form-label">Work Mobile</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="mobile" value=""/>
            </div>
        </div>
        <div class="form-group row">
            <label for="landline" class="col-sm-3 col-form-label">LandLine</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="landline" value=""/>
            </div>
        </div>
        <div class="form-group row">
            <label for="country_id" class="col-sm-3 col-form-label">Country</label>
            <div class="col-sm-6">
            <select class="form-control" name="country_id">
                @foreach($countries as $country)
                <option value="{{$country->country_id}}">{{$country->title}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="state_id" class="col-sm-3 col-form-label">State</label>
            <div class="col-sm-6">
            <select class="form-control" name="state_id">
                @foreach($states as $state)
                <option value="{{$state->state_id}}">{{$state->title}}</option>
                @endforeach
            </select>
            </div>
        </div>
         <div class="form-group row">
            <label for="city_id" class="col-sm-3 col-form-label">City</label>
            <div class="col-sm-6">
            <select class="form-control" name="city_id">
                @foreach($cities as $city)
                <option value="{{$city->city_id}}">{{$city->title}}</option>
                @endforeach
            </select>
            </div>
        </div>

         <div class="form-group row">
            <label for="address" class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="address" value=""/>
            </div>
        </div>

        <div class="form-group">
            <label for="description"> Description</label>
            <textarea cols="5" rows="5" class="form-control" name="description"></textarea>
        </div>
        <button type="button" class="btn btn-primary" id="update-profile-btn">>Save</button>
        </form>
            </div>
        </div>
    </div>

        <!--Password Update !-->
        <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
             <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Change Password
        </a>
      </h4>

        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
            <form id = "update-password" method="post" action="{{url('/update-password')}}">
    
    <input type="hidden" value="{{csrf_token()}}" name="_token" />
        <div class="form-group row">
            <label for="old_password" class="col-sm-3 col-form-label">Old Password</label>
            <div class="col-sm-6">
            <input type="password" class="form-control" name="old_password"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-6">
            <input type="password" class="form-control" name="password"/>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="confirm_password" class="col-sm-3 col-form-label">Confirm Password</label>
            <div class="col-sm-6">
            <input type="password" class="form-control" name="confirm_password" />
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="update-password">Save</button>
        </form>
        </div>
        </div>
    </div>
    
    <!--close change Password!-->
</div>

</div>
</div>
<script>
setTimeout(function(){ 

    $(document).ready(function(){

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        $("#update-acccount-btn").click(function(){
            var data  = $('#update-account').serialize();
            data._token = CSRF_TOKEN;
            $.ajax({
                /* the route pointing to the post function */
                url: "{{url('/update-account')}}",
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: data,
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) { 
                    console.log(data);
                    $(".writeinfo").append(data.msg); 
                }
            }); 
        });
    }); 

}, 3000);

</script>
@endsection
