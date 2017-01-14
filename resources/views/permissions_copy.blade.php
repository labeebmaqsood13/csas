@extends('layouts.main2')

@section('title','Activity Dashboard')

@section('user_name','Labeeb')

@section('user_role','Admin')

@section('scripts')



<script  src="{{ URL::asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}" ></script>
<script  src="{{ URL::asset('build/js/custom.min.js') }}" ></script>
<!-- <script  src="{{ URL::asset('bower_components/angular-xeditable/dist/css/xeditable.css') }}" ></script> -->
<!-- <script  src="{{ URL::asset('bower_components/angular-xeditable/dist/js/xeditable.js') }}" ></script> -->
   
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>



<!-- <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script> -->


<script>
// $.fn.editable.defaults.mode = 'inline';
// $(document).ready(function() {
//     $('#username').editable({
//         params: function(params) {
//             // add additional params from data-attributes of trigger element
//             params.name = $(this).editable().data('name');
//             return params;
//         },
//         error: function(response, newValue) {
//             if(response.status == 500) {
//                 return 'Server error. Check entered data.';
//             } else {
//                 return response.responseText;
//                 // return "Error.";
//             }
//         }
//     });
// });
</script>

<script type='text/javascript'>

 //    var app = angular.module("app", ["xeditable"]);

 //    app.config(function($interpolateProvider) {
	//   	$interpolateProvider.startSymbol('<%');
	//     $interpolateProvider.endSymbol('%>');
	// });

 //    app.run(function (editableOptions)
 //    {
 //        editableOptions.theme = 'bs3';
 //    });


 //    app.controller('Ctrl', function ($scope, $filter)
 //    {
 //        $scope.useAll = true;
 //        $scope.sup= [true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true];
 //    });
       
</script>     


<style type='text/css'>
/*	div[ng-app] {
		margin: 50px;
	}*/
</style>

   


@endsection

@section('content')
 <!-- page content -->
       <div class="right_col" role="main">
           <!-- <div class="container container-fluid"> -->

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Permissions</h3>
              </div>

            </div>

            <div class="clearfix"></div>
               <div class="col-lg-10">
                    <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#admin" data-toggle="tab" aria-expanded="true"  >Admin</a>
                                </li>
                                <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Analyst Default</a>
                                </li>
                                <li class=""><a href="#messages" data-toggle="tab" aria-expanded="false">Pentester Default</a>
                                </li>
                                <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Observer / Client.Rep Default</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                      <div class="tab-pane fade active in" id="admin" value="abc"  >


												<div ng-controller="Ctrl">

												    <form editable-form name="editableForm3" onaftersave="">

												       
												        <div>
												           

												            <div>
												                <span e-title="Dashboard" editable-checkbox="sup[0]" e-name="Dashboard">
												                 <% sup[0] ? "&#x2714" :  "&#x2718;"%> <b>Dashboard</b> </span>
												                <br />
												                --> <span e-title="Activity" editable-checkbox="sup[1]"
												                e-name="Activity">
												                    <% sup[1] ? "&#x2714" :  "&#x2718;" %> Activity
												                </span>
												                <br />
												                --> <span e-title="Analytics" editable-checkbox="sup[2]" e-name="Analytics">
												                    <% sup[2] ? "&#x2714" :  "&#x2718;" %> Analytics
												                </span>
												                <br />
												                --> <span e-title="Analysis" editable-checkbox="sup[3]" e-name="Analytics">
												                     <% sup[3] ? "&#x2714" :  "&#x2718;" %> Analysis
												                </span>
												                <br />
												                <br />

												                 <span e-title="Administrator Settings" editable-checkbox="sup[4]" e-name="Administrator Settings">
												                 <% sup[4] ? "&#x2714" :  "&#x2718;" %> <b>Administrator Settings</b> </span>
												                <br />
												                --> <span e-title="User" editable-checkbox="sup[5]"
												                e-name="Users">
												                    <% sup[5] ? "&#x2714" :  "&#x2718;" %> Users
												                </span>
												                <br />
												                --> <span e-title="Groups" editable-checkbox="sup[6]" e-name="Groups">
												                    <% sup[6] ? "&#x2714" :  "&#x2718;" %> Groups
												                </span>
												                <br />
												                --> <span e-title="Manage Permissions" editable-checkbox="sup[7]" e-name="Manage Permissions">
												                     <% sup[7] ? "&#x2714" :  "&#x2718;" %> Manage Permissions
												                </span>

												                 <br />
												                --> <span e-title="Organization" editable-checkbox="sup[8]"
												                e-name="Organization">
												                    <% sup[8] ? "&#x2714" :  "&#x2718;" %> Organization
												                </span>
												                <br />
												                --> <span e-title="Customization" editable-checkbox="sup[9]" e-name="Customization">
												                   <% sup[9] ? "&#x2714" :  "&#x2718;" %> Customization
												                </span>
												                <br />
												                --> <span e-title="Threats Scource" editable-checkbox="sup[10]" e-name="Threats Scource">
												                    <% sup[10] ? "&#x2714" :  "&#x2718;" %> Threats Scource
												                </span>


												                 <br />
												                <br />

												                 <span e-title="Create Project" editable-checkbox="sup[11]" e-name="Administrator Settings">
												                 <% sup[11] ? "&#x2714" :  "&#x2718;" %> <b>Create Project</b> </span>
												                <br />
												                --> <span e-title="Step-1" editable-checkbox="sup[12]"
												                e-name="Users">
												                   <% sup[12] ? "&#x2714" :  "&#x2718;" %> Step-1
												                </span>
												                <br />
												                --> <span e-title="Step-2" editable-checkbox="sup[13]" e-name="Groups">
												                    <% sup[13] ? "&#x2714" :  "&#x2718;" %> Step-2
												                </span>
												                <br />
												                --> <span e-title="Step-3" editable-checkbox="sup[14]" e-name="step-3">
												                   <% sup[14] ? "&#x2714" :  "&#x2718;" %> Step-3
												                </span>

												                 <br />

												                    <br />
												                <br />

												                 <span e-title="View Project" editable-checkbox="sup[15]" e-name="View Project">
												                 <% sup[15] ? "&#x2714" :  "&#x2718;" %> <b>View Project</b> </span>
												                <br />
												                --> <span e-title="Project Status" editable-checkbox="sup[16]"
												                e-name="Project Status">
												                    <% sup[16] ? "&#x2714" :  "&#x2718;" %> Project Status
												                </span>
												                <br />




												            </div>
												        </div>

												       
												         
												            <!-- button to show form -->
												            <button type="button" class="btn btn-default"
												                    ng-click="editableForm3.$show();disableWndActions('rinexSettingsId')"
												                    ng-show="!editableForm3.$visible">
												                Edit
												            </button>
												            <!-- buttons to submit / cancel form -->
												                                  <span ng-show="editableForm3.$visible">

												                                      <button type="submit" class="btn btn-success"
												                                              ng-disabled="editableForm.$waiting"
												                                              ng-click=""
												                                              >
												                                          Save
												                                      </button>

												                                      <button type="button" class="btn btn-danger"
												                                              ng-disabled="editableForm3.$waiting"
												                                              ng-click="editableForm3.$cancel();">
												                     q                     Cancel
												                                      </button>
												                                  </span>
												        </div>
												    </form>
												</div>
                        </div>

                        <!-- /.panel-body -->
                    <a href="" id="username" data-type="text" data-column="name" data-url="{{url('update', ['id'=>'1'])}}" data-pk="['id'=>'1']" data-title="change" data-name="name">faisalmax_vp</a>



                    <!-- /.panel -->
                </div></div></div>

@endsection


