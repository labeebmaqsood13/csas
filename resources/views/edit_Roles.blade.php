<body>
<div class="row">
              <!-- form input mask -->
          


              <div class="col-md-5" style="margin-left:170px;">
                <div  class="x_panel">
                 <div class="x_title">
                    <h5>User Details</h5>
                  <div class="clearfix"></div>  
                  <div class="x_content">
                    <br />

                    <form class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Full Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                        <w class="form-control" value="{{$userdata->name}}">
                        {{$userdata->name}}</w>
                          
                          
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <w  class="form-control" value="{{$userdata->email}}">{{$userdata->email}}</w>
                          </div>
                      </div>
                     
                       <div class="text-center">
                      <img hight="290" width="260" style="border-radius: 100px;"src="{{URL::asset('uploads/'.$userdata->image_url)}}"  >
                        </div>
                     
                     
                    </form>
                   
                  </div>                
                 </div>
                </div>
              </div>
              <!-- /form input mask -->

              <!-- form color picker -->
              <div class="col-md-3" >
                <div class="x_panel" style="min-height: 313px;">
                  <div class="x_title">
                    <h5>Edit User's Roles</h5>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    

                      
                                        
                        

                       
              <div class="wrapper">
                <div class="content">
                <form class="for-group">
                   <ul class="radio unstyled">
                     @foreach($allrole as $rol)
                     <li>
                       @if($rol->id==$rolee->id)
                       <input class="form-group" type="radio" id="chk{{$rol->id}}" name="radioo" checked ><span style="margin-left: 10px;">{{$rol->name}}</span>
                       @endif
                        @if($rol->id!=$rolee->id)
                        <input class="form-group" type="radio" id="chk{{$rol->id}}" name="radioo"><span style="margin-left: 10px;">{{$rol->name}}</span>
                      @endif
                     </li>
                    @endforeach
                    </ul>
                    </form>


               
              </div>
              <div class="clear"></div>

        

                  </div>
                </div>
              </div>
              <!-- /form color picker -->
             
            </div>
             <div class="col-md-12 text-center ">
              <Button  onclick="ckme()" class="btn btn-primary">Save</Button>
              <Button  class="btn btn-primary">Cancel</Button>
              </div>
              </body>
<script >

   function ckme(){
    var x=[];
    var i=0;
    var id={{$tid}};
$('input:radio[id^="chk"]').each(function(){
 var p= this.id.substr(3,this.id.length);

if($('#'+this.id).prop('checked')){
x[i]=p;
i=i+1;
}

    });
$.ajax({
            url: "users",
            method: 'POST',
            dataType: 'JSON',
            data:{'data':x,'i':id},
            success: function(data) {
               
                console.log('success');
                 
             

            },
            error: function(data) {
                console.log("storystory");
            }
        });


}

</script>
