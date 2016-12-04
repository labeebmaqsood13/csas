@extends('layouts.main2')

@section('title','Analytics Dashboard')

@section('user_name','Labeeb')

@section('user_role','Admin')

@section('scripts')


<style type="text/css">
    .bs-example{
        margin: 20px;
     p {
     white-space: pre-line; /* collapse WS, preserve LB */
   }
    }

    .hidden { display: none; }
</style>

    <script src="{{URL::asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
   
    <!-- jQuery Sparklines -->
   
  <script src="{{URL::asset('vendors/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
   

    <!-- Flot -->
     <!-- Chart.js -->
    <script src="{{ URL::asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
   
   
    <script src="{{URL::asset('vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{URL::asset('vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{URL::asset('vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{URL::asset('vendors/Flot/jquery.flot.time.js') }}"></script>   

    <script src="{{URL::asset('vendors/Flot/jquery.flot.stack.js') }}"></script>

    <script src="{{URL::asset('vendors/Flot/jquery.flot.resize.js') }}"></script>

    <!-- Flot plugins -->
 

    <script src="{{URL::asset('produtcion/js/flot/jquery.flot.orderBars.js') }}"></script>

   
    <script src="{{URL::asset('produtcion/js/flot/date.js') }}"></script>

      <script src="{{URL::asset('produtcion/js/flot/jquery.flot.spline.js') }}"></script>

     <script src="{{URL::asset('produtcion/js/flot/curvedLines.js') }}"></script>


   
    <!-- bootstrap-daterangepicker -->  

     <script src="{{URL::asset('produtcion/js/moment/moment.min.js') }}"></script>

     <script src="{{URL::asset('production/js/datepicker/daterangepicker.js') }}"></script>



@endsection

@section('content')

 <!-- page content -->
           
        <div class="right_col" role="main">
        <div class="container" style="min-height: 1000px;">
          <div class="row">
         <div class="col-md-8 col-sm-8 col-lg-8 ">

           <h4>ANALYTICS DASHBOARD</h4>

         </div>
         </div>


              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
          

            <div class="clearfix"></div>






          <div  class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 ">
    
              <div class="ccms_form_element cfdiv_custom" id="style_container_div">
                <label>Client:</label><select size="1" id="beerStyle"  type="select" name="style">
                <option value="">-Choose A Client-</option>
                <option value="Ale">Pepsi /</option>
                <option value="Lager">Ebryx</option>
                <option value="Hybrid">Intel</option>
                </select><div class="clear"></div><div id="error-message-style"></div></div>
              </div>  

               <div class="col-md-4 col-sm-4 col-lg-6">

                <div id="Ale"  class="style-sub-1"  style="display: none;" name="stylesub1">
                  <label>Project</label>
                    <select>
                      <option value="">-Choose An Project-</option> 
                      <option value="re">1 xyzyz</option>
                      <option value="re">2 xyzxyz</option>
                      <option value="re">3xyzxyz</option>                     
                    </select>
                </div>

                <div id="Lager"  class="style-sub-1"  style="display: none;" name="stylesub1" >
                  <label>Project:</label>
                    <select>
                    <option value="">-Choose A Project-</option>
                      <option value="re">1_new</option>
                      <option value="re">2_bro</option>
                      <option value="re">3_max</option>
                     
                    </select>
                </div>
                <div id="Hybrid"  class="style-sub-1"  style="display: none;" name="stylesub1" >
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
           

           
            <div id="blah" class="">
            <div class="row">
              <div class="">

              <br />

               <div>
               <div class="progress-bar progress-bar-success" role="progressbar" style="width:25%">
               Open Ports <br /> 90
               </div>
               <div class="progress-bar progress-bar-warning" role="progressbar" style="width:25%">
               Vulnerabilities <br /> 22
               </div>
               <div class="progress-bar progress-bar-danger" role="progressbar" style="width:25%">
               Active Systems<br /> 212
               </div>
               <div class="progress-bar progress-bar-info" role="progressbar" style="width:25%">
               Systems compromised <br />18
               </div>
               </div>



          







               </div>
               </div>
               <br />
                 <div class="row">

                <div class="clearfix"></div>
              <div class="col-md-4 col-sm-6 col-lg-6">
                <div class="x_panel">
                  <div class="x_title">
                    <!-- <h2>Critical Severity ka count in each Ip <small>Sessions</small></h2> -->
                    <!-- <h2>Count of critical severity  <small>Sessions</small></h2> -->
                    <!-- <h2>Ip's having critical severity<small>Sessions</small></h2> -->
                    <!-- <h2>Summary Critical Ip <small>Sessions</small></h2> -->
                    <!-- <h2>Critical Ip Summary<small>Sessions</small></h2> -->

                    <h2>Most Vulnerable Machines <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="pieChart"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-md-4 col-sm-6 col-lg-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Vulnerabilities Summary <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="canvasDoughnut"></canvas>
                  </div>
                </div>
              </div>
                <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Line graph<small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="lineChart"></canvas>
                  </div>
                </div>
              </div>
    <!-- Added line here -->
    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Top 10 Compromised Machines <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="bar_compromised_machines"></canvas>
                  </div>
                </div>
              </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Top 10 (Potential) Vulnerabilities <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="mybarChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
            </div>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pie Area Graph <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="polarArea"></canvas>
                  </div>
                </div>
              </div>
               </div>
               </div>
              

             
           

           
                    </div> 
        <!-- /page content -->

        <!-- footer content -->
        <footer>
         
        </footer>
        <!-- /footer content -->
      </div>
      </div>
      </div>

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

<script >
      $("#beerStyle").change ( function () {
          var targID  = $(this).val ();
          $("div.style-sub-1").hide ();
          $('#' + targID).show ();
      } )

    </script>
 
   
 <script>
    
       var ctx = document.getElementById("pieChart");
      var data = {
        datasets: [{
          // data: [120, 50, 140, 180, 100],
          data: {{ $critical_ips_count }},
          // backgroundColor: [
          //   "#455C73",
          //   "#9B59B6",
          //   "#BDC3C7",
          //   "#26B99A",
          //   "#3498DB"
          // ],
          backgroundColor: {!! $colors !!},
          label: 'My dataset' // for legend
        }],
        // labels: [
        //   "High",
        //   "Medium",
        //   "Low",
        //   "V.Low",
        //   "Unknown"
        // ]
        labels: {!! $critical_ips !!}
      };

      var pieChart = new Chart(ctx, {
        data: data,
        type: 'pie',
        otpions: {
          legend: false
        }
      });


      // PolarArea chart
       var ctx = document.getElementById("canvasDoughnut");
      var data = {
        labels: [
          "critical",
          "high",
          "medium",
          "low"
        ],
        datasets: [{
          data: [ {{ $reportitems_critical}}, {{$reportitems_high}}, {{$reportitems_med}}, {{$reportitems_low}} ],
          backgroundColor: [
            "#455C73",
            "#9B59B6",
            "#BDC3C7",
            "#26B99A",
            "#3498DB"
          ],
          hoverBackgroundColor: [
            "#34495E",
            "#B370CF",
            "#CFD4D8",
            "#36CAAB",
            "#49A9EA"
          ]

        }]
      };

      var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data
      });
       var ctx = document.getElementById("lineChart");
      var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
            label: "My First dataset",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [31, 74, 6, 39, 20, 85, 7]
          }, {
            label: "My Second dataset",
            backgroundColor: "rgba(3, 88, 106, 0.3)",
            borderColor: "rgba(3, 88, 106, 0.70)",
            pointBorderColor: "rgba(3, 88, 106, 0.70)",
            pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(151,187,205,1)",
            pointBorderWidth: 1,
            data: [82, 23, 66, 9, 99, 4, 2]
          }]
        },
      });


      // Top 10 Vulnerabilities Bar chart
      var ctx = document.getElementById("mybarChart");
      var mybarChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
          labels: {!! $top_ten_vuln_names !!} ,
          // labels: ["January", "February", "March", "April", "May", "June", "July", "Jusad","dsafsad","asd"],
          datasets: [{
            label: '# of Vulnerabilities count',
            backgroundColor: "#26B99A",
            data: {{$top_ten_vuln_count}}
            // data: ["January", "February", "March", "April", "May", "June", "July", "Jusad","dsafsad","asd"]
          }]
        },

        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                barOptions_stacked: true
              }
            }]
          }
        }
      });

      // Top 10 Compromised machines Bar chart
      var ctx = document.getElementById("bar_compromised_machines");
      var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: {!! $top_compromised_ip !!} ,
          // labels: ["January", "February", "March", "April", "May", "June", "July", "Jusad","dsafsad","asd"],
          datasets: [{
            label: '# of Vulnerabilities count',
            backgroundColor: "#455C73",
            data: {{$top_compromised_ip_count}}
            // data: ["January", "February", "March", "April", "May", "June", "July", "Jusad","dsafsad","asd"]
          }]
        },

        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                barOptions_stacked: true
              }
            }],
            xAxes: [{ barPercentage: 0.8,
              ticks: {
                fontSize: 10.7
              } 
            }]
          }
        }
      });




       // PolarArea chart
      var ctx = document.getElementById("polarArea");
      var data = {
        datasets: [{
          data: [120, 50, 140, 180, 100],
          backgroundColor: [
            "#455C73",
            "#9B59B6",
            "#BDC3C7",
            "#26B99A",
            "#3498DB"
          ],
          label: 'My dataset'
        }],
        labels: [
          "Dark Gray",
          "Purple",
          "Gray",
          "Green",
          "Blue"
        ]
      };

      var polarArea = new Chart(ctx, {
        data: data,
        type: 'polarArea',
        options: {
          scale: {
            ticks: {
              beginAtZero: true
            }
          }
        }
      });
      </script>
    
@endsection


