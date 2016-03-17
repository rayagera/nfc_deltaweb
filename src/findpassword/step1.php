<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" href="../../favicon.ico">-->

    <title>NFC DeltaPlus Security - Remeber Password</title>

    <!-- Bootstrap core CSS -->
    <!--link href="css/bootstrap.min.css" rel="stylesheet"-->
	<link href="../css/lavish-bootstrap.css" rel="stylesheet">	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
		.form-signin
		{
			max-width: 330px;
			padding: 15px;
			margin: 0 auto;
		}
		.form-signin .form-signin-heading, .form-signin .checkbox
		{
			margin-bottom: 10px;
		}
		.form-signin .checkbox
		{
			font-weight: normal;
		}
		.form-signin .form-control
		{
			position: relative;
			font-size: 16px;
			height: auto;
			padding: 10px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		.form-signin .form-control-sm
		{
			position: relative;
			font-size: 14px;
			height: auto;
			padding: 10px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		.form-signin .form-control:focus
		{
			z-index: 2;
		}
		.form-signin input[type="text"]
		{
			margin-bottom: 10px;
			
		}
		.form-signin input[type="password"]
		{
			margin-bottom: 10px;
			
		}
		.account-wall
		{
			margin-top: 20px;
			padding: 40px 0px 20px 0px;
			background-color: #f7f7f7;
			-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		}
		.login-title
		{
			color: #555;
			font-size: 18px;
			font-weight: 400;
			display: block;
		}
		.profile-img
		{
			width: 173px;
			height: 59px;
			margin: 0 auto 10px;
			display: block;
			/*
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			-border-radius: 50%;
			*/
		}
		.need-help
		{
			margin-top: 10px;
		}
		.new-account
		{
			display: block;
			margin-top: 10px;
		}
    </style>
  </head>

	<body>

		<div class="container"  ng-app="deltaAppSec" ng-controller="myCtrl">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-md-offset-4">					
					<h1 class="text-center login-title">Delta Security Center</h1>
					<div class="account-wall">
						<img class="profile-img" src="../images/delta-plus.gif" alt="Delta Plus">
						<form name="myForm" class="form-signin" role="form" action='step2.php' method = 'post' novalidate>   
							 <h3>Step 1: Fill Account</h3>
                              
			                  <input type="text" name='name' class="form-control" placeholder="Fill your registered Account / Email" 
			                  		 ng-model="name" required autofocus> 
			                  <span style="color:red" ng-show="myForm.name.$dirty && myForm.name.$invalid">
			                    	<span>Username is required.</span>
			                  </span>
			                  <?php if(isset($invalidAccount)){?>
				                  <span style="color:red">
				                    	<span>Account or Email is invalid.</span>
				                  </span>
			                  <?php }?>
			                  <span class="clearfix"></span>
			                  <p>
			                  	<input class="btn btn-primary" type="submit" value="Next Step"/> 
			                  	<a class="btn btn-primary" href="../index.php"> Cancel </a>
			                  </p>
			            </form>
					</div>
				</div>
			</div>
		</div> <!-- /container -->

 
    <script type="text/javascript" src="../js/angular.min.js"></script>
    <script type="text/javascript" src="../js/angular-route.min.js"></script>
    <script type="text/javascript" src="../js/appsec.js"></script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>
