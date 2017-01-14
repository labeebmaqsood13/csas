@extends('layouts.main2')

@section('title','Roles')

@section('user_name')
  {{ Auth::user()->name }}
@endsection

@section('user_role')
  {{Auth::user()->role()->first()->name}}
@endsection
@section('scripts')

@endsection

@section('scripts')
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

  @if(Session::has('success'))
     <script type='text/javascript'>
              console.log('Another Here');
              $('#success').modal('show');

    </script>
  @endif


@endsection

@section('content')

<div class="right_col" role="">
          
            <div class="page-title">
              <div class="title_left">
                <h3>Roles Info</h3>
              </div>
         
      <div id="div1" class="">
              
             <div class="row">
              <div class="col-md-8 col-sm-8 col-lg-12">
                <div class="x_panel">

					<table id="myTable" class="table table-bordered table-striped">
					  <thead  >
					      <tr align="center">
                  <td scope="row" ><b>#</b></td>
                  <td id="name"><b>Role Name</b></td>
                  <td><b>Members</b></td>
                  <td><b>Action</b></td>
                </tr>
					  </thead>
					  
					  <tbody>
                <?php $x=1;?>
              @foreach($roles as $role)
  					    <tr align="center">
  					      <td scope="row"><?php echo $x;?></td>
  				        <td id="name"> {{$role->name}} </a></td>
                  <td> {{$role->user()->where('role_id',$role->id)->count()}} </td>
                  <td clas>
                    <a  onclick="mv($(this).attr('value'),$(this).attr('id'))"id="{{$role->name}}" value="{{ $role->id }}" class="btn btn btn-primary btn-sm ">Edit Members</a>
                  </td>
  					    </tr>
                <?php $x=$x+1;?>
              @endforeach
                
					  </tbody>
					   
					</table> 
           <div id="moodal" class="modal fade">  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel"> Add /Remove Members</h4>
                    </div>
                    <div class="modal-body">
                    <form id="formm">
                     <div class="row">
                     <div class="col-md-6">
                     <label class="control-label" id="myphase" ><h4>Role : </h4></label><span  style="margin-left:30px;"id="1"></span></div>
                     <div class="col-md-5" >
                    <h4 style="border-bottom:1px solid"> List of Members(selected)</h4>
                    <select id="select_role" value="" style="border:none;min-width: 270px" multiple >
                      @foreach($users as $user)
                      <option id="{{$user->name}}" value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                    </div></div>
                     
                     </form>
                    </div>
                    <div class="modal-footer">
                     <button type="button" class="btn btn-sucess" onclick="selected($(this).attr('value'),$(this).attr('id'))" value="" id="imrole" class="btn btn-info" >Done</button>
                      <a type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    
                    </div>
                    </div>
                   </div>
                  </div>
  				</div>
	          <div class="text-center">
               {!! $roles->render() !!}
            </div>
	        </div> 
	        </div>
	        </div>           
            </div>
          <div class="clearfix"></div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
        <script>
       
  function mv(we,y) { var x = we;

   
   $.ajax({
            url: 'roledata',
            method: 'POST',
            data: {'x':x },
            success: function(data) {
               var va=Object.values(data);
                var length=Object.keys(data).length;
              var v;
                $('#1').append(y);
              for(v=0;v<length;v++){
               $('#select_role option[id=' + va[v] + ']').prop('selected', true);
                
              }
           
           $('#imrole').prop('value',we);
                $('#moodal').modal('show'); 
               
               

            },
            error: function(data) {
                console.log("storystory");
            }
        });

   
}
 function selected(id){
 
          var items = [];
$('#select_role option:selected').each(function(){ items.push($(this).val()); });
var result = items.join(', ');

    $('#1').empty();
                $('#moodal').modal('hide'); 

                $.ajax({
            url: 'roledatachange',
            method: 'POST',
            data: {'x':items,'y':id },
            success: function(data) {
              location.reload();
                
              
            
                
            },
            error: function(data) {
                console.log("storystory");
            }
        });

               }
</script>

<script type="text/javascript">
  
 
</script>
  
@endsection


