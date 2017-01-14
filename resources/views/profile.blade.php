@extends('layouts.main2')

@section('title','Activity Dashboard')

@section('user_name')
	{{ Auth::user()->name }}
@endsection

@section('user_role')
  {{Auth::user()->role()->first()->name}}
@endsection

@section('scripts')

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<style type='text/css'>
	a.previous { display: none; }
	.demo { width:960px; margin:50px auto;}
	

	table tr { display: none; }

	table tr:nth-child(-n+8) { display: table-row; }
	</style>


<script type="text/javascript">
   
 $(function () {

 $(".sub").click(function() {
    var x=location.href;
    
    var y= new FormData($("#mform")[0]);

   $.ajax({
            url: x,
            method: 'POST',
            dataType: 'JSON',
            async:false,
            processData: false,
            contentType: false,
            data:new FormData($("#mform")[0]),
            success: function(data) {
               
                console.log('success');
                 
               alert("i am here");

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
 <!-- page content -->
      <div class="right_col" role="main">
        <div style="min-height:750px;">
    <div class="row">
    @if($p==0)
    
             

              <div class="col-md-5 text-center" style="margin-left:290px;" >
                <div  class="x_panel" >
                 <div class="x_title">
                    <h2>My Profile</h2>
                  <div class="clearfix"></div>  
                  <div class="x_content">
                    <br />
                   
                       <div class="form-control">
                       <label>Name : </label>             {{$userdata->name}}  
                       </div>
                        <div class="form-control">
                       <label>Email :</label>            {{$userdata->email}}
                       </div>
                       
                       <div class="form-control">
                       <label>Role : </label>               {{$role->name}} 
                       </div>
					
					<div class="row">
					    <div class="col-md-4">
                
                      <img height="250" width="210" style="border-radius: 100px;margin-top:10px;margin-left: 95px;"src="{{URL::asset('uploads/'.$userdata->image_url)}}" class="rounded mx-auto d-block" >

                    </div>
                    </div>
                      
                       
                     
                     
                  </div>                
                 </div>
                </div>
              </div>
              <!-- /form input mask -->

              <!-- form color picker -->
             <div class="col-md-12 text-center">
             <button style="border-radius:20px" class="btn btn-success"onclick="project(this.value)" id="vl" value="{{$userdata->id}}">
                          Edit Details
                           </button> 
              </div>
          
              </div>
    @endif
    @if($p==1)
               <div class="col-md-5 text-center" style="margin-left:290px;" >
                <div  class="x_panel" >
                 <div class="x_title">
                    <h2>My Profile</h2>
                  <div class="clearfix"></div>  
                  <div class="x_content">
                    <br />
                     
                      {!! Form::open(array('url' => 'profile/uploadd', 'enctype' => 'multipart/form-data')) !!}
                       <div class="form-control">
                       <label>Name : </label> <input style="max-height: 22px;"name="name" value="{{$userdata->name}}"/>  
                       </div>
                        <div class="form-control">
                       <label>Email :</label> <input style="max-height: 22px;" name="email" value="{{$userdata->email}}"/>
                       </div>
                       
                       <div class="form-control">
                       <label>Role : </label>               {{$role->name}} 
                       </div>
          
				          <div class="row">
				              <div class="col-md-4">
					                
	                      <img  height="250" width="210" style="border-radius: 100px;margin-top:10px;margin-left: 95px;"src="{{URL::asset('uploads/'.$userdata->image_url)}}" class="rounded mx-auto d-block" >
	                     
							    {!! Form::file('image', null) !!}
							</div>
                            </div>
							<div class="form-group" style="margin-top: 12px;">
							   <input type="submit" name="submit" value="save"style="border-radius:20px" class="btn btn-success"></input>
							     <a href="/profile" style="max-width:70px;border-radius:20px" class="btn btn-danger">Cancel</a>
							</div>
							{!! Form::close() !!}
							
                       
                     
                     
                  </div>                
                 </div>

                </div>
              </div>
           
          
              </div>
             
              <!-- /form color picker -->
              @endif

             </div>
            </div>


        <!-- /page content -->

  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>




<script type="text/javascript">
var x;

 

  function project(id){
   // alert(id);
     var idd=id;
     something=location.href;
window.location.href=something+id;
  
  


  }


</script>


@endsection