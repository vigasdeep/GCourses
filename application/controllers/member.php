<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Controller {

		private $data;
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));		
		$this->load->model('member_model');
		$this->load->library('session');
		
		$checkLoggedIn = $this->member_model->checkLoggedIn();

		if($checkLoggedIn == false){
			redirect(site_url('user/login'));
		}else{
			$this->data['username'] = $checkLoggedIn->username;
			$this->data['id'] = $checkLoggedIn->id;
			$this->data['email'] = $checkLoggedIn->email;
			$this->data['confirmed'] = $checkLoggedIn->confirmed;
		}

	}

	public function index(){

	/*	$this->load->helper(array('form', 'url'));		
		$this->load->model('member_model');
		$this->load->library('session');
	  
		$checkLoggedIn = $this->member_model->checkLoggedIn();

		if($checkLoggedIn == false){
			$this->load->view('user/login');
		}else{
			$data['username'] = $checkLoggedIn->username;
			$data['id'] = $checkLoggedIn->id;
			$data['email'] = $checkLoggedIn->email;
	 		$data['confirmed'] = $checkLoggedIn->confirmed;
*/
			$this->load->view('member/index',$this->data);
	//	}
	}
	public function SelectBoxData(){
		$zone = $_GET['zone'];
		$this->member_model->selectUserData("zone",NULL,NULL,0);
	$subzones = $this->member_model->selectUserData("sub_zone",NULL,NULL,0);
		
		
		
	$subz = array();
	foreach($subzones as $subzone){
		$subz[$subzone['zone_id']][$subzone['id']]= $subzone['name'] ;
	}
		echo json_encode( $subz[$zone] );

	}
	public function autoCompleteSearchData(){	
		
		$dataRows = $this->member_model->selectUserData("survey_form",NULL,NULL,0);
		$term = trim(strip_tags($_GET['term']));
		 
		$matches = array();
		foreach($dataRows as $Row){
			if(stripos($Row['name'], $term) !== false){
				// Add the necessary "value" and "label" fields and append to result set
				$Row['value'] = $Row['name'];
				$Row['label'] = "{$Row['name']}, {$Row['father_name']}, {$Row['property_no']}";
				$matches[] = $Row;
			}
		}

		// Truncate, encode and return the results
		$matches = array_slice($matches, 0, 5);
		print json_encode($matches);
	}


	public function getReceipt(){

		$this->db->select('*');
		$this->db->from('studentRegister');
		$this->db->where('studentRegister.id', $this->data['id']); 
		$this->db->join('courses', 'courses.course_id = studentRegister.course','left');
		$this->db->join('branches', 'branches.branch_id = studentRegister.branch','left');

		$query = $this->db->get();
	$row = $query->row_array();
//		$dataRows = $this->member_model->selectUserData('studentRegister',$this->data['id'],'id');
//		echo $this->data['id'];
//		print_r($dataRows);
		//$house_no = $DRow['address'];
	//	$property_no = $DRow['property_no'];
	//	$annual_tax = $DRow['tax_payable'];
	//	$amount_paid = $DRow['net_payment'];
	//	$receipt_no = "_________";
	//	$book_no = "________";
//	print_r($row);
	?>

<html>
<head>
<style >
@media print,screen {
*{
font-family:Times;
margin:0;
padding:0;
line-height:2em;
}
.center {
text-align:center;
margin: 0 auto;
}

}
</style>
</head>

<body>
<div style="width:380px; padding:0 10px;margin-top:20px;  border:1px solid #ccc;">
<h5  class="center">Six Weeks Training</h5>
<h5 class="center" style="margin-top:-10px;">on</h5>
<h2 style="margin-top:-10px;" class="center"><?php echo $row['course_name']; ?></h2>
<h5  style="margin-top:-10px;" class="center">(<?php echo $row['start_date']." TO ".$row['end_date'];  ?>)</h5>
<h4 style="margin-top:-10px;" class="center">Application Form</h4>
	Name : <b><?php echo $row['name'];?> </b>
<br>Father's Name : <b><?php echo $row['father_name'];?> </b>
<br> Date of Birth : <b><?php echo $row['dob'];?> </b>
<br>Branch : <b><?php echo $row['branch_name'];?> </b> 
<br>Class Roll No : <b><?php echo $row['roll_no'];?> </b>

<br>Affiliation (College/Institute/Organisation): <b><?php echo $row['affiliation_institute'];?> </b>

<br>Univ. Roll no : <b><?php echo $row['university_roll_no'];?> </b>

<br>Mailing Address : <b><?php echo $row['mailing_address'];?> </b>

<br>Contant No. : <b><?php echo $row['contact_number'];?> </b>

<br>Email: <b><?php echo $this->data['email'];?> </b>

<br>Bank Draft No. / Cash : <b><?php echo $row['draft_no'];?> </b>
<br>
<div style="text-align:right;" >Please register me for above course.</div><br>
<hr>
<div style="float:right;"><h6>Signature of the Applicant</h6></div>

</div>
	<script>
	window.print();
	</script>
</body>
</html>

	<?php
	}// Get recipt function ends
	public function basicInfo(){
		$this->load->helper(array('form', 'url'));		
		$this->load->model('member_model');
		$this->load->library('session');

		$checkLoggedIn = $this->member_model->checkLoggedIn();
		if(($checkLoggedIn == false)){
			$this->load->view('user/login');
		}else{
			$data = $this->assignSessionToData($checkLoggedIn);
			if($this->uri->segment(3, 0) != FALSE)	$data['route'] = $this->uri->segment(3, 0);
			else $data['route'] = "";
			if($this->uri->segment(4, 0) != FALSE)	$data['param'] = $this->uri->segment(4, 0);
			else $data['param'] = "";
			$table = $this->find_route($data['route']);
			$tablePri = $this->find_primary_field($data['route']);
			if($table != "no"){
				if($this->uri->segment(4, 0) != FALSE)	$data['param'] = $this->uri->segment(4, 0);
				else $data['param'] = $data['id'];
				if($this->input->post()){
					$insertData = $_POST; 
					if(!isset($insertData[$tablePri])) 
						$insertData[$tablePri] = "";
					if($this->member_model->updateData($insertData,$table,$tablePri,$insertData[$tablePri]))
						$data['success'] = "Your Request has been saved/updated successfully. ";
				}
				$userData = $this->member_model->selectUserData($table,$data['param'],$tablePri);
				$opts = "";
				$zid = "";
				if($data['route'] == "basic"){
					$courses = $this->member_model->selectUserData('courses',0,NULL,0, 3, 4);
					foreach($courses as $course){
						$crs[$course['course_id']] = $course['course_name'];
					}
					$branches = $this->member_model->selectUserData("branches",0,NULL,0);
					foreach($branches as $branch){
						$brch[$branch['branch_id']] = $branch['branch_name'];
					}
					$data['courses'] =$crs;
					$data['branches'] =$brch;
				}
					
				$data['form'] = $userData;
				$this->load->view('member/'.$data['route'].'Info',$data);	
		
			}else { /* 404 */}
	
	
		}
	}
	
	public function deleteRow(){
		$this->load->helper(array('form', 'url'));		
		$this->load->model('member_model');
		$this->load->library('session');

		$checkLoggedIn = $this->member_model->checkLoggedIn();
		if($checkLoggedIn == false){
			$this->load->view('user/login');
		}else{
			$data = $this->assignSessionToData($checkLoggedIn);
			if($this->uri->segment(3, 0) != FALSE)	$data['route'] = $this->uri->segment(3, 0);
			else $data['route'] = "";
			if($this->uri->segment(4, 0) != FALSE)	$data['param'] = $this->uri->segment(4, 0);
			else $data['param'] = "";
			$table = $this->find_route($data['route']);
			if($table != "no"){
				$data['success'] = $this->member_model->deleteRows($table,$data['param'],'parent_id',$data['id']);
						//$data['success'] = "Your entry has been saved successfully";
				
				$this->load->view('member/deleteInfo',$data);	
		
			}else { /* 404  */}
	
	
		}
	}
	
	public function viewInfo(){
		$this->load->helper(array('form', 'url'));		
		$this->load->model('member_model');
		$this->tableStyle();		
		$checkLoggedIn = $this->member_model->checkLoggedIn();
		if($checkLoggedIn == false){
			$this->load->view('user/login');
		}else{
			$data = $this->assignSessionToData($checkLoggedIn);
		if($this->uri->segment(3, 0) != FALSE){	$data['route'] = $this->uri->segment(3, 0);$route=$data['route']; }
		else {$data['route'] = "";}
				$table = $this->find_route($data['route']);
			if($table != "no"){
				$userData = $this->member_model->selectUserData($table,'','',0, 3, 4);
				if($userData != FALSE )
					$data['userData'] = $userData;
				$basicElementView=$this->findTableHead($data['route'],$data['admin']);
				$smallElements = $this->db->list_fields($table);
				$this->table->set_heading($basicElementView);
			if(isset($data['userData'])){
				if($data['route'] == 'courses'){
					foreach($data['userData'] as $row){
						if(!$data['admin']){

						$this->table->add_row($row[$smallElements[1]],$row[$smallElements[2]],$row[$smallElements[3]],$row[$smallElements[4]],$row[$smallElements[5]]);
						}else{
						$this->table->add_row('<a href="'.site_url('member/basicInfo/courses/'.$row[$smallElements[0]]).'">Edit</a>',$row[$smallElements[1]],$row[$smallElements[2]],$row[$smallElements[3]],$row[$smallElements[4]],$row[$smallElements[5]], '<a href="'.site_url('member/viewStudents/'.$row[$smallElements[0]]).'">View Students</a>');
						}
					}
				}else {}
			}
				$data['dataTable'] = $this->table->generate(); 
			$this->load->view('member/'.$data['route'].'ViewInfo',$data);
			}else{
				$this->load->view('404');
			}
		}
	}
	/*
	 * Function to Generate the Resume PDF
	 *
	 *
	 */
		public function find_primary_field($handle){
		$directions=array(
			'courses'=> 'course_id',
			'basic'  => 'id',
		);
		if(array_key_exists($handle, $directions))	
			return $directions[$handle];
		else
			return "no";
	}public function find_route($handle){
		$directions=array(
			'courses'=> 'courses',
			'basic'  => 'studentRegister',
		);
		if(array_key_exists($handle, $directions))	
			return $directions[$handle];
		else
			return "no";
	}
	public function findTableHead($handle,$admin=0){
		$directions=array(
			'basic'  => 'resume_personal',
			'courses' => array('Course Name','Details','Start Date','End Date','Fee Structure'),
		);
		$directionsAdmin =array(
			'basic'  => 'resume_personal',
			'courses' => array('Operations','Course Name','Details','Start Date','End Date','Fee Structure'),
		);
		if($admin){
			return $directionsAdmin[$handle];
		}else{
			return $directions[$handle];
		}
	}
	public function tableStyle(){
				$this->load->library('table');
		$tmpl = array (
                    'table_open'          => '<table border="1" cellpadding="4" cellspacing="2" width="100%">',
                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',
                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',
                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',
                    'table_close'         => '</table>'
              );
		$this->table->set_template($tmpl); 
	
	}
	public function assignSessionToData($checkLoggedIn){
		
		$this->load->library('session');
		$data['username'] = $checkLoggedIn->username;
		$data['id'] = $checkLoggedIn->id;
		$data['email'] = $checkLoggedIn->email;
		$data['confirmed'] = $checkLoggedIn->confirmed;
		$data['admin'] = $checkLoggedIn->admin;
		return $data;
	}

	public function viewStudents($course = null)
	{
		//Lets show them the students.
		$this->load->model('member_model');
		$checkLoggedIn = $this->member_model->checkLoggedIn();
		if(($checkLoggedIn == false)){
			$this->load->view('user/login');
		}
		else
		{
			$data = $this->assignSessionToData($checkLoggedIn);
			$this->db->select('*');
			$this->db->from('studentRegister');
			$this->db->join('courses', 'courses.course_id = studentRegister.course');
			$this->db->join('branches','branches.branch_id = studentRegister.course');
			$this->db->where('course_id', $course);
			$query = $this->db->get();
			$data['students'] = $query->result();
			$this->load->view('member/header',$data);
			$this->load->view('functions', $data);
			$this->load->view('studentregister', $data);
		}

	}	


}
?>
