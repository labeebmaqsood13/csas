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
     <link href="{{URL::asset('build/css/custom.min.css')}}" rel="stylesheet">


  <!-- Sweet alerts path given -->
  <script src="{{URL::asset('sweet_alerts/dist/sweetalert.min.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{URL::asset('sweet_alerts/dist/sweetalert.css')}}">

     

  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    
    <style type='text/css'>
        div[ng-app] {
            margin: 50px;
        }
    </style>
  


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
              <a href="/" class="site_title"> CSAS. </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <a href="profile"><img src="{{URL::asset('uploads/profile.png')}}" alt="..." class="img-circle profile_img"></a>
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
                <h3 style="margin-left: -8px; padding-top: 75px;">
                  @yield('user_role')
                </h3>
                <ul class="nav side-menu">
                
                @if(Auth::guest())  
                
                @else

                  @if(Auth::user()->role()->first()->permission()->whereIn('name', ['Activity Dashboard', 'Analytics Dashboard', 'Analysis Dashboard'])->count())
                      <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          
                          @if(Auth::user()->role()->first()->permission()->where('name', 'Activity Dashboard')->count())
                            <li><a href="/index_activity">Activity Dashboard</a></li>  
                          @endif
                          
                          @if(Auth::user()->role()->first()->permission()->where('name', 'Analytics Dashboard')->count())
                          <li><a href="/analytics_dashboard" id="abcd">Analytics Dashboard</a></li>
                          @endif

                          @if(Auth::user()->role()->first()->permission()->where('name', 'Analysis Dashboard')->count())                      
                          <li><a href="/dashboard/" id="abc">Analysis Dashboard</a></li>
                          @endif

                        </ul>
                      </li>
                    @endif

                  @endif  

                  @if(Auth::guest())  
                
                  @else
                                  
                    @if(Auth::user()->role()->first()->permission()->where('name', 'Manage Projects')->count())                        
                    <li><a><i class="fa fa-wrench" style="padding-right: 10px;"></i> Projects & TASKS <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                        <li><a onclick="hreff();" id="projects_tasks" href="/projects_tasks">View / Choose Project</a></li>
                        </ul>
                    </li>
                    @endif

                  @endif

                  @if(Auth::guest())  
                
                  @else


                    @if(Auth::user()->role()->first()->permission()->whereIn('name', ['Edit Users','Edit Roles','Customization', 'Edit Clients Projects', 'Manage Permissions', 'Customize Sop'])->count())

                      <li><a><i class="fa fa-cog"></i> Administrator Settings<span class="fa fa-chevron-down"></span></a>

                      <!-- <li><a><i class="fa fa-edit"></i> Administrator Settings<span class="fa fa-chevron-down"></span></a>                       -->
                        <ul class="nav child_menu">
                          @if(Auth::user()->role()->first()->permission()->where('name', 'Edit Users')->count())                    
                            <li><a href="/users">Users</a></li>
                          @endif

                          @if(Auth::user()->role()->first()->permission()->where('name', 'Edit Roles')->count())                      
                            <li><a href="/roles">Roles</a></li>
                          @endif
           

                          @if(Auth::user()->role()->first()->permission()->where('name', 'Customize Sop')->count())                          
                          <li><a><i class="glyphicon glyphicon-cog"></i> Customization <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                          
                        
                            <li><a href="/sop">S O P</a></li>

                          </ul>
                          </li>
                          @endif                      

                          @if(Auth::user()->role()->first()->permission()->where('name', 'Edit Clients Projects')->count())                       
                            <li><a id="projects_edit" href="/edit_clients_projects" onclick="hreff();">Edit Clients / Project Details</a></li>
                          @endif

                          @if(Auth::user()->role()->first()->permission()->where('name', 'Manage Permissions')->count())  
                           <li><a href="/permissions">Manage Permissions</a></li>
                          @endif

                        </ul>
                      </li>

                    @endif  

                  @endif




                  @if(Auth::guest())  

                  @else


                    @if(Auth::user()->role()->first()->permission()->where('name', 'Project Wizard')->count())                
                      <li><a><i class="fa fa-desktop"></i> Client & Projects <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          
                          
                          <li><a href="/project_wizard">Wizard</a></li>

                           <!-- should have button to ask if you want to use the default tasks and on that click tasks table should be populated with the default set of tasks and further it should also allow to edit those -->

                        </ul>
                      </li>
                    @endif 
                  
                  @endif                                     


                  @if(Auth::guest())  
                 
                  @else
                

                    @if(Auth::user()->role()->first()->permission()->where('name', 'Customized Report')->count())                  
                    <li><a><i class="fa fa-bar-chart-o"></i> Generate Reports<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                       <li><a href="/reports">Customized Report</a></li>


                      </ul>
                    </li>
                    @endif

                  @endif    


                  @if(Auth::guest())  
                
                  @else
                

                    @if(Auth::user()->role()->first()->permission()->where('name', 'My Tasks')->count())
                    <li><a><i class="fa fa-tasks"></i>Mytasks <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                       <li><a href="/mytasks">All Tasks</a></li>
                      </ul>
                    </li>
                    @endif
                  
                  @endif
                  

                  @if(Auth::guest())  
                
                  @else

                    <li><a href="/profile"><i class="fa fa-user"></i>Profile</a>

                  @endif    

                  
                    
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                     
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
             
              <a  href="/logout" data-toggle="tooltip" data-placement="top" title="Logout">
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
                    <img src="{{URL::asset('uploads/profile.png')}}" alt="">@yield('user_name')
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="/profile"> Profile</a></li>
                   
                    <li><a href="/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
                 <a href="#" class="close" data-dismiss="alert" aria-label="close"> &nbsp;&times;</a>
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