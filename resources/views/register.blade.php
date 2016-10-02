@extends('layouts.main2')

@section('title','User Registration')

@section('user_name','Guest')

@section('user_role','Guest')

@section('content')

<div class="right_col" role="main">
  <div class="container container-fluid">

    <div class="row">
      
      <div class="col-md-1">
      </div>
      
      <div class="col-md-6">
      <br /> 
      <h1>Register User</h1>
          {!! Form::open(array('url' => 'register_user', 'class' => 'form')) !!}
            {!! Form::token() !!}
            <br />
            <div class="form-group">
                {!! Form::label('E-mail Address') !!}
                {!! Form::text('email', $user_email, 
                    array('required', 
                          'class'=>'form-control', 
                          'readonly' => 'true',
                          'placeholder'=>'Enter your email address')) !!}
            </div>           

            <div class="form-group">
                {!! Form::label('Name') !!}
                {!! Form::text('name', null, 
                    array('required', 
                          'class'=>'form-control', 
                          'placeholder'=>'Enter your name')) !!}
            </div>

            <div>
                {!! Form::label('Enter Password') !!}
                {!! Form::password('password', ['class' => 'form-control','placeholder'=>'Enter your password']) !!}
            </div>

            <br />
            <div class="form-group">
                {!! Form::submit('Register', 
                  array('class'=>'btn btn-primary')) !!}
            </div>
          {!! Form::close() !!}
      </div>    
    </div>
  </div>
</div>        
@endsection