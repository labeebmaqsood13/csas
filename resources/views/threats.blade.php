@extends('layouts.main2')

@section('title','Activity Dashboard')


@section('user_name')
	{{ Auth::user()->name }}
@endsection

@section('user_role')
  {{Auth::user()->role()->first()->name}}
@endsection

@section('scripts')
 <link href="{{URL::asset('build/css/index1.min.css')}}" rel="stylesheet">

@endsection

@section('content')
 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              <br />
             <h3><strong >NEWS FEED</strong><h3>
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

  

            <div class="container">
             <div class="row">
               <div class="col-lg-4">
               
            </div>
            <div class="col-lg-8">
             <div class="pull-right">
             <label style="color:black;">Show Types</label>
             <Select id="colorselector">
               
               <option value="reg">All</option>
               <option value="yellow">Tasks Modified</option>
               <option value="red">Uploaded</option>
               <option value="green">others</option>
             </Select>
            </div>
            </div>

            </div>
            <br />

           
            <div class="row">


                   <div class="col-lg-8" >
                    

                   <div id="reg" class="colors" > 

                    <div class="qa-message-list" id="wallmessages">
    				<div class="message-item" id="m16">
						<div class="message-inner">
							<div class="message-head clearfix">
								<div class="message-icon pull-left"><a href="#"><i class="glyphicon glyphicon-check"></i></a></div>
								<div class="user-detail">
									<h5 class="handle">Modified Task</h5>
                                    <div class="post-type">
										<p>Task</p>
									</div>
									<div class="post-time">
                                        <p><i ></i> 2 Min Ago</p>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<p>Faisal Mahmood modified task internal pci network scan for cocacola project</p>
							</div>
			            </div>   
					</div>
					
					<div class="message-item" id="m16">
    					<div class="message-inner">
							<div class="message-head clearfix">
								<div class="message-icon pull-left"><a href="#"><i class="glyphicon glyphicon-check"></i></a></div>
								<div class="user-detail">
									<h5 class="handle">Uploaded Filed</h5>
                                    <div class="post-type">
										<p>Task</p>
									</div>
									<div class="post-time">
                                        <p><i ></i> 2 Min Ago</p>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<p>Faisal Mahmood uploaded a file</p>
							</div>
			            </div>   
					</div>

					<div class="message-item" id="m16">
    					<div class="message-inner">
							<div class="message-head clearfix">
								<div class="message-icon pull-left"><a href="#"><i class="glyphicon glyphicon-check"></i></a></div>
								<div class="user-detail">
									<h5 class="handle">Modified Task</h5>
                                    <div class="post-type">
										<p>Task</p>
									</div>
									<div class="post-time">
                                        <p><i ></i> 10 Min Ago</p>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<p>Labeeb Maqsood modified the task</p>
							</div>
			            </div>   
					</div>

					<div class="message-item" id="m16">
    					<div class="message-inner">
							<div class="message-head clearfix">
								<div class="message-icon pull-left"><a href="#"><i class="glyphicon glyphicon-check"></i></a></div>
								<div class="user-detail">
									<h5 class="handle">Other Activity</h5>
                                    <div class="post-type">
										<p>Project</p>
									</div>
									<div class="post-time">
                                        <p><i ></i> 10/2/2016</p>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<p>other activity sample example 1</p>
							</div>
			            </div>   
					</div>

					<div class="message-item" id="m16">
    					<div class="message-inner">
							<div class="message-head clearfix">
								<div class="message-icon pull-left"><a href="#"><i class="glyphicon glyphicon-check"></i></a></div>
								<div class="user-detail">
									<h5 class="handle">other Activity</h5>
                                    <div class="post-type">
										<p>Project</p>
									</div>
									<div class="post-time">
                                        <p><i ></i> 2/2/2016</p>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<p>Other activity sample example 2</p>
							</div>
			            </div>   
					</div>
                    
                 
                    
                  
					
	</div>


                   </div>

                      
                      <div id="red" class="colors" style="display:none">
                       <div class="qa-message-list" id="wallmessages">
                      <div class="message-item" id="m16">
    					<div class="message-inner">
							<div class="message-head clearfix">
								<div class="message-icon pull-left"><a href="#"><i class="glyphicon glyphicon-check"></i></a></div>
								<div class="user-detail">
									<h5 class="handle">Uploaded Filed</h5>
                                    <div class="post-type">
										<p>Task</p>
									</div>
									<div class="post-time">
                                        <p><i ></i> 2 Min Ago</p>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<p>Faisal Mahmood uploaded a file</p>
							</div>
			            </div>   
					</div>
                      </div>
                      </div>



                     <div id="yellow" class="colors" style="display:none">
                     <div class="qa-message-list" id="wallmessages">
                    <div class="message-item" id="m16">
    					<div class="message-inner">
							<div class="message-head clearfix">
								<div class="message-icon pull-left"><a href="#"><i class="glyphicon glyphicon-check"></i></a></div>
								<div class="user-detail">
									<h5 class="handle">Modified Task</h5>
                                    <div class="post-type">
										<p>Task</p>
									</div>
									<div class="post-time">
                                        <p><i ></i> 10 Min Ago</p>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<p>Labeeb Maqsood modified the task</p>
							</div>
			            </div>   
					</div>

                         <div class="qa-message-list" id="wallmessages">
    				<div class="message-item" id="m16">
						<div class="message-inner">
							<div class="message-head clearfix">
								<div class="message-icon pull-left"><a href="#"><i class="glyphicon glyphicon-check"></i></a></div>
								<div class="user-detail">
									<h5 class="handle">Modified Task</h5>
                                    <div class="post-type">
										<p>Task</p>
									</div>
									<div class="post-time">
                                        <p><i></i> 2 Min Ago</p>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<p>Faisal Mahmood modified task internal pci network scan for cocacola project</p>
							</div>
			            </div>   
					</div>
					</div>
					

                       </div>
                       </div>

                      <div id="green" class="colors" style="display:none">
                     
                     <div class="message-item" id="m16">
    					<div class="message-inner">
							<div class="message-head clearfix">
								<div class="message-icon pull-left"><a href="#"><i class="glyphicon glyphicon-check"></i></a></div>
								<div class="user-detail">
									<h5 class="handle">Other Activity</h5>
                                    <div class="post-type">
										<p>Project</p>
									</div>
									<div class="post-time">
                                        <p><i ></i> 10/2/2016</p>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<p>other activity sample example 1</p>
							</div>
			            </div>   
					</div>

					<div class="message-item" id="m16">
    					<div class="message-inner">
							<div class="message-head clearfix">
								<div class="message-icon pull-left"><a href="#"><i class="glyphicon glyphicon-check"></i></a></div>
								<div class="user-detail">
									<h5 class="handle">other Activity</h5>
                                    <div class="post-type">
										<p>Project</p>
									</div>
									<div class="post-time">
                                        <p><i ></i> 2/2/2016</p>
									</div>
								</div>
							</div>
							<div class="qa-message-content">
								<p>Other activity sample example 2</p>
							</div>
			            </div>   
					</div>
                    
                      </div>
                 

                 </div>
                 <div class="col-lg-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 style="color:black;">Tasks due soon</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
             
                <div class="content">
                    <label>Task Name</label>
                              <p>Perform Arp Scans !!</p>
                          
                          </div>

              </div>
              <div class="clear"></div>

        

                  </div>
                
              </div>
                 
          

              </div>
              </div>
              </div>
              </div>
            
         
        <!-- /page content -->

      
      </div>
    </div>


<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
  
  <script type="text/javascript">
    
     $(function() {
        $('#colorselector').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
    });
  </script>
@endsection


