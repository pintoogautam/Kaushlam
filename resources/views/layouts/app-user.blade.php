<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/shop-homepage.css') }}" rel="stylesheet">
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}" defer></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js" defer> </script>

    <!-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <style>
nav {    
  display: block;
  text-align: left;

}
nav ul {
  margin: 0;
  padding:0;
  list-style: none;
}
.nav a {
  display:block; 
  color:  #FFF ; 
  text-decoration: none;
  padding: 0.8em 1.8em;
  /* text-transform: uppercase; */
  font-size: 80%;
  letter-spacing: 2px;
  position: relative;
  width:100%;
  font-weight:600;
}
.nav{  
  vertical-align: top; 
  display: inline-block;
  /* box-shadow: 
    1px -1px -1px 1px #000, 
    -1px 1px -1px 1px #fff, 
    0 0 6px 3px #fff; */
  border-radius:6px;
}
.nav li {
  position: relative;
}
.nav > li { 
  float: left; 
  margin-right: 1px; 
  width:100%;
} 
.nav > li > a { 
  margin-bottom: 1px;
  /* box-shadow: inset 0 2em .33em -0.5em #555;  */
}
.nav > li:hover, 
.nav > li:hover > a { 
  border-bottom-color: yellow;
}
.nav li:hover > a { 
  color:#FFF; 
  background-color:  #04213d  ; 
}
.nav > li:first-child { 
  border-radius: 4px 0 0 4px;
} 
.nav > li:first-child > a { 
  border-radius: 4px 0 0 0;
}
.nav > li:last-child { 
  border-radius: 0 0 4px 0; 
  margin-right: 0;
} 
.nav > li:last-child > a { 
  border-radius: 0 4px 0 0;
}
.nav li li a { 
  display:block; 
  background:  #d6dbdf  ; 
  color:  #566573 ; 
}
.nav li a.active {   
  color:#FFF; 
  background-color:  #04213d ;
  width:100%;
}
.nav li li a.active {   
  color:#FFF; 
  background-color:  #04213d  
}
.nav li a:first-child:nth-last-child(2):before { 
  content: ""; 
  position: absolute; 
  height: 0; 
  width: 0; 
  border: 5px solid transparent; 
  top: 50% ;
  right:5px;  
 }
 .panel-title > a:before {
    float: right !important;
    font-family: FontAwesome;
    content:"\f068";
    padding-right: 5px;
}
.panel-title > a.collapsed:before {
    float: right !important;
    content:"\f067";
}
.panel-title > a:hover, 
.panel-title > a:active, 
.panel-title > a:focus  {
    text-decoration:none;
}
#overlay{
  position:fixed;
  z-index:99999;
  top:0;
  left:0;
  bottom:0;
  right:0;
  background:rgba(0,0,0,0.9);
  transition: 1s 0.4s;
}
#overlay1{
  position:fixed;
  z-index:99999;
  top:0;
  left:0;
  bottom:0;
  right:0;
  background:rgba(0,0,0,0.9);
  transition: 1s 0.4s;
}
#loader{  margin: auto;
  margin-top: 300px;
    width: 200px;
    border: 1px solid #FFF;
    padding: 10px;
    background-color:green;
    color:#fff;
     }
#loader1{  margin: auto;
    top: 20px;
    width: 60%;
    border: 1px solid #FFF;
    padding: 10px;
    background-color:green;
    color:#fff;
    font-weight:700;
     } 

.ack-btn { padding : 2px 3px; margin-left:2px; border-radius:none;line-height: 1.4;
border-radius: .0rem;}   
.left-align
{
  float:right;
  display:block;
}   
.table-bordered td, .table-bordered th {
    padding:.30rem;;
}
.bg-sol{ background:#132e49; }
</style>
<script type="text/javascript">

function loader()
{
  $('#overlay').toggle();
}

function loaderMessage(message)
{
  $('#overlay1').slideDown(function() {
    $('#overlay1').html('').html('<div id="loader1">'+message+'</div>');
    setTimeout(function() {
        $('#overlay1').slideUp();
    }, 2000);
});
}

function loadError(errors, elementID)
{
  var html = '';
  if(errors)
  {
    $.each( errors, function( key, error ) {

      html +='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>';

      html += error;
      
    html += '</div>';
    });
    if(elementID == 'false') {
    $('#error-msg').html('').fadeIn().html(html);
    setTimeout(function() {
        $('#error-msg').fadeOut();
      }, 10000);
    }
    else{
      $('#'+elementID).html('').fadeIn().html(html);
      setTimeout(function() {
        $('#'+elementID).fadeOut();
      }, 10000);
    }
  }    
}


/**
create state select box and set selected value
 
 */

function stateSelectBox(obj, state_value, state_element_id)
{
/* Create new Country */
  var country_id = (typeof obj === 'object')? $(obj).val(): obj;
    if(country_id != ''){

        $.ajax({
            dataType: 'json',
            type:'GET',
            url:  '/state-list-by-country?country_id='+country_id,
        }).done(function(res){

          if(res.status == 'true' || res.status == true){	
                  
            state_element_id = (state_element_id != '') ? state_element_id: 'state_id';
            $('#'+state_element_id).html('');
            $.each(res.data, function(key, value) {
                $('#'+state_element_id).append($("<option></option>")
                    .attr("value",value.state_id)
                    .text(value.state_name)); 
            });
            if(state_value !='')
            {
              $('#'+state_element_id).val(state_value);
            }
          }
        });

    }
}

function citySelectBox(obj, city_value, city_element_id)
{
/* Create new Country */
  var state_id = (typeof obj === 'object')? $(obj).val(): obj;
    if(state_id != ''){

        $.ajax({
            dataType: 'json',
            type:'GET',
            url:  '/city-list-by-state?state_id='+state_id,
        }).done(function(res){

          if(res.status == 'true' || res.status == true){	
                  
            city_element_id = (city_element_id != '') ? city_element_id: 'city_id';
            $('#'+city_element_id).html('');
            $.each(res.data, function(key, value) {
                $('#'+city_element_id).append($("<option></option>")
                    .attr("value",value.city_id)
                    .text(value.city_name)); 
            });
            if(city_value !='')
            {
              $('#'+city_element_id).val(city_value);
            }
          }
        });

    }
}

</script>
  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-sol fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">SolutionTrick</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li> -->
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @else
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li> -->
            <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-user-circle" aria-hidden="true"></i>
           {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a href="{{url('/admin/myprofile')}}" class="dropdown-item">
            <i class="fa fa-id-badge" aria-hidden="true"></i> My Profile</a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container-fluid" style="min-height:480px;padding:0px;">
    @yield('content')
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-sol">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>
<div id="overlay" style="display:none;"><div id="loader"><i class="fa fa-refresh fa-spin" style="font-size:24px"></i> Processing...</div></div>
<div id="overlay1" style="display:none;"></div>

</body>

</html>
