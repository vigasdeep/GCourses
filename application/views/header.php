<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>GNDEC Courses</title>
	<base href="<?php echo base_url(); ?>"/>
	<link href="css/default.css" rel="stylesheet" type="text/css" />
	<link type="text/css" rel="stylesheet" href="css/demo.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/jqtransformplugin/jqtransform.css" />
	<link rel="stylesheet" type="text/css" href="css/formValidator/validationEngine.jquery.css" />
	<link href='http://fonts.googleapis.com/css?family=Concert+One' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="css/jqtransformplugin/jquery.jqtransform.js"></script>
	<script type="text/javascript" src="css/formValidator/jquery.validationEngine.js"></script>
	<!--<link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />-->

	
<link href="css/Styles/ui-lightness/jquery-ui-1.8.13.custom.css"        rel="stylesheet" type="text/css" />
    <link href="css/Styles/Site.css" rel="stylesheet" type="text/css" />

    <script src="css/Scripts/jquery-1.6.1.min.js" type="text/javascript"></script>
    <script src="css/Scripts/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script>
    <script src="css/Scripts/jquery.validate.min.js" type="text/javascript"></script>
    <script src="css/Scripts/jquery.validate.wrapper.js" type="text/javascript"></script>
	




</head>

<body>
<?php if(isset($username) && isset($id)){ ?>

<!-- Top bar -->
<div class="topBar">
	<div class="top960">
		<span class="logo"><a href="<?php echo site_url(); ?>">GNDEC Courses</a></span>
		<div class="searchBox">
			<span><em>Hey, <?php echo $username;?>! (<a href="<?php echo base_url("index.php/user/logout"); ?>">Logout</a>)</em></span>
		</div>
		
	</div>
</div>
<!-- Top bar -->

<div class="topNavBar">
	<div class="top960">
		<ul>
		<li><a href="<?php echo site_url('member');?>">Home</a></li>
<!--	 <li><a href="<?php echo site_url('member/basicInfo/basic');?>">Basic Information</a></li>-->
<li><a href="<?php echo site_url('member/viewInfo/uf');?>">BlockA UF</a></li>
	 <li><a href="<?php echo site_url('member/viewInfo/tf');?>">BlockB TF</a></li>
<li><a href="<?php echo site_url('member/viewInfo/sf');?>">BlockC SF</a></li>
 <li><a href="<?php echo site_url('member/viewInfo/of');?>">BlockD OF</a></li>
<li><a href="<?php echo site_url('member/viewInfo/af');?>">BlockE AF</a></li>
<!--<li><a href="<?php echo site_url('member/getPDF');?>">Get Resume</a></li>
-->


		</ul>


		<div class="loginButton" id="buttonLogin"><div><a href="<?php echo base_url("index.php/user/logout"); ?>">Logout</a></div></div>
	</div>
</div>



<?php } else { ?>
<!-- Top bar -->
<div class="topBar">
	<div class="top960">
		<span class="logo"><a href="<?php echo site_url(); ?>">GNDEC Courses</a></span>
<!--		<div class="searchBox">
		<!--	<span><em>New here? Lets take a tour!</em></span>
			<form method="get" action="<?php echo base_url("index.php/search"); ?>" ><input type="hidden" name="category" value="All"><input type="text" id="searchField" name="search" value="Search here..."/><input type="submit" id="searchSubmit" value="G O"/></form> <!-- &rArr; --
		</div>-->
		
	</div>
</div>
<!-- Top bar -->

<div class="topNavBar">
	<div class="top960">
		<ul>
			<li><a href="">Home</a></li>
		</ul>


		<div class="loginButton" id="buttonLogin"><div><?php echo $this->lang->line('login');?></div></div>
		<div class="loginButton" id="button"><div><?php echo $this->lang->line('signup');?></div></div>
	</div>
</div>
<?php } ?>
