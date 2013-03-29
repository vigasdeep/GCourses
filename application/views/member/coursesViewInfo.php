<?php $this->load->view('member/header'); 
	 $this->load->view('functions'); 
?>
<div id="container"> 
	<h1>List Of Courses</h1>
<style>
table {
border:1px solid #ccc;
}
td{
border:1px solid #ccc;
padding:3px;
}
th{
border:1px solid #000;
}
</style>
<?php if($admin){ echo '<a href="'.site_url('member/basicInfo/courses').'">'.form_button('','Add one').'</a>';} ?>

	<br/>
	<?php
//	echo form_open();
//	echo form_hidden('id',$id);
///	$basicElements=array('Qualification','College','University','From','To','Marks Obtained','Marks Total');
//	if(!isset($form)) $form="";

//textInput($basicElements,$form);
//	echo form_label(' ', ' ');
//	echo form_submit('submit','Save Profile');
echo $dataTable;

	?>
	<br/><br/>
</div>



<?php $this->load->view('member/footer'); ?>
