<?php $this->load->view('member/header'); 
	 $this->load->view('functions'); 
?>
<div id="container"> 


	<br/>
	<div class="editProfileForm">
<?php
if(isset($success)){
		echo $success;
}
	?>
	</div>
	<br/><br/>
</div>



<?php $this->load->view('member/footer'); ?>
