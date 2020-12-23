@extends('layouts.app-user')

@section('content')
    <div class="row justify-content-center">
    <div class="col-xs-6 col-md-3 bg-sol">
 @include('layouts.sidebar');
</div>
<div class="col-xs-12 col-sm-6 col-md-9" style="margin-top:20px">

		<div class="row">

		    <div class="col-lg-12 margin-tb">	
							

		        <div class="pull-left">

		            <h2>Zipcode List </h2>

		        </div>

		        <div class="pull-right">
				

				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-zipcode">

					  Create Zipcode

				</button>

		        </div>
				

		    </div>
			<div class="col-lg-12 margin-tb">
			<form id="search-form" class="form-inline mr-auto">
               <input class="form-control mr-sm-2" type="text" name= "zipcode" placeholder="Zipcode" aria-label="Zipcode">

			    <input class="form-control mr-sm-2" type="text" name= "city_name" placeholder="City" aria-label="City">
				<input class="form-control mr-sm-2" type="text" name= "state_name" placeholder="State" aria-label="State">
				<input type="hidden" id="sort_by" name="sort_by" value="zipcode_id">
				<input type="hidden" id="sort_order" name="sort_order" value="desc">
				<button class="btn btn-outline-success btn-rounded btn-sm my-0" type="button" id="search" >Search</button>
			</form>
			</div>
		</div>


		<table class="table table-bordered">

			<thead>
			
			    <tr>

				<th>Zipcode <i class="fa fa-caret-up sort" id="zipcode"></th>

				<th>City <i class="fa fa-caret-up sort" id="city_name"></i></th>

				<th>State <i class="fa fa-caret-up sort" id="state_name"></i></th>

				<th>Country <i class="fa fa-caret-up sort" id="country_name"></th>

				<th width="200px">Action</th>

			    </tr>
				
			</thead>

			<tbody>
			</tbody>

		</table>


		<ul id="pagination" class="pagination-sm"></ul>


	        <!-- Create Country Modal -->

		<div class="modal fade" id="create-zipcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Create Zipcode</h4>

		      </div>


		      <div class="modal-body">
                    <div id="error-msg1"></div>
		      		<form data-toggle="validator" action="{{url('/admin/zipcode/create')}}" method="POST">


		      			<div class="form-group">

							<label class="control-label" for="zipcode">Zipcode </label>

							<input type="text" name="zipcode" class="form-control" data-error="Please enter zipcode." required />

							<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

							<label class="control-label" for="country_id">Country </label>

							<select class="form-control" name="country_id" data-error="Please enter country." required onchange="stateSelectBox(this, '', '');">
							<option value="" selected>Select</option>
								@foreach($countries as $country)
								<option value="{{$country->country_id}}">{{$country->country_name}}</option>
								@endforeach
							</select>
							<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="state_id">State </label>

						<select class="form-control" name="state_id" id="state_id" data-error="Please enter State." required onchange="citySelectBox(this, '', '');">
						<option value="" selected>Select</option>
							@foreach($states as $state)
							<option value="{{$state->state_id}}">{{$state->state_name}}</option>
							@endforeach
						</select>
						<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="city_id">City </label>

						<select class="form-control" name="city_id" id="city_id" data-error="Please enter State." required >
						<option value="" selected>Select</option>
							@foreach($cities as $city)
							<option value="{{$city->city_id}}">{{$city->city_name}}</option>
							@endforeach
						</select>
						<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="status">Status</label>
						<select class="form-control" name="status" data-error="Please enter status." required>
							<option value="1">Active</option>
							<option value="0">InActive</option>	
						</select>
						<div class="help-block with-errors"></div>

						</div>
						<div class="form-group">

							<button type="submit" class="btn submit-create btn-success">Submit</button>

						</div>


		      		</form>


		      </div>

		    </div>


		  </div>

		</div>


		<!-- Edit State Modal -->

		<div class="modal fade" id="edit-zipcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Edit State</h4>

		      </div>


		      <div class="modal-body">
			  <div id="error-msg2"></div>
		      		<form data-toggle="validator" action="{{url('/admin/zipcode/update')}}" method="put">

		      			<input type="hidden" name="id" class="edit-id">


		      			<div class="form-group">

							<label class="control-label" for="zipcode">Zipcode</label>

							<input type="text" name="zipcode" class="form-control" data-error="Please enter zipcode." required />

							<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

							<label class="control-label" for="country_id">Country</label>

								<select class="form-control" name="country_id" onchange="stateSelectBox(this, '', 'edit_state_id');">
									@foreach($countries as $country)
									<option value="{{$country->country_id}}">{{$country->country_name}}</option>
									@endforeach
								</select>
							<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

						<label class="control-label" for="state_id">State </label>

						<select class="form-control" name="state_id" id="edit_state_id" data-error="Please enter State." required onchange="citySelectBox(this, '', 'edit_city_id');">
							@foreach($states as $state)
							<option value="{{$state->state_id}}">{{$state->state_name}}</option>
							@endforeach
						</select>
						<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="city_id">City </label>

						<select class="form-control" name="city_id" id="edit_city_id" data-error="Please enter City." required>
							@foreach($cities as $city)
							<option value="{{$city->city_id}}">{{$city->city_name}}</option>
							@endforeach
						</select>
						<div class="help-block with-errors"></div>

						</div>

					    <div class="form-group">

						<label class="control-label" for="status">Status</label>
						<select class="form-control" name="status" data-error="Please enter status." required>
							<option value="1">Active</option>
							<option value="0">InActive</option>	
						</select>
						<div class="help-block with-errors"></div>

						</div>

						<div class="form-groups">

							<button type="submit" class="btn btn-success submit-edit">Submit</button>

						</div>


		      		</form>


		      </div>

		    </div>

		  </div>

		</div>
		</div>
		</div>
		<!--Delete Confiirm mode box!-->
	<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to delete the following detail?
                <!-- We display the details entered by the user here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="delete-submit" class="btn btn-success success">Confirm</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
setTimeout(function(){

$( document ).ready(function(e) {

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

var page = 1;

var current_page = 1;

var total_page = 0;

var is_ajax_fire = 0;

var sort_by = 'id'

var sort_order = 'desc';

var search = '';

var zipcodes = [];

manageData();

/* manage data list */

function manageData() {
	loader();
    $.ajax({

        dataType: 'json',

        url: '/admin/zipcode/list?'+search,

        data: {page:page}

    }).done(function(res){

    	total_page = res.data.last_page;

    	current_page = res.data.current_page;

    	$('#pagination').twbsPagination({

	        totalPages: total_page,

	        visiblePages: 5,

	        onPageClick: function (event, pageL) {

	        	page = pageL;

                if(is_ajax_fire != 0){

	        	  getPageData();

                }

	        }

	    });


    	manageRow(res.data.data);

        is_ajax_fire = 1;

    loader();
    });


}
/* Get Page Data*/

function getPageData() {
	loader();
	$.ajax({

    	dataType: 'json',

    	url: '/admin/zipcode/list?'+search,

    	data: {page:page}

	}).done(function(res){
		loader();
		manageRow(res.data.data);

	});

}
/* Add new Country table row */

function manageRow(data) {
	zipcodes = data;
    var rows = '';
	$.each( data, function( key, value ) {

	  	rows = rows + '<tr>';

	  	rows = rows + '<td>'+value.zipcode+'</td>';

		  rows = rows + '<td>'+value.city_name+'</td>';

	  	rows = rows + '<td>'+value.state_name+'</td>';

	  	rows = rows + '<td>'+value.country_name+'</td>';

	  	rows = rows + '<td data-id="'+value.zipcode_id+'">';

        rows = rows + '<a title="edit" href="#" data-target="#edit-zipcode" data-toggle="modal" class="edit-zipcode btn btn-primary ack-btn"><i class="fa fa-pencil" aria-hidden="true">&nbsp;</i></a>';

        rows = rows + '<a title="remove" href="#" class="remove-state btn btn-danger ack-btn"><i class="fa fa-trash " aria-hidden="true">&nbsp;</i></a>';

        rows = rows + '</td>';

	  	rows = rows + '</tr>';

	});


	$("tbody").html(rows);

}


/* Create new Country */
$(document).on("click",".submit-create",function(e){
   loader();
	e.preventDefault();
	
    var form_action = $("#create-zipcode").find("form").attr("action");

    var zipcode = $("#create-zipcode").find("input[name='zipcode']").val();

	var country_id = $("#create-zipcode").find("select[name='country_id']").val();

	var state_id = $("#create-zipcode").find("select[name='state_id']").val();

	var city_id = $("#create-zipcode").find("select[name='city_id']").val();

    if(zipcode != '' && city_id != ''){

        $.ajax({

            dataType: 'json',

            type:'POST',

            url:  form_action,

            data:{ zipcode:zipcode, city_id:city_id, country_id:country_id, state_id:state_id, _token:CSRF_TOKEN }

        }).done(function(res){
			loader();
			if(res.status == 'true' || res.status == true)
			{				
				$("#create-zipcode").find("input[name='zipcode']").val('');

				$("#create-zipcode").find("input[name='country_id']").val('');

				$("#create-zipcode").find("input[name='state_id']").val('');

				$("#create-zipcode").find("input[name='city_id']").val('');

				loaderMessage(res.data);
				getPageData();

				$(".modal").modal('hide');
			}
			else{

				loadError(res.errors,'error-msg1');
			}
        });

    }else{

        alert('You are missing title or country.')

    }


});

/* Edit Country */

$("body").on("click",".edit-zipcode",function(){

    var id = $(this).parent("td").data('id');
	
	$.each( zipcodes, function( key, value ) {

		if(value.zipcode_id == id)
		{
			$("#edit-zipcode").find("input[name='zipcode']").val(value.zipcode);

            $("#edit-zipcode").find("select[name='country_id']").val(value.country_id);

			stateSelectBox(value.country_id, value.state_id, 'edit_state_id');

			citySelectBox(value.state_id, value.city_id, 'edit_city_id');
		}
	});
    $("#edit-zipcode").find(".edit-id").val(id);


});


/* Updated new Country */

$(".submit-edit").click(function(e){

    loader();
    e.preventDefault();

    var form_action = $("#edit-zipcode").find("form").attr("action");

    var zipcode = $("#edit-zipcode").find("input[name='zipcode']").val();


    var country_id = $("#edit-zipcode").find("select[name='country_id']").val();

	var state_id = $("#edit-zipcode").find("select[name='state_id']").val();

	var city_id = $("#edit-zipcode").find("select[name='city_id']").val();

    var id = $("#edit-zipcode").find(".edit-id").val();

    if(zipcode != '' && country_id != '' && state_id != ''){

        $.ajax({

            dataType: 'json',

            type:'POST',

            url:  form_action,

            data:{zipcode:zipcode, city_id:city_id, country_id:country_id, state_id:state_id, id:id, _token :CSRF_TOKEN }

        }).done(function(res){
			loader();
			if(res.status == 'true' || res.status == true)
			{				
				loaderMessage(res.data);
				getPageData();

				$(".modal").modal('hide');
			}
			else{

				loadError(res.errors,'error-msg2');
			}

        });

    }else{

        alert('You are missing title or country or state.')

    }


});

/* Remove Country */

$("body").on("click",".remove-state",function(){

var country_id = $(this).parent("td").data('id');

var c_obj = $(this).parents("tr");

$('#confirm-submit').modal('show');

$(document).on("click","#delete-submit",function(){

	$('#confirm-submit').modal('hide');

	$.ajax({

	dataType: 'json',

	type:'GET',

	url:  '/admin/zipcode/delete?country_id='+country_id

	}).done(function(data){

	c_obj.remove();

	getPageData();

	});
})

});


/**Search form with query  */
$(document).on("click","#search",function(e){
	search = $("#search-form").serialize();
	manageData();
});

/**sort form with query  */
$(document).on("click",".sort",function(e){
	var currentClass;
	if ($(this).hasClass("fa-caret-up")) {

		$(".sort").hasClass("fa-caret-up");
        $(this).removeClass('fa-caret-up').addClass("fa-caret-down");
		$('#sort_by').val($(this).attr('id'));
		$('#sort_order').val('DESC');

	} else {

		$(".sort").hasClass("fa-caret-up");
        $(this).removeClass('fa-caret-down').addClass("fa-caret-up");
		$('#sort_by').val($(this).attr('id'));
		$('#sort_order').val('ASC');
	}
	$("#search").click();
});
/**function closes */

});
}, 1000);
</script>

@endsection