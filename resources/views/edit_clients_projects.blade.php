
@extends('layouts.main2')

@section('title','File Upload')

@section('user_name','Labeeb')

@section('user_role','Admin')


@section('scripts')
<link href="{{URL::asset('build/css/dashbord3.min.css')}}">

    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

<style type="text/css">
  .animated{-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:both;animation-fill-mode:both}.animated.infinite{-webkit-animation-iteration-count:infinite;animation-iteration-count:infinite}.animated.hinge{-webkit-animation-duration:2s;animation-duration:2s
}@-webkit-keyframes zoomIn{0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}50%{opacity:1}}@keyframes zoomIn{0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}50%{opacity:1}}.zoomIn{-webkit-animation-name:zoomIn;animation-name:zoomIn}
@-webkit-keyframes zoomOut{0%{opacity:1}50%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}100%{opacity:0}}@keyframes zoomOut{0%{opacity:1}50%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}100%{opacity:0}}.zoomOut{-webkit-animation-name:zoomOut;animation-name:zoomOut}

#accordion .panel-title i.glyphicon{
    -moz-transition: -moz-transform 0.5s ease-in-out;
    -o-transition: -o-transform 0.5s ease-in-out;
    -webkit-transition: -webkit-transform 0.5s ease-in-out;
    transition: transform 0.5s ease-in-out;
}

.rotate-icon{
    -webkit-transform: rotate(-225deg);
    -moz-transform: rotate(-225deg);
    transform: rotate(-225deg);
}

.panel{
    border: 0px;
    border-bottom: 1px solid white;
}
.panel-group .panel+.panel{
    margin-top: 0px;
}
.panel-group .panel{
    border-radius: 5px;
}
.panel-heading{
    border-radius: 0px;
    color: black;
}
.panel-custom>.panel-heading{
    background-color: #dedfe0;
}
.panel-group .panel:last-child{
    border-bottom: 1px solid grey;
}

.panel-collapse .collapse.in{
    border-bottom:0;
}

</style>

<script type="text/javascript">
var x;
  function client(id){
   // alert(id);
  
    something = "/edit_clients_projects/" + id;


       //alert("asd");
    window.location.href=something;
  
  


  }


</script>
@endsection

@section('content')

 <div class="right_col" role="main">
          <div class="container container-fluid">
    
              <div class="row">
                  <div class="col-md-8 col-sm-8 col-lg-8 ">
                    <h4>Clients and their Projects</h4>
                  </div>
              </div>


              <div class="row">
                  <div class="col-md-8 col-sm-8 col-lg-6 ">
                      <div class="ccms_form_element cfdiv_custom" id="style_container_div">
                          
                         
                         @if($iamzeo==0)
                          <select size="1" id="beerStyle" class="form-control" title="" type="select" name="style"
                           onchange="client(this.value)" >
                              <option value="0">-Choose A Client-</option>
                              @foreach($clients as $client) 


                              <option value="{{$client->id}}" name="clients[]">{{$client->name}}</option>
                              @endforeach
                             
                          </select>
                          @endif


                         @if($iamzeo==1)
                          <select size="1" id="beerStyle" class="form-control" title="" type="select" name="style"
                           onchange="client(this.value)">
                              <option value="0">-Choose A Client-</option>
                              @foreach($clients as $client)                              
                              <option value="{{$client->id}}"<?php if($client->id== $id) echo "selected";?> name="clients[]">{{$client->name}}</option>
                              @endforeach
                             
                          </select>
                          @endif

                          
                          <div class="clear"></div>
                          <div id="error-message-style"></div>
                      </div>
                      
                     
                     <div class="clear"></div><div id="error-message-style-sub-1"></div>

                  </div>  
              </div>


       <br/>
       <br/>


       <!--<div id="blah" class="hidden">
         -->
         @if($iamzeo!=0)

         <div class="panel-group" id="accordion">
            <div class="panel panel">
            <div class="panel-heading">

               <div class="row">
               <div class="col-md-9">

              
                 <div class="row">
                            <div class="col-md-3" style="margin-left: 10px">
                            <LABEL>Client</LABEL>
                            </div>
                            <div class="col-md-6">
                          <!--  <p>{{$client->name}}</p> -->
                            <a href="#" class="myedit" data-type="text" data-column="name" data-url="{{url('edit_clients_projects/updatee/'.$client_id[0])}}" data-pk="{{$client_id[0]}}" data-name="name" data-token="{{ csrf_token() }}">     
                            {{$client_name[0]}}
                   </a>
                            </div>
                            </div>
                 </div>
                       
                
               
                <div class="col-md-3">
               <p>**Blue underlined Text is editable **</p>
                </div>
                </div>
                <?php $p=0;?>
                    @foreach($projects as $project)
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">    
         
            <div class="panel panel-custom">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" value="{{$project->id}}" name="projects[]" data-parent="#accordion" href="#{{$p}}" aria-expanded="true" aria-controls="collapseOne">
                            <i style="color:white"class="glyphicon glyphicon-plus"></i>
                             {{$project->name}}
                        </a>
                    </h4>
                </div>
                <div id="{{$p}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body animated zoomOut">
                       <div class="row">
                       <div class="col-md-9">
                       <form >

                            <div>
                            <div class="row">
                            <div class="col-md-3">
                            <LABEL>Created by</LABEL>
                            </div>
                            <div class="col-md-6">
                            <p>{{$m->name}}</p>
                            </div>
                            </div>
                        

                         
                       </form>
                       </div>
                      
                       </div>
                    </div>
                </div>
            </div>
                
               
             
                
                 </div>
                 <?php $p=$p+1;?>
                  @endforeach   
      

              </div>
              </div>
              </div>
              </div>
                 @endif

    </div>
    </div>
</div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 


<script type="text/javascript">
  var y = "{{$link}}";
  console.log(y);
 document.getElementById("projects_edit").href= y;
 
</script>
<script type="text/javascript">
      
      function hreff(){
        document.getElementById("projects_edit").href= "/edit_clients_projects";
        window.location.href="/edit_clients_projects";

      }

    </script>

    
  

<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

  
<script>
$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
    $('.myedit').editable({
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
$(function() {

    function toggleChevron(e) {
        $(e.target)
                .prev('.panel-heading')
                .find("i")
                .toggleClass('rotate-icon');
        $('.panel-body.animated').toggleClass('zoomIn zoomOut');
    }
    
    $('#accordion').on('hide.bs.collapse', toggleChevron);
    $('#accordion').on('show.bs.collapse', toggleChevron);
})

</script>
        

       

       



@endsection
