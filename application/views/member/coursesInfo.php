<?php $this->load->view('member/header'); 
	 $this->load->view('functions'); 
?>
<div id="container"> 
	<h1>Add Course</h1>


	<br/>
	<div class="editProfileForm">
<?php
if(isset($success)){
		echo $success;
echo '<a href="'.current_url().'">'.form_button('',' Go back !').'</a>';


}else{
	echo form_open();

//	echo form_hidden('course_id',$param);
//	if($param != "" && isset($form)) echo form_hidden('id',$form['id']);
	$basicElements=array('Course Name','Course Details','Start Date','End Date','Course Fee Structure');
	if(!isset($form)) $form="";

	textInput($basicElements,$form);
?>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript">
	$(function() {
		$( "#start_date" ).datepicker({
			changeMonth:true,
				changeYear:true,
				dateFormat: "dd-mm-yy",
		});
		$( "#end_date" ).datepicker({
			changeMonth:true,
				changeYear:true,
				dateFormat: "dd-mm-yy",
		});
	});
	</script>

<?php

echo form_label(' ', ' ');
	echo form_submit('submit','Save');


		echo '<a href="'.site_url('member/viewInfo/courses').'">'.form_button('','Cancel, Go back !').'</a>';


}
	?>
	</div>
	<br/><br/>
</div>



<?php $this->load->view('member/footer'); ?>
