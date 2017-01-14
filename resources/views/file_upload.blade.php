@extends('layouts.main2')

@section('title','File Upload')


@section('user_name')
  {{ Auth::user()->name }}
@endsection

@section('user_role')
  {{Auth::user()->role()->first()->name}}
@endsection

@section('content')

<div class="right_col" role="main">
  <div class="container container-fluid">

    <div class="row">
          <p> {{$pluginid_count}} Plugin Id's are in Pluginid model<br>If plugin count would vary in next nessus source file then it will be changed</p>

          <!-- ========= Nessus File Upload ======== -->
          {!! Form::open(array('url' => 'nessus/upload', 'enctype' => 'multipart/form-data')) !!}

          <div class="col-xs-6">
                  <div class="form-group">
                    <h3>Nessus File Upload</h3> <br>
                    <label>Name: </label> <input type="text" name="name" class="form-control" placeholder="Name the report file"> <br>
                    <label>Choose a project from the following list of your projects</label>
                    <select class="form-control" name="project">
                      <option value="0">Choose a project</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}">{{$project->name}}</option>
                      @endforeach
                    </select><br>
                    <label>Information: </label> <textarea class="form-control" name="information" placeholder="Write Info/Description about the Nessus Souce File"></textarea><br>
                    {!! Form::file('nessus_file_upload') !!}
                    <p class="help-block">Choose .nessus file</p>
                 </div><br>
                 {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!} 
          </div>    

          {!! Form::close() !!}

          <!-- ========= Nmap File Upload ======== -->
    <!--       <div class="clearfix visible-xs-block"></div>

          <?php /*{!! Form::open(array('url' => 'nmap/upload', 'enctype' => 'multipart/form-data')) !!}

          <div class="col-xs-6">
                  <div class="form-group">
                    {!! Form::label('nmap_file_upload', 'Nmap File Upload') !!}
                    {!! Form::file('nmap_file_upload') !!}
                    <p class="help-block">Choose .txt file</p>
                 </div>
                 {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!} 
          </div>    

          {!! Form::close() !!}*/ ?>
 -->
    </div>   

  </div>
</div>  

@endsection