@extends('layouts.main2')

@section('title','Reports')

@section('user_name','Labeeb')

@section('user_role','Admin')

@section('content')

  <div class="right_col" role="main">
    <div class="container container-fluid">
      <div class="row">
        <div class="col-md-8 col-sm-8 col-lg-8 ">
          <h4> Generate Reports </h4>
        </div>
      </div>

      <div class="row"> 
          <button type="button" class="btn btn-lg btn-default">
            {!! Html::linkRoute('nessus.updated_word', 'Word Document') !!}
          </button>
          <button type="button" class="btn btn-lg btn-default">
          {!! Html::linkRoute('nessus.updated_pdf', 'Pdf Report') !!}
          </button>
      </div>    

    </div>
  </div>

@endsection