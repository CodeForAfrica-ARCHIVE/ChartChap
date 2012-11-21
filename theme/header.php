<?php
require_once('config.php');
require_once('stats.php');
require_once('mostrecent.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Chart Chap! - Data Visualization on The Fly</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Olas Navigator">

	<!-- bootstrap css -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	
	<!-- template css -->
	<link href="app/css/styles.css" rel="stylesheet">
	<link href="app/css/demo.css" rel="stylesheet">
	
	<link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">

	<!-- HTML5 shim -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- sample fav and touch icons -->
	<link rel="shortcut icon" href="assets/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
	<!-- Header -->
	<div id="header">
		<!-- top navbar -->
		<div class="navbar navbar-blue">
			<div class="navbar-inner">
				<a class="brand" href="index.php">Chart Chap!</a>
				<ul class="nav pull-right">
					<li class="active"><a href="index.php"><i class="icon-large"><img src='icons/home.png' style='height:15px;'></i> Home</a></li>
					<li><a href="messages.html"><i class="icon-large"><img src='icons/about.png' style='height:17px;'></i> About</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-large"><img src='icons/tutorial.png' style='height:15px;'></i> Tutorial <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Topic</a></li>
							<li><a href="#">Topic2</a></li>
							<li><a href="#">Topic4</a></li>
							<li><a href="#">Topic5</a></li>
							<li><a href="#">Topic5</a></li>
						</ul>
					</li>
					
					<li><a href="messages.html"><i class="icon-large"><img src='icons/feedback.png' style='height:15px;'></i> Feedback</a></li>
					<li class="divider-vertical"></li>
					<li><a href="#"><i class="icon-large"><img src='icons/github.png' style='height:15px;'></i> Github</a></li>
				</ul>
			</div>
		</div><!-- ./ top navbar -->
	</div>

	<div id="page-wrap">
		<!-- left sidebar -->
		<div id="main-sidebar">
		
			<!-- sidebar user avatar -->
			<div class="user-profile">
				<img src="icons/icon4.png">
				<h3></h3>
				<small><a href="#"></a></small>
			</div><!-- ./ sidebar user avatar -->
			
			<div class="accordion" id="sbAccordion">
				
				<!-- accordion content -->
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="btn btn-primary btn-block" href="index.html">Home</a>
					</div>
				</div><!-- ./ accordion content -->
				
				<!-- accordion content -->
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#sbAccordion" href="#sbaOne">Datasets</a>
					</div>
					<div id="sbaOne" class="accordion-body collapse">
						<div class="accordion-inner">
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
								<li><a tabindex="-1" href="typography.html"><i class="icon-file icon-large"></i> sub1</a></li>
								<li><a tabindex="-1" href="tables.html"><i class="icon-file icon-large"></i> sub2</a></li>
							</ul>
						</div>
					</div>
				</div><!-- ./ accordion content -->
				
				<!-- accordion content -->
				
				<!-- accordion content -->
				
				
				<!-- accordion content -->
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#sbAccordion" href="#sbaFour">Visualizations</a>
					</div>
					<div id="sbaFour" class="accordion-body collapse">
						<div class="accordion-inner">
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
								<li><a tabindex="-1" href="info-widgets.html"><i class="icon-file icon-large"></i> Sub1</a></li>
								<li><a tabindex="-1" href="well-dropdowns.html"><i class="icon-file icon-large"></i> Sub2</a></li>
								
							</ul>
						</div>
					</div>
				</div><!-- ./ accordion content -->
				<div align='center' style='margin-top:70px;'>
<img src='icons/merge.png'><br>Merge datasets</div>
					</div>       
		</div>

		<div id="main-content">
			<div id="inner">	
						
				<div class="container-fluid">
					<div class="tabbable main-tabs">
						<!-- main content title -->
						

						<div class="tab-content">
							<div class="tab-pane active" id="mainTabReports">
								<div class="row-fluid">