
@extends('layouts.main2')

@section('title','File Upload')

@section('user_name')
  {{ Auth::user()->name }}
@endsection

@section('user_role')
  {{Auth::user()->role()->first()->name}}
@endsection


@section('scripts')

<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<style type="text/css">
 


#exTab1 .tab-content {
  color : black;
  padding : 5px 15px;
}

#exTab2 h3 {
  color : #515254;
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
  border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
  color : black;
  background-color: #edeff2;
  padding : 5px 15px;
}
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;

}
.mid_height{
  min-height: 100px;
}

 

.info-card {
    float: left;
  margin: 10px;
  -webkit-perspective: 400px;
}

.frontk, .backk {
  background: #395571;
  border-radius: 60px;
  transition: -webkit-transform .7s;
  -webkit-transform-style: preserve-3d;
  -webkit-backface-visibility: hidden;
border-right: 1px;
  -webkit-box-shadow: -12px 14px 16px -1px rgba(121,153,136,1);
-moz-box-shadow: -12px 14px 16px -1px rgba(121,153,136,1);
box-shadow: -12px 14px 16px -1px rgba(121,153,136,1);
   
}

.frontk {
  overflow: hidden;
  width: 250px;
  height: 140px;
  position: absolute;
  z-index: 1;
}

.backk {
  padding: 20px;
  padding-top: 10px;
  width: 250px;
  height: 150px;
  -webkit-transform: rotateY(-180deg);
  
}

.info-card:hover .backk {
  -webkit-transform: rotateY(0);
}

.info-card:hover .frontk {
  -webkit-transform: rotateY(180deg);
}



</style>
<script type="text/javascript">
 

$(document).ready(function(){
  
    $("select").change(function(){
    var x =$('#sco').val();
    var y =$('.sc').text();

            console.log(x,y);
   
   $.ajax({
            url: 'user_add',
            method: 'POST',
            dataType: 'JSON',
            data: {'x':x,'y':y},
            success: function(data) {
               
                console.log('success');
                 location.reload();
               }
           
        });

      });
     });


</script>
<script type="text/javascript">

   function getvaluee(idd){
    var taskid=idd;
    console.log(taskid);
    $('#taskc').val(taskid);
     }

$(document).ready(function(){
  
    $("#submittt").click(function(){
    var membr=$('#scco').val();
    var dat=$('#datee').val();
    var taskid=$('#taskc').val();
    var projectid=$('#project_cid').val();
   

            console.log(membr,dat,projectid,taskid);
   
   $.ajax({
            url: 'assign_member',
            method: 'POST',
            dataType: 'JSON',
            data: {'membr':membr,'dat':dat,'projectid':projectid,'taskid':taskid},
            success: function(data) {
               
                console.log('success');
                 location.reload();
            }
           
        });

      });
     });


</script>

<script type="text/javascript">
   
 $(function () {

 $("#submit").click(function() {
    var x=$('#vali').val();
    var y=$('#val').val();

// alert(x);
// alert(y);            console.log(y);

            //alert(y);
   
   $.ajax({
            url: 'create_task_sop',
            method: 'POST',
            dataType: 'JSON',
            data: {'x':x ,'y':y},
            success: function(data) {
               
                console.log('success');
                 
                var new_task ='<tr><td><a>'+data.name+'</a></td> <td><button type="submit" class="btn btn-danger btn-xs pull-right"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';                 
                $("#table_row").append(new_task);
                $("#moodal").modal('hide');
                location.reload();
               

            },
            error: function(data) {
                console.log("storystory");
            }
        });

     });

  });

</script>


<script type="text/javascript">
   
 $(function () {

 $("#submitt").click(function() {
    var x=$('#valii').val();
    var projectid=$('#project_cid').val();
    //var y=$('#val').val();

            console.log("story",projectid,"story");

            //alert(y);
   
   $.ajax({
            url: 'create_phase_sop',
            method: 'POST',
            dataType: 'JSON',
            data: {'x':x,'projectid':projectid },
            success: function(data) {
               
                console.log('success');
                 
                location.reload();
                $("#mod").modal('hide');
               

            },
            error: function(data) {
                console.log("storystory");
            }
        });

     });

  });

</script>

<script type="text/javascript">
   
 $(function () {

 $("#submit_upload").click(function() {
 
    var name=$('#name_up').val();
    var text=$('#text_up').val();
   
   
   $.ajax({
            url: 'upload_update_file',
            method: 'POST',
            dataType: 'JSON',
            data:new FormData($("#upload_form")[0]),
            async:false,
            processData: false,
            contentType: false,
            success: function(data) {
               
                console.log('success');
                 
               },
            error: function(data) {
                console.log("storystory");
            }
        });

     });

  });

</script>


<script type="text/javascript">
var x;
  function project(id){
   // alert(id);
     var idd=id;
    something = "projects_tasks/" + id;
 

       //alert("asd");
    window.location.href=something;
  
  


  }


</script>
<script type="text/javascript">
   
 
function delete_file(id,name){
    var x=id;
    var y=name;
    // alert(name);
   
   $.ajax({
            url: 'delete_file',
            method: 'POST',
            dataType: 'JSON',
            data: {'x':x,'y':y },
            success: function(data) {
               
                console.log('success');
                // alert("deleted"); 
                location.reload();
                

            },
            error: function(data) {
                console.log("storystory");
            }
        });

   }
</script>


<script>
$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
    $('.testEdit').editable({

        params: function(params) {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            // add additional params from data-attributes of trigger element
            params.name = $(this).editable().data('name');
            return params;
        },
        error: function(response, newValue) {
            if(response.status === 500) {
                return 'Server error. Check entered data.';
            } else {
                return response.responseText;
                // return "Error.";
            }
        }
    });
});
</script>


@endsection

@section('content')


    <div id="mod_delete" class="modal fade">  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"> Confirmation!</h4>
        </div>
        <div class="modal-body">
        <form id="formm">
         <label class="control-label col-md-8 col-sm-8 col-xs-8">Sure you wanna delete this task ?</label>
        
         </form>
        </div>
        <div class="modal-footer">
         <a   href="" type="button" class="btn btn-danger btn-secondary" data-dismiss="">Yes</a>
          <a   href="" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
        
        </div>
        </div>
       </div>
      </div>
    <!-- Modal close-->

    <div id="moodal" class="modal fade">  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"> Create New Task</h4>
        </div>
        <div class="modal-body">
        <form id="formm">
         <label class="control-label col-md-3 col-sm-3 col-xs-3">Name of Task</label>
         <input type="text" id="vali" style="border: 1px solid green;"></input>
          <input type="button"  id="submit" name="submit" value="create"  class="btn btn-info">
         </form>
        </div>
        <div class="modal-footer">
          <a   href="" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
        
        </div>
        </div>
       </div>
      </div>
    <!-- Modal close-->

    <!-- Modal close-->
 

    

<div class="right_col" role="main">
  <div class="container">

   <div class="row" style="margin-top: 80px;">


    @if($iam==0)
    @if($noproject==0)
    <h1 style="margin:195px">!! No Projects Available !!</h1>
    @endif
    @if($noproject==1)
    
    <h1>Your Projects</h1>
               <div id="" style="text-align: center;">
               <?php 
                  $x=0;
                   $v=0;
               ?>
               @foreach($loggedin_project as $loggedin_projects)
        
                
            
                 <div class="info-card">
        <div class="frontk">
          <div class="panel panel" style="background-color: #2a3f54">
                          <div class="panel-heading"><h3 style="color:white"value="{{$loggedin_projects->id}}">
                          {{$loggedin_projects->name}} 
                         
                           </h3> 

                        </div>

                         <div class="panel-body"> 
                         <div class="progress">
                      @if($percent[$x]!=0)
                         <div class="progress-bar progress-bar-striped active" role="progressbar"
                          aria-valuenow=" {{$percent[$x]}} " aria-valuemin="0" aria-valuemax="100" style="color:white;width: {{$percent[$x]}}%">
                           {{$percent[$x]}}%
                      @endif
                        
                         @if($percent[$x]==0) 
                          <div class="progress-bar progress-bar-striped active " role="progressbar"
                          aria-valuenow=" {{$percent[$x]}} " aria-valuemin="0" aria-valuemax="100" style="color:black;width: {{$percent[$x]}}%">
                         {{$percent[$x]}}%
                      
                          @endif
                          
                         
                        </div>
                       
                      </div>

                            
                        </div>
           </div>
                        </div>
         <div class="backk">
                       <div style="min-height: 90px">
                       <form>
                      
                       <div>
                       <label style="color: white"> Client : <span style="color:#adb1b5">{{$client[$v][0]['name']}}</span></label>  
                       </div>
                       <div>
                       <label style="color: white"> Due Date : <span style="color:#adb1b5">{{$due_date[$v]}}</span></label>
                       </div>
                       <div>
                       <label style="color: white"> Status : <span style="color:#adb1b5">{{$status[$v]}}</span></label>
                       </div>
                       
                         <?php $v=$v+1;?>
                         </form>
                         </div>
                         <div >
                         <button style="border-radius:20px" class="btn btn-success"onclick="project(this.value)" id="vl" value="{{$loggedin_projects->id}}">
                          Open Project 
                           </button> 
                           </div>
                        
                       
                      </div>
                    </div>
              <?php $x=$x+1;?>
                 @endforeach
           
               
              </div>
               @endif
               @endif
               </div>
             
   
@if($iam!=0)
<div id="mod" class="modal fade">  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"> Create New Phase</h4>
        </div>
        <div class="modal-body">
        <form id="formm">
         <label class="control-label col-md-3 col-sm-3 col-xs-3">Name of Phase</label>
         <input type="text" id="valii" style="border: 1px solid green;"></input>
          @foreach($pproject as $roject)
                    
                      <?php  $pr=$roject->id?>
                      @endforeach
           <input type="hidden" id="project_cid" value="{{$pr}}"></input>
          <input type="button"  id="submitt" name="submit" value="create"  class="btn btn-info" >
         </form>
        </div>
        <div class="modal-footer">
          <a   href="" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
        
        </div>
        </div>
       </div>
      </div>
    <!-- Modal close-->


    <div class="row">

@if($is_manager['0']=='1')

    <div class="col-md-3">
    <div style="">
            <div class="panel panel-default" style="min-height: 200px">
                  <div class="panel-heading"  style="background-color: #eaeaea;color:#757272">Summary</div>
                    <div style="margin-top:10px;margin-left: 5px;">
                     
                      <form class="" style="border: none; box-shadow: none;">
                   
                       <div>
                       <label > Client Name : <span class="badge"style="color:white">{{$client[0]['name']}}</span></label>  
                       </div>
                        <div>
                       <label> Project Name : <span class="badge"style="color:white">{{$pproject[0]['name']}}</span></label>
                       </div>
                        <div>
                       <label> Due Date : <span  class="badge"style="color:white">{{$due_date[0]}}</span></label>
                       </div>
                       <div>
                       <label> Status : <span class="badge" style="color:white">{{$status[0]}}</span></label>
                       </div>
                       <div>
                       <label s>Incomplete Tasks : <span class="badge"style="color:#white">{{$incmplt}}</span></label>
                       </div>
                       
                         </form>
                         

                </div>
                </div>



           <div class="panel panel-default" style="min-height: 260px">
                          <!-- Default panel contents -->
                          <div class="panel-heading" style="background-color: #eaeaea"><h5 style="color:#757272">List Of included Members</h5></div>
                      <div style="margin-top:6px;margin-left: 5px;">
                     @foreach($pproject as $roject)
                    
                     <div hidden class="sc" value="{{$roject->id}}">{{$roject->id}}</div>
                  
                   
                      @endforeach
                     <div style="margin-right: 10px;">
                       <select  class="form-control"name="myid" id="sco">
                           <option vallue="">Add New Member</option>
                          <?php $u=0;?>
                          @foreach($user as $usr)
                          
                          @if($ro[$u]['name']=='Manager'||$ro[$u]['name']=='Analyst')
                          <option value="{{$usr->id}}">{{$usr->name}}</option>
                          @endif

                         <?php $u=$u+1;?>

                          @endforeach
                        </select>
                      </div>
                      
                        
                      </div>
                         <div style="margin-top: 20px;">
                          <ul>
                            @foreach($member as $id)
                          <div class="row">
                          <div class="col-md-6 ">
                           <li>{{$id->name}}</li></div>
                           <div class="col-md-6">
                           <!-- {{$id->id}}
                           -->
                             @foreach($pproject as $roject)
                    
                      <?php  $pr=$roject->id?>
                   
                      @endforeach
                           {!! Form::open(array('method' => 'DELETE', 'route' => ['delete_member',$id->id,$pr])) !!}
                           <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                           {!! Form::close() !!}
                           </div>
                               </div>
                        @endforeach
                             
                            

                          </ul>
                          </div>

                          <div style="text-align: center;margin-top: 10px"> <button type="button" class="btn btn-success" >Invite User</button></div>
                </div>
           

          
            </div>
            </div>
            @endif
     


 <div class="col-md-9">
            
<div class="container"></div>

    <div id="exTab2" class="container"> 
    <ul class="nav nav-tabs">
                <li class="active">
            <a  href="#1" data-toggle="tab">Tasks</a>
                </li>
                <li><a href="#2" data-toggle="tab">Project Details</a>
                </li>
                <li><a href="#3" data-toggle="tab">Mytask</a>
                </li>
                 <li><a href="#4" data-toggle="tab">Attachments</a>
                </li>
                 @if($is_manager['0']=='1')
                          <a style="float: right;"  href="#mod" data-toggle="modal"> <button type="button" class=" btn btn-primary"value="Create Phase">Create Phase</button></a>
                       @endif
            </ul>

                <div class="tab-content ">
                  <div class="tab-pane active" id="1">
                         <div class="col-md-12"></div><br/>
                          
                     
                          
          @foreach($phase as $phs)

          <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading" style="background-color: #eaeaea">
             @if($is_manager['0']=='1')
                   
            <div class="row">
            <div  class="col-md-6"data-toggle="tooltip" data-placement="left" title="Edit Me !!">
            <i class="fa fa-cog fa-spin fa-1x fa-pull-left"></i> <a  style="color: black;" href="#" class="testEdit" data-type="text" data-column="name" data-url="{{url('sop/updatep/'.$phs['id'])}}" data-pk="{{$phs['id']}}" data-name="name" data-token="{{ csrf_token() }}">     
                            <h5 style="color:#757272"> {{$phs["name"]}}</h5>
                   </a>

                
                   </div>
                   <div class="col-md-6 text-right">
                    <?php $x=1; ?>
                   {!! Form::open(array('method' => 'DELETE', 'route' => ['delete_phase',$phs["id"],$x])) !!}
                        <button type="submit" style="max-height: 30px;max-width: 44px;"><span class="fa fa-remove"></span></button>
                      {!! Form::close() !!}</div>
                    </div>
                      
                   
                  
                   @endif
                    @if($is_manager['0']=='0')
                  <a  style="color: black;" >     
                            <h5 style="color:#757272"> {{$phs["name"]}}</h5>
                   </a>
                   
                   @endif

             </div>

              <table class="table " >
            
                
               <body>
               <tr>
                 <td>TASK </td>
                 <td>Assigned Member</td>
                 <td>Due Date</td>
                  @if($is_manager['0']=='1')
                  <td></td>
                  @endif
               </tr>
                <input type="hidden" id="project_cid" value="{{$pr}}"></input>
                            
                @foreach($test as $t)
                    @if($phs["id"]==$t["phase_id"])
               
                     <tr>
                    <td>
                    
                     @if($is_manager['0']=='1')
                   
                     <div data-toggle="tooltip" data-placement="left" title="Edit Me !!">
                     <span> 
                     @endif

                       <input type="checkbox" id="chk{{$t['id']}}" disabled  />
                     </span>

                     @if($is_manager['0']=='1')
                   

                      <a  href="#" class="testEdit" data-type="text" data-column="name" data-url="{{url('sop/update/'.$t['id'])}}" data-pk="{{$t['id']}}" data-name="name" data-token="{{ csrf_token() }}">     
                            {{$t["name"]}}
                   </a> <i class="fa fa-cog fa-spin fa-1x "></i></div>
                     @endif

                      @if($is_manager['0']=='0')
                       <a   id="chkk" value="{{$t['id']}}">{{$t["name"]}} </a>
                      @endif


                    </td>


                      <div id="modal" class="modal fade">  <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel"> Allocate Task</h4>
                            </div>
                            <div class="modal-body">
                            <form id="formm" >
                             <div class="form-group">
                             <label class=" col-md-3 col-sm-3 col-xs-3">Member/owner</label><span>
                            
                             <select style="min-width: 200px;" name="myid" id="scco" >
                                               <option vallue="">choose User</option>
                                             
                                              @foreach($member as $id)
                                                  <?php $q=0?>
                                                  @foreach($imcl as $m)
                                                 @if($id->id==$m)
                                                 <?php $q=1;?>
                                                 @endif
                                                 @endforeach
                                                 @if($q!=1)
                                              <option value="{{$id->id}}">{{$id->name}}</option>
                                              @endif
                                             
                                              @endforeach
                                            </select></span>
                                            </div>
                                           
                                 <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-3">Due DATE</label>
                                 <input id="datee" type="date"></input>
                                 </div>
                                  
                                <div class="col-md-3">
                                  <label>Can upload File</label>
                                  
                                  </div>


                                <div class="form-group">
                                 <ul class="radio unstyled">
                    
                     <li>
                       <input class="form-group" type="radio" id="" name="radioo" checked ><span>Yes</span><br/>
                        <input class="form-group" type="radio" id="" name="radioo"><span >No</span>
                     </li>
                                  </div>
                                <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-3">ADD note</label>
                                 <textarea style="min-width: 300px;min-height: 180px;"id="textarea"></textarea><br/>
                                 </div>
                                <input hidden id="taskc"></input>

                             </form>
                            </div>
                            <div class="modal-footer">
                             <input type="button"  id="submittt" name="submit" value="Done"  class="btn btn-info">
                              <a   href="" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            
                            </div>
                            </div>
                           </div>
                          </div>
                <?php $x=1; ?>
                 <?php $y=0; ?>
                 @foreach($assign as $ass)
                 
                  
                     
                     @if($ass->task_id== $t->id)
                       @foreach($member as $m)
                         @if($m->id==$ass->user_id && $ass->project_id==$pr)
                          <?php $y=1; ?>
                         <td>{{$m->name}}</td>
                          
                      <td>{{$ass->due_date}}</td>
                      @if($is_manager['0']=='1')
                      <td >

                      <?php $x=1; 
                       $projectid=$pr;
                       ?>
                       {!! Form::open(array('method' => 'DELETE', 'route' => ['delete_taskss',$t->id,$projectid])) !!}
                        <button type="submit" style="max-height: 30px;max-width: 44px;"class="btn btn-danger btn-xm "><span class="fa fa-trash-o"></span></button>
                      <a href="#modal" data-toggle="modal" id="chkk" value="{{$t['id']}}" onclick="getvaluee({{$t['id']}})"><i  title="Assign Task" class="fa fa-edit fa-lg fa-2x"></i>
                     </a>   
                      {!! Form::close() !!}

                      </td>
                      @endif
                      </tr>

                         @endif
                       @endforeach
                     
                     
                       

                       @endif
                    @endforeach
                       @if($y!=1)
                      <td>non</td>
                      <td>non</td>
                    @if($is_manager['0']=='1')
                       <td >
                      <?php $x=1; ?>
                       {!! Form::open(array('method' => 'DELETE', 'route' => ['delete_task',$t->id,$x])) !!}
                        <button type="submit" style="max-height: 30px;max-width: 44px;"class="btn btn-danger btn-xm "><span class="fa fa-trash-o"></span></button>
                      <a href="#modal" data-toggle="modal" id="chkk" value="{{$t['id']}}" onclick="getvaluee({{$t['id']}})"><i  title="Assign Task" class="fa fa-edit fa-lg fa-2x"></i>

                     </a>
                      {!! Form::close() !!}
                      
                      </td>
                      @endif
                      </tr>

                       @endif

                       @endif
                    <?php $y=0; ?>
                    
                 @endforeach
                <tbody>
               </table>
            @if($is_manager['0']=='1')
            <?php $o=0;?>
             <div class="well well-sm"  >
             <div id="apnd"></div>
               <input type="text"  hidden  value='{{$phs["id"]}}'></input>
                <button type="button" class="btn btn-primary btn-xm" id="modw" onclick="mv($(this).prev().attr('value'));">    
                <span class="pull-left glyphicon glyphicon-plus">
                </span>
               &nbsp;Create a new task                             
              </button>
               
             </div> 

    
                          <!-- Modal start-->
                 <div id="moodal" class="modal fade">  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel"> Create New Task</h4>
                    </div>
                    <div class="modal-body">
                    <form id="formm">
                     <label class="control-label col-md-3 col-sm-3 col-xs-3" id="myphase" >Name of Task</label>
                       <input type="hidden" id="val" value=''></input>
            
                     <input type="text" id="vali" style="border: 1px solid green;"></input>
                      <input type="submit" id="submit" name="submit" value="create"  class="btn btn-info" >
                     </form>
                    </div>
                    <div class="modal-footer">
                      <a   href="" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    
                    </div>
                    </div>
                   </div>
                  </div>
                       <?php $o=$o+1;?>
                  @endif
                <!-- Modal close-->


             </div>

    @endforeach
 
                  
                     </div>
                      
                    <div class="tab-pane" id="2">

                      
                     
                       
                       @foreach($pproject as $roject)
                         <div class="tab-pane" role="tabpanel" id="step3">
                        <form class="" >
                              <div class="well" style="background-color: white" >
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                  <strong > Client</strong>
                                </div>
                                <div class="col-md-3" id="client_nm">
                                   <p align="center" id="clientnm" value=""> {{$client[0]['name']}}</p>
                                </div>
                                
                            </div>    
                        
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" >Project Name</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center " id="projectnm" >{{$roject->name}}</p>
                                </div>
                                
                            </div>    
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center">Subnet </Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center" >{{$roject->subnet_from}} to {{$roject->subnet_to}}</p>
                                </div>
                                
                            </div>    
 
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center">Responsible members</Label>
                                </div>
                                <div class="col-md-4 " style="margin-left: 20px;">
                                    <ul>
                                    @foreach($member as $id)
                                    
                                     <li>{{$id->name}}</li>
                                    @endforeach
                                    </ul>
                                </div>
                                
                            </div>    
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" >Due Date</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center">{{$roject->due_date}}</p>
                                </div>
                                
                            </div>    



                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center">Added Instructions</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center">{{$roject->description}}</p>
                                </div>
                                 
                            </div> 
                              </div>   
                           </form>
                             </div>
                        @endforeach
                        
                       
                    </div>
            <div class="tab-pane" id="3">
                 
                 <div class="panel panel-default" style="margin-top: 10px;" >
                    <!-- Default panel contents -->

                 @foreach($phase as $phsz)
                 @foreach ($idp as $key => $value)
    
                
                     
                     @if($phsz->id==$value->phase_id)        

                    <div class="panel-heading"><strong>{{$phsz->name}}</strong></div>
                     <table class="table">
                        <thead>
                         <tr >
                           <th class="text-center">
                             Task Name
                           </th>
                           <th class="text-center">Due Date</th>
                           <th class="text-center">Status</th>
                         </tr>
                         </thead>
                       <tbody id="table_row">
                      <!--  <tr>
                         <td  style="font-size: 100%;color:black">Tasks</td>
                         <td  style="font-size: 100%;color:black">Due Date</td>
                       </tr> -->
                         @foreach($idd as $t)
                         @foreach($test as $mytas)

                          @if($mytas->id==$t && $mytas->phase_id==$value->phase_id )
                          <tr class="text-center" ><td >
                                <input hidden id="task_fnd_i" value="{{$mytas->id}}"></input>
                              <button class="btn btn-info btn-sm" onclick="fnc($(this).prev().attr('value'),$(this).attr('name'));" name="" id="task_fnd_id{{$mytas->id}}" >        
                                        {{$mytas->name}}
                                    </button>
   <div id="modal_for_mytasks" class="modal fade">  
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"> Task Details</h4>
        </div>
        <div class="modal-body">
        <div class="container">


               
           
        
        <div class="row">
       
              <div id="exTab3" class="container"> 
              <ul  class="nav nav-pills">
                    <li class="active">
                      <a  href="#1b" data-toggle="tab">Detals</a>
                    </li>
                    <li><a href="#2b" data-toggle="tab">View Note</a>
                    </li>
                    <li><a href="#3b" data-toggle="tab">Attachments</a>
                    </li>
                   
                  </ul>

                    <div class="tab-content clearfix well">
                      <div class="tab-pane active" id="1b" style="min-height: 150px">
                      DETAILS Here!
                      </div>
                      <div class="tab-pane" id="2b"style="min-height: 150px">
                      no notes
                          </div>
                      <div class="tab-pane" id="3b"style="min-height: 150px">
                       <div class="row" style="margin-top: 78px;">
                        <div class="col-md-6 " id="hideme">
         
                              <!-- ========= Nessus File Upload ======== -->
                        {!! Form::open(array('url' => 'nessus/upload', 'enctype' => 'multipart/form-data')) !!}

          <div class="col-xs-6">
                  <div class="form-group">
                    <h3>Nessus File Upload</h3> <br>
                    <label>Name: </label> <input type="text" name="name" class="form-control" placeholder="Name the report file"> <br>
                    <label>Choose a project from the following list of your projects</label>
                    <select class="form-control" name="project">
                      <option value="0">Choose a project</option>
                      @foreach($pproject as $project)
                        <option value="{{$project->id}}">{{$project->name}}</option>
                      @endforeach
                    </select><br>
                    <label>Information: </label> <textarea class="form-control" name="information" placeholder="Write Info/Description about the Nessus Souce File"></textarea><br>
                      <div hidden id="apnd_me_id"></div>
                           
                    {!! Form::file('nessus_file_upload') !!}
                    <p class="help-block">Choose .nessus file</p>
                 </div><br>
                 {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!} 
          </div>    

          {!! Form::close() !!}
 
                        </div>   
                       </div>
                      </div>
                   </div>
                  </div>                
               </div>

          </div>   


         <div class="modal-footer">
         
         <a type="button" class="btn btn-success btn-xs">Mark Task completed</a>
        
          <a   href="" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
        
        </div>
        </div>
        
        </div>
       </div>
      

          </td>
          <td> 12/12/16</td>
          <td id="upi{{$mytas->id}}">
          </td>
          </tr>

                          @endif
                        @endforeach
                        @endforeach
                        </tbody>
                        @endif
                   
                     </table>
                      @endforeach
                    
                        @endforeach

                  </div>
               <hr></hr>
              </div>
             
              <!--end of pannels (pannel 3 my tasks) -->

                <div class="tab-pane" id="4">
                
                 <div class="panel panel-default" style="margin-top:10px;" >
                    <!-- Default panel contents -->
                    
                    <div class="panel-heading"><strong>My Attachments</strong></div>
                     <table class="table">
                        <tr><th class="text-center">File Name</th>
                        <th class="text-center">Task Name</th>
                        <th class="text-center">Action</th></tr>
                       <tbody id="table_row">
                  
                   @foreach($upl as $up)
                   @foreach($task_file as $ts)
                    @if($up->task_id==$ts['id'])
                      <tr>
                      <td class="text-center">{{$up->name}}</td>
                     <td class="text-center">{{$ts['name']}} </td>
                    <td class="text-center">  
                    <div>

                    <a onclick="delete_file(this.id,this.name)"id="{{$up->id}}" name="{{$ts['id']}}"><span class="glyphicon glyphicon-remove"></span></a>
                    
                     <a onclick="update_file(this.id)"id="{{$up->id}}" name="{{$ts['id']}}"style="margin-left: 5px;"><span class="glyphicon glyphicon-edit"></span></a>
                     </div></td>
                    </tr>
                    @endif
                    @endforeach
                   @endforeach
             
                        </tbody>
                     </table>
                  </div>
                                  <!-- Modal start-->
                 <div id="modal_up" class="modal fade">  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel"> Update File</h4>
                    </div>
                    <div class="modal-body">
                   
                  <form enctype="multipart/form-data" id="upload_form" >
                    <label >Name: </label> 
                    <input type="text" name="name" id="name_up" class="form-control" placeholder="Name the report file"> <br>
                    <label>Choose a project from the following list of your projects</label>
                    <label>Information: </label> <textarea id="text_up"class="form-control" name="information" placeholder="Write Info/Description about the Nessus Souce File"></textarea><br>
                      <input hidden id="up_id" name="id" value=""></input> 
                     {!! Form::file('nessus_file_upload') !!}
                    <p class="help-block">Choose .nessus file</p>
                    <button type="button" id="submit_upload" value="Submit">Submit</button>
                  </form>
               
                    
                    </div>
                    <div class="modal-footer">
                      <a   href="" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    
                    </div>
                    </div>
                  
                  </div>
                      
                <!-- Modal close-->

              </div>
              </div>
              </div>
       </div>       
      </div>  
     </div>
     @endif
    </div>
</div>
<script type="text/javascript">
    $("#im").on('click', function() {
   $("#dom").fadeIn();
 
});
</script>
<script type="text/javascript">
  
  function mv(we) { var x = we;
  $('#apnd').append('<input  hidden name="myfieldname" id="val" value='+x+' />');
  
$('#moodal').modal('show'); 
 
}
</script>
<script type="text/javascript">
  
  function fnc(we,nam) { var x = we;
  $('#apnd_me_id').append('<input  hidden name="tskid" id="tskid" value='+x+' />');
  // alert(nam);
  if(!nam){
$('#modal_for_mytasks').modal('show'); }
 if(nam=="uploaded"){
  $('#hideme').hide();
$('#modal_for_mytasks').modal('show'); }
}
</script>


<script type="text/javascript">
  var y = "{{$link}}";
  console.log(y);
 document.getElementById("projects_tasks").href= y;
 
</script>
<script type="text/javascript">
      
      function hreff(){
        document.getElementById("projects_tasks").href= "/projects_tasks";
        window.location.href="/projects_tasks";

      }

    </script>

  @if($iam!=0)
    <script >
    @foreach($chekedtask as $ch)
    var x={{$ch['task_id']}};
$('input:checkbox[id^="chk"]').each(function(){
 var p= this.id.substr(3,this.id.length);

if(p==x){
$("#" + this.id).prop('checked', true);

}

    });


    
@endforeach;
@foreach($uploads as $up)
    var x={{$up}};

$("[id^='upi']").each(function(){

  var p=this.id.substr(3,this.id.length); 
  
 if(p==x){
$("#upi" + x).append('file uploaded');
$("[id^='task_fnd_id']").each(function(){
  var j=this.id.substr(11,this.id.length);
   if(j==x){

$('#task_fnd_id'+x).attr('name','uploaded');
}
});
}
    });


    
@endforeach;

    </script>
    
    <script type="text/javascript">
      function update_file(id){
        $('#up_id').val(id);
         @foreach($upl as $up)
         var p={{$up->id}};
           if (p==id) {
            $('#name_up').val("{{$up->name}}");
            $('#text_up').val("{{$up->info}}");
      
           }
         @endforeach


        $("#modal_up").modal('show');
               


      }


    </script>
    
    
@endif
@endsection
