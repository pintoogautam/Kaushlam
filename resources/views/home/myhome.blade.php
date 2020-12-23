@extends('layouts.app-user')

@section('content')
<div class="row">
 <div class="col-lg-3">
 @include('layouts.sidebar');
</div>
<!-- /.col-lg-3 -->
<div class="col-lg-9">

<div class="panel panel-default" style=" margin-top:20px;">
  <div class="panel-heading">
    <div class="panel-title">Account Information  
    
    </div>
    <a href="/update-profile">
    <span class="glyphicon glyphicon-pencil">Edit</span>
    </a>
  </div>
  <div class="panel-body">
  <table class="table" style="width:70%">
<tbody>
<tr>
<td>Name</td>
<td>{{$name}}</td>
</tr>
<tr>
<td>E-mail</td>
<td>{{$email}}</td>
</tr>
<tr>
<td>Phone</td>
<td>{{$phone}}</td>
</tr>
<tr>
<td>Address</td>
<td>{{$address}}</td>
</tr>
</tbody>
</table>
  </div>
</div>

</div>
  <!-- /.row -->

</div>
<!-- /.col-lg-9 -->

</div>
<!-- /.row -->
@endsection