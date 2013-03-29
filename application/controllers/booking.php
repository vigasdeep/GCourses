<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class booking extends CI_Controller {

	 
	public function index(){	
		$this->load->helper(array('form', 'url'));

		$this->load->model('booking_model');
		$this->load->model('location_model');
		$bCompanies = $this->booking_model->getBusCompanies();
		$hospitals = $this->booking_model->getHospitals();
		$restaurants = $this->booking_model->getRestaurants();
		$hotels = $this->booking_model->getHotels();
		$hotelTypes = $this->booking_model->getHotelTypes();
		$locations = $this->location_model->getLocations();

		$overview = $this->booking_model->getTypeOverview('default');

		$data['busCompanies'] = $bCompanies;
		$data['hospitals'] = $hospitals;
		$data['restaurants'] = $restaurants;
		$data['hotels'] = $hotels;
		$data['hotelTypes'] = $hotelTypes;
		$data['locations'] = $locations;
		$data['overview'] = $overview;
		
		$this->load->view('booking/index',$data);
	 } 

	 public function fetchPageOverview(){
	 	$this->load->helper(array('form', 'url'));

		$this->load->model('booking_model');
		if($this->input->post('id'))
			$overview = $this->booking_model->getTypeOverview($this->input->post('id'));
		else{
			$overview = $this->booking_model->getTypeOverview('default');
		}

		echo '<p class="overviewHeading">'.$overview->title.'</p>';
		echo '<span>'.$overview->description.'</span>';

	 }

	 public function fetchCompanyOverview(){
	 	$this->load->helper(array('form', 'url'));
		$this->load->model('booking_model');
		if($this->input->post('table') && $this->input->post('key') && $this->input->post('val')){
			$arr = array('Bus'=>'booking_bus_company','Hospital'=>'booking_hospital', 'Accommodation'=>'booking_hotel','Restaurant'=>'booking_restaurant');
			$overview = $this->booking_model->getCompanyOverview($arr[$this->input->post('table')],array($this->input->post('key')=>$this->input->post('val')));
		}else{
			$overview = $this->booking_model->getTypeOverview('default');
		}

		echo '<p class="overviewHeading">'.$overview->title.'</p>';
		echo '<span>'.$overview->description.'</span>';

	 }

	 public function fetchHotels(){
	 	$this->load->helper(array('form', 'url'));
		$this->load->model('hotel_model');
		//echo "*".$this->input->post('hotelType')."*".$this->input->post('location')."*";
		if($this->input->post('hotelType') && $this->input->post('location')){
			if($this->input->post('hotelType') != "" && $this->input->post('location') != ""){
				//echo 1;
				$hotels = $this->hotel_model->getHotelsByMatch($this->input->post('hotelType'), $this->input->post('location'));
			}else{
				//echo 2;
				$hotels = $this->hotel_model->getHotels();
			}
		}else{
			//echo 3;
			$hotels = null;
		}
		
			echo "<select name='accommodation' id='accommodation'><option value=''>- Select Accommodation - </option>";
			if($hotels != null)
			foreach($hotels as $hotel){
				echo "<option value='".$hotel->id."'>".$hotel->name."</option>";
			}
			echo "</select>";
		
	 }

	 public function fetchRes(){
	 	$this->load->helper(array('form', 'url'));
		$this->load->model('restaurant_model');
		if($this->input->post('val') && $this->input->post('val') != ""){
			$res = $this->restaurant_model->getRestaurantsByMatch($this->input->post('val'));
		}else{
			$res = null;
		}
		
			echo "<select name='restaurant' id='restaurant'><option value=''>- Select Restaurant - </option>";
			if($res != null)
			foreach($res as $r){
				echo "<option value='".$r->id."'>".$r->name."</option>";
			}
			echo "</select>";
		
	 }

	 public function confirm(){
	 	var_dump($_POST);
	 }
	
	///////////////////
}//); OF CLASS


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
