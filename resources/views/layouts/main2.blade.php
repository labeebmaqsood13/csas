<!DOCTYPE html>
<html>
<head>
  <!-- Bootstrap -->
  <meta name="_token" content="{{ csrf_token() }}" />
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <!-- <meta name="_token" content="{{ csrf_token() }}"> -->

    
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
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css">
    <!-- Custom Theme Style -->
    <link href="{{URL::asset('build/css/custom.min.css')}}" rel="stylesheet">
     
  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    
    <style type='text/css'>
        div[ng-app] {
            margin: 50px;
        }
    </style>

   


   
    

    <!--
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
   -->




    <!-- Javascript Internal Code Start -->
    @yield('scripts')
  
    

  <title>CSAS - @yield('title')</title>
</head>




<!--============================== HEADER STARTS HERE ====================================================-->

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
                      <li><a href="/index_activity">Activity</a></li>
                      <li><a href="/analytics_dashboard">Analytics</a></li>
                      <li><a href="dashboard">Analysis Dashboard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Administrator Settings<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/users">Users</a></li>
                      <li><a href="/roles">Roles</a></li>
                      <!-- <li><a href="invite_user">Invite Users</a></li> -->
                      <li><a href="file_upload">Upload File</a></li>
                      <li><a href="form_validation.html">Organization</a></li>
                      <li><a href="form_wizards.html">Customization</a></li>
                      <li><a href="form_upload.html">Threat Source</a></li>
                      <li><a href="form_buttons.html">Notification</a></li>
                      <li><a href="/permissions">Manage Permissions</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Client & Projects <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="/project_wizard">Wizard</a></li>
                      <li><a href="/clients">Clients</a></li>
                      <li><a href="/projects">Projects</a></li>
                      <li><a href="/manage_tasks">Manage Tasks</a></li>
                       <!-- should have button to ask if you want to use the default tasks and on that click tasks table should be populated with the default set of tasks and further it should also allow to edit those -->

                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> View Projects<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Projects Status</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Generate Reports<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li><a href="nessus/updated_pdf">Pdf Report</a></li>
                     <li><a href="nessus/updated_word">Word Report</a></li>
                     

                    </ul>
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
                        <span class="image"><img src="{{URL::asset('production/images/img.jpg')}}" alt="Profile Image" /></span>
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
                        <span class="image"><img src="{{URL::asset('production/images/img.jpg')}}" alt="Profile Image" /></span>
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
                        <span class="image"><img src="{{URL::asset('production/images/img.jpg')}}" alt="Profile Image" /></span>
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
                        <span class="image"><img src="{{URL::asset('production/images/img.jpg')}}" alt="Profile Image" /></span>
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
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">' '.&times;</a>
            </div>

            <!-- <div class="alert alert-info pull-right">
                {{ Session::get('message') }} 
            </div> -->
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
      </div>
    

 <!-- Javascript External Code -->
    <script type="text/javascript">
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           }
       });
    </script>

    <!-- jQuery -->
    <!-- Bootstrap -->
    <script src="{{ URL::asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
           <script src="{{ URL::asset('build/js/custom.min.js') }}"></script>


  
@yield('scripts_create')

  <script type="text/javascript">

  $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        });
    $(document).ready(function(){
        $("mnm").click(function(){
            $("#div1").load("/userDetails.blade.php");
        });
    });  
  </script>   


         


  </body>




</html>