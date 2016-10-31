 <!DOCTYPE html>
<html lang="en">

  <head>  
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>NSPR !! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
        .span12{ border:solid ;}

        .centered      { width: 900px; }
		.columns       { width: 600px;  margin: 0 auto;}
		.columns_div   { width: 300px; height: 100px; float: left; }
		.grey          { background-color: #cccccc; }
		.red           { background-color: #e14e32; }
		.clear         { clear: both; } 
	    .wrapper {
			  margin-left: 200px;
			}
			.content {
			  float: right;
			  width: 100%;
			  
			}
			.sidebar {
			  float: left;
			  width: 200px;
			  margin-left: -200px;
			  
			}
			.cleared {
			  clear: both;
			}
     </style>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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





















