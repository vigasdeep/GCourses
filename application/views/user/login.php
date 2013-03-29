<?php $this->load->view('header'); ?>

<div id="container">
	<h1><?php echo $this->lang->line('signup');?></h1>
<span class="alert red">
<?php	if(isset($_GET['error']))
	echo $_GET['error'];

?></span>
	<div id="body">

			<form action="<?php echo base_url();?>index.php/user/login" method="post">
			<table>
				<tr>
		<td><?php echo $this->lang->line('username');?> </td><td> <input type="text" name="username"/> </td>
				</tr>
				<tr>
		<td><?php echo $this->lang->line('password');?> </td><td> <input type="password" name="password" /> </td>
				</tr>
				<tr>
		<td colspan="2"><input type="submit" value="<?php echo $this->lang->line('login');?>"></td>
				</tr>
			</table>
		</form>
		
	</div>

</div>

<?php $this->load->view('footer'); ?>
