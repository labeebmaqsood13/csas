@extends('layouts.main2')

@section('title','Activity Dashboard')

@section('user_name','Labeeb')

@section('user_role','Admin')

@section('scripts')
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
		                <h3>Users Info!</h3>
		              </div>

		              <div class="title_right">
		                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
		                  <div class="input-group">
		                    <input type="text" class="form-control" placeholder="Search for...">
		                    <span class="input-group-btn">
		                      <button class="btn btn-default" type="button">Go!</button>
		                    </span>
		                  </div>
		                  <br>
		                 
		                 <a  href="#myModal" class="btn btn btn-primary" data-toggle="modal">Invite users</a>
		     
		               
		                </div>
		              </div>
		            </div>
                


                    <!-- Modal start-->
                    <div class="bs-example">
 
					    <div id="myModal" class="modal fade">
					        <div class="modal-dialog">
					            <div class="modal-content">
					                <div class="modal-header">
					                   
					                    <h4 class="modal-title">INVITE USER</h4>
					                </div>
					                <div class="modal-body">
					                    <form class="form-horizontal form-label-left">

					                     
					                      <div class="form-group">
					                        <label class="control-label col-md-3 col-sm-3 col-xs-3 text-left">Email</label>
					                        <div class="col-md-9 col-sm-9 col-xs-9">
					                                  <input type="txt"></input>
					                         
					                        </div>
					                      </div>
					                      <div class="form-group">
					                        <label class="control-label col-md-3 col-sm-3 col-xs-3 text-left">Permission</label>
					                        <div class="col-md-9 col-sm-9 col-xs-9">

					                       <div class="radio">
					                          <label><input type="radio" name="optradio">Admin</label>
					                        </div>
					                        <div class="radio">
					                          <label><input type="radio" name="optradio">Default</label>
					                        </div>
					                        <div class="radio">
					                          <label><input type="radio" name="optradio">Observer</label>
					                        </div>
					                        <div class="radio">
					                          <label class="text-danger"><input type="radio" name="optradio" class="text-danger"> Master Admin</label>
					                        </div> 
					                        </div>
					                      </div>
					                      <div class="form-group">
					                        <label class="control-label col-md-3 col-sm-3 col-xs-3 text-left">Group</label>
					                        <div class="col-md-9 col-sm-9 col-xs-9">
					                            
					                            <select class="selectpicker">
					                              <option>Manager</option>
					                              <option>Analyst</option>
					                              <option>Pentester</option>
					                              <option>Client.Rep</option>
					                            </select>
					                         
					                        </div>
					                        </div>
					                     </form>
					                    
					                </div>

					                <div class="modal-footer">
					                    <b type="button" class="btn btn-default" data-dismiss="modal">Close</b>
					                    
					                    <b type="button" class="btn btn-info" data-toggle="modal" data-target="#myMod" data-dismiss="modal">Send Invite</b>
					                </div>
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
							      <th>Email-Id</th>
							      <th>Permission</th>
							      <th>Group</th>
							      <th>Action</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr >

							      <th scope="row" >1</th>
						          <td id="name"> Faisal Khan</a></td>
		                          <td>Faisalrocky1@yahoo.com</td>
							      <td>Admin</td>
							      <td>Manager</td>
							      <td><mnm class="btn btn-primary btn-sm"> Edit Details</mnm></td>
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td id="name">Labeeb Maqsood</a></td>
							      <td>labeebmaqsood13@gmail.com</td>
							      <td>Default</td>
							      <td>Analyst</td>
							      <td><mnm class="btn btn-primary btn-sm"> Edit Details </mnm></td>
							    </tr>
		                         <th scope="row" >3</th>
		                         <td id="name"> Faisal Khan</a></td>

		                          
		                          <td>Faisalrocky1@yahoo.com</td>
		                          <td>Admin</td>
		                          <td>Manager</td>
		                          <td><mnm class="btn btn-primary btn-sm"> Edit Details</mnm></td>
		                        </tr>
		                          <th scope="row" >4</th>
		                          <td id="name"> Faisal Khan</a></td>

		                          
		                          <td>Faisalrocky1@yahoo.com</td>
		                          <td>Admin</td>
		                          <td>Manager</td>
		                          <td><mnm class="btn btn-primary btn-sm"> Edit Details</mnm></td>
		                        </tr>

							    <tr>
							      <th scope="row">5</th>
							      <td id="name">Larry</a></td>
							      <td>something@yahoo.com</td>
							      <td>observer</td>
							      <td>Client Rep.</td>
							      <td><mnm class="btn btn-primary btn-sm"> Edit Details </mnm></td>
							    </tr>
		                        <tr>
		                          <th scope="row">6</th>
		                          <td id="name">Labeeb Maqsood</a></td>
		                          <td>labeebmaqsood13@gmail.com</td>
		                          <td>Default</td>
		                          <td>Analyst</td>
		                          <td><mnm class="btn btn-primary btn-sm"> Edit Details </mnm></td>
		                        </tr>
		                        <tr>
		                          <th scope="row">7</th>
		                          <td id="name">Larry</a></td>
		                          <td>something@yahoo.com</td>
		                          <td>observer</td>
		                          <td>Client Rep.</td>
		                          <td><mnm class="btn btn-primary btn-sm"> Edit Details </mnm></td>
		                        </tr>
		                        <tr>
		                          <th scope="row">8</th>
		                          <td id="name">Labeeb Maqsood</a></td>
		                          <td>labeebmaqsood13@gmail.com</td>
		                          <td>Default</td>
		                          <td>Analyst</td>
		                          <td><mnm class="btn btn-primary btn-sm"> Edit Details </mnm></td>
		                        </tr>
							  </tbody>
							   
							</table> 
							  <a   onmouseover="this.style.cursor='pointer'" class="previous">Previous</a>

							  <a  onmouseover="this.style.cursor='pointer'" class="next">Next</a>

							  <input onmouseover="this.style.cursor='pointer'" type="hidden" id="hdnActivePage" value="1">			   
							                           
						  </div>
						 </div>
						</div>
			          <div class="clearfix"></div>
			        </div>
			        <!-- Table close-->
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