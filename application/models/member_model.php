<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member_model extends CI_Model {

	function __construct(){
	parent::__construct();
    	}

    	function checkLoggedIn(){
		$this->load->library('session');
		$this->load->database();
		$key=$this->session->userdata('key');
		$username=$this->session->userdata('username');
		$query = $this->db->query("Select * from users where username='$username'");
			
		$row = $query->row();
		if($row->confirmed != 1){
		}
		if(isset($row->username)){
			if($key == md5($row->username."mBn".$row->id)){
				return $row;
			}else{ 
				return false;
			}
		}else{
			return false;
		}
	
	}
	function insertData($arry,$table){
		$this->load->database();
		unset($arry['submit']);
		return $this->db->insert($table, $arry);
	}
	function updateData($arry, $table, $where_col,$id){
		$this->load->database();
		$fields = $this->db->list_fields($table);
		$arry = array_intersect_key($arry, array_flip($fields));
		$query = $this->db->get_where($table,array($where_col => $id));
		if($query->num_rows() > 0){
			//		update
			$this->db->where($where_col, $id);
			unset($arry['id']);
			$queryResult = $this->db->update($table, $arry); 
		}else{
			//		insert
			$this->db->set($where_col, $id); 
			unset($arry['id']);
			$queryResult =  $this->db->insert($table, $arry);
		}
		return $queryResult;
	}
	
	function selectBoxFromDB($tablei,$selected){
		
		$this->load->database();
		$que = $this->db->get($table);

		if ($query->num_rows() > 0){

			foreach ($query->result_array() as $rows){
//				$selectOptions = "<option value\"\"> </option>
			}
		}
		
	}

	function selectUserData($table, $id=0,$where_col='id',$single=1, $limit=null, $offset=null){
		$this->load->database();
		if($id == 0){
			$query = $this->db->get($table, $limit, $offset);
		}else{		
			$query = $this->db->get_where($table, array($where_col => $id));
		}
		if ($query->num_rows() > 0){
			if($single==0){

				$counter=0;
				foreach ($query->result_array() as $rows){
					$counter++;
					$allRows[$counter] = $rows;
				}
				return $allRows;
			}else{
				return $query->row_array(); 
			}
		}
	}
	function DeleteRows($table,$id,$where_col='id',$parent){
		$this->load->database();
		$query = $this->db->get_where($table, array('id' => $id));
		$data = $query->row_array();
		if ($data[$where_col]==$parent){
			$this->db->where('id', $id);
			if($this->db->delete($table)) return "Row has been deleted successfully.";
			else return "Sorry, Try again ! Some problem Occured in the transaction. ";
		}
	}
}
?>
