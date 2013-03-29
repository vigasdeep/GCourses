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
	<script type="text/javascript">
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
	$("#zone").change(function() {

		//get what they selected
		var selected = $("option:selected",this).val();
		//no matter what, clear the other DD
		//Tip taken from: http://stackoverflow.com/questions/47824/using-core-jquery-how-do-you-remove-all-the-options-of-a-select-box-then-add-on
		$("#sub_zone").children().remove().end().append("<option value=\"\">Select Sub Zone</option>");

		//now load in new options if I picked a state
		if(selected == "") return;
		var jsn="<?php echo site_url('member/SelectBoxData' ) . '?zone=';?>" + selected;
		$.getJSON(jsn,{"sub_zone":selected}, function(res,code) {
			var newoptions = "";
			$.each( res, function( key, value ) {
				newoptions += "<option value=\"" + key + "\">" + value + "</option>";
			});

			$("#sub_zone").children().end().append(newoptions);
			if(subz != null){ $("#sub_zone").val( subz ).attr('selected',true); }
		});
	});	
	});
	</script>
<script type="text/javascript">

	$('.top960 span').click(function(){
		window.location = "<?php echo base_url(); ?>";
	}); 

</script>
<style>
.jcarousel-skin-tango .jcarousel-container {
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
   border-radius: 10px;
    background: transparent;
    border: none;
}

.jcarousel-skin-tango .jcarousel-container-horizontal {
    width: 500px;
    padding: 15px 40px;
}

.jcarousel-skin-tango .jcarousel-clip-horizontal {
    width:  500px;
    height: 75px;
}
.jcarousel-skin-tango .jcarousel-next-horizontal {
	top:35px !important;
}
.jcarousel-skin-tango .jcarousel-prev-horizontal {
	top:35px !important;
}
</style>


<!-- Auto compelte
	<link rel="stylesheet" href="http://static.jquery.com/ui/css/base2.css" type="text/css" media="all" />-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js" type="text/javascript"></script>

<!--Auto Complete-->
</head>

<body>


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
	 <li><a href="<?php echo site_url('member/basicInfo/basic');?>">Apply for Course</a></li>
<li><a href="<?php echo site_url('member/viewInfo/courses');?>">List Of Courses</a></li>
<!--	 <li><a href="<?php echo site_url('member/viewInfo/tf');?>">BlockB TF</a></li>
<li><a href="<?php echo site_url('member/viewInfo/sf');?>">BlockC SF</a></li>
 <li><a href="<?php echo site_url('member/viewInfo/of');?>">BlockD OF</a></li>
<li><a href="<?php echo site_url('member/viewInfo/af');?>">BlockE AF</a></li>
<li><a href="<?php echo site_url('member/getPDF');?>">Get Resume</a></li>
<li><a href="<?php echo site_url('member/viewInfo/auv');?>">AUV Percentage</a></li>

<li><a href="<?php echo site_url('member/viewInfo/lat');?>">Lumsum Annucal Tax</a></li>
<li><a href="<?php echo site_url('member/viewInfo/partg');?>">Part G dates</a></li>
<li><a href="<?php echo site_url('member/viewInfo/z');?>">Zone</a></li>
<li><a href="<?php echo site_url('member/viewInfo/subz');?>">Sub Zone</a></li>-->



</ul>


	</div>
</div>

