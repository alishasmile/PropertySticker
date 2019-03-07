<!--doctype html-->
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="_token" content="{!! csrf_token() !!}" />

		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		
	    <link rel="Shortcut Icon" type="image/x-icon" href="{{URL::asset('/img/mcl_propertySticker.png')}}">

		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
	    
		<script type="text/javascript" src="{{URL::asset('js/jquery-1.11.2.min.js')}}"></script>

		<link href="{{URL::asset('css/bootstrap.css')}}" rel="stylesheet" />
	    <link href=”css/bootstrap-switch/bootstrap-switch.css” rel=”stylesheet”>

	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.3/sweetalert2.css" />
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.3/sweetalert2.js" type="text/javascript"></script>

	    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet" />
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.bundle.js"></script>

	    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		

	    <link href="{{URL::asset('css/fresh-bootstrap-table.css')}}" rel="stylesheet" />

	     
	    <!--     Fonts and icons     -->
	    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

		<!--
	    <script type="text/javascript">
    		google.load("jquery", "1.2.3");
			google.load("jqueryui", "1.5.2");
			google.load("prototype", "1.6");
			google.load("scriptaculous", "1.8.1");
			google.load("mootools", "1.11");
			google.load("dojo", "1.1.1");
	    </script>-->

	        
		@yield('css')
	  	@yield('AddStyle')
	  	@yield('title')
	</head>

	@yield('body')
</html>