<?php $this->load->view('header'); ?>
<div id="container">
	<h1><?php echo $this->lang->line('signup');?></h1>

	<div id="body">
			<?php if(!isset($register)){ ?>
			<form action="<?php echo base_url();?>index.php/user/signup" method="post">
			<table>
				<tr>
		<td><?php echo $this->lang->line('username');?> </td><td> <input type="text" name="username"/> </td>
				</tr>
				<tr>
		<td><?php echo $this->lang->line('password');?> </td><td> <input type="password" name="password" /> </td>
				</tr>
				<tr>
		<td><?php echo $this->lang->line('email');?> </td><td> <input type="text" name="email" /> </td>
				</tr>
				<tr>
		<td colspan="2"><input type="submit" value="<?php echo $this->lang->line('signup');?>"></td>
				</tr>
			</table>
		</form>
		<?php } 
		else { ?>
		<p>
		Thank you for registration, please check your email for accont activation. If you do not receive email, you may wait for a while or check your <span style="color:red">SPAM / JUNK</span> folder.
		</p>

		<?php }?>
		
	</div>

	
</div>
<?php $this->load->view('footer'); ?>

