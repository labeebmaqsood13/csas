<!DOCTYPE html>
<html>
<head>
	<!-- Bootstrap -->

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    
    <title>CSAS - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{URL::asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{URL::asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{URL::asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{URL::asset('vendors/pnotify/dist/pnotify.css')}}" rel="stylesheet">
    <link href="{{URL::asset('vendors/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
    <link href="{{URL::asset('vendors/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css">
    <!-- Custom Theme Style -->
    <link href="{{URL::asset('build/css/custom.min.css')}}" rel="stylesheet">
     
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
   

    <!-- Inline Style Sheet START -->
    <style type="text/css">

      .paging-nav {
        text-align: right;
        padding-top: 2px;
      }

      .paging-nav a {
        margin: auto 1px;
        text-decoration: none;
        display: inline-block;
        padding: 1px 7px;
        background: #91b9e6;
        color: white;
        border-radius: 3px;
      }

      .paging-nav .selected-page {
        background: #187ed5;
        font-weight: bold;
      }

      .paging-nav,
     
      </style>


    <style type="text/css">
        div.content {
            display: table;
            width: 100%;
            border: 1px solid black;
            
        }
        main { display: table-row-group }
        
        div.content header, div.content main section {
            display: table-row;
            border: 1px solid black;
        }
        
        span.open_port,span.close_port,span.list {
            display: table-cell;
            width: 33%;
            border: 1px solid black;
        }
    </style>

    <style type="text/css">
        .bs-example{
            margin: 20px;
        }
    </style>

    <style type="text/css">
      #showme{
        display:none;
    }
        <style type="text/css">
            body { font-family:Arial, Helvetica, Sans-Serif; font-size:0.8em;}
            #report { border-collapse:collapse;}
         
            #report th { background:#7CB8E2 url(header_bkg.png) repeat-x scroll center left; color:#fff; padding:5px 15px; text-align:center;}
            #report td { background:white none repeat-x scroll center left; color:#000; padding:7px 15px; }
          
        </style>

    </style>
    
    <style type="text/css">
        .Rounded {
           
            border-radius:10px 10px 10px 10px;  //rounds corners for other browsers
            border:solid 3px;
            color:white;
           
            padding:4px;
        }
    </style>

    <style>
     p {
         white-space: pre-line; /* collapse WS, preserve LB */
       }
    </style>
    
    <style type="text/css">
        .bs-example{
          margin: 20px;
        }
        @media screen and (min-width: 768px) {
            .modal-dialog {
              width: 700px; /* New width for default modal */
            }
            .modal-sm {
              width: 350px; /* New width for small modal */
            }
        }
        @media screen and (min-width: 1200px) {
            .modal-lg {
              width: 1200px; /* New width for large modal */
            }
        }
    </style>
    
    <style type="text/css">
      .divTable{
      display: table;
      width: 100%;
    }
    .divTableRow {
      display: table-row;
    }
    .divTableHeading {
      background-color: #EEE;
      display: table-header-group;
    }
    .divTableCell, .divTableHead {
      border: 1px solid #999999;
      display: table-cell;
      padding: 3px 10px;
    }
    .divTableHeading {
      background-color: #EEE;
      display: table-header-group;
      font-weight: bold;
    }
    .divTableFoot {
      background-color: #EEE;
      display: table-footer-group;
      font-weight: bold;
    }
    .divTableBody {
      display: table-row-group;
    }
    </style>
    <!-- Inline Style Sheet END -->


   


    <!-- Javascript External Code -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Javascript Internal Code Start -->
    <script type="text/javascript">
            $(document).ready(function(){
                 $("#").click(function(){
                     $("#").load("users-details.html");
                 });
            });
        </script>
    <style>
      td{cursor:pointer;}
    </style> 

  
    <script>$(document).ready(function() {
        $('').click(function(event) {
            event.preventDefault();
            $.get(this.href, {}, function(data) {
              $('#').html(data);
            });
        });
      });
    </script>

    <script>
        $(document).ready(function(){
           $("").click(function(){
              $("").load("");
           });
        });
    </script>
    
    <script>
        $(document).ready(function(){
            $("mnm").click(function(){
                $("#div1").load("users-details.html");
            });
        });
    </script>
    
    <script>
        $(document).ready(function(){         
            $("").load("tablee.html");    
        });
    </script>

	<title>CSAS - @yield('title')</title>
</head>




<!--============================== HEADER STARTS HERE ======================================================-->

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"> CSAS. </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="{{URL::asset('production/images/img.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>
                  @yield('user_name')
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />


            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>
                  @yield('user_role')
                </h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Activity</a></li>
                      <li><a href="index2.html">Analytics</a></li>
                      <li><a href="/dashboard">Analysis Dashboard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Administrator Settings<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="admin_user.html">users</a></li>
                      <li><a href="file_upload">Upload File</a></li>
                      <li><a href="groups.html">Groups</a></li>
                      <li><a href="form_validation.html">Organization</a></li>
                      <li><a href="form_wizards.html">Customization</a></li>
                      <li><a href="form_upload.html">Threat Source</a></li>
                      <li><a href="form_buttons.html">Notification</a></li>
                      <li><a href="calendar.html">Manage Permissions</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Create Projects <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="widgets.html">Step-1</a></li>
                      <li><a href="invoice.html">Step-2</a></li>
                      <li><a href="inbox.html">Step-3</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> View Projects<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Projects Status</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Generate Reports</a>
                   
                  </li>
                  <li><a><i class="fa fa-clone"></i>Mytasks <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Completed Tasks</a></li>
                      <li><a href="fixed_footer.html">Incomplete Tasks</a></li>
                      <li><a href="fixed_footer.html">All Tasks</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                     
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
             
              <a  href="logout" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{URL::asset('production/images/img.jpg')}}" alt="">@yield('user_name')
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Last Logon | 2/2/2016</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Admin</a></li>
                    <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>Faisal Khan</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>Faisal Mahmood</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- Page Content -->

          @if(Session::has('message'))
            <div class="alert alert-info pull-right">
                {{ Session::get('message') }} 
            </div>
          @endif
          @yield('content')

        <!-- /Page Content  -->


        <!-- Footer Content -->
        <footer>
          <div class="pull-right">
            CSAS - Cyber Security Assessment Suite by <a href="#">Labeeb and Faisal</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      
    </div>


    <!-- jQuery -->
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ URL::asset('vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ URL::asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{ URL::asset('vendors/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- morris.js -->
    <script src="{{ URL::asset('vendors/raphael/raphael.min.js') }}"></script>
    <script src="{{URL::asset('vendors/morris.js/morris.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ URL::asset('vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ URL::asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- Skycons -->
    <script src="URL::asset('vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ URL::asset('vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ URL::asset('vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ URL::asset('vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ URL::asset('production/js/flot/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ URL::asset('production/js/flot/date.js') }}"></script>
    <script src="{{ URL::asset('production/js/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ URL::asset('production/js/flot/curvedLines.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ URL::asset('production/js/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('production/js/datepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ URL::asset('build/js/custom.min.js') }}"></script>

    <script >
      $("#beerStyle").change ( function () {
          var targID  = $(this).val ();
          $("div.style-sub-1").hide ();
          $('#' + targID).show ();
      } )
    </script>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
          $("select").change(function(){
              $(this).find("option:selected").each(function(){
                  if($(this).attr("value")=="re"){
                    $("div.b").show ();
                  } 
                  else{
                      $("div.b").hide();
                  }
              });
          }).change();
      });
    </script>


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('production/paging.js') }}"></script> 

    <script type="text/javascript">
      $(function() {
          $("td[colspan=5]").find("d").hide();
          $("td[colspan=10]").find("d").hide();
          
          $("table").click(function(event) {
              var $target = $(event.target);
              if ( $target.closest("td").attr("colspan") > 1 ) {
                   $target.closest("tr").next().find("d").hide();
              } else {
                  $target.closest("tr").next().find("d").slideToggle();
              }                    
          });
      });
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


    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('production/paging.js') }}"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('production/paging.js') }}"></script> 
    <script type="text/javascript">
      $(document).ready(function() {
          $('#tableData').paging({limit:10});
      });
    </script>




         


  </body>




</html>