@extends('layouts.main2')

@section('title','Invite User')

@section('user_name','Labeeb')

@section('user_role','Admin')

@section('content')

<div class="right_col" role="main">
  <div class="container container-fluid">

    <div class="row">

      <div class="col-md-4"> 
        <br />  
         {!! Form::open(array('url' => 'invite_user', 'class' => 'form')) !!}
          {!! Form::token() !!}

          <div class="form-group">
              {!! Form::label('E-mail Address') !!}
              {!! Form::text('email', null, 
                  array('required', 
                        'class'=>'form-control',
                        'placeholder'=>'Enter Email Address')) !!}
          </div>


          <br />
          <div class="form-group">
              {!! Form::submit('Invite', 
                array('class'=>'btn btn-primary')) !!}
          </div>
        {!! Form::close() !!}
      </div>  
    </div>   

  </div>
</div>  

@endsection