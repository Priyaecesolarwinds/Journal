<!doctype html>
<html class="no-js" lang="en">
    <head> 
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Laravel Admin</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
       <!-- <link rel="icon" href="{{ asset('favicon1.png') }}" type="image/x-icon" />-->

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- themekit admin template asstes -->
        <link rel="stylesheet" href="{{ asset('all.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/theme.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>
		<div class="container">
		    <div class="row justify-content-center">
		        <div class="col-md-12 m-5 text-center">
		        	<a href="#">
		         <!--   	<img height="40" src="{{ asset('img/logo1.png') }}"> -->
		            </a>
		        </div>
		        <div class="col-md-12 m-5 mt-0 text-center">
		            <h6>Hello <span class="text-danger">Artisan</span>,</h6>
		            <h1 class="m-5">This is your homepage!</h1>
		            <a href="{{url('login')}}" class="btn btn-success">Go to Login Page</a>
		           
		          
		            
		        </div>

		        </div>
		    </div>
		</div>
		<script src="{{ asset('all.js') }}"></script>
        
    </body>
</html>

