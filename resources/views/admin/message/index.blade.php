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

		            <h2>Message List </h2>

		        </div>

		        <div class="pull-right">
				

				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-message">

					  Create Message

				</button>

		        </div>
				

		    </div>
			<div class="col-lg-12 margin-tb">
			<form id="search-form" class="form-inline mr-auto">
			    <input class="form-control mr-sm-2" type="text" name= "subject" placeholder="Subject" aria-label="Subject">
				<div id="advanced-search" style="display">
					<table class="table table-bordered">
					<tbody>
					<tr>
						<td>Sender</td>
						<td><input class="form-control mr-sm-2" type="text" name= "sender" placeholder="Sender E-mail" aria-label="Sender E-mail"></td>
					</tr>
					<tr>
						<td>Receiver</td>
						<td><input class="form-control mr-sm-2" type="text" name= "receiver" placeholder="Receiver E-mail" aria-label="Receiver E-mail"></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td><input class="form-control mr-sm-2" type="text" name= "phone" placeholder="Sender Phone" aria-label="Sender Phone"></td>
					</tr>
					<tr>
						<td>Status</td>
						<td><input class="form-control mr-sm-2" type="text" name= "status" placeholder="Status" aria-label="Status"></td>
					</tr>
					<tr>
						<td>Message</td>
						<td><input class="form-control mr-sm-2" type="text" name= "message" placeholder="Message" aria-label="Message"></td>
					</tr>
					</tbody>
					</table>
				</div>
				<input type="hidden" id="sort_by" name="sort_by" value="message_id">
				<input type="hidden" id="sort_order" name="sort_order" value="desc">
				<button class="btn btn-outline-success btn-rounded btn-sm my-0" type="button" id="search" >Search</button>
				<button class="btn btn-outline-success btn-sm " type="button" id="adavnced" >Advanced</button>
			</form>
			</div>
		</div>


		<table class="table table-bordered">

			<thead>
			
			    <tr>
				<th>Message <i class="fa fa-caret-up sort" id="subject"></i></th>

				<th>State <i class="fa fa-caret-up sort" id="state_name"></i></th>

				<th>Country <i class="fa fa-caret-up sort" id="user_name"></th>

				<th width="200px">Action</th>

			    </tr>
				
			</thead>

			<tbody>
			</tbody>

		</table>


		<ul id="pagination" class="pagination-sm"></ul>


	        <!-- Create Country Modal -->

		<div class="modal fade" id="create-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Create State</h4>

		      </div>


		      <div class="modal-body">
                    <div id="error-msg1"></div>
		      		<form data-toggle="validator" action="{{url('/admin/message/create')}}" method="POST">


		      			<div class="form-group">

							<label class="control-label" for="subject">Message</label>

							<input type="text" name="subject" class="form-control" data-error="Please enter title." required />

							<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

							<label class="control-label" for="sender_user_id">Sender </label>

							<select class="form-control" name="sender_user_id" data-error="Please enter user." required onchange="stateSelectBox(this, '', '');">
							<option value="" selected>Select</option>
								@foreach($users as $user)
								<option value="{{$user->id}}">{{$user->email}}</option>
								@endforeach
							</select>
							<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

						<label class="control-label" for="receiver_user_id">Receiver </label>

						<select class="form-control" name="receiver_user_id" id="receiver_user_id" data-error="Please enter State." required >
						<option value="" selected>Select</option>
							@foreach($users as $user)
							<option value="{{$user->id}}">{{$user->email}}</option>
							@endforeach
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

		<div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Edit State</h4>

		      </div>


		      <div class="modal-body">
			  <div id="error-msg2"></div>
		      		<form data-toggle="validator" action="{{url('/admin/message/update')}}" method="put">

		      			<input type="hidden" name="id" class="edit-id">


		      			<div class="form-group">

							<label class="control-label" for="subject">Message</label>

							<input type="text" name="subject" class="form-control" data-error="Please enter title." required />

							<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

							<label class="control-label" for="user_id">Sender</label>

								<select class="form-control" name="user_id" onchange="stateSelectBox(this, '', 'edit_state_id');">
									@foreach($users as $user)
									<option value="{{$user->user_id}}">{{$user->user_name}}</option>
									@endforeach
								</select>
							<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

						<label class="control-label" for="receiver_user_id">State </label>

						<select class="form-control" name="receiver_user_id" id="edit_receiver_user_id" data-error="Please enter State." required>
						    @foreach($users as $user)
							<option value="{{$user->user_id}}">{{$user->user_name}}</option>
							@endforeach
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

var cities = [];

manageData();

/* manage data list */

function manageData() {
	loader();
    $.ajax({

        dataType: 'json',

        url: '/admin/message/list?'+search,

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

    	url: '/admin/message/list?'+search,

    	data: {page:page}

	}).done(function(res){
		loader();
		manageRow(res.data.data);

	});

}
/* Add new Country table row */

function manageRow(data) {
	cities = data;
    var rows = '';
	$.each( data, function( key, value ) {

	  	rows = rows + '<tr>';

	  	rows = rows + '<td>'+value.subject+'</td>';

	  	rows = rows + '<td>'+value.state_name+'</td>';

	  	rows = rows + '<td>'+value.user_name+'</td>';

	  	rows = rows + '<td data-id="'+value.message_id+'">';

        rows = rows + '<a title="edit" href="#" data-target="#edit-city" data-toggle="modal" class="edit-city btn btn-primary ack-btn"><i class="fa fa-pencil" aria-hidden="true">&nbsp;</i></a>';

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
	
    var form_action = $("#create-message").find("form").attr("action");

    var subject = $("#create-message").find("input[name='subject']").val();

	var user_id = $("#create-message").find("select[name='user_id']").val();

	var state_id = $("#create-message").find("select[name='state_id']").val();

    if(subject != '' && user_id != ''){

        $.ajax({

            dataType: 'json',

            type:'POST',

            url:  form_action,

            data:{ subject:subject, user_id:user_id, state_id:state_id, _token:CSRF_TOKEN }

        }).done(function(res){
			loader();
			if(res.status == 'true' || res.status == true)
			{				
				$("#create-message").find("input[name='state_name']").val('');

				$("#create-message").find("input[name='user_id']").val('');

				$("#create-message").find("input[name='state_id']").val('');

				loaderMessage(res.data);
				getPageData();

				$(".modal").modal('hide');
			}
			else{

				loadError(res.errors,'error-msg1');
			}
        });

    }else{

        alert('You are missing title or user.')

    }


});

/* Edit Country */

$("body").on("click",".edit-city",function(){

    var id = $(this).parent("td").data('id');
	
	$.each( cities, function( key, value ) {

		if(value.message_id == id)
		{
			$("#edit-city").find("input[name='subject']").val(value.subject);

            $("#edit-city").find("select[name='user_id']").val(value.user_id);

			stateSelectBox(value.user_id, value.state_id, 'edit_state_id');
		}
	});
    $("#edit-city").find(".edit-id").val(id);


});


/* Updated new Country */

$(".submit-edit").click(function(e){

    loader();
    e.preventDefault();

    var form_action = $("#edit-city").find("form").attr("action");

    var subject = $("#edit-city").find("input[name='subject']").val();


    var user_id = $("#edit-city").find("select[name='user_id']").val();

	var state_id = $("#edit-city").find("select[name='state_id']").val();

    var id = $("#edit-city").find(".edit-id").val();

    if(subject != '' && user_id != '' && state_id != ''){

        $.ajax({

            dataType: 'json',

            type:'POST',

            url:  form_action,

            data:{subject:subject, user_id:user_id, state_id:state_id, id:id, _token :CSRF_TOKEN }

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

        alert('You are missing title or user or state.')

    }


});

/* Remove Country */

$("body").on("click",".remove-state",function(){

var user_id = $(this).parent("td").data('id');

var c_obj = $(this).parents("tr");

$('#confirm-submit').modal('show');

$(document).on("click","#delete-submit",function(){

	$('#confirm-submit').modal('hide');

	$.ajax({

	dataType: 'json',

	type:'GET',

	url:  '/admin/message/delete?user_id='+user_id

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