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

		            <h2>User List </h2>

		        </div>

		        <div class="pull-right">
				

				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-user">

					  Create User

				</button>

		        </div>
				

		    </div>
			<div class="col-lg-12 margin-tb">
			<form id="search-form" class="form-inline mr-auto">
				<input class="form-control mr-sm-2" type="text" name= "name" placeholder="Name" aria-label="Name">
				<input class="form-control mr-sm-2" type="text" name= "email" placeholder="E-mail" aria-label="E-mail">
				<input type="hidden" id="sort_by" name="sort_by" value="id">
				<input type="hidden" id="sort_order" name="sort_order" value="desc">
				<button class="btn btn-outline-success btn-rounded btn-sm my-0" type="button" id="search" >Search</button>
			</form>
			</div>
		</div>


		<table class="table table-bordered">

			<thead>
			
			    <tr>

				<th>User <i class="fa fa-caret-up sort" id="name"></i></th>

				<th>E-mail <i class="fa fa-caret-up sort" id="email"></th>

				<th>Phone <i class="fa fa-caret-up sort" id="phone"></th>

				<th>Status</th>

				<th width="200px">Action</th>

			    </tr>
				
			</thead>

			<tbody>
			</tbody>

		</table>


		<ul id="pagination" class="pagination-sm"></ul>


	        <!-- Create User Modal -->

		<div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Create User</h4>

		      </div>


		      <div class="modal-body">
                    <div id="error-msg1"></div>
		      		<form id="create-form" data-toggle="validator" action="{{url('/admin/user/create')}}" method="POST">


		      			<div class="form-group">

							<label class="control-label" for="fname">First Name</label>

							<input type="text" name="fname" class="form-control" data-error="Please enter first name." required />

							<div class="help-block with-errors"></div>

						</div>

		      			<div class="form-group">

						<label class="control-label" for="lname">Last Name</label>

						<input type="text" name="lname" class="form-control" data-error="Please enter last name." required />

						<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="email">E-mail</label>

						<input type="text" name="email" class="form-control" data-error="Please enter email." required />

						<div class="help-block with-errors"></div>

						</div>
						
						<div class="form-group">

						<label class="control-label" for="password">Password</label>

						<input type="password" name="password" class="form-control" data-error="Please enter password." required />

						<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="phone">Phone</label>

						<input type="text" name="phone" class="form-control" data-error="Please enter phone number." required />

						<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="role_id">Role</label>

							<select class="form-control" name="role_id" data-error="Please enter role." required>
								@foreach($roles as $role)
								<option value="{{$role->role_id}}">{{$role->role}}</option>
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

						<label class="control-label" for="phone">E-mail  Notification </label>

						<input type="checkbox" name="notification" value="1" data-error="Please enter phone number." required />

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


		<!-- Edit User Modal -->

		<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Edit User</h4>

		      </div>


		      <div class="modal-body">
			  <div id="error-msg2"></div>
		      		<form id="edit-form" data-toggle="validator" action="{{url('/admin/user/update')}}" method="put">

		      			<input type="hidden" name="id" class="edit-id">


		      			<div class="form-group">

						<label class="control-label" for="fname">First Name</label>

						<input type="text" name="fname" class="form-control" data-error="Please enter first name." required />

						<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="lname">Last Name</label>

						<input type="text" name="lname" class="form-control" data-error="Please enter last name." required />

						<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="email">E-mail</label>

						<input type="text" name="email" class="form-control" data-error="Please enter email." required />

						<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="password">Password</label>

						<input type="password" name="password" class="form-control" data-error="Please enter password." required />

						<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="phone">Phone</label>

						<input type="text" name="phone" class="form-control" data-error="Please enter phone number." required />

						<div class="help-block with-errors"></div>

						</div>
						<div class="form-group">

						<label class="control-label" for="role_id">Role</label>

							<select class="form-control" name="role_id" data-error="Please enter role." required>
								@foreach($roles as $role)
								<option value="{{$role->role_id}}">{{$role->role}}</option>
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

						<label class="control-label" for="notification">E-mail  Notification </label>

						<input type="checkbox" name="notification" value="1" data-error="Please enter phone number." required />

						<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

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
var users;

manageData();

/* manage data list */

function manageData() {
	loader();
    $.ajax({

        dataType: 'json',
        url: '/admin/user/list?'+search,
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
    	url: '/admin/user/list?'+search,
    	data: {page:page}

	}).done(function(res){
		loader();
		manageRow(res.data.data);

	});

}
/* Add new User table row */

function manageRow(data) {
	users = data;
    var rows = '';
	$.each( data, function( key, value ) {

	  	rows = rows + '<tr>';
	  	rows = rows + '<td>'+value.name+'</td>';
	  	rows = rows + '<td>'+value.email+'</td>';
		rows = rows + '<td>'+value.phone+'</td>';
		rows = rows + '<td>'+((value.status == '1') ? 'Active':'In-active')+'</td>'; 
	  	rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<a title="edit" href="#" data-target="#edit-user" data-toggle="modal" class="edit-user btn btn-primary ack-btn"><i class="fa fa-pencil" aria-hidden="true">&nbsp;</i></a>';
        rows = rows + '<a title="remove" href="#" class="remove-user btn btn-danger ack-btn"><i class="fa fa-trash " aria-hidden="true">&nbsp;</i></a>';
        rows = rows + '</td>';
	  	rows = rows + '</tr>';

	});


	$("tbody").html(rows);

}


/* Create new User */
$(document).on("click",".submit-create",function(e){
    loader();
	e.preventDefault();
	
    var form_action = $("#create-user").find("form").attr("action");

	var data = { };
	$.each($('#create-form').serializeArray(), function() {
		data[this.name] = this.value;
	});
	data['_token'] = CSRF_TOKEN;

    if(data.fname != '' && data.lname != '' && data.email != ''){

        $.ajax({

            dataType: 'json',
            type:'POST',
            url:  form_action,
            data:data

        }).done(function(res){
			loader();
			if(res.status == 'true' || res.status == true)
			{
				$('#create-form').trigger("reset");
				loaderMessage(res.data);
				getPageData();

				$(".modal").modal('hide');
			}
			else{

				loadError(res.errors,'error-msg1');
			}
        });

    }else{
		loader();
		loadError('There is some required field are empty.','error-msg1');
    }


});

/* Edit User */

$("body").on("click",".edit-user",function(){

    var id = $(this).parent("td").data('id');
	$.each( users, function( key, value ) {
		if(value.id == id)
		{
			$("#edit-user").find("input[name='fname']").val(value.fname);

			$("#edit-user").find("input[name='lname']").val(value.lname);

			$("#edit-user").find("input[name='email']").val(value.email);

			$("#edit-user").find("input[name='phone']").val(value.phone);

			$("#edit-user").find("select[name='status']").val(value.status);

            $("#edit-user").find("select[name='role_id']").val(value.role_id);
		}
	});
    $("#edit-user").find(".edit-id").val(id);
});


/* Updated new User */

$(".submit-edit").click(function(e){
    loader();
    e.preventDefault();

    var data = {};
	$.each($('#edit-form').serializeArray(), function() {
		data[this.name] = this.value;
	});
	data['_token'] = CSRF_TOKEN;

	data['id'] = $("#edit-user").find(".edit-id").val();

	var form_action = $("#edit-user").find("form").attr("action");

    if(data.fname != '' && data.lname != '' && data.email != ''){

        $.ajax({

            dataType: 'json',
            type : 'POST',
            url : form_action,
            data : data

        }).done(function(res){

			loader();

			if(res.status == 'true' || res.status == true)
			{				
				$('#edit-form').trigger("reset");
				loaderMessage(res.data);
				getPageData();

				$(".modal").modal('hide');
			}
			else{
				loadError(res.errors,'error-msg2');
			}

        });

    }else{
		loader();
		loadError('There is some required field are empty.','error-msg2');
    }
});

/* Remove User */

$("body").on("click",".remove-user",function(){

var id = $(this).parent("td").data('id');

var c_obj = $(this).parents("tr");

$('#confirm-submit').modal('show');

$(document).on("click","#delete-submit",function(){

	$('#confirm-submit').modal('hide');

	$.ajax({

	dataType: 'json',

	type:'GET',

	url:  '/admin/user/delete?id='+id

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