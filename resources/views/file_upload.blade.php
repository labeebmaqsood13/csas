@extends('layouts.main2')

@section('title','File Upload')

@section('user_name','Labeeb')

@section('user_role','Admin')

@section('content')

<div class="right_col" role="main">
  <div class="container container-fluid">

    <div class="row">
          <p>{{$pluginid_count}} Plugin Id's are in Pluginid model</p>

          <!-- ========= Nessus File Upload ======== -->
          {!! Form::open(array('url' => 'nessus/upload', 'enctype' => 'multipart/form-data')) !!}

          <div class="col-xs-6">
                  <div class="form-group">
                    {!! Form::label('nessus_file_upload', 'Nessus File Upload') !!}
                    {!! Form::file('nessus_file_upload') !!}
                    <p class="help-block">Choose .nessus file</p>
                 </div>
                 {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!} 
          </div>    

          {!! Form::close() !!}

          <!-- ========= Nmap File Upload ======== -->
          <div class="clearfix visible-xs-block"></div>

          {!! Form::open(array('url' => 'nmap/upload', 'enctype' => 'multipart/form-data')) !!}

          <div class="col-xs-6">
                  <div class="form-group">
                    {!! Form::label('nmap_file_upload', 'Nmap File Upload') !!}
                    {!! Form::file('nmap_file_upload') !!}
                    <p class="help-block">Choose .txt file</p>
                 </div>
                 {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!} 
          </div>    

          {!! Form::close() !!}

    </div>   

  </div>
</div>  

@endsection