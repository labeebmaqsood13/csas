@extends('layouts.main2')

@section('title','Activity Dashboard')

@section('user_name','Labeeb')

@section('user_role','Admin')

@section('scripts')
 <link href="{{URL::asset('build/css/groups.min.css')}}" rel="stylesheet">

@endsection

@section('content')
 <!-- page content -->

        <div class="right_col" role="main">
          
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
                 
                
               
                </div>
              </div>
            </div>
                 


            <div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
   
    <!-- Modal HTML -->
    <div id="myModa" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h5><strong> Create Group </strong></h5>
                </div>
                
                <div class="modal-body">
                


                 <div class="row">
                    <div align="middle" class="col-md-3 col-sm-3 col-lg-3">
                    <h4 class="modal-title">Group Name <h4></div>
                    <div align="right" class="col-md-3 col-sm-3 col-lg-4">
                    <h4 class="modal-title">Members</h4></div>
                 </div>
                      <div class="row">
                        <div  class="col-md-5 col-sm-5 col-lg-5">
                                                

                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                        
                           <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="txt"></input>
                           </div>
                      </div>
                      
                      </form>  
                      </div>




                      <div  class="col-md-5 col-sm-6 col-lg-6">
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            
                            

                              <input type="checkbox"> <label>  Faisal (faisalrocky1@yahoo.com)</label><br />
                              <input type="checkbox"> <label>  Labeeb (Examle.com)</label><br />

                            <input type="checkbox"> <label>  Waleed (etcetca.com)</label> <br />
                            <input type="checkbox"> <label>  Ali Yousaf (etcetca.com)</label><br />

                         
                         
                        </div>
                      </div>
                      
                      </div>

                  
                    
                </div>
                <div class="modal-footer">
                    <b type="button" class="btn btn-default" data-dismiss="modal">Close</b>
                    
                    <b type="button" class="btn btn-info" data-toggle="modal" data-target="#myMod" data-dismiss="modal">Create Group</b>

        
       
                </div>
            </div>
        </div>
      </div>
    </div>


            </div>




            <div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
   
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h5><strong> Create Group </strong></h5>
                </div>
                
                <div class="modal-body">
                


                 <div class="row">
                    <div align="middle" class="col-md-3 col-sm-3 col-lg-3">
                    <h4 class="modal-title">Group Name <h4></div>
                    <div align="right" class="col-md-3 col-sm-3 col-lg-4">
                    <h4 class="modal-title">Members</h4></div>
                 </div>
                      <div class="row">
                        <div  class="col-md-5 col-sm-5 col-lg-5">
                                                

                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                        
                           <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="txt"></input>
                           </div>
                      </div>
                      
                      </form>  
                      </div>




                      <div  class="col-md-5 col-sm-6 col-lg-6">
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            
                            

                              <input type="checkbox"> <label>  Faisal (faisalrocky1@yahoo.com)</label><br />
                              <input type="checkbox"> <label>  Labeeb (Examle.com)</label><br />

                            <input type="checkbox"> <label>  Waleed (etcetca.com)</label> <br />
                            <input type="checkbox"> <label>  Ali Yousaf (etcetca.com)</label><br />

                         
                         
                        </div>
                      </div>
                      
                      </div>

                  
                    
                </div>
                <div class="modal-footer">
                    <b type="button" class="btn btn-default" data-dismiss="modal">Close</b>
                    
                    <b type="button" class="btn btn-info" data-toggle="modal" data-target="#myMod" data-dismiss="modal">Create Group</b>

        
       
                </div>
            </div>
        </div>
      </div>
    </div>

           


   <div id="myMod" class="modal fade">  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body">
        <strong>Group Created !!</strong>
      </div>
      <div class="modal-footer">
        <a href="/groups" type="button" class="btn btn-secondary" >Close</a>
       
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
                          <td id="name"><b>Group Name</b></td>
                          <td><b>Members</b></td>
                          </tr>
					  </thead>
					  
					  <tbody>
					    <tr align="center">

					      <td scope="row" >1</td>
				          <td id="name">Manager</a></td>
                          <td>2</td>
					    </tr>
					    <tr align="center" valign="middle">
					      <td scope="row">2</td>
					      <td  valign="middle" id="name">Pentester</a></td>
					      <td valign="middle" >3</td>
                          </tr>
                         <td scope="row" >3</td>
                         <td id="name">Pear Reviewer</a></td>
                          <td>4</td>
                        </tr>
                          <td scope="row" >4</td>
                          <td id="name">Analyst</a></td>
                            <td>3</td>
                        </tr>

					  </tbody>
					   
					</table> 
						</div>
	            <div class="row">
	              <div class="col-lg-6">
	                <a  href="#myModal" class="btn btn btn-primary" data-toggle="modal">Add Group</a>
	              </div>
	            </div>
	        
	        </div> 
	        </div>
	        </div>           
         

            </div>
          <div class="clearfix"></div>
        </div>





@endsection


