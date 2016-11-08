@extends('layouts.main2')

@section('title','Create Project')

@section('user_name','Labeeb')

@section('user_role','Admin')





@section('scripts')
    <link href="{{URL::asset('build/css/create_project.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('build/css/datepicker.css')}}">
    <script type="text/javascript">

    //   function post_values(){ console.log('here');
    //     // $.ajaxSetup({
    //     //   headers: {
    //     //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     //   }
    //     // });
    //     var client_name = document.getElementById('client_name').value;
    //     var project_name = document.getElementById('project_name').value;
    //     var subnet_from = document.getElementById('subnet_from').value;
    //     var subnet_to = document.getElementById('subnet_to').value;
    //     var location = document.getElementById('location').value;
    //     var due_date = document.getElementById('due_date').value;
    //     var description = document.getElementById('description').value;
    //       $.ajax({
    //           url: 'create_project_and_allocate_tasks',
    //           method: 'POST',
    //           dataType: 'JSON',
    //           data:  {
    //            'client_name': client_name,
    //            'name': project_name,
    //            'subnet_from': subnet_from,
    //            'subnet_to': subnet_to,
    //            'location': location,
    //            'due_date': due_date,
    //            'description': description
    //            },
    //           success: function(data) {
    //               // swal("Favorite Removed!", "", "success");
    //               //document.getElementById("fav").className = "fa fa-heart-o";
    //               console.log('success');
    //                $("#success").show();
    //                // $("#preremove").hide();
    //                // $("#prefav").hide();
    //                // $("#remove").hide();
    //           },
    //           error: function(data) {
    //               console.log('POST error.');
    //           }
    //       });

    //       // $.post('create_project/', 
    //       //   {
    //       //     'client_name': client_name,
    //       //      'name': project_name,
    //       //      'subnet_from': subnet_from,
    //       //      'subnet_to': subnet_to,
    //       //      'location': location,
    //       //      'due_date': due_date,
    //       //      'description': description
    //       //   },
    //       //   function(data){
    //       //     console.log(data);
    //       //   });

    //   }




    // // $('.datepicker').datepicker({
    // //     startDate: '-3d'
    // // });
        





    </script>
@endsection

@section('scripts_create')

<script type="text/javascript">
  function new_task(){

('#new_task_Modal').modal('show');

  }
</script>
  <!-- <script type="text/javascript">
    function post_values(){
      // $.ajaxSetup({
      //   headers: {
      //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   }
      // });
      var client_name = document.getElementById('client_name').value;
      var project_name = document.getElementById('project_name').value;
      var subnet_from = document.getElementById('subnet_from').value;
      var subnet_to = document.getElementById('subnet_to').value;
      var location = document.getElementById('location').value;
      var due_date = document.getElementById('due_date').value;
      var description = document.getElementById('description').value;
        $.ajax({
            url: 'create_project',
            method: 'POST',
            dataType: 'JSON',
            data:  {
             'client_name': client_name,
             'name': project_name,
             'subnet_from': subnet_from,
             'subnet_to': subnet_to,
             'location': location,
             'due_date': due_date,
             'description': description
             },
            success: function(data) {
                // swal("Favorite Removed!", "", "success");
                //document.getElementById("fav").className = "fa fa-heart-o";
                console.log('success');
                 $("#success").show();
                 // $("#preremove").hide();
                 // $("#prefav").hide();
                 // $("#remove").hide();
            },
            error: function(data) {
                console.log('POST error.');
            }
        });

        // $.post('create_project/', 
        //   {
        //     'client_name': client_name,
        //      'name': project_name,
        //      'subnet_from': subnet_from,
        //      'subnet_to': subnet_to,
        //      'location': location,
        //      'due_date': due_date,
        //      'description': description
        //   },
        //   function(data){
        //     console.log(data);
        //   });

    }




  // $('.datepicker').datepicker({
  //     startDate: '-3d'
  // });
      





  </script> -->
  <script src="{{ URL::asset('production/js/moment/moment.min.js') }}"></script>
  <script src="{{ URL::asset('production/js/datepicker/daterangepicker.js') }}"></script>

  <!-- Custom Theme Scripts -->
  <script src="{{ URL::asset('build/js/create_project.js') }}"></script>

  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="{{ URL::asset('production/paging.js') }}"></script> 
  <script src="{{ URL::asset('production/js/datepicker.js') }}"></script>





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
                    <!-- New task Modal start-->
                     <div id="#new_task_Modal" class="modal fade">  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Please enter the name of new task</h4>
                        </div>
                        <div class="modal-body">
                          <strong>Project Created</strong>
                        </div>
                        <div class="modal-footer">
                          <a   href="/users" type="button" class="btn btn-secondary">Close</a>
                         
                        </div>
                       </div>
                      </div>
                     </div>
                    <!-- Modal close-->

                    <!-- Success Modal start-->
                     <div id="success" class="modal fade">  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Success</h4>
                        </div>
                        <div class="modal-body">
                          <strong>Project Created</strong>
                        </div>
                        <div class="modal-footer">
                          <a   href="/users" type="button" class="btn btn-secondary">Close</a>
                         
                        </div>
                       </div>
                      </div>
                     </div>
                    <!-- Modal close-->

                    
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
                <a href="create_project.html" type="button" class="btn btn-secondary">Close</a>
               
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

            {!! Form::open(array('url'=>'create_project_and_allocate_tasks','method'=>'POST', 'id'=>'myform')) !!}
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <h4 class="text-center">Entry</h4>
                          <div  style="padding-right: 130px;">

                             <div class="row mar_ned">
                                <div class="col-md-4 col-xs-3">
                                    <p align="right" style="margin-top:4px"><strong>Choose Client</strong></p>
                                </div>
                                <div class="col-md-8 col-xs-9">
                                    <select name="client_name" id="client_name" class="dropselectsec">
                                          @foreach($clients as $key => $client)
                                            <option value="{{$client->name}}" name="client_name">{{ $client->name }}</option>
                                          @endforeach
                                    </select>

                     <a  href="#myModal" class="glyphicon glyphicon-plus" data-toggle="modal">Create</a>
                               </div>
                            </div>

                              <div class="row mar_ned">
                                <div class="col-md-4 col-xs-3">
                                    <p align="right" style="margin-top:4px"><strong>Project Name</strong></p>
                                </div>
                                <div class="col-md-8 col-xs-9">
                                    <input type="text" name="project_name" id="project_name" placeholder="Name" class="dropselectsec form-control" >
                                </div>
                            </div>    
                        



  
                            <div class="row mar_ned">
                            <div class="col-md-4 col-xs-3">
                                  <p align="right" style="margin-top:4px"><strong>Subnet</strong></p>
                            </div>
                            <div class="col-md-2 col-xs-3">
                                 <input name="subnet_from" id="subnet_from" placeholder="0.0.0.0" class="inp form-control" /> 
                            </div>
                             <div class="col-md-1">
                                 <p align="center" style="margin-top:4px">-To-</p>
                            </div>
                            <div class="col-md-2 col-xs-3">
                                 <input name="subnet_to" id="subnet_to" placeholder="256.256.256.256" class="inp form-control" />
                            </div>
                          </div>   


  
                            <div class="row mar_ned">
                            <div class="col-md-4 col-xs-3">
                                  <p align="right" style="margin-top:4px"><strong>Location</strong></p>
                            </div>
                            <div class="col-md-6 col-xs-8">
                                 <input name="location" id="location" placeholder="City / Address" class="dropselectsec form-control" /> 
                            </div>
                           
                          </div>   




                            <div class="row mar_ned">
                                <div class="col-md-4 col-xs-3">
                                    <p align="right" style="margin-top:4px"><strong>Due Date</strong></p>
                                </div>

<!-- 
<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </div>
</div> -->
                            <div class="row">
                              <div class="col-md-6 col-xs-8">
                                  <div class="form-group">
                                      <div class='input-group date' id='datetimepicker1'>
                                          <input type='text' class="form-control dropselectsec" placeholder="MM/DD/YYYY" name="due_date_project" id="due_date"/>
                                          <span class="input-group-addon">
                                              <span class="glyphicon glyphicon-calendar"></span>
                                          </span>
                                      </div>
                                  </div>
                                    </div>
                                </div>

                              </div>


                              <div class="row mar_ned">
                                <div class="col-md-4 col-xs-3">
                                    <p align="right"><strong>Description / Note</strong></p>
                                </div>
                                <div class="col-md-8 col-xs-9">
                                    <textarea rows="3" class="dropselectsec1 form-control" name="description_project" id="description"></textarea>
                                </div>
                            </div>    
                        




                       
                        <ul class="list-inline pull-right">
                            <li><input type="button" class="btn btn-primary next-step" onclick="post_values()" value="Save and Continue"></li>
                        </ul>
                    </div>
                    </div>





                    <div class="tab-pane" role="tabpanel" id="step2">
                        <h4>Assign Tasks</h4>
                        <div style="padding: 6px 10px;border: 1px solid #ccc;">

                       <div class="clearfix"> </div>
                              
                              <div class="row mar_ned">
                                <div class="col-md-2">

                                    <h5 class="text-center"><u>Tasks</u></h5>
                                    <!-- <h5 class="text-center"><u>Pre-Engagement</u></h5> -->
                                </div>
                                <div class="col-md-3">
                                    <h5 style="margin-left:68px"><u>Member</u></h5>
                                </div>
                                <div class="col-md-2">
                                    <h5 style="margin-left:80px"><u>Due Date</u></h5>
                                </div>
                                <div class="col-md-3">
                                    <h5 align="center" style="margin-left:150px"><u>Optional Action</u></h5>
                                </div>
                            </div>    
                        

                             


                            @foreach($tasks as $task)
                              <div class="row mar_ned">
                                <div class="col-md-2">
                                    <h5 align="center"><strong>{{$task->name}}</strong></h5>
                                </div>
                               
                                <div class="col-md-3">
                                    <select align="center" name="member[{{$task->id}}]" id="member" class="dropselectsec1 form-control">
                                      <option value="0">Choose Member</option>
                                      @foreach($users as $user)
                                        <option value="{{$user->name}}">{{$user->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                 <div class="col-md-3 form-group form-horizontal" >
                                    <p align="center">
                                 <input class="datepicker form-control" name="due_date_task[{{$task->id}}]" id="due_date_task" placeholder="MM/DD/YYYY" data-date-format="mm/dd/yyyy">
                                    </p>
                                </div>
                                <div class="col-md-3">
                                     <!-- <a  href="#mod" class="btn btn btn-default" data-toggle="modal">Add note</a> -->  
                                     <textarea rows="2" class="form-control" placeholder="Optional Note/Description" name="description_task[{{$task->id}}]" id="description"></textarea>
                                </div>
                               </div>    
                        
                            @endforeach

                        <a id="#new_task_modal" onclick="new_task()">    
                          <span class="pull-left glyphicon glyphicon-plus">
                          </span>
                          <h5>&nbsp;Create a new task</h5>                             
                        </a>  


                            <!-- Enter here deleted code -->
                        
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

                                <li><input type="submit" value="Done" class="btn btn-primary btn-info-full"></li>

                                <!-- <li><a href="/index_activity" type="button" class="btn btn-primary btn-info-full ">Done</a></li> -->
                            </ul>
                        </div>
                       
                        <div class="clearfix"></div>
                  </div>
              <!-- </form> -->

            {!! Form::close() !!}

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


