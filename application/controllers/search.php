<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search extends CI_Controller {

	 
	public function index(){	
		$this->load->database(); 
		$this->load->helper(array('form', 'url'));
		$this->load->view('search/index');
	 }

	public function advance(){	
		$this->load->database(); 
		$this->load->helper(array('form', 'url'));
		$this->load->view('search/index');
	 }
	 
	
	///////////////////
}//END OF CLASS


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
