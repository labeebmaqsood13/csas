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
           

           
            <div id="blah" class="hidden">
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



            <div class="row">


              <div class="col-md-4 col-sm-6 col-lg-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Vulnerability Severity <small>Sessions</small></h2>
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
            </div>







               </div>
               </div>
               <br />
               </div>
               </div>
              

             
           

           
                    </div> 
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
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
        function queryParams() {
            return {
                type: 'owner',
                sort: 'updated',
                direction: 'desc',
                per_page: 100,
                page: 1
            };
        }
    </script>
   <script>
      $(document).ready(function() {
        //define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
        var chartColours = ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'];

        //generate random number for charts
        randNum = function() {
          return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
        };

        var d1 = [];
        //var d2 = [];

        //here we generate data for chart
        for (var i = 0; i < 30; i++) {
          d1.push([new Date(Date.today().add(i).days()).getTime(), randNum() + i + i + 10]);
          //    d2.push([new Date(Date.today().add(i).days()).getTime(), randNum()]);
        }

        var chartMinDate = d1[0][0]; //first day
        var chartMaxDate = d1[20][0]; //last day

        var tickSize = [1, "day"];
        var tformat = "%d/%m/%y";

        //graph options
        var options = {
          grid: {
            show: true,
            aboveData: true,
            color: "#3f3f3f",
            labelMargin: 10,
            axisMargin: 0,
            borderWidth: 0,
            borderColor: null,
            minBorderMargin: 5,
            clickable: true,
            hoverable: true,
            autoHighlight: true,
            mouseActiveRadius: 100
          },
          series: {
            lines: {
              show: true,
              fill: true,
              lineWidth: 2,
              steps: false
            },
            points: {
              show: true,
              radius: 4.5,
              symbol: "circle",
              lineWidth: 3.0
            }
          },
          legend: {
            position: "ne",
            margin: [0, -25],
            noColumns: 0,
            labelBoxBorderColor: null,
            labelFormatter: function(label, series) {
              // just add some space to labes
              return label + '&nbsp;&nbsp;';
            },
            width: 40,
            height: 1
          },
          colors: chartColours,
          shadowSize: 0,
          tooltip: true, //activate tooltip
          tooltipOpts: {
            content: "%s: %y.0",
            xDateFormat: "%d/%m",
            shifts: {
              x: -30,
              y: -50
            },
            defaultTheme: false
          },
          yaxis: {
            min: 0
          },
          xaxis: {
            mode: "time",
            minTickSize: tickSize,
            timeformat: tformat,
            min: chartMinDate,
            max: chartMaxDate
          }
        };
        var plot = $.plot($("#placeholder33x"), [{
          label: "Email Sent",
          data: d1,
          lines: {
            fillColor: "rgba(150, 202, 89, 0.12)"
          }, //#96CA59 rgba(150, 202, 89, 0.42)
          points: {
            fillColor: "#fff"
          }
        }], options);
      });
    </script>
    <!-- /Flot -->

    <!-- jQuery Sparklines -->



    <script>
      $(document).ready(function() {
        $(".sparkline_one").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 4, 5, 6, 3, 5, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
          type: 'bar',
          height: '125',
          barWidth: 13,
          colorMap: {
            '7': '#a1a1a1'
          },
          barSpacing: 2,
          barColor: '#26B99A'
        });

        $(".sparkline11").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3], {
          type: 'bar',
          height: '40',
          barWidth: 8,
          colorMap: {
            '7': '#a1a1a1'
          },
          barSpacing: 2,
          barColor: '#26B99A'
        });

        $(".sparkline22").sparkline([2, 4, 3, 4, 7, 5, 4, 3, 5, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6], {
          type: 'line',
          height: '40',
          width: '200',
          lineColor: '#26B99A',
          fillColor: '#ffffff',
          lineWidth: 3,
          spotColor: '#34495E',
          minSpotColor: '#34495E'
        });
      });
    </script>
    <!-- /jQuery Sparklines -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function() {
        var canvasDoughnut,
            options = {
              legend: false,
              responsive: false
            };

        new Chart(document.getElementById("canvas1i"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]

            }]
          },
          options: options
        });

        new Chart(document.getElementById("canvas1i2"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]

            }]
          },
          options: options
        });

        new Chart(document.getElementById("canvas1i3"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]

            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->

    <!-- bootstrap-daterangepicker -->
    <script type="text/javascript">
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>

    
@endsection


