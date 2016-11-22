<div class="row">
              <!-- form input mask -->
              <div class="col-md-4">
                

                <div class = "panel panel-default">
                   <div class = "panel-heading">
                     USER Profile Picture
                   </div>
                   
                   <div class = "panel-body">
                      <img src="{{URL::asset('production/download.jpg')}}" class="rounded mx-auto d-block" >

                   </div>
                    
                    <div class="choose_file">
                         
                          <input name="Select File" type="file" />
                      </div>
                </div>

              
              </div>


              <div class="col-md-5">
                <div  class="x_panel">
                 <div class="x_title">
                    <h2>User Details</h2>
                  <div class="clearfix"></div>  
                  <div class="x_content">
                    <br />

                    <form class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">First Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                        <input  class="form-control" value="Faisal"></input>
                          
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Last Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input  class="form-control" value="Mahmood"></input>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input  class="form-control" value="faisalrocky1@yahoo.com"></input>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Permission</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                       
                       
                      <select class="form-control">
                        <option>Admin</option>
                        <option>Default</option>
                        <option>Observer</option>
                      </select> 
                                  
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Group</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
            
                      <select class="form-control">
                        <option>Manager</option>
                        <option>Analyst</option>
                        <option>Pentester</option>
                        <option>Client.Rep</option>
                      </select>
                         
                        </div>
                      </div>
                      <div class="form-group">
                        
                      </div>
                    </form>
                   
                  </div>                
                 </div>
                </div>
              </div>
              <!-- /form input mask -->

              <!-- form color picker -->
              <div class="col-md-3" >
                <div class="x_panel" style="min-height: 300px;">
                  <div class="x_title">
                    <h2>Edit Roles</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    

                      
                                        
                        

                       
              <div class="wrapper">
                <div class="content">
                   <ul class="checkbox-list">
                     <li>
                      <label for="item01">
                       <input type="checkbox" id="item01" name="io1" checked>Manager
                      </label>
                      
                     </li>
                     
                     <li>
                      <label for="item02">
                       <input type="checkbox" id="item02" name="io2">Analyst
                      </label>
                     </li>
                     
                     <li>
                      <label for="item03">
                       <input type="checkbox" id="item03" name="io3" checked>Pentester
                      </label>
                     </li>
                     
                     <li>
                      <label for="item04">
                       <input type="checkbox" id="item04" name="io4">Sub-Admin
                      </label>
                     
                     </li>
                    </ul>


               
              </div>
              <div class="clear"></div>

        

                  </div>
                </div>
              </div>
              <!-- /form color picker -->
             
            </div>
             <div class="col-md-12 text-right" style="background-color:#efedb7; ">
              <Button  class="btn btn-primary">Save</Button>
              <Button  class="btn btn-primary">Cancel</Button>
              </div>

