@extends('layouts.main2')

@section('title','Welcome')

@section('user_name')
    {{Auth::user()->name}}
@endsection

@section('user_role','Admin')

@section('content')


    <div class="right_col">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        Your Application's Landing Page is here.
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
