<?php $this->load->view('member/header'); 
	$this->load->view('functions'); 
?>
<div id="container"> 
	<h1>My Application</h1>
<?php 
	if(isset($success))
		echo "<span class=\"alert red\">". $success. "<a href=\"".site_url('member/getReceipt')."\">Get Receipt</a></span>";
?><style>
select {
width:200px;
}
</style>

	<br/>
	<div class="editProfileForm">
<?php
	echo form_open();
	echo form_hidden('id',$id);	

	echo form_label('Course you want to join:','');
	$course="";
	if(isset($form['course'])){
		$course = $form['course'];
	}else{
		$course = "";
	}
	echo form_dropdown('course',$courses,$course);
	$basicElements=array('Name','Father Name','DOB');

	$basicElements1=array('University Roll No','University');
	$basicElements2=array('Mailing Address','Contact Number');
	textInput($basicElements,$form);

	if(isset($form['roll_no'])){
		$roll_no = $form['roll_no'];
	}else{
		$roll_no="";
	}
	echo form_label('Class Roll No :','');
	echo form_input('roll_no',$roll_no);

	if(isset($form['affiliation_institute'])){
		$affiliation_institute = $form['affiliation_institute'];
	}else{
		$affiliation_institute="";
	}
	echo form_label(' Affiliation (college/Institute/Organisation) :','');
	echo form_input('affiliation_institute',$affiliation_institute);

	textInput($basicElements1,$form);
	if(!isset($form)) $form="";
	echo form_label('Branch:','');

	$branch="";
	if(isset($form['branch'])){
		$branch = $form['branch'];
	}else{
		$branch="";
	}
	echo form_dropdown('branch',$branches,$branch);
?>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript">
	$(function() {
		$( "#dob" ).datepicker({
			changeMonth:true,
				changeYear:true,
				dateFormat: "dd-mm-yy",
				yearRange: "1950:2000",
				defaultDate: new Date(1991, 1 - 1, 1)
		});
	});
	</script>
<?php

	textInput($basicElements2,$form);
	$data0 = array(
		'name'        => 'accomodation_required',
		'id'          => 'newsletter',
		'value'       => '0',
		//		'checked'     => TRUE,
		'style'       => 'margin:10px',
	);

	if(isset($form['accomodation_required'])){
		if($form['accomodation_required'] == "0") $data0['checked'] = TRUE;
		$data1 = array(
			'name'        => 'accomodation_required',
			'id'          => 'newsletter',
			'value'       => '1',
			'style'       => 'margin:10px; margin-left:30px;',
		);

		if($form['accomodation_required'] == "1") $data1['checked'] = TRUE;
	}else{
		$data1="";
		$data0="";
	}
	echo form_label('Accomodation Required:', ' ');
	echo form_radio($data0). "No ";
	echo form_radio($data1). "Yes ";
	echo form_label('Draft No / Cash:','');
	if(isset($form['draft_no'])){
		$draft_no=$form['draft_no'];
	}else{
		$draft_no ="";
	}
	echo form_input('draft_no',$draft_no);


	echo form_label(' ', ' ');
	echo form_label(' ', ' ');
	echo form_submit('submit','Save Profile');


?>
	</div>
	<br/><br/>
</div>



<?php $this->load->view('member/footer'); ?>
