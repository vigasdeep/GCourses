<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
<link href="<?php echo base_url(); ?>application/css/default.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="container">
	<h1><?php echo $this->lang->line('signup');?></h1>

	<div id="body">

			<form action="<?php echo base_url();?>index.php/user/login" method="post">
			<table>
				<tr>
		<td><?php echo $this->lang->line('username');?> </td><td> <input type="text" name="username"/> </td>
				</tr>
				<tr>
		<td><?php echo $this->lang->line('password');?> </td><td> <input type="text" name="password" /> </td>
				</tr>
				<tr>
		<td colspan="2"><input type="submit" value="<?php echo $this->lang->line('login');?>"></td>
				</tr>
			</table>
		</form>
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>
