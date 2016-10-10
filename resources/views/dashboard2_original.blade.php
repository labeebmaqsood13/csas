@extends('layouts.main2')

@section('title','Dashboard')

@section('user_name','Labeeb')

@section('user_role','Admin')

@section('scripts')

  <link href="{{URL::asset('build/css/dashbord3.min.css')}}">

    

  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

  <script type="text/javascript">
      $(document).ready(function(){
        
          $("select").change(function(){
              $(this).find("option:selected").each(function(){
                  if($(this).attr("value")=="re"){
                   
           $('#blah').removeClass('hidden');

      } 
                  
                 
                  else{
                      $("#b").hide();
                  }
              });
          }).change();
      });
  </script>


  <script>


    $(document).ready(function(){

      $(document).on('click','#details', function () {
        $.get("reportitems/"+$(this).val(),
        function(data){
          console.log(data);
          $.each(data, function(i, obj) {
            // console.log(obj.id);
            var tabledata = "<tr><td>" +obj.id + "</td><td>"+obj.port+"</td><td>"+obj.svc_name+"</td><td>"+obj.protocol+"</td><td>"+obj.severity+"</td><td>"+obj.plugin_id+"</td><td>"+obj.plugin_name+"</td><td>"+obj.plugin_family+"</td></tr>";

            tabledata +='<tr><td colspan="10"><d class="col-md-8 col-sm-8 col-lg-12"><div class="container"><div class="row"><div class="col-md-10 col-sm-10 col-lg-12"><label>Description:</label><br /><p><description>'+ obj.description +'</description></p><label>Solution: </label><br /><p><solution>'+ obj.solution +'</soluion></p><label>Risk Factor: </label><p><riskfactor>'+ obj.riskfactor +'</riskfactor></p><label>Plugin Output: </label><p style="overflow-y: scroll;height:160px">'+ obj.plugin_output +'</p></div></div></div></d></td></tr>';

            $("#task-list").append(tabledata);
          });
        });
      });   
    });  


    
  </script>

@endsection

@section('content')


        <div class="right_col" role="main">
          <div class="container container-fluid">
    
              <div class="row">
                  <div class="col-md-8 col-sm-8 col-lg-8 ">
                    <h4>Analaysis Dashboard - Passive Threats</h4>
                  </div>
              </div>


              <div class="row">
                  <div class="col-md-8 col-sm-8 col-lg-6 ">
                      <div class="ccms_form_element cfdiv_custom" id="style_container_div">
                          <label>Client:</label>
                          <select size="1" id="beerStyle" class=" validate['required']" title="" type="select" name="style">
                              <option value="">-Choose A Client-</option>
                              <option value="Ale">Pepsi /</option>
                              <option value="Lager">Ebryx</option>
                              <option value="Hybrid">Intel</option>
                          </select>
                          <div class="clear"></div>
                          <div id="error-message-style"></div>
                      </div>
                      
                      <div id="Ale"  class="style-sub-1" style="display: none;" name="stylesub1" onchange="ChangeDropdowns(this.value)">
                          <label>Project</label>
                          <select>
                            <option value="">-Choose An Project-</option> 
                            <option value="re">1 xyzyz</option>
                            <option value="re">2 xyzxyz</option>
                            <option value="re">3xyzxyz</option>                     
                          </select>
                      </div>

                      <div id="Lager"  class="style-sub-1"  style="display: none;" name="stylesub1" onchange="ChangeDropdowns(this.value)">
                          <label>Project:</label>
                          <select>
                            <option value="">-Choose A Project-</option>
                              <option value="re">1_new</option>
                              <option value="re">2_bro</option>
                              <option value="re">3_max</option>       
                          </select>
                      </div>

                      <div id="Hybrid"  class="style-sub-1"  style="display: none;" name="stylesub1" onchange="ChangeDropdowns(this.value)">
                          <label>Project</label> 
                          <select>
                          <option value="">-Choose A Project-</option>
                            <option value="re">1----zip</option>
                            <option value="re">2----spicy</option>
                            <option value="re">3-----bravo</option>
                          </select>
                      </div><div class="clear"></div><div id="error-message-style-sub-1"></div>

                  </div>  
              </div>





              <div class="b">
      
                <table  id="report" class = "table table-bordered">

                  <th>ID</th>
                  <th>Ip Address</th>
                  <th>Vulnerablity count</th>
                  <th>Severity</th>
                  <th>Threat Source</th>

                  <!-- First Row -->
                  @foreach($reporthosts as $reporthost)
                      <tr>
                        <!-- <td><d>1</d></td> -->
                        <td><d>{{$reporthost['id']}}</d></td>
                        <!-- <td><d>192.168.1.23</d></td> -->
                        <td><d>{{$reporthost['host_ip']}}</d></td>
                        <td><d><div align="center">{{$reporthost['total']}}</div></d></td>
                    
                        <td>
                            <d>
                              <div align="center" class="container">
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                  {{$reporthost['high']}}
                                  <aa class="Rounded" style=" background-color:#FF5B33;">High</aa>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                  {{$reporthost['med']}}
                                  <aa class="Rounded" style=" background-color:#FF7A33;">Medium</aa> 
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                  {{$reporthost['low']}}
                                  <aa  style=" background-color:#3AA432;" class="Rounded">Low</aa>
                                </div>  
                              </div> 
                            </d>
                        </td>

                        <td>
                            <d>
                              <div align="center">
                                <stronge  class="Rounded" style="color:white;font-family: 'Raleway',sans-serif; font-size: 15px; font-weight: 60;background-color:#3AA432;">Not Available</stronge>
                              </div>
                            </d>
                        </td>
                      </tr>
                      <!-- /First Row -->

                      <!-- Second Row -->
                      <tr>
                        <td colspan="5">
                          <d class="col-md-8 col-sm-8 col-lg-12">
                            <div class="container">
                              <div class="row">
                                  
                                  <div>
                                    <div class="">
                                      <h4><u>Destination MetaDetails</u></h4>
                                    </div>
                                  </div>
                         
                                  <div class="col-md-3 col-sm-3 col-lg-3">
                                       <strong font="3">
                                       <p>Host-Ip:</p>
                                       <p>ssh fingerprint:</p>
                                       <p>MAC Address:</p>
                                       <p>cpe-1 :</p>
                                       <p>path symmary total cves :</p> 
                                       <p>last unauthenticated results :</p> 
                                       <p>policy-used :</p>
                                       <p>cpe :</p>
                                       <p>cpe-0 :</p>
                                       <p>trace route hope 0 :</p>
                                       <p>Credentialed Scan :</p>
                                       <p>operating system full :</p>
                                       <p>system-type :</p>
                                       <p>os :</p>
                                       <p>netbios name  :</p>
                                       </strong>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-lg-6">
                                      <p>{{$reporthost['host_ip']}}</p>
                                      <p style="color:gray;">{{$reporthost['ssh_fingerprint']}}</p>
                                      <p>{{$reporthost['mac']}}</p>
                                      <p>{{$reporthost['cpe_1']}}</p>
                                      <p>{{$reporthost['total_cves']}}</p>
                                      <p>{{$reporthost['last_unauthenticated_results']}}</p>
                                      <p>{{$reporthost['policy_name']}}</p>
                                      <p>{{$reporthost['cpe']}}</p>
                                      <p>{{$reporthost['cpe_0']}}</p>
                                      <p>{{$reporthost['traceroute_hop_0']}}</p>
                                      <P>{{$reporthost['credentialed_scan']}}</P>
                                      <P>{{$reporthost['operating_system']}}</P>
                                      <P>{{$reporthost['system_type']}}</P>
                                      <p>{{$reporthost['os']}}</p>
                                      <p>{{$reporthost['netbios_name']}}</p>
                                  </div>

                                  <div class="col-md-3 col-sm-3 col-lg-3">              
                                      <button type="button" class="btn btn-primary btn-large" data-toggle="modal" data-target="#myModal" id="details" value="{{$reporthost['id']}}">Details</button>
                                  </div>

                              </div>
                            </div>
                          </d>
                        </td>
                      </tr>
                  @endforeach
                  <!-- /Second Row -->
                </table>
                                  
              </div>

          </div>
        </div>


        <div class="bs-example">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="purchaseLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" id="purchaseLabel">Report Items</h4>
                          </div>
                        <div class="modal-body" id="task_list">              

                         <div id="tableData">
                            <table  id="report" class = "table table-bordered">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Port</th>
                                  <th>Service</th>
                                  <th>Protocol</th>
                                  <th>Severity</th>
                                  <th>Plugin Id</th>
                                  <th>Plugin Name</th>
                                  <th>plugin Family</th>
                                </tr>
                              </thead>
                              <tbody id="task-list">

<!--                                     <tr>
                                        <td id="reporthost_id"><d></d></td>
                                        <td id="port"><d></d></td>
                                        <td id="svc_name"><d><div align="center"></div></d></td>
                                        <td id="protocol"></td>
                                        <td id="severity"></td>
                                        <td id="plugin_id"></td>
                                        <td id="plugin_name"></td>
                                        <td id="plugin_family"></td>
                                    </tr>
 -->
<!--                                     <tr>
                                    <td colspan="10">
                                       <d class="col-md-8 col-sm-8 col-lg-12">
                                          <div class="container">
                                            <div class="row">
                                              <div class="col-md-10 col-sm-10 col-lg-12">

                                                <Label>Description :</Label><br /> <p><description>By sending a Lookup request to the portmapper (TCP 135 or epmapper PIPE) it was possible to enumerate the Distributed Computing Environment (DCE) services running on the remote port. Using this information it is possible to connect and bind to each service by sending an RPC request to the remote port/pipe.</description></p>
                                                <LABEL>Solution :</LABEL><br /> <p><solution>Fix the reverse DNS or host file.</solution></p>
                                             
                                                <label>Risk Factor :</label><p><riskfactor>None</riskfactor></p>
                                                <label>Plugin Output :</label>
                                                 <p style="overflow-y: scroll;height:160px">
                                                  The remote operating system matched the following CPE : 

                                                    cpe:/o:microsoft:windows_7:::ultimate
                                                    The following DCERPC services are available on TCP port 1026 :

                                                  Object UUID : 00000000-0000-0000-0000-000000000000
                                                  UUID : f6beaff7-1e19-4fbb-9f8f-b89e2018337c, version 1.0
                                                  Description : Unknown RPC service
                                                  Annotation : Event log TCPIP
                                                  Type : Remote RPC service
                                                  TCP Port : 1026
                                                  IP : 192.168.1.5

                                                  Object UUID : 00000000-0000-0000-0000-000000000000
                                                  UUID : 3c4728c5-f0ab-448b-bda1-6ce01eb0a6d6, version 1.0
                                                  Description : Unknown RPC service
                                                  Annotation : DHCPv6 Client LRPC Endpoint
                                                  Type : Remote RPC service
                                                  TCP Port : 1026
                                                  IP : 192.168.1.5

                                                  Object UUID : 00000000-0000-0000-0000-000000000000
                                                  UUID : 3c4728c5-f0ab-448b-bda1-6ce01eb0a6d5, version 1.0
                                                  Description : DHCP Client Service
                                                  Windows process : svchost.exe
                                                  Annotation : DHCP Client LRPC Endpoint
                                                  Type : Remote RPC service
                                                  TCP Port : 1026
                                                  IP : 192.168.1.5

                                                  Object UUID : 00000000-0000-0000-0000-000000000000
                                                  UUID : 06bba54a-be05-49f9-b0a0-30f790261023, version 1.0
                                                  Description : Unknown RPC service
                                                  Annotation : Security Center
                                                  Type : Remote RPC service
                                                  TCP Port : 1026
                                                  IP : 192.168.1.5

                                                  Object UUID : 00000000-0000-0000-0000-000000000000
                                                  UUID : 30adc50c-5cbc-46ce-9a0e-91914789e23c, version 1.0
                                                  Description : Unknown RPC service
                                                  Annotation : NRP server endpoint
                                                  Type : Remote RPC service
                                                  TCP Port : 1026
                                                  IP : 192.168.1.5
                                                 </p>
                                              </div>
                                            </div>
                                          </div>                         
                                         </d>
                                      </td>
                                    </tr>
 -->
                              </tbody>                         
                            </table>
                          </div>
                        </div>
                
                  

                           <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   
                           </div>
                        </div>
                    </div>
                </div>
            </div>

            
<script type="text/javascript" src="{{ URL::asset('production/paging.js') }}"></script>



 <script type="text/javascript">
      $(document).ready(function() {
          $('#tableData').paging({limit:10});
      });
    </script>

    <script >
      $("#beerStyle").change ( function () {
          var targID  = $(this).val ();
          $("div.style-sub-1").hide ();
          $('#' + targID).show ();
      } )

    </script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
   

    <script type="text/javascript">
          $(function() {
    $("td[colspan=5]").find("d").hide();
    $("td[colspan=10]").find("d").hide();
    
    $("table").click(function(event) {
       
        var $target = $(event.target);
        if ( $target.closest("td").attr("colspan") > 1 ) {
          
           
        } else {
            $target.closest("tr").next().find("d").slideToggle();
        }                    
    });
    });
    </script>            

@endsection