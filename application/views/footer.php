
<p class="footer">
<span style="float:left;">Page rendered in <strong>{elapsed_time}</strong> seconds.</span>
<span style="float:right; padding-right:20px;">Copyright &copy; 2012 <strong>GNDEC Courses</strong>.</span>
</p>

<div id="popupContainer" class="hidden popupContainer">
		<a id="close" class="hidden close" title="close popup"></a>
		<h1><?php echo $this->lang->line('quick_signup');?></h1>
		<p id="contactArea" class="contactArea">
        	<form action="<?php echo base_url("index.php/user/signup");?>" method="post">
			<table style="margin:auto;" cellspacing="5" cellpadding="5">
				<tr>
		<td><?php echo $this->lang->line('username');?> </td><td> <input type="text" name="username" class="leftspace" /> </td>
				</tr>
				<tr>
		<td><?php echo $this->lang->line('password');?> </td><td> <input type="password" name="password" class="leftspace" /> </td>
				</tr>
				<tr>
		<td><?php echo $this->lang->line('email');?> </td><td> <input type="text" name="email" class="leftspace" /> </td>
				</tr>
				<tr>
		<td colspan="2"><input type="submit" value="<?php echo $this->lang->line('signup');?>" class="submitButton"></td>
				</tr>
			</table>
		</form>
		</p>
	</div>
	<div id="overlayEffect" class="overlayEffect">
    </div>
  <!--end popup content--> 
  <div id="popupContainerLogin" class="hidden popupContainer">
		<a id="closeLogin" class="hidden close" title="close popup"></a>
		<h1><?php echo $this->lang->line('user_login');?></h1>
		<p id="contactAreaLogin" class="contactArea">
        	
			<form action="<?php echo base_url("index.php/user/login");?>" method="post">
			<table  style="margin:auto;" cellspacing="5" cellpadding="5">
				<tr>
		<td><?php echo $this->lang->line('username');?> </td><td> <input type="text" name="username" class="leftspace" /> </td>
				</tr>
				<tr>
		<td><?php echo $this->lang->line('password');?> </td><td> <input type="password" name="password" class="leftspace" /> </td>
				</tr>
				<tr>
		<td colspan="2"><input type="submit" value="<?php echo $this->lang->line('login');?>" class="submitButton"></td>
				</tr>
			</table>
		</form>
		</p>
	</div>
	<div id="overlayEffectLogin" class="overlayEffect">
    </div>
<!--end popup content--> 
<!--<script src="<?php echo base_url(); ?>scripts/jquery-1.5.js" type="text/javascript"></script>-->
	<script src="<?php echo base_url(); ?>scripts/script.js" type="text/javascript"></script>

</div>

</body>
</html>
