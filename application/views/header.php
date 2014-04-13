<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.png')?>">

    <title><?php echo $title?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/css/bootstrap.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/bootstrap-theme.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/datepicker.css')?>" rel="stylesheet">

    <!-- siimple style -->
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-multiselect.css')?>" type="text/css"/>
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
          <a class="navbar-brand" href="<?echo base_url()?>">Connectify</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?if(isset($loggedin) && $loggedin != false){?>
            <li><a href="<?echo site_url('user/search')?>">Search</a></li>
            <li><a href="<?echo site_url('user/pendingrequests')?>">Requests</a></li>
            <li><a href="<?echo site_url('user/profile')?>">Profile</a></li>
            <li><a href="<?echo site_url('user/friends')?>">Friends</a></li>
            <li><a href="<?echo site_url('group/showall')?>">Groups</a></li>
            <li><a href='<? echo site_url('user/logout')?>'>Sign out</a></li> 
            <? } else { ?>
            <li data-toggle='modal' data-target='#loginModal' ><a href='#'>Sign in</a></li>
              <?
            }
            ?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="alert alert-success alert-dismissable fixed-top" id="success" style="display:none; z-index:100">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong>Success!</strong> .
    </div>
    <div class="alert alert-danger alert-dismissable fixed-top" id="failed" style="display:none; z-index:100"> 
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong>Something went wrong!</strong> .
    </div>

    <div id="loginModal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Login</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" action="<? echo site_url('user/login') ?>" method="POST">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Username" name="username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Password" name="password">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Sign In</button>
            </div>
          </form>
      </div>
      <div class="modal-footer">
         
      </div>  
      </div>
  </div>
  </div>
</div>
