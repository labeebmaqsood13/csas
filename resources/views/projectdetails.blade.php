



@section('scripts')

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





</style>
<script type="text/javascript">
 

$(document).ready(function(){
  
    $("select").change(function(){
    var x =$('#sco').val();

            console.log("story",x,"story");
   
   $.ajax({
            url: 'user_add',
            method: 'POST',
            dataType: 'JSON',
            data: {'x':x},
            success: function(data) {
               
                console.log('success');
                 location.reload();
                 
              
               

            }
           
        });

      });
     });


</script>
<script type="text/javascript">
 

$(document).ready(function(){
  
    $("#submittt").click(function(){
    var membr=$('#scco').val();
    var dat=$('#datee').val();
    var projectid=1;
    var taskid=$('#taskid').val();

            console.log(membr,dat,projectid,taskid);
   
   $.ajax({
            url: 'assign_member',
            method: 'POST',
            dataType: 'JSON',
            data: {'membr':membr,'dat':dat,'projectid':projectid,'taskid':taskid},
            success: function(data) {
               
                console.log('success');
                 //location.reload();
                 
              
               

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

            console.log("story",x,"story");

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
                //location.reload();
               

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
    //var y=$('#val').val();

            console.log("story",x,"story");

            //alert(y);
   
   $.ajax({
            url: 'create_phase_sop',
            method: 'POST',
            dataType: 'JSON',
            data: {'x':x },
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
                        <div class="col-md-6 text-right">
                      <form >
                           <div class="form-group">
                          <label>Subnet</label>
                          <input type="text"style="min-height:26px;border: 1px solid #989faa">
                        </div>
                      </form>
                          </div>
                      <div class="col-md-4 text-left">
                          <span class="btn btn-default btn-file ">
                          File Upload <input type="file">
                          </span>
                    
                       </div>
                      </div>
                   </div></div>                 </div>

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
      
    <!-- Modal close-->

<div class="right_col" role="main">
  <div class="container">

    
    <div class="row">
    <div class="col-md-3">
    <div style="border-right: 1px solid">
<!--     <div class="panel panel-default">
               Default panel contents               <div class="panel-heading">SUMMARY</div>

   
                <div>
                <div class="row">
                <div class="col-md-4">
                <LABEL>Task Name</LABEL>
                </div>
                <div class="col-md-6">
                <p>Scan this and that</p>
                </div>
                </div>
                <div class="row">
                <div class="col-md-4">
                <LABEL>Created by</LABEL>
                </div>
                <div class="col-md-6">
                <p>faisal</p>
                </div>
                </div>
                <div class="row">
                <div class="col-md-4">
                <LABEL>Created at</LABEL>
                </div>
                <div class="col-md-6">
                <p>1/1/1</p>
                </div>
                </div>
               </div>
 


                </div> -->



                <div class="panel panel-default" style="min-height: 300px">
                          <!-- Default panel contents -->
                          <div class="panel-heading">Members Added</div>
                      <div style="margin-top:6px;margin-left: 5px;">
                      
                      Add Member
                       <select  name="myid" id="sco"style="min-width: 160px;min-height: 30px;border: 1px solid;">
                           <option vallue="">choose User</option>
                          @foreach($user as $usr)
                          <option value="{{$usr->id}}">{{$usr->name}}</option>
                          @endforeach
                        </select>
                      
                      
                        
                      </div>
                         <div style="margin-top: 50px;">
                          <ul>
                            @foreach($member as $id)
                          <div class="row">
                          <div class="col-md-6 ">
                           <li>{{$id->name}}</li></div>
                           <div class="col-md-6">
                           <!-- {{$id->id}}
                           -->

                           {!! Form::open(array('method' => 'DELETE', 'route' => ['delete_member',$id->id])) !!}
                           <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                           {!! Form::close() !!}
                           </div>
                               </div>
                        @endforeach
                             
                            

                          </ul>
                          </div>

                          <div style="text-align: center;margin-top: 20px;"> <button type="button" class="btn btn-success" >Invite User</button></div>
                </div>
           

          
            </div>
            </div>
            
      


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
            </ul>

                <div class="tab-content ">
                  <div class="tab-pane active" id="1">
                         <div class="col-md-12"></div><br/>
                          <a  href="#mod" data-toggle="modal"> <button type="button" class=" btn btn-primary"value="Create Phase">Create Phase</button></a>
                       
                     
                          
          @foreach($phase as $phs)

          <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading" style="color:white;background-color: grey; ">
            <div style="color:white" >
            
                {{$phs->name}}
                  
                   </div>
             </div>

              <table class="table " >
            
                
               <body>
               <tr>
                 <td>TASK </td>
                 <td>Assigned Member</td>
                 <td>Due Date</td>
                 <td>Action</td>
               </tr>
                @foreach($test as $t)
                @foreach($assign as $ass)
                @if($phs->id==$t->phase_id)
                <tr>
                 <td>
                   <a href="#modal" data-toggle="modal" >{{$t->name}}</a>
                 </td>
                 @if($t->id==$ass->task_id)
                 @foreach($member as $m)
                 @if($m->id==$ass->user_id)
                 <td>{{$m->name}}</td>

                 @endif
                 @endforeach
                 <td>{{$ass->due_date}}</td>
                 @else <td>Not assigned</td><td>none</td>
                 @endif
                 

           
                 

                  <td >
                    <?php $x=1; ?>
                       {!! Form::open(array('method' => 'DELETE', 'route' => ['delete_task',$t->id,$x])) !!}
                        <button type="submit" class="btn btn-danger btn-sm "><span class="glyphicon glyphicon-remove"></span></button>
                      {!! Form::close() !!}
                  </td>
                </tr>
                @endif
               
              @endforeach
              @endforeach
                <body>
               </table>
             <div class="well well-sm" >
              <a  href="#moodal" data-toggle="modal">    
                <span class="pull-left glyphicon glyphicon-plus">
                </span>
               &nbsp;Create a new task                             
              </a>
             </div> 

     <div id="modal" class="modal fade">  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"> Allocate Task</h4>
        </div>
        <div class="modal-body">
        <form id="formm">
         <div>
         <label class="control-label col-md-3 col-sm-3 col-xs-3">Member/owner</label>
        
         <select  name="myid" id="scco" style="min-width: 160px;min-height: 30px;border: 1px solid;">
                           <option vallue="">choose User</option>
                          @foreach($member as $id)
                          <option value="{{$id->id}}">{{$id->name}}</option>
                          @endforeach
                        </select>
                        </div>
                        <div style="margin-top: 7px;">
             <label class="control-label col-md-3 col-sm-3 col-xs-3">ADD note</label>
             <textarea id="textarea"></textarea><br/>
             </div>
             <div style="margin-top: 7px;">
             <label class="control-label col-md-3 col-sm-3 col-xs-3">Due DATE</label>
             <input id="datee" type="date"></input>
             </div>
              <div class="row">
            <div class="col-md-3">
              <label>Can upload File</label>
              
              </div>

            <div class="col-md-3">
            <ul>
                  <li><input type="radio">Yes </li>
                      <li><input type="radio">No </li>
              </ul>
              </div>
            </div>
           <input type="hidden" id="phaseid" value="{{$phs->id}}"></input>
           <input type="hidden" id="taskid" value="{{$t->id}}"></input>
         </form>
        </div>
        <div class="modal-footer">
         <input type="button"  id="submittt" name="submit" value="Done"  class="btn btn-info">
          <a   href="" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
        
        </div>
        </div>
       </div>
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
                     <input type="hidden" id="val" value="{{$phs->id}}"></input>
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
                <!-- Modal close-->


             </div>

    @endforeach
 
                  
                     </div>
                      
                    <div class="tab-pane" id="2">
              
                       <div class="tab-pane" role="tabpanel" id="step3">
                       @foreach($pproject as $roject)
                              <div class="well" style="background-color: white">
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                  <strong style="color: black"> Client</strong>
                                </div>
                                <div class="col-md-3" id="client_nm">
                                   <p align="center" id="clientnm" value=""> {{$roject->client_id}}</p>
                                </div>
                                
                            </div>    
                        
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Project Name</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center " id="projectnm" >{{$roject->name}}</p>
                                </div>
                                
                            </div>    
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Subnet </Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center" >{{$roject->subnet_from}} to {{$roject->subnet_to}}</p>
                                </div>
                                
                            </div>    
 
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Responsible members</Label>
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
                                   <Label align="center" style="color: black">Due Date</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center">{{$roject->due_date}}</p>
                                </div>
                                
                            </div>    



                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Added Instructions</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center">{{$roject->description}}</p>
                                </div>
                                 
                            </div> </div>   

                        </div>
                        @endforeach
                           
                    </div>
            <div class="tab-pane" id="3">
                 <hr></hr>
                 <div class="panel panel-default" >
                    <!-- Default panel contents -->
                    
                    <div class="panel-heading"><strong>PHASE-1</strong></div>
                     <table class="table">

                       <tbody id="table_row">
                      <!--  <tr>
                         <td  style="font-size: 100%;color:black">Tasks</td>
                         <td  style="font-size: 100%;color:black">Due Date</td>
                       </tr> -->
                         @foreach($test as $t)
                          <tr><td>
                              <a  href="#modal_for_mytasks" data-toggle="modal">        
                                        {{$t->name}}
                                    </a>
                          </td>
                          <td> 12/12/16</td>
                          </tr>

                        @endforeach
                        </tbody>
                     </table>
                  </div>

               <hr></hr>
              
            


              </div>
             
              <!--end of pannels (pannel 3 my tasks) -->

                <div class="tab-pane" id="4">
                 <hr></hr>
                 <div class="panel panel-default" >
                    <!-- Default panel contents -->
                    
                    <div class="panel-heading"><strong>My Attachments</strong></div>
                     <table class="table">

                       <tbody id="table_row">
                      <!--  <tr>
                         <td  style="font-size: 100%;color:black">Tasks</td>
                         <td  style="font-size: 100%;color:black">Due Date</td>
                       </tr> -->
                        <!--  @foreach($test as $t)
                          <tr><td>
                              <a  href="#modal_for_mytasks" data-toggle="modal">        
                                        {{$t->name}}
                                    </a>
                          </td>
                          <td> 12/12/16</td>
                          </tr>

                        @endforeach
                         -->
                        </tbody>
                     </table>
                  </div>

               <hr></hr>
              
              </div>
              
              </div>
       </div>       
      </div>  
     </div>
    </div>
</div>
<script type="text/javascript">
    $("#im").on('click', function() {
   $("#dom").fadeIn();
 
});
</script>



@endsection