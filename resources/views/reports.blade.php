@extends('layouts.main2')

@section('title','Reports')

@section('user_name')
  {{ Auth::user()->name }}
@endsection

@section('user_role')
  {{Auth::user()->role()->first()->name}}
@endsection

@section('scripts')

  <!-- Bootstrap select path given -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

  <script type="text/javascript">



    function checkbox(){

      var chkBox = document.getElementById('table1');
      if (chkBox.checked)
      {
        // alert('Checked');
        document.getElementById('ip').disabled = false;
        document.getElementById('ip').onclick = function (event) {
          return false;
        };
        document.getElementById('ip').checked = true;

        document.getElementById('mac').disabled = false;
        document.getElementById('mac').checked = true;

        document.getElementById('asset').disabled = false;
        document.getElementById('asset').checked = true;

        document.getElementById('count').disabled = false;
        document.getElementById('count').checked = true;                


      }
      else{
        // alert('Unchecked');
       
        document.getElementById('ip').removeAttribute("onclick");
        document.getElementById('ip').checked = false;
        document.getElementById('ip').disabled = true ;

        document.getElementById('mac').checked = false;
        document.getElementById('mac').disabled = true ;

        document.getElementById('asset').checked = false;
        document.getElementById('asset').disabled = true ;

        document.getElementById('count').checked = false;
        document.getElementById('count').disabled = true ;

      }

    }





    function checkbox_two(){
      // alert('haha');
      var chkBox = document.getElementById('table2');
      if (chkBox.checked)
      {
        // alert('Checked');
        document.getElementById('vulnerability').disabled = false;
        document.getElementById('vulnerability').onclick = function (event) {
          return false;
        };
        document.getElementById('vulnerability').checked = true;

        document.getElementById('count_two').disabled = false;
        document.getElementById('count_two').checked = true;
             


      }
      else{
        // alert('Unchecked');
       
        document.getElementById('vulnerability').removeAttribute("onclick");
        document.getElementById('vulnerability').checked = false;
        document.getElementById('vulnerability').disabled = true ;

        document.getElementById('count_two').checked = false;
        document.getElementById('count_two').disabled = true ;


      }

    }



    function checkbox_three(){
      // alert('haha');
      var chkBox = document.getElementById('table3');
      if (chkBox.checked)
      {
        // alert('Checked');
        document.getElementById('plugin').disabled = false;
        document.getElementById('plugin').onclick = function (event) {
          return false;
        };
        document.getElementById('plugin').checked = true;

        document.getElementById('description').disabled = false;
        document.getElementById('description').checked = true;

        document.getElementById('remedy').disabled = false;
        document.getElementById('remedy').checked = true;

        document.getElementById('ip_three').disabled = false;
        document.getElementById('ip_three').checked = true;                

        document.getElementById('mac_three').disabled = false;
        document.getElementById('mac_three').checked = true;                



      }
      else{
        // alert('Unchecked');
       
        document.getElementById('plugin').removeAttribute("onclick");
        document.getElementById('plugin').checked = false;
        document.getElementById('plugin').disabled = true ;

        document.getElementById('description').checked = false;
        document.getElementById('description').disabled = true ;

        document.getElementById('remedy').checked = false;
        document.getElementById('remedy').disabled = true ;

        document.getElementById('ip_three').checked = false;
        document.getElementById('ip_three').disabled = true ;


        document.getElementById('mac_three').checked = false;
        document.getElementById('mac_three').disabled = true ;

      }

    }


    function back_page(){
      console.log('im here');
      $('#report').addClass('hidden');
      $('#selection').removeClass('hidden');
    }


    function hide(id){
      $('#selection').addClass('hidden');
      $('#report').removeClass('hidden');
      var options = '<input type="hidden" value="'+id+'" name="project_id[]">';
      $('#myform').append(options);  
    }


  </script>

  <style type="text/css">
    .bootstrap-select>.dropdown-toggle.bs-placeholder, .bootstrap-select>.dropdown-toggle.bs-placeholder:active, .bootstrap-select>.dropdown-toggle.bs-placeholder:focus, .bootstrap-select>.dropdown-toggle.bs-placeholder:hover{
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
          background-color: #fff;
    }

    .glyphicon:before {
         visibility: visible;
    }
    .glyphicon.glyphicon-remove:checked:before {
        content: "\e013";
    }
    input[type=checkbox].glyphicon{
         visibility: hidden;        
    }

  </style>


@endsection


@section('content')

  <div class="right_col" role="main">
    <div class="container container-fluid">


      <div id="selection">  
        <div class="row" style="margin-top: 75px;">
          <div class="col-md-6 col-md-offset-3">
            <select name="project_name" id="project_name" class="selectpicker form-control" title="Choose a project for report generation" style="" onchange="hide(this.value)">
              @foreach($projects as $key => $project)
                <option value="{{$project->id}}" name="project_name">{{ $project->name }}</option>
              @endforeach
            </select>
          </div>  
        </div>
      </div>  

      <div id="report" class="hidden">

        <form role="form" id="myform" action="/generate_report" method="POST" style="margin-top: 75px;">
            <h3 class="lead text-center" style="font-weight: 400;"><u>Please Choose the attributes from tables to be shown in generated report</u></h3>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- <h4>Table 1: List of most vulnerable assets in the network </h4> -->
            <div class="checkbox" style="margin-top: 35px;">
              <label>
                <input type="checkbox" name="table[]" id="table1" value="table1" onclick="checkbox();" checked="checked" class="glyphicon glyphicon-remove"><h4 class="lead" style="margin-top: 0px;">Table 1: List of most vulnerable assets in the network </h4>
              </label>
            </div>  

            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline" style="color: #C0C0C0;" onfocus="">
                <input type="checkbox" name="report[]" value="IP Address 1" id="ip" onclick="return false;" checked="checked"> IP Address
              </label>
            </div>
            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline">
                <input type="checkbox" name="report[]" value="MAC Address 1" id="mac" checked="checked"> MAC Address
              </label>
            </div>
            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline">
                <input type="checkbox" name="report[]" value="Asset Type" id="asset" checked="checked"> Asset Type
              </label>
            </div>
            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline">
                <input type="checkbox" name="report[]" value="Vulnerability Count" id="count" checked="checked"> Vulnerability Count
              </label>
            </div>
            <br>

            <!-- <h4>Table 2: Top 10 Vulnerabilities</h4> -->
            <div class="checkbox">
              <label>
                <input type="checkbox" name="table[]" class="glyphicon glyphicon-remove" id="table2" onclick="checkbox_two();" value="table2" checked="checked"><h4 class="lead" style="margin-top: 0px;">Table 2: Top 10 Vulnerabilities </h4>
              </label>
            </div>  

            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline" style="color: #C0C0C0;" onfocus="">
                <input type="checkbox" name="report[]" value="Exploit Category" id="vulnerability" onclick="return false;" checked="checked"> Exploit Category 
              </label>
            </div>
            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline">
                <input type="checkbox" name="report[]" value="Infected Assets Count" id="count_two" checked="checked"> Infected Asssets Count
              </label>
            </div>
            <br>

            <!-- <h4>Table 3: Vulnerability details</h4> -->
            <div class="checkbox">
              <label>
                <input type="checkbox" name="table[]" id="table3" value="table3" class="glyphicon glyphicon-remove" onclick="checkbox_three();" checked="checked"><h4 class="lead" style="margin-top: 0px;">Table 3: Vulnerability details </h4>
              </label>
            </div>  

            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline" style="color: #C0C0C0;" onfocus="">
                <input type="checkbox" id="plugin" name="report[]" value="Plugin Name" onclick="return false;" checked="checked"> Plugin Name 
              </label>
            </div>
            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline">
                <input type="checkbox" name="report[]" id="description" value="Description" checked="checked"> Description
              </label>
            </div>
            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline">
                <input type="checkbox" name="report[]" id="remedy" value="Remediation" checked="checked"> Remediation
              </label>
            </div>
            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline">
                <input type="checkbox" name="report[]" id="ip_three" value="IP Address 3" checked="checked"> IP Address
              </label>
            </div>
            <div class="checkbox" style="margin-left: 23px;">
              <label class="checkbox-inline">
                <input type="checkbox" name="report[]" id="mac_three" value="MAC Address 3" checked="checked"> MAC Address
              </label>
            </div>
            <br>
           

           <input type="submit" value="Word Document" name="word" class="btn btn-default">
           <input type="submit" value="Pdf Document" name="pdf" class="btn btn-default">
           <input type="button" value="Back" name="back" class="btn btn-default" onclick="back_page()">

        </form>
      </div>  

    </div>
  </div>

@endsection
