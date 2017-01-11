
@extends('layouts.main2')

@section('title','File Upload')

@section('user_name','Labeeb')

@section('user_role','Admin')


@section('scripts')

 

<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

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

<script type="text/javascript">
   
 $(function () {

 $("#submit").click(function() {
    var x=$('#vali').val();
    var y=$('#val').val();

          

   
   $.ajax({
            url: 'create_task_sop_custom',
            method: 'POST',
            dataType: 'JSON',
            data: {'x':x ,'y':y},
            success: function(data) {
               
                console.log('success');
                 
                var new_task ='<tr><td><a href="" data-column="name" data-url="{{url("sop/update/'+data.id+'")}}" data-pk="{{'+data.id+'}}" data-name="name" data-token="{{ csrf_token() }}class="testEdit" data-type="text" ">'+data.name+'</a></td> <td><button type="submit" class="btn btn-danger btn-sm pull-left">Delete</a></td></tr>';                 
                $("#table_row").append(new_task);
                $("#moodal").modal('hide');
               

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

   
   $.ajax({
            url: 'create_phase_sop_custom',
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

   
<div class="right_col" role="main">
  <div class="container container-fluid">
 
    <div class="row">
     <div class="col-md-10" style="margin: 10px;">
    
    <h3 class="bg-primary" style="max-width:300px;border-radius: 10px;">.Edit Create Sop Phases.</h3>
    <h6 class="bg-danger" style="max-width:150px ;border-radius: 20px;">Every text is Editable.</h6>
   
  </div>
        <div class="col-md-9" style="margin: 50px;">

              
              @foreach($phase as $phs)

          <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading" style="color:white;background-color: #ededed; ">
            <div class="row" >
            
            <div class="col-md-10">
            <div style=" " >
            <h5 data-toggle="tooltip" data-placement="left" title="Edit Me !!">
             <a  style="color: black;" href="#" class="testEdit" data-type="text" data-column="name" data-url="{{url('sop/update/'.$phs->id)}}" data-pk="{{$phs->id}}" data-name="name" data-token="{{ csrf_token() }}">     
                            <h3 style="color:#757272">{{$phs->name}}</h3>
                   </a></h5>
                   </div>
                   </div>
                   <div class="col-md-2 text-right">
                   <?php $x=0; ?>
                       {!! Form::open(array('method' => 'DELETE', 'route' => ['delete_phase',$phs->id])) !!}
                        <button style="margin-right:0px;"type="submit" class="btn btn-danger btn-sm text"><span class="glyphicon glyphicon-remove"></span></button>
                      {!! Form::close() !!}
                   </div>
                   </div>




            </div>
              
              <table class="table table-striped" >
            
                
               <tbody id="table_row">
                @foreach($task as $t)
                @if($phs->id==$t->phase_id)
                <tr >
                 <td data-toggle="tooltip" data-placement="left" title="Edit Me !!">
                   <a  href="#" class="testEdit" data-type="text" data-column="name" data-url="{{url('sop/update/'.$t->id)}}" data-pk="{{$t->id}}" data-name="name" data-token="{{ csrf_token() }}">     
                            {{$t->name}}
                   </a>
                 </td>
                  <td style="float:right">
                  <?php $x=0; ?>
                       {!! Form::open(array('method' => 'DELETE', 'route' => ['delete_task',$t->id,$x])) !!}
                        <button type="submit" class="btn btn-info btn-sm pull-left"><span class="glyphicon glyphicon-minus"></span></button>
                      {!! Form::close() !!}
                  </td>
                </tr>
                @endif

              @endforeach
                </tbody>
               </table>
             <div >
              <a  href="#moodal" data-toggle="modal">    
                <span class="pull-left glyphicon glyphicon-plus">
                </span>
                <h5>&nbsp;Create a new task</h5>                             
              </a>
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
          <div class="col-md-1">
              <a  href="#mod" data-toggle="modal"> <button type="button" class=" btn btn-primary"value="Create Phase">Create Phase</button></a>
            
          </div>

            
       </div>

</div>
</div>



@endsection
