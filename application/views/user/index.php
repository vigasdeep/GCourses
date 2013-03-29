<?php $this->load->view('header'); ?>

<div id="container">
	
<div class="siteSlider">

	<h1 style=""> Welcome.</h1>
		
	<br />
<h4>Instructions</h4>
 <ol style="margin-left:30px;">
	<li> <a href="<?php echo site_url('user/signup'); ?>" >Register</a> yourself. </li>
<li> Check your email inbox ( SPAM / JUNK ), and activate your account with given hyperlink.  </li> 
<li> Do Login, and then follow the instructions on the screen.</li> 
</ol>
</div>
	
	
</div>
<!--
<div style="margin-top:100px; width:100%;">
	<span class="siteLogo"></span>		
	<span style="width:406px; height : 100px; display:block; margin: auto;">
		<span class="menuRadio">Hotels</span>
		<span class="menuRadio">Resorts</span>
		<span class="menuRadio">Flights</span>
		<span class="menuRadio">Rentals</span>
		<span class="menuRadio selectedRadio">All</span>
	</span>
	<form method="get" action="<?php echo base_url("index.php/search");?>">
		<input name="category" value="All" type="hidden" id="cat" />
		<input name="search" type="text" size="40" placeholder="Search..." id="search" />
	</form>
<center>
<span class="mainLinks"><a href="<?php echo base_url("index.php/search/advance"); ?>">Advance Search</a> &ndash; <a href="<?php echo base_url("index.php/business/register"); ?>">Business Registration</a> &ndash; <a href="<?php echo base_url("index.php/advertise"); ?>">Advertise With Us</a></span>
</center>
</div>

<script>
$(document).ready(function(){
	$('.siteLogo').animate({opacity:0.6});

	$('.siteLogo').mouseenter(function(){ $(this).animate({opacity:0.9}); });
	$('.siteLogo').mouseleave(function(){ $(this).animate({opacity:0.6}); });

	$('.menuRadio').click(function(){
		$('#cat').val($(this).html());
		$('.menuRadio.selectedRadio').removeClass("selectedRadio");
		$(this).addClass("selectedRadio");
	});

});
</script>
-->
<?php $this->load->view('footer'); ?>
