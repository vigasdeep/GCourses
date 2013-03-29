<?php $this->load->view('header'); ?>

<div id="container">
	<h1>Forgot Password</h1>
<?php	if(isset($_GET['error']))
	echo $_GET['error'];

?>

	<div id="body">
		Please let us know your username, we will send password recovery email to your registered email address.

			<form action="<?php echo base_url();?>index.php/user/forgotPassword" method="post">
			<table>
				<tr>
		<td><?php echo $this->lang->line('username');?> </td><td> <input type="text" name="username"/> </td>
				</tr>
				<tr>
		<td colspan="2"><input type="submit" value="Recover Password"></td>
				</tr>
			</table>
		</form>
		
	</div>

</div>

<?php $this->load->view('footer'); ?>
