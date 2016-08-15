<!DOCTYPE html>
<html>
<head>
	<!-- Bootstrap -->

    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::script('js/jquery-1.12.4.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!} 

	<title>CSAS - @yield('title')</title>
</head>



<body>

<!--============================== HEADER STARTS HERE ======================================================-->

<nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">CSAS.</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nessus Parser <span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li>{{ HTML::linkRoute('nessus.pdf', 'Pdf Report') }}</li>
            <li role="separator" class="divider"></li>
            <li>{{ HTML::linkRoute('nessus.word', 'Word Document') }}</li>
            <li role="separator" class="divider"></li>
            <li>{{ HTML::linkRoute('nessus.excel', 'Excel Spreadsheet') }}</li> 
            <li role="separator" class="divider"></li>
            <li>{{ HTML::linkRoute('nessus.webpage', 'Webpage Report') }}</li>  

          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nmap Parser <span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li>{{ HTML::linkRoute('nmap.pdf', 'Pdf Report') }}</li>
            <li role="separator" class="divider"></li>
            <li>{{ HTML::linkRoute('nmap.word', 'Word Document') }}</li>
            <li role="separator" class="divider"></li>
            <li>{{ HTML::linkRoute('nmap.excel', 'Excel Spreadsheet') }}</li> 
            <li role="separator" class="divider"></li>
            <li>{{ HTML::linkRoute('nmap.webpage', 'Webpage Report') }}</li>         

          </ul>
        </li>


      </ul>

      <ul class="nav navbar-nav navbar-right">
	      <form class="navbar-form navbar-left" role="search">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search CSAS">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	      </form>
	  </ul>


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!--================================ BODY STARTS HERE =======================================================-->

<div class="container container-fluid">

  @if(Session::has('message'))
    <div class="alert alert-info">
        {{ Session::get('message') }} 
    </div>
  @endif
  @yield('content')

</div>

</body>
</html>