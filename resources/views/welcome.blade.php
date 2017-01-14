@extends('layouts.main2')

@section('title','Welcome')


@section('user_name')
    {{ Auth::user()->name }}
@endsection

@section('user_role')
  {{Auth::user()->role()->first()->name}}
@endsection

@section('content')


    <div class="right_col">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        Welcome to Kvasir! Herein these directories lay the groundwork tools for effective data management during a Penetration Test.

Penetration tests can be data management nightmares because of the large amounts of information that is generally obtained. Vulnerability scanners return lots of actual and potential vulnerabilities to review. Port scanners can return thousands of ports for just a few hosts. How easy is it to share all this data with your co-workers?

That's what Kvasir is here to help you with. Here's what you'll need to get started:

The latest version of web2py (http://www.web2py.com/)
A database (PostgreSQL known to work)
A network vulnerability scanner (Nexpose, Nessus and Nmap supported)
Additional python libraries
Kvasir is a web2py application and can be installed for each customer or task. This design keeps data separated and from you accidentally attacking or reviewing other customers.

This tool was developed primarily for the Cisco Systems Advanced Services Security Posture Assessment (SPA) team. While not every methodology may not directly align, Kvasir is something that can be molded and adapted to fit almost any working scenario. Pull requests through Github are encouraged!
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
