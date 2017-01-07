@extends('layouts.main2')

@section('title','Reports')

@section('user_name','Labeeb')

@section('user_role','Admin')

@section('content')

  <div class="right_col" role="main">
    <div class="container container-fluid">

    <form>
      <div class="form-group">
        <label class="form-check-label" style="margin-right: 10px;">
          <input type="checkbox" class="form-check-input">
          IP address
        </label>
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input">
          MAC address
        </label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

<!-- 
<label class="form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> First option
</label>
<label class="form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> Second option
</label>
<label class="form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3"> Third option
</label> -->







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