
@extends('layouts.main2')

@section('title','File Upload')

@section('user_name','Labeeb')

@section('user_role','Admin')


@section('scripts')


@endsection

@section('content')



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
         <label class="control-label col-md-3 col-sm-3 col-xs-3">Member/owner</label>
        
         <select class="form-control" style="width:150px;">
              <optgroup label="Analyst">
                <option>ABC</option>
                <option>DEF</option>
                <option>GHY</option>
              </optgroup>
              <optgroup label="Pentester">
                <option>JKL</option>
                <option>MNO</option>
                <option>PQRS</option>
              </optgroup>
            </select><br/>

             <label class="control-label col-md-3 col-sm-3 col-xs-3">ADD note</label>
             <textarea></textarea><br/>
              <div class="row">
            <div class="col-md-3">
              <label>Can upload File</label>
              
              </div>

            <div class="col-md-3">
            <ul>
                  <li><input type="checkbox">Yes </li>
                      <li><input type="checkbox">No </li>
              </ul>
              </div>
            </div>

         </form>
        </div>
        <div class="modal-footer">
          <a   href="" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
        
        </div>
        </div>
       </div>
      </div>
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
         <input type="text" id="vali" style="border: 1px solid green;"></input>
          <input type="button"  id="im" name="submit" value="create"  class="btn btn-info"  data-dismiss="modal">
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
  <div class="container">

    
    <div class="row">
    <div class="col-md-4">
    <div style="border-right: 1px solid">
    <div class="panel panel-default">
                          <!-- Default panel contents -->
                          <div class="panel-heading">SUMMARY</div>
            
               
                <div>
                <div class="row">
                <div class="col-md-3">
                <LABEL>Task Name</LABEL>
                </div>
                <div class="col-md-6">
                <p>Scan this and that</p>
                </div>
                </div>
                <div class="row">
                <div class="col-md-3">
                <LABEL>Created by</LABEL>
                </div>
                <div class="col-md-6">
                <p>faisal</p>
                </div>
                </div>
                <div class="row">
                <div class="col-md-3">
                <LABEL>Created at</LABEL>
                </div>
                <div class="col-md-6">
                <p>1/1/1</p>
                </div>
                </div>
               </div>
                </div>



                <div class="panel panel-default">
                          <!-- Default panel contents -->
                          <div class="panel-heading">Members Added</div>
                          <ul>
                              <li> <input type="checkbox" checked>Faisal</li>

                              <li><input type="checkbox" checked>Labeeb</li>

                              <li><input type="checkbox" checked>Rehan</li>

                              <li><input  type="checkbox">Arsalan</li>
                          </ul>
            </div>
           

             <div class="panel panel-default">
                          <!-- Default panel contents -->
                          <div class="panel-heading">Attachements</div>
                          Number of attachments or who added attachemnts etc

                          </div>

            </div>
            </div>
            
      


 <div class="col-md-8">
            



   
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
            </ul>

                <div class="tab-content ">
                  <div class="tab-pane active" id="1">
                         <div class="col-md-12"></div><br/>
                          <a  href="#mod" data-toggle="modal"> <button type="button" class=" btn btn-primary"value="Create Phase">Create Phase</button></a>
                       
                       
                        <div class="panel panel-default">
                          <!-- Default panel contents -->
                          <div class="panel-heading">PHASE-1</div>

                         
                        


                        <table class="table" >
                        
                             
                        <tbody id="table_row">
                        @foreach($test as $t)
                            <tr>
                              

                                <td>

                                    <input type="checkbox"> <a  href="#modal" data-toggle="modal">        
                                        {{$t->name}}
                                    </a>
                               </td>
                              

                                


                               
                            </tr>

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
                                        </div>  
                                         

                         <div class="panel panel-default" id="dom" style="display: none">
                          <!-- Default panel contents -->
                          <div class="panel-heading">PHASE-1</div>

                         
                        


                        <table class="table" >
                        
                             
                        <tbody id="table_row">
                        @foreach($test as $t)
                            <tr>
                              

                                <td>

                               </td>
                              

                                


                               
                            </tr>

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
                                        </div>    
                       
                     </div>
                    <div class="tab-pane" id="2">
              
                       <div class="tab-pane" role="tabpanel" id="step3">
                       
                              <div style="border: 1px solid; padding: 25px; margin: 25px;">
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                  <strong style="color: black"> Client</strong>
                                </div>
                                <div class="col-md-3" id="client_nm">
                                   <p align="center" id="clientnm" value=""> Ebryx</p>
                                </div>
                                
                            </div>    
                        
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Project Name</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center " id="projectnm" >Pepsi</p>
                                </div>
                                
                            </div>    
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Subnet </Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center" >0.0.0.0 to 0.0.0.0</p>
                                </div>
                                
                            </div>    
 
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Responsible members</Label>
                                </div>
                                <div class="col-md-3">
                                   <ul>
                                     <li style="color: lightblack ;"> Faisal Mahmood (Analyst)</li>
                                     <li> Labeeb Maqsood (Analyst)</li>
                                   </ul>
                                </div>
                                
                            </div>    
                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Due Date</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center">31/5/2017</p>
                                </div>
                                
                            </div>    



                              <div class="row mar_ned">
                                <div class="col-md-3">
                                   <Label align="center" style="color: black">Added Instructions</Label>
                                </div>
                                <div class="col-md-3">
                                   <p align="center">Take work seriously !
                                   put some effort
                                   enjoy!</p>
                                </div>
                                
                            </div> </div>   

                            
                        </div>
                       
                        
                    </div>
            <div class="tab-pane" id="3">
              <h3>3</h3>
                    </div>
                </div>
      </div>

    <hr></hr>


                
       </div>  
    </div></div>
</div>
<script type="text/javascript">
    $("#im").on('click', function() {
   $("#dom").fadeIn();
 
});
</script>


@endsection
