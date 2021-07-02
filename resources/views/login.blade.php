<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
  <title>
    Om Sai Travels
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="{{asset('css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('css/main.css')}}" rel="stylesheet" />
  <link href="{{asset('css/util.css')}}" rel="stylesheet" />
 
  <!-- CSS Files -->
  <link href="{{asset('css/black-dashboard.css')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('demo/demo.css')}}" rel="stylesheet" />
</head>

<body class="white-content" >
  <div class="wrapper">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid1">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
            </div>
            <a class="navbar-brand1 " style="font-size: xx-large;" href="javascript:void(0)">Om Sai Travels</a>
          </div>
		</div>
</nav>

      
	<div class="content">
		
		<div class="container-login100">
			<div class="wrap-login100">
            

				<form class="login100-form validate-form" action="login" method="POST">
				@if(session()->has('error'))
        			<script>alert("{{ session()->get('error') }}");</script>
 				@endif
            <br>
                @csrf       
					<span class="login100-form-title p-b-34">
						Account Login
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="text" name="username" placeholder="User name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							User name / password?
						</a>
					</div>

					<div class="w-full text-center">
						<a href="#" class="txt3">
							Sign Up
						</a>
					</div>
				</form>

		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="../vendor/daterangepicker/moment.min.js"></script>
	<script src="../vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>

</body>
</html>