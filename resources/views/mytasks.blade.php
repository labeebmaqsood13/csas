
@extends('layouts.main2')

@section('title','File Upload')

@section('user_name')
  {{ Auth::user()->name }}
@endsection

@section('user_role')
  {{Auth::user()->role()->first()->name}}
@endsection

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
    border-radius: 1px;
    color: white;
}
.txt{
  color:black;
}
.panel-custom>.panel-heading{
    background-color: #374d63;
}
.panel-group .panel:last-child{
    border-bottom: 1px solid #374d63;
}

.panel-collapse .collapse.in{
    border-bottom:0;
}

</style>

</script>
@endsection

@section('content')


 <div class="right_col" role="main">
          <div class="container container-fluid">
    

            @if($notaskassigned == 1)
              <div class="row">
                  <div class="col-md-8 col-sm-8 col-lg-8 ">
                    <h4>No tasks Assigned yet.</h4>
                  </div>
              </div>

            @else    

              <div class="row">
                  <div class="col-md-8 col-sm-8 col-lg-8 ">
                    <h4>Assignments</h4>
                  </div>
              </div>



       <br/>
       <br/>


         <div class="panel-group" id="accordion">
            <div class="panel panel">
            <div class="panel-heading">

               <div class="row">
                </div>
                <?php $p=0;?>
                    @foreach($taskname as $m)
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">    
         
            <div class="panel panel-custom">
                <div class="panel-heading" role="tab" id="headingOne">
                  
                    <h4 class="panel-title">
                        <a data-toggle="collapse" value="{{$m['task_id']}}" name="projects[]"  href="#{{$p}}" aria-expanded="true" aria-controls="collapseOne">
                            <i style="color:white"class="glyphicon glyphicon-plus"></i>
                             {{$m['name']}}
                        </a>
                         <span style="margin-left:30px;">
                      @if($m['status']=='pending')
                      <m class="badge badge-danger">Pending</m>
                      @endif</span>
                      @if($m['status']!='pending')
                      <m class="badge badge-danger">Completed</m>
                      @endif</span>
                    </h4>


                </div>
                <div id="{{$p}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                       <div class="row">
                       <div class="col-md-9">
                       <form >

                            <div class="txt">
                            <div class="row">
                            <div class="col-md-3">
                            <LABEL>Project</LABEL>
                            </div>
                            <div class="col-md-6">
                            <p>{{$m['project']}}</p>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3">
                            <LABEL>Task</LABEL>
                            </div>
                            <div class="col-md-6">
                            <p>{{$m['name']}}</p>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3">
                            <LABEL>Phase</LABEL>
                            </div>
                            <div class="col-md-6">
                            <p>{{$m['phasename']}}</p>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3">
                            <LABEL>Due Date</LABEL>
                            </div>
                            <div class="col-md-6">
                            <p>{{$m['date']}}</p>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3">
                            <LABEL>Status</LABEL>
                            </div>
                            <div class="col-md-6">
                            <p>{{$m['status']}}</p>
                            </div>
                            </div>
                        

                         
                       </form>
                       </div>
                      
                       </div>
                    </div>
                </div>
            </div>
                
               
             
                 <?php $p=$p+1;?>  
                 </div>
              
                  @endforeach   
      

              </div>
              </div>
              </div>
              </div>
               

    </div>
          @endif
    </div>
</div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 


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
