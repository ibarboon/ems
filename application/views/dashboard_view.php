<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>EMS | Dashboard</title>
		<link href="<?php echo base_url('/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/css/font-awesome.min.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/css/custom.css') ?>" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">Education Management Systems</a>
				</div>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
					<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
					</li>
					<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
					</li>
					<li class="divider"></li>
					<li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
					</li>
					</ul>
					</li>
				</ul>
				<div class="navbar-default navbar-static-side" role="navigation">
					<div class="sidebar-collapse">
						<ul class="nav" id="side-menu">
							<li>
								<a href="<?php echo site_url('/'); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Dashboard</h1>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo base_url('/assets/js/jquery-1.11.1.min.js') ?>"></script>
		<script src="<?php echo base_url('/assets/js/bootstrap.min.js') ?>"></script>
	</body>
</html>