<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	 
	public function index(){	
		
		echo "<frameset cols='20%,80%'>";
		echo "<frame src='home/menu' />";
		echo "<frame src='home/welcome' name='admin'/>";
		echo "</frameset>";

	 } 

	 public function menu(){

	 	echo "<h3>Admin Menu</h3>";
	 	echo "<h4><a href='../home/welcome' target='admin'>Admin Home</a></h4>";
	 	echo "<h4>Booking</h4>";
	 	echo "<ul><li><a href='../booking/listHotel'  target='admin'>List Hotels</a></li><li><a href='../booking/addHotel'  target='admin'>Add Hotel</a></li>";
		echo "<li><a href='../booking/listHotelType'  target='admin'>List Hotel Types</a></li><li><a href='../booking/addHotelType'  target='admin'>Add Hotel Type</a></li>";
		echo "<li><a href='../booking/listBus'  target='admin'>List Bus Company</a></li><li><a href='../booking/addBus'  target='admin'>Add Bus Company</a></li>";
		echo "<li><a href='../booking/listHospital'  target='admin'>List Hospital</a></li><li><a href='../booking/addHospital'  target='admin'>Add Hospital</a></li>";
		echo "<li><a href='../booking/listRestaurant'  target='admin'>List Restaurant</a></li><li><a href='../booking/addRestaurant'  target='admin'>Add Restaurant</a></li>";
	 	echo "</ul>";


	 	echo "<h4>Locations</h4>";
	 	echo "<ul><li><a href='../home/listLocation'  target='admin'>List Locations</a></li><li><a href='../home/addLocation'  target='admin'>Add Location</a></li></ul>";

	 }

	 public function welcome(){

		echo "<h3>Welcome to admin panel.</h3><br/>";
		echo "<p>Please use menu links on left sidebar to navigate in admin panel.</p>";

	 }

	 public function listLocation(){
	 	$this->load->helper('form','url');
		$this->load->model('location_model');
		$locations = $this->location_model->getLocationsByOrder('name','asc');

		foreach($locations as $location){
			echo $location->name." - <a href='viewLocation?id=".$location->id."'>View/Edit</a><br/>";
		}
		echo "<b><a href='addLocation'>Add New Location</a></b>";
	 }

	 public function addLocation(){
	 	$this->load->helper('form');
		$this->load->model('location_model');
		echo "<h3>Add Location</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->location_model->insertLocation();
			echo "-DataGaya";
		}

		echo form_open();
		echo "Name : ".form_input('name')."<br/>";
		echo form_submit('submit','Add Location');
	 }

	 public function viewLocation(){
	 	$this->load->helper('form');
		$this->load->model('location_model');
		echo "<h3>View Location</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->location_model->updateLocation();
			echo "-DataGaya";
		}

		if($this->input->get('id')){
			$location = $this->location_model->getLocationById($this->input->get('id'));
		}

		echo form_open('admin/home/viewLocation?id='.$this->input->get('id'));
		echo form_hidden('id',$this->input->get('id'));
		echo "Name : ".form_input('name',$location->name)."<br/>";
		echo form_submit('submit','Save Location');

	 }
}

?>