 	<script>
	$(document).ready(function(){
	    $("Button").click(function(){
	        $("#div1").load("/editUsers");
          
	    });
	});
	</script>




  </head>
  
	<div class="row">
              <!-- form input mask -->
              <div  class="col-md-6 col-sm-12 col-xs-12">
                <div  id="div1" class="x_panel">
                 <div class="x_title">
                    <h2>User Details</h2>
                  <div class="clearfix"></div>  
                  <div class="x_content">
                    <br />

                    <form class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">First Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                        <p  class="form-control-static">Faisal</p>
                          
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Last Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <p  class="form-control-static">Mahmood</p>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <p  class="form-control-static">faisalrocky1@yahoo.com</p>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Permission</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                        <p  class="form-control-static">Admin</p>
							 <!-- 
							<select class="selectpicker">
							  <option>Admin</option>
							  <option>Default</option>
							  <option>Observer</option>
							</select> -->
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Group</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
							<p  class="form-control-static">Analyst</p>
							<!-- 
							<select class="selectpicker">
							  <option>Manager</option>
							  <option>Analyst</option>
							  <option>Pentester</option>
							  <option>Client.Rep</option>
							</select>
                         -->
                        </div>
                      </div>
                      
                      
                    </form>
                      <div class="col-md-9 col-md-offset-3">
                          <Button type="button" class="btn btn-primary">Edit Details</Button>
                          
                        
                      </div>
                  </div>                
                 </div>
                </div>
              </div>
              <!-- /form input mask -->

              <!-- form color picker -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Current Tasks</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    

                      
                                        
                        

                       
					    <div class="wrapper">
						    <div class="content">
						        <label >Task Name</label>
	                            <p>Perform Arp Scans !!</p>
	                        
	                        </div>

					        <div class="sidebar">
					        <label >Due Date</label>
					           <p type="text" >10/24/1984</p> 
 
					        
	                        
					        	
					        </div>
					    </div>
					    <div class="clear"></div>

				

                  </div>
                </div>
              </div>
              <!-- /form color picker -->

             
            </div>
<!--
<script type="text/javascript">
$(function() {
    $('p[name="birthdate"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    }, 
    function(start, end, label) {
        var years = moment().diff(start, 'years');
        alert("You are " + years + " years old.");
    });
});
</script>
-->
</html>





















