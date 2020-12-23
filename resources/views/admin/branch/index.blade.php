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

		            <h2>Branch List </h2>

		        </div>

		        <div class="pull-right">
				

				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-branch">

					  Create Branch

				</button>

		        </div>
				

		    </div>
			<div class="col-lg-12 margin-tb">
			<form id="search-form" class="form-inline mr-auto">
				<input class="form-control mr-sm-2" type="text" name= "branch" placeholder="Branch" aria-label="Branch">
				<input class="form-control mr-sm-2" type="text" name= "education" placeholder="Education" aria-label="Education">
				<input type="hidden" id="sort_by" name="sort_by" value="branch_id">
				<input type="hidden" id="sort_order" name="sort_order" value="desc">
				<button class="btn btn-outline-success btn-rounded btn-sm my-0" type="button" id="search" >Search</button>
			</form>
			</div>
		</div>


		<table class="table table-bordered">

			<thead>
			
			    <tr>

				<th>Branch <i class="fa fa-caret-up sort" id="branch"></i></th>

				<th>Education <i class="fa fa-caret-up sort" id="education"></th>

				<th width="200px">Action</th>

			    </tr>
				
			</thead>

			<tbody>
			</tbody>

		</table>


		<ul id="pagination" class="pagination-sm"></ul>


	        <!-- Create Education Modal -->

		<div class="modal fade" id="create-branch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Create Branch</h4>

		      </div>


		      <div class="modal-body">
                    <div id="error-msg1"></div>
		      		<form data-toggle="validator" action="{{url('/admin/branch/create')}}" method="POST">


		      			<div class="form-group">

							<label class="control-label" for="branch">Branch</label>

							<input type="text" name="branch" class="form-control" data-error="Please enter branch." required />

							<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

							<label class="control-label" for="education_id">Education </label>

							<select class="form-control" name="education_id" data-error="Please enter education." required>
								@foreach($educations as $education)
								<option value="{{$education->education_id}}">{{$education->education}}</option>
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


		<!-- Edit Branch Modal -->

		<div class="modal fade" id="edit-branch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Edit Branch</h4>

		      </div>


		      <div class="modal-body">
			  <div id="error-msg2"></div>
		      		<form data-toggle="validator" action="{{url('/admin/branch/update')}}" method="put">

		      			<input type="hidden" name="id" class="edit-id">


		      			<div class="form-group">

							<label class="control-label" for="branch">Branch</label>

							<input type="text" name="branch" class="form-control" data-error="Please enter title." required />

							<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

							<label class="control-label" for="education_id">Education</label>

								<select class="form-control" name="education_id">
									@foreach($educations as $education)
									<option value="{{$education->education_id}}">{{$education->education}}</option>
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
var states;

manageData();

/* manage data list */

function manageData() {
	loader();
    $.ajax({

        dataType: 'json',

        url: '/admin/branch/list?'+search,

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

    	url: '/admin/branch/list?'+search,

    	data: {page:page}

	}).done(function(res){
		loader();
		manageRow(res.data.data);

	});

}
/* Add new Education table row */

function manageRow(data) {
	states = data;
    var rows = '';
	$.each( data, function( key, value ) {

	  	rows = rows + '<tr>';

	  	rows = rows + '<td>'+value.branch+'</td>';

	  	rows = rows + '<td>'+value.education+'</td>';

	  	rows = rows + '<td data-id="'+value.branch_id+'">';

        rows = rows + '<a title="edit" href="#" data-target="#edit-branch" data-toggle="modal" class="edit-branch btn btn-primary ack-btn"><i class="fa fa-pencil" aria-hidden="true">&nbsp;</i></a>';

        rows = rows + '<a title="remove" href="#" class="remove-branch btn btn-danger ack-btn"><i class="fa fa-trash " aria-hidden="true">&nbsp;</i></a>';

        rows = rows + '</td>';

	  	rows = rows + '</tr>';

	});


	$("tbody").html(rows);

}


/* Create new Education */
$(document).on("click",".submit-create",function(e){
   loader();
	e.preventDefault();
	
    var form_action = $("#create-branch").find("form").attr("action");

    var branch = $("#create-branch").find("input[name='branch']").val();

	var education_id = $("#create-branch").find("select[name='education_id']").val();

    if(branch != '' && education_id != ''){

        $.ajax({

            dataType: 'json',

            type:'POST',

            url:  form_action,

            data:{ branch:branch, education_id:education_id, _token:CSRF_TOKEN }

        }).done(function(res){
			loader();
			if(res.status == 'true' || res.status == true)
			{				
				$("#create-branch").find("input[name='branch']").val('');

				$("#create-branch").find("input[name='education_id']").val('');
				loaderMessage(res.data);
				getPageData();

				$(".modal").modal('hide');
			}
			else{

				loadError(res.errors,'error-msg1');
			}
        });

    }else{

        alert('You are missing branch or education.')

    }


});

/* Edit Education */

$("body").on("click",".edit-branch",function(){

    var id = $(this).parent("td").data('id');
	$.each( states, function( key, value ) {
		if(value.branch_id == id)
		{
			$("#edit-branch").find("input[name='branch']").val(value.branch);

            $("#edit-branch").find("select[name='education_id']").val(value.education_id);
		}
	});
    $("#edit-branch").find(".edit-id").val(id);


});


/* Updated new Education */

$(".submit-edit").click(function(e){

    loader();
    e.preventDefault();

    var form_action = $("#edit-branch").find("form").attr("action");

    var branch = $("#edit-branch").find("input[name='branch']").val();


    var education_id = $("#edit-branch").find("select[name='education_id']").val();

    var id = $("#edit-branch").find(".edit-id").val();

    if(branch != '' && education_id != ''){

        $.ajax({

            dataType: 'json',

            type:'POST',

            url:  form_action,

            data:{branch:branch, education_id:education_id, id:id, _token :CSRF_TOKEN }

        }).done(function(res){
			loader();
			if(res.status == 'true' || res.status == true)
			{				
				$("#create-branch").find("input[name='branch']").val('');

				$("#create-branch").find("select[name='education_id']").val('');
				loaderMessage(res.data);
				getPageData();

				$(".modal").modal('hide');
			}
			else{

				loadError(res.errors,'error-msg2');
			}

        });

    }else{

        alert('You are missing title or education.')

    }


});

/* Remove Education */

$("body").on("click",".remove-branch",function(){

var branch_id = $(this).parent("td").data('id');

var c_obj = $(this).parents("tr");

$('#confirm-submit').modal('show');

$(document).on("click","#delete-submit",function(){

	$('#confirm-submit').modal('hide');

	$.ajax({

	dataType: 'json',

	type:'GET',

	url:  '/admin/branch/delete?branch_id='+branch_id

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