<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class booking extends CI_Controller {

	 
	public function index(){	
		
	 } 

	 public function listHotel(){
	 	$this->load->helper('form','url');
		$this->load->model('hotel_model');
		$hotels = $this->hotel_model->getHotels();

		foreach($hotels as $hotel){
			echo $hotel->name." - ".$hotel->contactPerson." - ".$hotel->email." - <a href='viewHotel?id=".$hotel->id."'>View</a><br/>";
		}
		echo "<b><a href='addHotel'>Add New Hotel</a></b>";
	 }

	public function addHotel(){
		$this->load->helper('form');
		$this->load->model('location_model');
		$this->load->model('hotel_model');
		$this->load->model('hoteltype_model');
		$locations = $this->location_model->getLocations();
		$hotelTypes = $this->hoteltype_model->getHotelTypes();

		echo "<h3>Add Hotel</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->hotel_model->insertHotel();
			echo "-DataGaya";
		}

		echo form_open();
		echo "Name : ".form_input('name')."<br/>";
		echo "Contact Person : ".form_input('contactPerson')."<br/>";
		echo "Email : ".form_input('email')."<br/>";
		echo "Location : <br/>";

		foreach($locations as $location) {
			echo form_checkbox('location[]',$location->name)." ".$location->name."<br/>";
		}
		echo "Hotel Type : <br/>";
		foreach($hotelTypes as $hotelType) {
			echo form_checkbox('hotelType[]',$hotelType->name)." ".$hotelType->name."<br/>";
		}
		echo "Title : ".form_input('title')."<br/>";
		echo "Description : <br/>".form_textarea('description')."<br/>";
		echo form_submit('submit','Add Hotel');
		echo form_close();
	}

	public function viewHotel(){
		$this->load->helper('form');
		$this->load->model('location_model');
		$this->load->model('hotel_model');
		$this->load->model('hoteltype_model');
		$locations = $this->location_model->getLocations();
		$hotelTypes = $this->hoteltype_model->getHotelTypes();
		echo "<h3>View Hotel</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->hotel_model->updateHotel();
			echo "-DataGaya";
		}
		if($this->input->get('id')){
			$hotel = $this->hotel_model->getHotelByID($this->input->get('id'));
		}

		echo form_open('admin/booking/viewHotel?id='.$this->input->get('id'));
		echo form_hidden('id',$this->input->get('id'));
		echo "Name : ".form_input('name',$hotel->name)."<br/>";
		echo "Contact Person : ".form_input('contactPerson',$hotel->contactPerson)."<br/>";
		echo "Email : ".form_input('email',$hotel->email)."<br/>";
		echo "Location : <br/>";
		
		$locs = unserialize($hotel->location);
		$types = unserialize($hotel->hotelType);
		if(!$locs)
			$locs = array();
		if(!$types)
			$types = array();
		foreach($locations as $location) {
			if(in_array($location->name, $locs))
				echo form_checkbox('location[]',$location->name, true)." ".$location->name."<br/>";
			else
				echo form_checkbox('location[]',$location->name, false)." ".$location->name."<br/>";
		}
		echo "Hotel Types : <br/>";
		foreach($hotelTypes as $hotelType) {
			if(in_array($hotelType->name, $types))
				echo form_checkbox('hotelType[]',$hotelType->name, true)." ".$hotelType->name."<br/>";
			else
				echo form_checkbox('hotelType[]',$hotelType->name, false)." ".$hotelType->name."<br/>";
		}
		echo "Title : ".form_input('title',$hotel->title)."<br/>";
		echo "Description : <br/>".form_textarea('description',$hotel->description)."<br/>";
		echo form_submit('submit','Save Hotel');
		echo form_close();
	}


	public function listHotelType(){
	 	$this->load->helper('form','url');
		$this->load->model('hoteltype_model');
		$hotelTypes = $this->hoteltype_model->getHotelTypesByOrder('name','asc');

		foreach($hotelTypes as $hotelType){
			echo $hotelType->name." - <a href='viewHotelType?id=".$hotelType->id."'>View</a><br/>";
		}
		echo "<b><a href='addHotelType'>Add New Hotel Type</a></b>";
	 }

	 public function addHotelType(){
		$this->load->helper('form');
		$this->load->model('hoteltype_model');

		echo "<h3>Add Hotel Type</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->hoteltype_model->insertHotelType();
			echo "-DataGaya";
		}

		echo form_open();
		echo "Name : ".form_input('name')."<br/>";
		echo form_submit('submit','Add Hotel');
		echo form_close();
	}

	public function viewHotelType(){
		$this->load->helper('form');
		$this->load->model('hoteltype_model');
		echo "<h3>View Hotel Type</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->hoteltype_model->updateHotelType();
			echo "-DataGaya";
		}
		if($this->input->get('id')){
			$hotel = $this->hoteltype_model->getHotelTypeByID($this->input->get('id'));
		}

		echo form_open('admin/booking/viewHotelType?id='.$this->input->get('id'));
		echo form_hidden('id',$this->input->get('id'));
		echo "Name : ".form_input('name',$hotel->name)."<br/>";
		
		echo form_submit('submit','Save Hotel Type');
		echo form_close();
	}


	 public function listBus(){
	 	$this->load->helper('form','url');
		$this->load->model('bus_model');
		$buses = $this->bus_model->getBus();

		foreach($buses as $bus){
			echo $bus->name." - ".$bus->contactPerson." - ".$bus->email." - <a href='viewBus?id=".$bus->id."'>View</a><br/>";
		}
		echo "<b><a href='addBus'>Add New Bus Company</a></b>";
	 }

	public function addBus(){
		$this->load->helper('form');
		$this->load->model('bus_model');

		echo "<h3>Add Bus Company</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->bus_model->insertBus();
			echo "-DataGaya";
		}

		echo form_open();
		echo "Name : ".form_input('name')."<br/>";
		echo "Contact Person : ".form_input('contactPerson')."<br/>";
		echo "Email : ".form_input('email')."<br/>";
		echo "Title : ".form_input('title')."<br/>";
		echo "Description : <br/>".form_textarea('description')."<br/>";
		echo form_submit('submit','Add Bus Company');
		echo form_close();
	}

public function viewBus(){
		$this->load->helper('form');
		$this->load->model('bus_model');
		echo "<h3>View Bus Company</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->bus_model->updateBus();
			echo "-DataGaya";
		}
		if($this->input->get('id')){
			$hotel = $this->bus_model->getBusByID($this->input->get('id'));
		}

		echo form_open('admin/booking/viewBus?id='.$this->input->get('id'));
		echo form_hidden('id',$this->input->get('id'));
		echo "Name : ".form_input('name',$hotel->name)."<br/>";
		echo "Contact Person : ".form_input('contactPerson',$hotel->contactPerson)."<br/>";
		echo "Email : ".form_input('email',$hotel->email)."<br/>";
		
		echo "Title : ".form_input('title',$hotel->title)."<br/>";
		echo "Description : <br/>".form_textarea('description',$hotel->description)."<br/>";
		echo form_submit('submit','Save Bus Company');
		echo form_close();
	}

		 public function listHospital(){
	 	$this->load->helper('form','url');
		$this->load->model('hospital_model');
		$hospitals = $this->hospital_model->getHospital();

		foreach($hospitals as $hospital){
			echo $hospital->name." - ".$hospital->contactPerson." - ".$hospital->email." - <a href='viewHospital?id=".$hospital->id."'>View</a><br/>";
		}
		echo "<b><a href='addHospital'>Add New Hospital</a></b>";
	 }

	public function addHospital(){
		$this->load->helper('form');
		$this->load->model('hospital_model');

		echo "<h3>Add Hospital</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->hospital_model->insertHospital();
			echo "-DataGaya";
		}

		echo form_open();
		echo "Name : ".form_input('name')."<br/>";
		echo "Contact Person : ".form_input('contactPerson')."<br/>";
		echo "Email : ".form_input('email')."<br/>";
		echo "Title : ".form_input('title')."<br/>";
		echo "Description : <br/>".form_textarea('description')."<br/>";
		echo form_submit('submit','Add Hospital');
		echo form_close();
	}

public function viewHospital(){
		$this->load->helper('form');
		$this->load->model('hospital_model');
		echo "<h3>View Hospital</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->hospital_model->updateHospital();
			echo "-DataGaya";
		}
		if($this->input->get('id')){
			$hotel = $this->hospital_model->getHospitalByID($this->input->get('id'));
		}

		echo form_open('admin/booking/viewHospital?id='.$this->input->get('id'));
		echo form_hidden('id',$this->input->get('id'));
		echo "Name : ".form_input('name',$hotel->name)."<br/>";
		echo "Contact Person : ".form_input('contactPerson',$hotel->contactPerson)."<br/>";
		echo "Email : ".form_input('email',$hotel->email)."<br/>";
		
		echo "Title : ".form_input('title',$hotel->title)."<br/>";
		echo "Description : <br/>".form_textarea('description',$hotel->description)."<br/>";
		echo form_submit('submit','Save Hospital');
		echo form_close();
	}


public function listRestaurant(){
	 	$this->load->helper('form','url');
		$this->load->model('restaurant_model');
		$restaurants = $this->restaurant_model->getRestaurants();

		foreach($restaurants as $restaurant){
			echo $restaurant->name." - ".$restaurant->contactPerson." - ".$restaurant->email." - <a href='viewRestaurant?id=".$restaurant->id."'>View</a><br/>";
		}
		echo "<b><a href='addRestaurant'>Add New Restaurant</a></b>";
	 }

	public function addRestaurant(){
		$this->load->helper('form');
		$this->load->model('restaurant_model');
		$locations = array("Take Away","Meal");

		echo "<h3>Add Restaurant</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->restaurant_model->insertRestaurant();
			echo "-DataGaya";
		}

		echo form_open();
		echo "Name : ".form_input('name')."<br/>";
		echo "Contact Person : ".form_input('contactPerson')."<br/>";
		echo "Email : ".form_input('email')."<br/>";
		echo "Type : <br/>";

		foreach($locations as $location) {
			echo form_checkbox('resType[]',$location)." ".$location."<br/>";
		}
		echo "Title : ".form_input('title')."<br/>";
		echo "Description : <br/>".form_textarea('description')."<br/>";
		echo form_submit('submit','Add Restaurant');
		echo form_close();
	}

public function viewRestaurant(){
		$this->load->helper('form');
		$this->load->model('restaurant_model');
		$locations = array("Take Away","Meal");
		echo "<h3>View Restaurant</h3>";
		if($this->input->post('submit')){
			echo "-";
			echo $this->restaurant_model->updateRestaurant();
			echo "-DataGaya";
		}
		if($this->input->get('id')){
			$hotel = $this->restaurant_model->getRestaurantByID($this->input->get('id'));
		}

		echo form_open('admin/booking/viewRestaurant?id='.$this->input->get('id'));
		echo form_hidden('id',$this->input->get('id'));
		echo "Name : ".form_input('name',$hotel->name)."<br/>";
		echo "Contact Person : ".form_input('contactPerson',$hotel->contactPerson)."<br/>";
		echo "Email : ".form_input('email',$hotel->email)."<br/>";
		echo "Type : <br/>";
		
		$locs = unserialize($hotel->resType);
		if(!$locs)
			$locs = array();

		foreach($locations as $location) {
			if(in_array($location, $locs))
				echo form_checkbox('resType[]',$location, true)." ".$location."<br/>";
			else
				echo form_checkbox('resType[]',$location, false)." ".$location."<br/>";
		}
		echo "Title : ".form_input('title',$hotel->title)."<br/>";
		echo "Description : <br/>".form_textarea('description',$hotel->description)."<br/>";
		echo form_submit('submit','Save Restaurant');
		echo form_close();
	}



	///////////////////
}//END OF CLASS


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>