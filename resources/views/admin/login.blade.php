<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Cungcaulaodong</title>
    {{-- <link href="/public/frontend/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{asset('/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- <link href="/public/frontend/css/font-awesome.min.css" rel="stylesheet"> --}}
    <link href="{{asset('/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> (+84) 0949820258</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> solaodongtinhquangbinh@gmail.com</a></li>
								<li><a href="{{URL::to('/')}}"><i class="fa fa-user"></i> Doanh nghi???p</a></li>
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><h1>CUNG C???U LAO ?????NG </h1></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									Qu???ng B??nh
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">?????ng H???i</a></li>
									<li><a href="#">Ba ?????n</a></li>
									
								</ul>
							</div>
							
							
						</div>
					</div>
					
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		
	</header><!--/header-->
	<section>
		<div class="container">
			<div class="row">
			
				<div class="col-sm-12 ">
					<div id="mainpanel">

			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--login form-->
						<h2>????ng nh???p</h2>
						
						@if ($error = $errors->first('email'))
							 <div class="alert alert-danger">
							   {{ $error }}
							 </div>
							@endif
						<form action="{{URL::to('login-admin')}}"  id='signin' name='signin' method='POST'>
							{{csrf_field()}}
							<input type="email"  name='email' placeholder="Email" />
							<input type="password" name='password' placeholder="password" />
							
							<span>
								<input type="checkbox" name='autolog'class="checkbox"> 
								T??? ?????ng ????ng nh???p
							</span>
							<button type="submit" class="btn btn-default">????ng nh???p</button>
						</form>
					</div><!--/login form-->
				</div>
				
			</div>
		

</div>
				</div>
			</div>
		</div>
	</section>
	
	
	
				
				

	
	<footer id="footer"><!--Footer-->
		
		
	
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright ?? 2021 Cungcaulaodong . All rights reserved.</p>
					</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('/frontend/js/main.js')}}"></script>
</body>
</html>
