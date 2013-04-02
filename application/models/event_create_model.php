<?
class Event_create_model extends CI_Model{
	
	
	function __construct()
    {
    
    	
		log_message('debug', 'Event_Create model construct');
        parent::__construct();
    }	
    	

  function event_create(){
  
  
		log_message('debug', 'Event_Create model function');
    //$this->load->database();
    $this->load->library('evquickbase');
	$event_name = $this->input->post('event_name');
	$event_type = $this->input->post('event_type');
	$event_copay = $this->input->post('event_copay');
	$event_date = $this->input->post('event_date');
	$event_start_time = $this->input->post('event_start_time');
	$event_end_time = $this->input->post('event_end_time');
	$event_location = $this->input->post('event_location');
	$meetup_time = $this->input->post('meetup_time');
	$meetup_location = $this->input->post('meetup_location');
	$rsvp_link = $this->input->post('rsvp_link');
	$rsvp_date = $this->input->post('rsvp_date');
	$rsvp_time = $this->input->post('rsvp_time');
	$event_description = $this->input->post('event_description');
	$account = $this->input->post('sponsored_by');
	$ca_name = $this->input->post('ca_name');
	$ca_email = $this->input->post('ca_email');
	$treasurer = $this->input->post('treasurer');
		          
	return $this->evquickbase->add_event($account, $ca_name, $event_date, $event_name, $event_type, $event_description,
		$treasurer, $event_copay, $event_start_time, $event_end_time, $event_location, $meetup_time,
		$meetup_location, $rsvp_link, $rsvp_date, $rsvp_time, $ca_email, $attend=0, $effort='3-average', 
		$effect='3',$turnout='3',$again='3-maybe', $more5='no');
  }
}