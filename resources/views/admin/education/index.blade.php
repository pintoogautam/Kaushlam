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

		            <h2>Education List </h2>

		        </div>

		        <div class="pull-right">
				

				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-education">

					  Create Education

				</button>

		        </div>
				

		    </div>
			<div class="col-lg-12 margin-tb">
			<form id="search-form" class="form-inline mr-auto">
				<input class="form-control mr-sm-2" type="text" name= "title" placeholder="Education" aria-label="Education">
				<input class="form-control mr-sm-2" type="text" name= "display_order" placeholder="Display Order" aria-label="Display Order">
				<input type="hidden" id="sort_by" name="sort_by" value="education_id">
				<input type="hidden" id="sort_order" name="sort_order" value="desc">
				<button class="btn btn-outline-success btn-rounded btn-sm my-0" type="button" id="search" >Search</button>
			</form>
			</div>
		</div>


		<table class="table table-bordered">

			<thead>
			
			    <tr>

				<th>Title <i class="fa fa-caret-up sort" id="title"></i></th>

				<th>Display Order <i class="fa fa-caret-up sort" id="display_order"></th>

				<th width="200px">Action</th>

			    </tr>
				
			</thead>

			<tbody>
			</tbody>

		</table>


		<ul id="pagination" class="pagination-sm"></ul>


	        <!-- Create Education Modal -->

		<div class="modal fade" id="create-education" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Create Education</h4>

		      </div>


		      <div class="modal-body">
                    <div id="error-msg1"></div>
		      		<form data-toggle="validator" action="{{url('/admin/education/create')}}" method="POST">


		      			<div class="form-group">

							<label class="control-label" for="education">Education</label>

							<input type="text" name="education" class="form-control" data-error="Please enter education." required />

							<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

							<label class="control-label" for="display_order">Display Order </label>

							<input type="text" name="display_order" class="form-control" data-error="Please enter display_order." required>

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


		<!-- Edit Education Modal -->

		<div class="modal fade" id="edit-country" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Edit Education</h4>

		      </div>


		      <div class="modal-body">
			  <div id="error-msg2"></div>
		      		<form data-toggle="validator" action="{{url('/admin/education/update')}}" method="put">

		      			<input type="hidden" name="id" class="edit-id">


		      			<div class="form-group">

							<label class="control-label" for="education">Education</label>

							<input type="text" name="education" class="form-control" data-error="Please enter education." required />

							<div class="help-block with-errors"></div>

						</div>


						<div class="form-group">

							<label class="control-label" for="display_order">Display Order</label>

							<input type="text" name="display_order" class="form-control" data-error="Please enter display_order." required>

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

manageData();

/* manage data list */

function manageData() {
	loader();
    $.ajax({

        dataType: 'json',

        url: '/admin/education/list?'+search,

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

    	url: '/admin/education/list?'+search,

    	data: {page:page}

	}).done(function(res){
		loader();
		manageRow(res.data.data);

	});

}
/* Add new Education table row */

function manageRow(data) {
    var rows = '';
	$.each( data, function( key, value ) {

	  	rows = rows + '<tr>';

	  	rows = rows + '<td>'+value.education+'</td>';

	  	rows = rows + '<td>'+value.display_order+'</td>';

	  	rows = rows + '<td data-id="'+value.education_id+'">';

        rows = rows + '<a title="edit" href="#" data-target="#edit-country" data-toggle="modal" class="edit-country btn btn-primary ack-btn"><i class="fa fa-pencil" aria-hidden="true">&nbsp;</i></a>';

        rows = rows + '<a title="remove" href="#" class="remove-education btn btn-danger ack-btn"><i class="fa fa-trash " aria-hidden="true">&nbsp;</i></a>';

        rows = rows + '</td>';

	  	rows = rows + '</tr>';

	});


	$("tbody").html(rows);

}


/* Create new Education */
$(document).on("click",".submit-create",function(e){
   loader();
	e.preventDefault();
	
    var form_action = $("#create-education").find("form").attr("action");

    var education = $("#create-education").find("input[name='education']").val();

	var display_order = $("#create-education").find("input[name='display_order']").val();
	
    if(education != '' && display_order != ''){

        $.ajax({

            dataType: 'json',

            type:'POST',

            url:  form_action,

            data:{ education:education, display_order:display_order, _token:CSRF_TOKEN }

        }).done(function(res){
			loader();
			if(res.status == 'true' || res.status == true)
			{				
				$("#create-education").find("input[name='education']").val('');

				$("#create-education").find("input[name='display_order']").val('');
				loaderMessage(res.data);
				getPageData();

				$(".modal").modal('hide');
			}
			else{

				loadError(res.errors,'error-msg1');
			}
        });

    }else{

        alert('You are missing title or description.')

    }


});

/* Edit Education */

$("body").on("click",".edit-country",function(){


    var id = $(this).parent("td").data('id');

    var education = $(this).parent("td").prev("td").prev("td").text();

    var display_order = $(this).parent("td").prev("td").text();


    $("#edit-country").find("input[name='education']").val(education);

    $("#edit-country").find("input[name='display_order']").val(display_order);

    $("#edit-country").find(".edit-id").val(id);


});


/* Updated new Education */

$(".submit-edit").click(function(e){

    loader();
    e.preventDefault();

    var form_action = $("#edit-country").find("form").attr("action");

    var education = $("#edit-country").find("input[name='education']").val();


    var display_order = $("#edit-country").find("input[name='display_order']").val();

    var id = $("#edit-country").find(".edit-id").val();

    if(education != '' && display_order != ''){

        $.ajax({

            dataType: 'json',

            type:'POST',

            url:  form_action,

            data:{education:education, display_order:display_order, id:id, _token :CSRF_TOKEN }

        }).done(function(res){
			loader();
			if(res.status == 'true' || res.status == true)
			{				
				$("#create-education").find("input[name='education']").val('');

				$("#create-education").find("input[name='display_order']").val('');
				loaderMessage(res.data);
				getPageData();

				$(".modal").modal('hide');
			}
			else{

				loadError(res.errors,'error-msg2');
			}

        });

    }else{

        alert('You are missing title or description.')

    }


});

/* Remove Education */

$("body").on("click",".remove-education",function(){

var education_id = $(this).parent("td").data('id');

var c_obj = $(this).parents("tr");

$('#confirm-submit').modal('show');

$(document).on("click","#delete-submit",function(){

	$('#confirm-submit').modal('hide');

	$.ajax({

	dataType: 'json',

	type:'GET',

	url:  '/admin/education/delete?education_id='+education_id

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