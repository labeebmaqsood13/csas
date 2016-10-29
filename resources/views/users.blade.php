@extends('layouts.main2')

@section('title','Activity Dashboard')

@section('user_name')
	{{ Auth::user()->name }}
@endsection

@section('user_role','Admin')

@section('scripts')


<!-- Sweet alerts -->
<!-- <link rel="stylesheet" type="text/css" href="{{URL::asset('sweet_alerts/dist/sweetalert.css')}}"> -->
<!-- @if(Session::has('success')) -->
<!-- <script type="text/javascript"> -->
	<!-- $(document).ready(function(){ -->
		<!-- sweetAlert("Oops...", "Something went wrong!", "error"); -->
	<!-- }; -->
<!-- </script>	 -->
<!-- <script src="{{URL::asset('sweet_alerts/dist/sweetalert.min.js')}}"></script> -->
<!-- @endif -->

    <link href="{{URL::asset('build/css/user_style.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<style type='text/css'>
	a.previous { display: none; }
	.demo { width:960px; margin:50px auto;}
	span {
	  display: none;
	  
	}

	table tr { display: none; }

	table tr:nth-child(-n+8) { display: table-row; }
	</style>


  <script>
	$(document).ready(function(){
    // alert("asd");
	    $("mnm").click(function(){

          	// alert("asd");
	        // $("#div1").load("users-details.html");


	      	$.get("dummy/", function(data){
	            // console.log(data);
	            // alert("Success");
	              // console.log(obj.id);
	         			
	              $("#div1").empty().append(data);

	        });



	    });
	});
	</script>   
@endsection

@section('content')
 <!-- page content -->
        <div class="right_col" role="main">
        <div style="min-height:750px;">
          <div>

                     <div class="page-title">
		              <div class="title_left">
		                <h3>Users Information</h3>
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
		                 
		                 <a  href="#myModal" class="btn btn btn-primary" value="{{Auth::user()->id}}" data-toggle="modal">Invite users</a>
		     
		               
		                </div>
		              </div>
		            </div>
                


                    <!-- Modal start-->
                    <div class="bs-example">
 
					    <div id="myModal" class="modal fade">
					        <div class="modal-dialog">
					            <div class="modal-content">
					                <div class="modal-header">
					                   
					                    <h4 class="modal-title">Invite User</h4>
					                </div>
					                
					                <div class="modal-body">
					                {!! Form::open(array('method' => 'POST', 'url' => 'invite_user' )) !!}
					                    <!-- <form class="form-horizontal form-label-left"> -->
					                     
					                      <div class="form-group">
					                        <label class="control-label col-md-3 col-sm-3 col-xs-3 text-left">Email</label>
					                        <div class="col-md-9 col-sm-9 col-xs-9">
					                            <input type="email" name="email" class="form-control"></input>
					                         	<br>
					                        </div>
					                      </div>
					                      
					                      <div class="form-group">
					                        <label class="control-label col-md-3 col-sm-3 col-xs-3 text-left">Role</label>
					                        <div class="col-md-9 col-sm-9 col-xs-9">
					                            
				                              @foreach($roles as $role)
				                              	<input type="checkbox" name="roles[]" value="{{$role->id}}">   <label>  {{$role->name}} </label><br />
				                              @endforeach

				                            <a href="/roles" class="pagination">Create a new Role</a>

					                         
					                        </div>
					                        </div>
					                     <!-- </form> -->
					                    
					                </div>

					                <div class="modal-footer">
					                    <b type="button" class="btn btn-default" data-dismiss="modal">Close</b>
					                    <!-- <button type="submit" class="btn btn-info btn-sm pull-left">Send Invite</a> -->
					                    <input type="submit" value="Send Invite" class="btn btn-info">
					                </div>
					                <!-- Modal Footer End -->
					                {!! Form::close() !!}
					            </div>
					        </div>
					      </div>
					  </div>

                    <!-- Modal End-->

           
                    <!-- Modal start-->

				   <div id="myMod" class="modal fade">  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
				      </div>
				      <div class="modal-body">
				        <strong>Invitation sent !!</strong>
				      </div>
				      <div class="modal-footer">
				        <a   href="/users" type="button" class="btn btn-secondary">Close</a>
				       
				      </div>
				     </div>
				    </div>
				   </div>


                    <!-- Modal close-->




		            <!-- Table Start-->
		            <div id="div1" >
		              
		             <div class="row">
		              <div class="col-md-10 col-sm-10 col-lg-10">
		                <div class="x_panel">

							<table id="myTable" class="table table-bordered table-striped">
							  <thead class="thead-inverse" >
							    <tr>
							      <th>#</th>
							      <th >Name</th>
							      <th>Email Id</th>
							      <th>Role</th>
							      <!-- <th>Permission</th> -->
							      <th>Action</th>
							    </tr>
							  </thead>
							  <tbody>
								  @foreach($users as $user)
								    
								    <tr>
								      <th scope="row">{{ $user->id }}</th>
							          <td id="name">{{ $user->name }}</a></td>
			                          <td>{{ $user->email }}</td>

								      <td>
								      	@if($user->role()->count() != 0)
									      <select multiple class="form-control" style="height:50px;" disabled>
										    @foreach( $user->role()->get() as $role)
												<option>{{ $role->name }}</option>
											@endforeach
										  </select>
										@endif
									  </td>

								      


								      <!-- <td>Admin</td> -->
								      <td>
								      	<mnm class="btn btn-primary btn-sm pull-left" value="{{$user}}"> Edit</mnm>
									    @if(Auth::user()->id != $user->id)
									      	{!! Form::open(array('method' => 'DELETE', 'route' => ['users_delete',$user->id])) !!}
						                      <button type="submit" class="btn btn-danger btn-sm pull-left">Delete</a>
						                    {!! Form::close() !!} 
								      	<!-- <mnm class="btn btn-danger btn-sm"> Delete</mnm> -->
								      	@endif
								      </td>
								    </tr>
								  
								  @endforeach
							    
							  </tbody>
							   
							</table> <!-- 
							  <a   onmouseover="this.style.cursor='pointer'" class="previous">Previous</a>

							  <a  onmouseover="this.style.cursor='pointer'" class="next">Next</a>

							  <input onmouseover="this.style.cursor='pointer'" type="hidden" id="hdnActivePage" value="1">			   
							                   -->         
						  </div>
						 </div>
						</div>
			          <div class="clearfix"></div>
			        </div>
			        <!-- Table close-->

			        <!-- Pagination Render -->
		            <div class="text-center col-sm-10">
		              {!! $users->links() !!}
		            </div>
          </div>
          </div>
          </div>
        <!-- /page content -->

  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



   

   <script>
      $(document).ready(function () {

    // number of records per page
    var pageSize = 8;
    // reset current page counter on load
    $("#hdnActivePage").val(1);
    // calculate number of pages
    var numberOfPages = $('table tr').length / pageSize;
    numberOfPages = numberOfPages.toFixed();
    // action on 'next' click
    $("a.next").on('click', function () {
    // show only the necessary rows based upon activePage and Pagesize
    $("table tr:nth-child(-n+" + (($("#hdnActivePage").val() * pageSize) + pageSize) + ")").show();
    $("table tr:nth-child(-n+" + $("#hdnActivePage").val() * pageSize + ")").hide();
    var currentPage = Number($("#hdnActivePage").val());
    // up<a href="http://www.jqueryscript.net/time-clock/">date</a> activepage
    $("#hdnActivePage").val(Number($("#hdnActivePage").val()) + 1);
    // check if previous page button is necessary (not on first page)
    if ($("#hdnActivePage").val() != "1") {
    $("a.previous").show();
    $("span").show();
    }
    // check if next page button is necessary (not on last page)
    if ($("#hdnActivePage").val() == numberOfPages) {
    $("a.next").hide();
    $("span").hide();
    }
    });
    // action on 'previous' click
    $("a.previous").on('click', function () {
    var currentPage = Number($("#hdnActivePage").val());
    $("#hdnActivePage").val(currentPage - 1);
    // first hide all rows
    $("table tr").hide();
    // and only turn on visibility on necessary rows
    $("table tr:nth-child(-n+" + ($("#hdnActivePage").val() * pageSize) + ")").show();
    $("table tr:nth-child(-n+" + (($("#hdnActivePage").val() * pageSize) - pageSize) + ")").hide();
    // check if previous button is necessary (not on first page)
    if ($("#hdnActivePage").val() == "1") {
    $("a.previous").hide();
    $("span").hide();
    } 
    // check if next button is necessary (not on last page)
    if ($("#hdnActivePage").val() < numberOfPages) {
    $("a.next").show();
    $("span").show();
    } 
    if ($("#hdnActivePage").val() == 1) {
    $("span").hide();
    }
    });
    });
    </script>




@endsection