@extends('layouts.main')

@section('title','Home')

@section('content')

  <!-- =====Nessus File Upload========= -->


    {!! Form::open(array('url' => 'nessus/upload', 'enctype' => 'multipart/form-data')) !!}

    <div class="col-md-3 pull-left">
           <div class="form-group">
              {!! Form::label('nessus_file_upload', 'Nessus File Upload') !!}
              {!! Form::file('nessus_file_upload') !!}
              <p class="help-block">Choose .nessus file</p>
           </div>
           {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!} 
    </div>    

    {!! Form::close() !!}

  <!-- =========Nmap File Upload======== -->

    {!! Form::open(array('url' => 'nmap/upload', 'enctype' => 'multipart/form-data')) !!}

    <div class="col-md-3 pull-left">
           <div class="form-group">
              {!! Form::label('nmap_file_upload', 'Nmap File Upload') !!}
              {!! Form::file('nmap_file_upload') !!}
              <p class="help-block">Choose .txt file</p>
           </div>
           {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!} 
    </div>    

    {!! Form::close() !!}


@endsection