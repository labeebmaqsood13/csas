@extends('layouts.main2')

@section('title','Create Project')

@section('user_name','Labeeb')

@section('user_role','Admin')





@section('scripts')
  <!-- Bootstrap select path given -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

  <!-- Sweet alerts path given -->
  <script src="{{URL::asset('sweet_alerts/dist/sweetalert.min.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{URL::asset('sweet_alerts/dist/sweetalert.css')}}">



  <!-- Custom css paths given -->
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
    <script type="text/javascript">



      // function post_values(){
      
      // alert('high');
      //   $('#client_name, #project_name, #subnet_from, #subnet_to, #location, #due_date, #description').bind('keyup', function() {
      //       if(allFilled()) $('#register').removeAttr('disabled');
      //   });

      //   function allFilled() {
      //       var filled = true;
      //       $('#myform > input').each(function() {
      //           if($(this).val() == '') filled = false;
      //       });
      //       return filled;
      //   }
      // }

      function invite_in_project(){
        
        var roles = [];
        var email = document.getElementById('email').value;
        $('#email').val('');
        
        
        $("input[name='roles[]']").each( function () {
          if($(this).prop('checked') == true){
            roles.push($(this).val());
            $(this).prop('checked', false);
            // console.log( $(this).val() );
          }
        });

        var project_id = '1';

        console.log(email);
        console.log(roles);
        console.log(project_id);

        $.ajax({
            url: '/invite_user',
            method: 'POST',
            dataType: 'JSON',
            data:  {
            'email': email,
            'roles': roles,
            'project_id': project_id
            },
            success: function(data) {
              if(data=='0'){
                sweetAlert("Oops...", "This email address has already been invited!", "error");
              }
              if(data=='1'){
                swal("Success!", "The invitation has been sent!", "success");
              }
              
            }
        });

      }  

    </script>

    <style type="text/css">
      .bootstrap-select>.dropdown-toggle.bs-placeholder, .bootstrap-select>.dropdown-toggle.bs-placeholder:active, .bootstrap-select>.dropdown-toggle.bs-placeholder:focus, .bootstrap-select>.dropdown-toggle.bs-placeholder:hover{
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            background-color: #fff;
      }

    </style>
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
                  <!-- <div class="title_left"> -->
                  <div class="text-center">
                    <!-- <h4>Start Creating New Project</h4> -->
                    <h3 style="line-height: inherit;">Project Wizard</h3>
                  </div>

                  <!-- <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button">Go!</button>
                        </span>
                      </div>
                    </div>
                  </div> -->
                </div>
                    

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
                        <!-- <h4 class="text-center">Entry</h4> -->
                        <br><br>
                          <div  style="padding-right: 130px;">

                            <!-- <a href="#"><u>Invite User in Project</u></a> -->
                            <a  href="#inviteModal" class="btn btn-primary" data-toggle="modal">Invite User in Project</a>


 
          <!-- Invite Modal start-->
 
              <div id="inviteModal" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Invite User</h4>
                          </div>
                          
                          {!! Form::open(array('method' => 'POST', 'url' => 'invite_user' )) !!}
                          <div class="modal-body">
                               
                                <div class="form-group row">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-3 text-left">Email</label>
                                  <div class="col-md-9 col-sm-9 col-xs-9">
                                      <input type="email" name="email" class="form-control" id="email"></input>
                                    <br>
                                  </div>
                                </div>
                                
                                <div class="form-group row">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-3 text-left">Role</label>
                                  <div class="col-md-9 col-sm-9 col-xs-9">
                                      
                                      @foreach($roles as $role)
                                        <input type="checkbox" name="roles[]" value="{{$role->id}}">   <label>  {{$role->name}} </label><br />
                                      @endforeach

                                    <a href="/roles" class="pagination"><u>Create a new Role</u></a>
                                    <br>Project is 1
                                  </div>
                                </div>

                              
                          </div>

                          <div class="modal-footer">
                              <b type="button" class="btn btn-default" data-dismiss="modal">Close</b>
                              <!-- <button type="submit" class="btn btn-info btn-sm pull-left">Send Invite</a> -->
                              <input type="button" value="Send Invite" class="btn btn-info" onclick="invite_in_project()" data-dismiss="modal">
                          </div>
                          <!-- Modal Footer End -->
                          {!! Form::close() !!}
                    </div>
                  </div>
                </div>

          <!-- Invitation Modal End-->




                             <div class="row mar_ned">
                                <div class="col-md-4 col-xs-3">
                                    <p align="right" style="margin-top:4px"><strong>Choose Client</strong></p>
                                </div>
                                <div class="col-md-5 col-xs-6" style="padding-left: 20px;">
                                    <select name="client_name" id="client_name" class="selectpicker form-control" title="Choose a client" style="">
                                          <!-- <option>Choose a client</option> -->
                                          <!-- <option hidden>Choose a client</option> -->
                                          @foreach($clients as $key => $client)
                                            <option value="{{$client->id}}" name="client_name">{{ $client->name }}</option>
                                          @endforeach
                                    </select>

                     
                               </div>
                               <div class="col-md-1" style="padding-top: 5px;">
                                <a href="#myModal" class="glyphicon glyphicon-plus" data-toggle="modal">Create</a>
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
                            <li><input type="button" class="btn btn-primary next-step" value="Continue"></li>
                        </ul>
                    </div>
                    </div>





                    <div class="tab-pane" role="tabpanel" id="step2">
                        <!-- <h4>Add Members</h4> -->
                        <br><br>
                        <div style="padding: 6px 10px 3px;border: 1px solid #ccc; margin-left: 20px; margin-right: 20px;">

                       <div class="clearfix"> </div>
                              
                            <div class="row mar_ned">
                                <div class="col-md-6 col-md-offset-3">
                                <!-- <div class="col-md-12"> -->
                                  <br>  
                                  <h4 class="text-center"><u>Add Members</u></h4>
                                  <br>
                                  <select name="users[]" class="selectpicker text-center form-control" multiple>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div> <br><br>    
                        

                        <!-- <a id="#new_task_modal" onclick="new_task()">    
                          <h5><span class="glyphicon glyphicon-plus"></span>&nbsp;<u>Invite User</u></h5>                             
                        </a>   -->


                        <div style="margin-top:13px">
                        <ul class="list-inline pull-right" style="margin-top: 32px;">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step" onclick="update_summary()">continue</button></li>
                        </ul>
                        </div>
                    </div>
                    </div>









                    <div class="tab-pane" role="tabpanel" id="step3">
                        <!-- <h3>Summary</h3><br /> -->
                        <br>
                              <div style="border: 1px solid #ccc; padding: 25px; margin: 25px;">
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                  <strong style="color: black"> Client</strong>
                                </div>
                                <div class="col-md-3">
                                   <p align="center" id="client"></p>
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

                            <ul class="list-inline pull-right" style="margin-right: 18px;">
                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>

                                <li><input type="submit" value="Done" id="register" class="btn btn-primary btn-info-full"></li>

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


