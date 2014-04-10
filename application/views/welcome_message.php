<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.png')?>">

    <title>Welcome to connectify</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/css/bootstrap.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/bootstrap-theme.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/datepicker.css')?>" rel="stylesheet">

    <!-- siimple style -->
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Connectify</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
			<li><a href="#">Sign in</a></li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h1>A fresh beginning</h1>
					<h2 class="subtitle">Simplicity!</h2>
					<form class="form signup" role="form" method="post" action="<? echo site_url('user/signup')?>">
					  <div class="form-group">
					    <input type="email" class="form-control"  placeholder="Enter your email address" name="email">
					    <input type="text" class="form-control"  placeholder="Enter your username" name="username">
					    <input type="text" class="form-control"  placeholder="Enter your first name" name="fname">
					    <input type="text" class="form-control"  placeholder="Enter your last name" name="lname">
					    <input type="text" class="form-control bday"  placeholder="Enter your birthday" name="dob">
					  </div>
					  <button type="submit" class="btn btn-theme">Sign Up</button>
					</form>					
				</div>
				
				
			</div>
		</div>
	</div>
	<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
					<p class="copyright">Copyright &copy; 2014 - Bootstraptaste.com</p>
			</div>
		</div>		
	</div>	
	</div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js')?>"></script>
	<script>
		$('.bday').datepicker()
	</script>
  </body>
</html>