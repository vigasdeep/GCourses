<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jobs extends CI_Controller {

	public function index(){	
//$config['csrf_protection'] = FALSE;	
			$this->load->view('jobs/index');
	}
	
	public function addJobCategory(){
			$this->load->library('session');
			$this->load->library('table');
			$this->load->helper(array('form', 'url'));
			$this->load->model('jobs_model');
			$this->load->library('form_validation');
			if($_POST){

			
			$this->form_validation->set_rules('parentCategory', '<span class="fieldname">Parent Category</span>', 'required');
			$this->form_validation->set_rules('subCategory', '<span class="fieldname">Sub Category</span>', 'required');
			$this->form_validation->set_rules('jobTitle', '<span class="fieldname">Title</span>', 'required');
			$this->form_validation->set_rules('expiryDate', '<span class="fieldname">Expiry Date</span>', 'required');
			$this->form_validation->set_rules('tags', '<span class="fieldname">Tags</span>', 'required');
			$this->form_validation->set_rules('type', '<span class="fieldname">Type</span>', 'required|numeric');
			$this->form_validation->set_rules('role', '<span class="fieldname">Role</span>', 'alpha');
			$this->form_validation->set_rules('jobDescription', '<span class="fieldname">Description</span>', 'alpha_numeric');
			$this->form_validation->set_rules('salaryFrom', '<span class="fieldname">Salary From</span>', 'numeric');
			$this->form_validation->set_rules('salaryTo', '<span class="fieldname">Salary To</span>', 'numeric');
			$this->form_validation->set_rules('locations', '<span class="fieldname">Locations</span>', 'trim');	
			$this->form_validation->set_rules('employerTypes', '<span class="fieldname">Employer Types</span>', 'trim');
			$this->form_validation->set_rules('jobPicture', '<span class="fieldname">Job Picture</span>', '');
			if ($this->form_validation->run() == FALSE)
			{
				$category["category"]=$this->jobs_model->getJobCategory(1,null);
				$this->load->view('jobs/addJobCategory',$category);
			}else{
																		
			$jobsArray=array(
				'jobsData'=>array(
					'submitDate'	=>	time(),
					'expiryDate'	=>	strtotime($_POST['expiryDate']),
					'title'		=>	$_POST['jobTitle'],
					'type'		=>	$_POST['type'],
					'tags'		=>	$_POST['tags'],
					'category'	=>	$_POST['subCategory'],
					'parentCategory'=>	$_POST['parentCategory']

				),
				'jobsInformation'=>array(
					'description'	=>	$_POST['jobDescription'],
					'role'		=>	$_POST['role'],
					'salary'	=>	$_POST['salaryFrom'].'-'.$_POST['salaryTo'],
					'locations'	=>	$_POST['locations'],
					'employerTypes'=>	$_POST['employerTypes'],
					'jobPicture'	=>	$_POST['jobPicture']
				)
			);
			$this->jobs_model->saveJob($jobsArray);
			}
		}else{
			$category["category"]=$this->jobs_model->getJobCategory(1,null);
			$this->load->view('jobs/addJobCategory',$category);
		}
	
	}

	public function showSubCategory(){
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->model('jobs_model');
		$parentId=$this->input->post('parentCategory');
		if((!empty($parentId)) && ($parentId != 'none')){ 
			$type=2;
			$category["category"]=$this->jobs_model->getJobCategory($type,$parentId);
			$this->load->view('jobs/showSubCategory',$category);
		}else{
			echo "";
		}
	
	}
	
}
?>
