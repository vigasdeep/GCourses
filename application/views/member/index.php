<?php $this->load->view('member/header'); ?>



<div id="container"> 
	<h1>Users Area</h1>

	<?php if($confirmed != 1) { ?>
	<span class="alert red">Some features of our website requires authenticated users. Please Confirm your Email Address . <a href="<?php echo site_url("/user/logout"); ?>">Click here.</a></span>
	<script language="javascript">
	setTimeout("top.location.href = 'http://www.devplace.in/index.php/user/logout'",5000);
	</script>
	<?php }else {?>	

	<br/><br/>

	<div style="width:972px; overflow:auto;">

		<div style="width:80%; margin:0 auto; border:1px #888 solid; padding:1px;">
			<span style="display:inline-block; width:98%; padding: 10px 0px 10px 10px; background: -webkit-gradient(linear, left top, left bottom, from(#999999), to(#ccc));
background: -moz-linear-gradient(top, #999, #ccc); color:white; margin-left:3px;">Information..</span>
<ol style="margin-left:30px; margin-top:10px;">
<li> Go through the <a href="<?php echo site_url('member/ViewInfo/courses'); ?>">List of courses</a>.</li>
	<li> <a href="<?php echo site_url('member/basicInfo/basic'); ?>">Apply for course</a></li>
<li>Fill reqired informations. </li>
<li>Take print out of receipt, after you save/update the application.</li>

</ol>


			<span style="display:inline-block; width:98%; padding: 2% 0px 2% 2%; background:#f9f9f9; font-size:2px;  height:200px;"> 
<div class="editProfileForm">
</div>


</span>
		</div>
	</div>

<!--	<div style="width:968px; border:1px #888 solid; padding:1px; margin-top:15px;">
		<span style="display:inline-block; width:99%; padding: 10px 0px 10px 10px; background: -webkit-gradient(linear, left top, left bottom, from(#999999), to(#ccc));
background: -moz-linear-gradient(top, #999, #ccc); color:white;">User &ndash; Resume Sub-Profiles</span>
		<span style="display:inline-block; width:98%; padding: 2% 0px 2% 2%; background:#f9f9f9; font-size:12px;"> Rotating Image Gallery of Latest X number of products.</span>
	</div>-->
	<br/><br/><br/><br/>
</div>


<?php } $this->load->view('footer'); ?>
