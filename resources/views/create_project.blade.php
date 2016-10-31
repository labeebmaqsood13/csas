@extends('layouts.main2')

@section('title','Create Project')

@section('user_name','Labeeb')

@section('user_role','Admin')





@section('scripts')
    <link href="{{URL::asset('build/css/create_project.min.css')}}" rel="stylesheet">
    
    
    <link href="{{URL::asset('build/css/datepicker.css')}}">
    @endsection

@section('scripts_create')

  <script src="{{ URL::asset('production/js/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('production/js/datepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ URL::asset('build/js/create_project.js') }}"></script>

     <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
      <script type="text/javascript" src="{{ URL::asset('production/paging.js') }}"></script> 
      <script src="{{ URL::asset('production/js/datepicker.js') }}"></script>

        <script type="text/javascript">
      $('.datepicker').datepicker({
    startDate: '-3d'
});
    </script>

@endsection

@section('content')

 <!-- page content -->
  
        <!-- page content -->
        <div class="right_col" role="main">
        <div style="min-height:750px;">
          <div>

                     <div class="page-title">
                  <div class="title_left">
                    <h4>Start Creating New Project</h4>
                  </div>

                  <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button">Go!</button>
                        </span>
                      </div>
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
                          {!! Form::open(array('method' => 'POST', 'route' => 'clients.create','class' => 'form-horizontal form-label-left')) !!}
                          <div class="modal-body">
                            <!-- <form class="form-horizontal form-label-left"> -->
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Client Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                   <input type="txt" style="width: 70%;" name="name" class="form-horizontal form-control" placeholder="Client Name">   
                                </div>
                              </div>
                            <!-- </form> -->
                          </div>
                          <div class="modal-footer">
                            <b type="button" class="btn btn-default" data-dismiss="modal">Close</b>
                            <!-- <b type="submit" class="btn btn-info" data-toggle="modal" data-target="#myMod" data-dismiss="modal">Send Invite</b> -->
                            <input type="submit" value="Send Invite" class="btn btn-info">
                          </div>
                          {!! Form::close() !!}  
                      </div>
                  </div>
                </div>
            </div>


                <div>
 
              <div id="mod" class="modal fade" >
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                             
                              <h4 class="modal-title">ADD NOTE</h4>
                          </div>
                          <div class="modal-body">
                              <form class="form-horizontal form-label-left">

                               
                                <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-3">Task Priority</label>
                                  <div class="col-md-9 col-sm-9 col-xs-9">
                                            <select name="highest_qualification" id="highest_qualification" class="dropselectsec">
                                        <option value=""> Select Priority</option>
                                        <option value="1" style="color:red;">High</option>
                                        <option value="2" style="color:blue ;">Medium</option>
                                        <option value="3" style="color:lightgreen;">Low</option>
                                       
                                    </select>
                                  </div>
                                  <div style="margin-top:4px;">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-3">Note</label>
                                  <div class="col-md-9 col-sm-9 col-xs-9">
                                            <textarea class="area"></textarea>
                                   
                                  </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  
                               </form>
                              
                          </div>

                          <div >
                              <b type="button" class="btn btn-primary" data-dismiss="modal">Close / Done</b>
                              
                              
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
                <a   href="create_project.html" type="button" class="btn btn-secondary">Close</a>
               
              </div>
             </div>
            </div>
           </div>

            
                <!-- Table Start-->
                <div class="container">
             
  <div class="row" style="border: 1px;">
    <section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1"  style="margin-left:200px;" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2"  style="margin-left:200px;"  data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3"  style="margin-left:200px;"  data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>

                    
                </ul>
            </div>

            <form role="form">
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <h4>Entry</h4>
                          <div  style="padding-right: 130px;">

                             <div class="row mar_ned">
                                <div class="col-md-4 col-xs-3">
                                    <p align="right" style="margin-top:4px"><strong>Choose Client</strong></p>
                                </div>
                                <div class="col-md-8 col-xs-9">
                                    <select name="highest_qualification" id="highest_qualification" class="dropselectsec">
                                     <!--    <option value=""> Select Client</option>
                                        <option value="1">Ebryx</option>
                                        <option value="2">Cola</option>
                                        <option value="3">Hbl</option>
                                        <option value="4">yxwqwe</option>
                                        <option value="5">DiPlsW</option>
                                        <option value="6">Intweaxc </option>
                                        <option value="7">Sewef</option>
                                        <option value="8">Oqwtcs</option> -->
                                          @foreach($clients as $key => $client)
                                            <option value="{{$key}}">{{ $client->name }}</option>
                                          @endforeach 
                                    </select>

                     <a  href="#myModal" class="btn btn btn-primary" data-toggle="modal">Create Client</a>
                               </div>
                            </div>

                              <div class="row mar_ned">
                                <div class="col-md-4 col-xs-3">
                                    <p align="right" style="margin-top:4px"><strong>Project Name</strong></p>
                                </div>
                                <div class="col-md-8 col-xs-9">
                                    <input type="text" name="project name" id="project name" placeholder="Name" class="dropselectsec" >
                                </div>
                            </div>    
                        



  
                            <div class="row mar_ned">
                            <div class="col-md-4 col-xs-3">
                                  <p align="right" style="margin-top:4px"><strong>Subnet</strong></p>
                            </div>
                            <div class="col-md-2 col-xs-3">
                                 <input name="subnet" id="subnet" placeholder="0.0.0.0" class="inp" /> 
                            </div>
                             <div class="col-md-1">
                                 <p align="center" style="margin-top:4px">-To-</p>
                            </div>
                            <div class="col-md-2 col-xs-3">
                                 <input name="subnet" id="subnet" placeholder="0.0.0.0" class="inp" />
                            </div>
                          </div>   


  
                            <div class="row mar_ned">
                            <div class="col-md-4 col-xs-3">
                                  <p align="right" style="margin-top:4px"><strong>Company Location</strong></p>
                            </div>
                            <div class="col-md-6 col-xs-8">
                                 <input name="subnet" id="subnet" placeholder="City / Address" class="dropselectsec" /> 
                            </div>
                           
                          </div>   




                            <div class="row mar_ned">
                                <div class="col-md-4 col-xs-3">
                                    <p align="right" style="margin-top:4px"><strong>Due Date</strong></p>
                                </div>



                     
                          
                            <div class="col-md-8 col-xs-9">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-4 wdth">
                                            <select name="visa_status" id="visa_status" class="dropselectsec1">
                                                <option value="">Date</option>
                                                <option value="2">1</option>
                                                <option value="1">2</option>
                                                <option value="4">3</option>
                                                <option value="5">4</option>
                                                <option value="6">5</option>
                                                <option value="3">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-xs-4 wdth">
                                            <select name="visa_status" id="visa_status" class="dropselectsec1">
                                                <option value="">Month</option>
                                                <option value="2">Jan</option>
                                                <option value="1">Feb</option>
                                                <option value="4">Mar</option>
                                                <option value="5">Apr</option>
                                                <option value="6">May</option>
                                                <option value="3">June</option>
                                                <option value="7">July</option>
                                                <option value="8">Aug</option>
                                                <option value="9">Sept</option>
                                                <option value="9">Dec</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-xs-4 wdth">
                                            <select name="visa_status" id="visa_status" class="dropselectsec1">
                                                <option value="">Year</option>
                                                <option value="2">1990</option>
                                                <option value="1">1991</option>
                                                <option value="4">1992</option>
                                                <option value="5">1993</option>
                                                <option value="6">1994</option>
                                                <option value="3">1995</option>
                                                <option value="7">1996</option>
                                                <option value="8">1997</option>
                                                <option value="9">1998</option>
                                                <option value="9">1999</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                              </div>


                              <div class="row mar_ned">
                                <div class="col-md-4 col-xs-3">
                                    <p align="right"><strong>Description / Note</strong></p>
                                </div>
                                <div class="col-md-8 col-xs-9">
                                    <textarea rows="3" class="dropselectsec1"></textarea>
                                </div>
                            </div>    
                        






                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">continue</button></li>
                        </ul>
                    </div>
                    </div>

                    <div class="tab-pane" role="tabpanel" id="step2">
                        <h4>Assign Tasks</h4>
                        <div style="padding: 6px 10px;border: 1px solid #ccc;">

                       <div class="clearfix"> </div>
                              
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                    <h5><stronge>Pre-Engagement</stronge></h5>
                                </div>
                                <div class="col-md-3">
                                    <p style="margin-left:68px">Member</p>
                                </div>
                                <div class="col-md-2">
                                    <p style="margin-left:80px">Due Date</p>
                                </div>
                                <div class="col-md-3">
                                    <p align="center" style="margin-left:26px">Optional Action</p>
                                </div>
                            </div>    
                        

                             



                              <div class="row mar_ned">
                                <div class="col-md-3">
                                    <p align="center"><strong>Scope</strong></p>
                                </div>
                               
                                <div class="col-md-3">
                                     <select align="center" name="visa_status" id="visa_status" class="dropselectsec1">
                                                <option value="">Choose Member</option>
                                                <option value="2">labeeb</option>
                                                <option value="1">faisal</option>
                                                <option value="4">belal</option>
                                                <option value="5">rehan</option>
                                                <option value="6">ahsan</option>
                                                <option value="3">arsalan</option>
                                                <option value="7">momin</option>
                                                <option value="8">abubakar</option>
                                                <option value="9">1xyz</option>
                                                <option value="9">abc</option>
                                            </select>
                                </div>
                                 <div class="col-md-3" >
                                    <p align="center">
                                 <input class="datepicker" data-date-format="mm/dd/yyyy">
                                    </p>
                                </div>
                                <div class="col-md-3">
                                  
                                     <a  href="#mod" class="btn btn btn-default" data-toggle="modal">Add note</a>  
                                </div>
                               </div>    
                        
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                    <p align="center"><strong>Documentation</strong></p>
                                </div>
                               
                                <div class="col-md-3">
                                     <select align="center" name="visa_status" id="visa_status" class="dropselectsec1">
                                                <option value="">Choose Member</option>
                                                <option value="2">labeeb</option>
                                                <option value="1">faisal</option>
                                                <option value="4">belal</option>
                                                <option value="5">rehan</option>
                                                <option value="6">ahsan</option>
                                                <option value="3">arsalan</option>
                                                <option value="7">momin</option>
                                                <option value="8">abubakar</option>
                                                <option value="9">1xyz</option>
                                                <option value="9">abc</option>
                                            </select>
                                </div>
                                 <div class="col-md-3" >
                                    <p align="center">
                                 <input class="datepicker" data-date-format="mm/dd/yyyy">
                                    </p>
                                </div>
                                <div class="col-md-3">
                                      <a  href="#mod" class="btn btn btn-default" data-toggle="modal">Add note</a>  
                                </div>
                               </div>    
                        
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                    <p align="center"><strong>Arp Scan</strong></p>
                                </div>
                               
                                <div class="col-md-3">
                                     <select  align="center" name="visa_status" id="visa_status" class="dropselectsec1">
                                                <option value="">Choose Member</option>
                                                <option value="2">labeeb</option>
                                                <option value="1">faisal</option>
                                                <option value="4">belal</option>
                                                <option value="5">rehan</option>
                                                <option value="6">ahsan</option>
                                                <option value="3">arsalan</option>
                                                <option value="7">momin</option>
                                                <option value="8">abubakar</option>
                                                <option value="9">1xyz</option>
                                                <option value="9">abc</option>
                                            </select>
                                </div>
                                 <div class="col-md-3" >
                                    <p align="center">
                                 <input class="datepicker" data-date-format="mm/dd/yyyy">
                                    </p>
                                </div>
                                <div class="col-md-3">
                                  <a  href="#mod" class="btn btn btn-default" data-toggle="modal">Add note</a>  
                                </div>
                               </div> 


                                <div class="clearfix"> </div>
                              
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                    <h5><stronge>Engagement</stronge></h5>
                                </div>
                              
                            </div>    
                        

                             



                              <div class="row mar_ned">
                                <div class="col-md-3">
                                    <p align="center"><strong>iddle scanning scan</strong></p>
                                </div>
                               
                                <div class="col-md-3">
                                     <select align="center" name="visa_status" id="visa_status" class="dropselectsec1">
                                                <option value="">Choose Member</option>
                                                <option value="2">labeeb</option>
                                                <option value="1">faisal</option>
                                                <option value="4">belal</option>
                                                <option value="5">rehan</option>
                                                <option value="6">ahsan</option>
                                                <option value="3">arsalan</option>
                                                <option value="7">momin</option>
                                                <option value="8">abubakar</option>
                                                <option value="9">1xyz</option>
                                                <option value="9">abc</option>
                                            </select>
                                </div>
                                 <div class="col-md-3" >
                                    <p align="center">
                                 <input class="datepicker" data-date-format="mm/dd/yyyy">
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <a  href="#mod" class="btn btn btn-default" data-toggle="modal">Add note</a>  
                                </div>
                               </div>    
                        
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                    <p align="center"><strong>OS detection</strong></p>
                                </div>
                               
                                <div class="col-md-3">
                                     <select align="center" name="visa_status" id="visa_status" class="dropselectsec1">
                                                <option value="">Choose Member</option>
                                                <option value="2">labeeb</option>
                                                <option value="1">faisal</option>
                                                <option value="4">belal</option>
                                                <option value="5">rehan</option>
                                                <option value="6">ahsan</option>
                                                <option value="3">arsalan</option>
                                                <option value="7">momin</option>
                                                <option value="8">abubakar</option>
                                                <option value="9">1xyz</option>
                                                <option value="9">abc</option>
                                            </select>
                                </div>
                                 <div class="col-md-3" >
                                    <p align="center">
                                 <input class="datepicker" data-date-format="mm/dd/yyyy">
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <a  href="#mod" class="btn btn btn-default" data-toggle="modal">Add note</a>  
                                </div>
                               </div>    
                        
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                    <p align="center"><strong>Services</strong></p>
                                </div>
                               
                                <div class="col-md-3">
                                     <select  align="center" name="visa_status" id="visa_status" class="dropselectsec1">
                                                <option value="">Choose Member</option>
                                                <option value="2">labeeb</option>
                                                <option value="1">faisal</option>
                                                <option value="4">belal</option>
                                                <option value="5">rehan</option>
                                                <option value="6">ahsan</option>
                                                <option value="3">arsalan</option>
                                                <option value="7">momin</option>
                                                <option value="8">abubakar</option>
                                                <option value="9">1xyz</option>
                                                <option value="9">abc</option>
                                            </select>
                                </div>
                                 <div class="col-md-3" >
                                    <p align="center">
                                 <input class="datepicker" data-date-format="mm/dd/yyyy">
                                    </p>
                                </div>
                                <div class="col-md-3">
                                      <a  href="#mod" class="btn btn btn-default" data-toggle="modal">Add note</a>  
                                </div>
                               </div> 
                              </div>  

                        
                        <div style="margin-top:5px">
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step">continue</button></li>
                        </ul>
                        </div>
                    </div>
                    

                    <div class="tab-pane" role="tabpanel" id="step3">
                        <h3>Summary</h3><br />
                              <div style="border: 1px solid; padding: 25px; margin: 25px;">
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                  <strong style="color: black"> Client</strong>
                                </div>
                                <div class="col-md-3">
                                   <p align="center">Ebryx </p>
                                </div>
                                
                            </div>    
                        
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Project Name</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center" >Alpha_Eb_First</p>
                                </div>
                                
                            </div>    
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Subnet </Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center" >0.0.0.0 to 0.0.0.0</p>
                                </div>
                                
                            </div>    
 
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Responsible members</Label>
                                </div>
                                <div class="col-md-3">
                                   <ul>
                                     <li style="color: lightblack ;"> Faisal Mahmood (Analyst)</li>
                                     <li> Labeeb Maqsood (Analyst)</li>
                                   </ul>
                                </div>
                                
                            </div>    
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Due Date</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center">31/5/2017</p>
                                </div>
                                
                            </div>    



                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Added Instructions</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center">Take work seriously !
                                   put some effort
                                   enjoy!</p>
                                </div>
                                
                            </div> </div>   

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                
                                <li><a href="/index_activity"type="button" class="btn btn-primary btn-info-full ">Done</a></li>
                            </ul>
                        </div>
                       
                        <div class="clearfix"></div>
                  </div>
              </form>
            </div>
            </section>
           </div>
        </div>
                      <!-- Table close-->
            </div>
            </div>
          </div>
        <!-- /page content -->

      </div>
    </div>   

  
@endsection


