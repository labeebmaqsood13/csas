@extends('layouts.main2')

@section('title','Activity Dashboard')

@section('user_name')
	{{Auth::user()->name}}
@endsection

@section('user_role')
	{{Auth::user()->role()->first()->name}}
@endsection

@section('scripts')

<style type="text/css">

	
.panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
	border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
	margin-bottom: -1px;
}
/********************************************************************/
/*** PANEL DEFAULT ***/
.with-nav-tabs.panel-default .nav-tabs > li > a,
.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
    color: #777;
}
.with-nav-tabs.panel-default .nav-tabs > .open > a,
.with-nav-tabs.panel-default .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-default .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
    color: #777;
	background-color: #ddd;
	border-color: transparent;
}
.with-nav-tabs.panel-default .nav-tabs > li.active > a,
.with-nav-tabs.panel-default .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.active > a:focus {
	color: #555;
	background-color: #fff;
	border-color: #ddd;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #f5f5f5;
    border-color: #ddd;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #777;   
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #ddd;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #555;
}
</style>

@endsection

@section('content')

<div class="right_col" role="main">
    <div class="container container-fluid">

	    <div class="page-title">
	      	<div class="title_left">
	        	<h3>Manage Permissions</h3><br>
	        </div>
        </div>
        <div class="clearfix"></div>
               
        <div class="col-lg-10">      

            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">            

                        @if(Auth::user()->role()->first()->name == 'Analyst')
                        <li class="active"><a href="#clientrepresentative" data-toggle="tab">Client Representative</a></li>
                        @endif


                        @if(Auth::user()->role()->first()->name == 'Manager')
                        <li class="active"><a href="#analyst" data-toggle="tab" >Analyst</a></li>
                        <li><a href="#clientrepresentative" data-toggle="tab">Client Representative</a></li>
                        @endif

                        @if(Auth::user()->role()->first()->name == 'Super Manager')
                        <li class="active"><a href="#manager" data-toggle="tab">Manager</a></li>
                        <li><a href="#analyst" data-toggle="tab">Analyst</a></li>
                        <li><a href="#clientrepresentative" data-toggle="tab">Client Representative</a></li>                        
                    	@endif

                    </ul>
                </div>

                <div class="panel-body">
                    <div class="tab-content">


					@if(Auth::user()->role()->first()->name == 'Analyst')

                        <div class="tab-pane fade in active" id="clientrepresentative">
							<form role="form" id="myform" action="change_permissions" method="POST">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
<!-- 					            <div class="checkbox" style="margin-top: 5px;">
					              <h4 class="lead" style="margin-top: 0px; margin-left: 7px;">Select checkboxes to change Manager's Permission </h4>
					            </div>  
 -->
					            @foreach($permissions as $permission)
					            <div class="checkbox" style="margin-left: 10px;">
					              <label class="checkbox-inline" onfocus="">
									@if(in_array($permission->name, $clientrepresentatives))

					                	<input type="checkbox" name="clientrepresentatives[]" value="{{$permission->name}}" id="ip" checked="checked"> {{$permission->name}}
					               
					                @else
					                	<input type="checkbox" name="clientrepresentatives[]" value="{{$permission->name}}" id="ip"> {{$permission->name}}
					                @endif	
					              </label>
					            </div>
					            @endforeach
					            <br>
					           <input type="submit" value="Submit" name="clientrepresentative" class="btn btn-default pull-right">
					        </form>	                        	
                        </div>

					@endif


					@if(Auth::user()->role()->first()->name == 'Manager')

                        <div class="tab-pane fade in active" id="analyst">
							<form role="form" id="myform" action="change_permissions" method="POST">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
<!-- 					            <div class="checkbox" style="margin-top: 5px;">
					              <h4 class="lead" style="margin-top: 0px; margin-left: 7px;">Select checkboxes to change Manager's Permission </h4>
					            </div>  
 -->
					            @foreach($permissions as $permission)
					            <div class="checkbox" style="margin-left: 10px;">
					              <label class="checkbox-inline" onfocus="">

									@if(in_array($permission->name, $analysts))

					                	<input type="checkbox" name="analysts[]" value="{{$permission->name}}" id="ip" checked="checked"> {{$permission->name}}
					               
					                @else
					                	<input type="checkbox" name="analysts[]" value="{{$permission->name}}" id="ip"> {{$permission->name}}
					                @endif	


					              </label>
					            </div>
					            @endforeach
					            <br>
					           <input type="submit" value="Submit" name="analyst" class="btn btn-default pull-right">
					        </form>	                        	
                        </div>



                        <div class="tab-pane fade" id="clientrepresentative">
							<form role="form" id="myform" action="change_permissions" method="POST">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
<!-- 					            <div class="checkbox" style="margin-top: 5px;">
					              <h4 class="lead" style="margin-top: 0px; margin-left: 7px;">Select checkboxes to change Manager's Permission </h4>
					            </div>  
 -->
					            @foreach($permissions as $permission)
					            <div class="checkbox" style="margin-left: 10px;">
					              <label class="checkbox-inline" onfocus="">
									@if(in_array($permission->name, $clientrepresentatives))

					                	<input type="checkbox" name="clientrepresentatives[]" value="{{$permission->name}}" id="ip" checked="checked"> {{$permission->name}}
					               
					                @else
					                	<input type="checkbox" name="clientrepresentatives[]" value="{{$permission->name}}" id="ip"> {{$permission->name}}
					                @endif	
					              </label>
					            </div>
					            @endforeach
					            <br>
					           <input type="submit" value="Submit" name="clientrepresentative" class="btn btn-default pull-right">
					        </form>	                        	
                        </div>


                    @endif    




                        

 					@if(Auth::user()->role()->first()->name == 'Super Manager')
                        <div class="tab-pane fade in active" id="manager">
							<form role="form" id="myform" action="change_permissions" method="POST">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
<!-- 					            <div class="checkbox" style="margin-top: 5px;">
					              <h4 class="lead" style="margin-top: 0px; margin-left: 7px;">Select checkboxes to change Manager's Permission </h4>
					            </div>  
 -->
					            @foreach($permissions as $permission)
					            <div class="checkbox" style="margin-left: 10px;">
					              <label class="checkbox-inline" onfocus="">
									@if(in_array($permission->name, $managers))

					                	<input type="checkbox" name="managers[]" value="{{$permission->name}}" id="ip" checked="checked"> {{$permission->name}}
					               
					                @else
					                	<input type="checkbox" name="managers[]" value="{{$permission->name}}" id="ip"> {{$permission->name}}
					                @endif	
					              </label>
					            </div>
					            @endforeach
					            <br>
					           <input type="submit" value="Submit" name="manager" class="btn btn-default pull-right">
					        </form>	
                        </div>




                       


                        <div class="tab-pane fade" id="analyst">
							<form role="form" id="myform" action="change_permissions" method="POST">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
<!-- 					            <div class="checkbox" style="margin-top: 5px;">
					              <h4 class="lead" style="margin-top: 0px; margin-left: 7px;">Select checkboxes to change Manager's Permission </h4>
					            </div>  
 -->
					            @foreach($permissions as $permission)
					            <div class="checkbox" style="margin-left: 10px;">
					              <label class="checkbox-inline" onfocus="">

									@if(in_array($permission->name, $analysts))

					                	<input type="checkbox" name="analysts[]" value="{{$permission->name}}" id="ip" checked="checked"> {{$permission->name}}
					               
					                @else
					                	<input type="checkbox" name="analysts[]" value="{{$permission->name}}" id="ip"> {{$permission->name}}
					                @endif	


					              </label>
					            </div>
					            @endforeach
					            <br>
					           <input type="submit" value="Submit" name="analyst" class="btn btn-default pull-right">
					        </form>	                        	
                        </div>



                        <div class="tab-pane fade" id="clientrepresentative">
							<form role="form" id="myform" action="change_permissions" method="POST">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
<!-- 					            <div class="checkbox" style="margin-top: 5px;">
					              <h4 class="lead" style="margin-top: 0px; margin-left: 7px;">Select checkboxes to change Manager's Permission </h4>
					            </div>  
 -->
					            @foreach($permissions as $permission)
					            <div class="checkbox" style="margin-left: 10px;">
					              <label class="checkbox-inline" onfocus="">
									@if(in_array($permission->name, $clientrepresentatives))

					                	<input type="checkbox" name="clientrepresentatives[]" value="{{$permission->name}}" id="ip" checked="checked"> {{$permission->name}}
					               
					                @else
					                	<input type="checkbox" name="clientrepresentatives[]" value="{{$permission->name}}" id="ip"> {{$permission->name}}
					                @endif	
					              </label>
					            </div>
					            @endforeach
					            <br>
					           <input type="submit" value="Submit" name="clientrepresentative" class="btn btn-default pull-right">
					        </form>	                        	
                        </div>


                    @endif    



                    </div>
                </div>
            </div>	

        </div>
    </div>
</div>

@endsection


