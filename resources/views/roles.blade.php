@extends('layouts.main2')

@section('title','Roles')

@section('user_name','Labeeb')

@section('user_role','Admin')

@section('scripts')
 <link href="{{URL::asset('build/css/groups.min.css')}}" rel="stylesheet">
<!-- Can be used for prompting after deletion inserting and editing(updating) -->
@if(Session::has('success'))
   <script type='text/javascript'>
        // alert('Here');
        $(window).load(function(){
            console.log('Another Here');
            $('myMod').modal('show');
        });
  </script>
@endif

@endsection

@section('content')
 <!-- page content -->

        <div class="right_col" role="main">
          
            <div class="page-title">
              <div class="title_left">
                <h3>Roles Info</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go</button>
                    </span>
                  </div>
                  <br>
                 
                
               
                </div>
              </div>
            </div>
                 


            <div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
  
    <!-- Add Role Modal HTML -->
    <div id="myModal" class="modal fade">
      <div class="modal-dialog modal-md">
        <div class="modal-content">

          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h5><strong> Create Role </strong></h5>
          </div>

          {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}                
              <div class="modal-body">
                <div class="row">
                  <div align="middle" class="col-md-3 col-sm-3 col-lg-3">
                    <h4 class="modal-title">Role Name <h4>
                  </div>
                  <div align="right" class="col-md-3 col-sm-3 col-lg-4">
                    <h4 class="modal-title">Members</h4>
                  </div>
                </div>
                
                <div class="row">
                    <div  class="col-md-5 col-sm-5 col-lg-5">
                      <div class="form-group">                      
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="txt" name="name" class="form-control"></input>
                          <!-- {!! Form::text('name',null,['class' => 'form-control']) !!} -->
                        </div>
                      </div>
                    </div>

                    <div  class="col-md-5 col-sm-6 col-lg-6">
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                          @foreach($users as $user)
                            <input type="checkbox" name="users[]" value="{{$user->id}}"> <label>  {{$user->name}} ({{$user->email}})</label><br />
                          @endforeach
                        
                        </div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="modal-footer">
                  <input type="button" value="Close" class="btn btn-default" data-dismiss="modal">
                  
                  <input type="submit" value="Create Role" class="btn btn-info">
                  <!-- <input type="submit" value="Create Role" class="btn btn-info" data-toggle="modal" data-target="#myMod" data-dismiss="modal"> -->
              </div>
          {!! Form::close() !!}  
        </div>
      </div>
    </div>
    <!-- END Add Role Modal HTML -->
     
    <!-- Delete Modal HTML -->
      
     <div id="deleteModal" class="modal fade">  <div class="modal-dialog" role="document" style="width:500px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure you want to Delete this Role?</strong>
        </div>
        <div class="modal-footer">
          <a href="/roles" type="button" class="btn btn-secondary">Confirm</a>
          <a href="/roles" type="button" class="btn btn-secondary">Close</a>         
        </div>
      </div>
    </div>

    <!-- End Delete Modal HTML -->
      

   <div id="myMod" class="modal fade">  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body">
        <strong>Role Created</strong>
      </div>
      <div class="modal-footer">
        <a href="/roles" type="button" class="btn btn-secondary" >Close</a>
       
      </div>
    </div>
  </div>
</div>




</div>
            <div id="div1" class="">
              
             <div class="row">
              <div class="col-md-8 col-sm-8 col-lg-12">
                <div class="x_panel">

					<table id="myTable" class="table table-bordered table-striped">
					  <thead  >
					      <tr align="center">
                  <td scope="row" ><b>#</b></td>
                  <td id="name"><b>Role Name</b></td>
                  <td><b>Members</b></td>
                  <td><b>Action</b></td>
                </tr>
					  </thead>
					  
					  <tbody>

              @foreach($roles as $role)
  					    <tr align="center">
  					      <td scope="row">{{$role->id}}</td>
  				        <td id="name"> {{$role->name}} </a></td>
                  <td> {{$role->user()->where('role_id',$role->id)->count()}} </td>
                  <td clas>
                  
                    <a href="#editModal" value="{{$role->id}}" value="{{ $role->id }}" class="btn btn btn-primary btn-sm pull-left" data-toggle="modal">Edit</a>
                    
                    {!! Form::open(array('method' => 'DELETE', 'route' => ['roles.destroy',$role->id]),'class' => 'foo') !!}
                      <button type="submit" class="btn btn-danger btn-sm pull-left">Delete</a><!-- <a href="#deleteModal" value="{{ $role->id }}" class="btn btn-primary" data-toggle="modal">Delete Role</a> -->
                    {!! Form::close() !!}  
                  
                  </td>
  					    </tr>
              @endforeach
                
					  </tbody>
					   
					</table> 
						</div>
	            <div class="row">
	              <div class="col-lg-6">
	                <a  href="#myModal" class="btn btn btn-primary" data-toggle="modal">Add Role</a>
	              </div>
	            </div>
	        
	        </div> 
	        </div>
	        </div>           
         

            </div>
          <div class="clearfix"></div>
        </div>





@endsection


