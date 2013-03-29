<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

	 
	 public function index(){	 
		$this->load->helper(array('form', 'url'));
		$this->load->view('user/index');
	 }
/*	 public function forgotPassword(){	 
		$this->load->member_model();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		if(!$_POST){
			$this->load->view('user/forgotPassword');
		}else{
			$validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ+-*#&@!?";
			$index = mt_rand(6, 10);
			$randomCharacter = $validCharacters[$index];
			
				$recoverData = array(
        	       			'username' => $this->input->post('username'),
        	       			'password' => md5($randomCharacter),
				);
			$userData = $this->member_model->selectUserData('users',$recoverData['username'],'username')
				$this->db->where('username',$userData['username']);
				if($this->db->update('users', $recoverData)){
					$this->load->library('email');
					$this->email->from('tcc@gndec.ac.in', 'TCC, GNDEC');
					$this->email->to($userData['email']); 
					$this->email->subject('GNDEC Courses : Password Recovery');
					$this->email->message('Your new password at GNDEC Courses is

						'.$randomCharacter.'



--
Dr. H. S. Rai
Dean Testing and Consultancy http://gndec.ac.in/tcc/
Guru Nanak Dev Engg. College http://gndec.ac.in/
Ludhiana (Pb) India
');

	echo "done";
		}
	 }
*/
	public function signup(){
		$this->load->database();
		$this->load->helper(array('form', 'url'));

		if(!$_POST){			
			$this->load->view('user/register');

		}else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]|min_length[4]|max_length[18]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[30]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
			
			if ($this->form_validation->run() == FALSE){ 
				echo validation_errors(); 
				$this->load->view('user/register');
			}else{
		
				$registerData = array(
        	       			'username' => $this->input->post('username'),
        	       			'password' => md5($this->input->post('password')),
        	       			'email' => $this->input->post('email'),
					'confirmed' => md5(microtime().$this->input->post('email'))
        	    		);
				if($this->db->insert('users', $registerData)){
					$this->load->library('email');
					$this->email->from('tcc@gndec.ac.in', 'TCC, GNDEC');
					$this->email->to($registerData['email']); 
					$this->email->subject('GNDEC Courses : Account activation');
					$this->email->message('Thank you for your interest in high end professional technical course being conducted by Testing and Consultancy Cell of Guru Nanank Dev Engineering College, Ludhiana.

To complete your registration process, you need to confirm your Email by clicking following link, which has been sent to '.$registerData['email'].'


 '.base_url().'index.php/user/confirm/'.$registerData['username'].'/'.$registerData['confirmed'].' 

 If you have not initiated this registration process, then just ignore this mail.

--
Dr. H. S. Rai
Dean Testing and Consultancy http://gndec.ac.in/tcc/
Guru Nanak Dev Engg. College http://gndec.ac.in/
Ludhiana (Pb) India
');	
					$this->email->send();
					// $this->email->print_debugger();	
					$data['register'] = 1;
//					$id = $this->db->insert_id();
//					$this->connect_user($this->input->post('username'),$id);
//					header('Location: '.base_url().'index.php/member');
					$this->load->view('user/register',$data);
				}
			}
		}
	}



	public function confirm()
	{
			$this->load->database();
			//$this->load->session();
	
		$this->load->helper('url');
		$data['user']=$this->uri->segment(3, 0);
		$data['code']=$this->uri->segment(4, 0);
		$query = $this->db->query("Select * from users where username='$data[user]' and confirmed='$data[code]'");
		if($query->num_rows() > 0){
			$row=$query->row();
			$data['row'] = $row;
			if($row->confirmed==$data['code']){
				if($this->db->query("update users set confirmed=1 where username='$data[user]' and confirmed='$data[code]'"))
				{
					$data['message']= "Your account has been activated, you can login now.";
				}
				else 
				{
					$data['message']= "Seems, there is a problem with your authentication token, either it is expired or its not valid. ";
				}
				
			}
		}
		$this->load->view('user/confirm',$data);
	}	
	//Login START
	public function login()
	{
	
		$this->load->helper('url');
		$this->load->database();
	
	
		if(!$_POST)
		{
			$this->load->view('user/login');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$query = $this->db->query("Select * from users where username='$username'");
			if($query->num_rows() > 0){			
				$row = $query->row();
				if($row->confirmed != "1" ){
				 redirect(site_url('user/login')."?error=You account is not activated. To activate check your email Inbox/SPAM/Junk folder of email ID which you used while registering with us.");
				}
				if($row->password==md5($password)){
					//
					//password matched
					//
					$this->connect_user($row);
					if($row->admin == 1){
						// TO ADMIN END
						header('Location: '.base_url().'index.php/member');
					}else{
						// TO USER END
						header('Location: '.base_url().'index.php/member');
					}

				}else{
					$this->load->view('user/login');
				}
			}else{
				$this->load->view('user/login');
			}
			
		}
		
	}


	
	
	private function connect_user($row){
		$this->load->library('session');
		$sessiondata = array(
                   'username'  => $row->username,
		   'key'     => md5($row->username."mBn".$row->id),
		   'admin'	=> $row->admin ,	
		   'logged_in' => TRUE,
               	);

		$this->session->set_userdata($sessiondata);
	}

	public function logout(){ 
		$this->load->helper('url');
		$this->load->library('session');
		$this->session->sess_destroy();
		$this->load->view('user/logout');
	}
	
	///////////////////
}//END OF CLASS


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
