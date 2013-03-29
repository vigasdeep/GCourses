<?php 
function textInput($elements,$value){
foreach($elements as $key=>$val){

	$val_=str_replace(' ','_',strtolower($val));

	echo form_label($val.' : ', $val_);

	if(isset($value[$val_])){
		$attribs = array(
			'id'          => $val_,
			'name' => $val_,
			'value'		=>$value[$val_]	
		);
	
		echo form_input($attribs)."<br />";
		
	}else{
		$attribs = array(
			'id'          => $val_,
			'name' => $val_,
		);
	
		echo form_input($attribs)."<br />";
		
	}
}
}

?>
