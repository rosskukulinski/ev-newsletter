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
    //$this->load->library('evquickbase');
	$event_name = $this->input->post('event_name');
  log_message('debug', $event_name);
	$event_type = $this->input->post('event_type');
  log_message('debug', $event_type);
	$event_copay = $this->input->post('event_copay');
  log_message('debug', $event_copay);
	$event_date = $this->input->post('event_date');
  log_message('debug', $event_date);
	$event_start_time = $this->input->post('event_start_time');
  log_message('debug', $event_start_time);
	$event_end_time = $this->input->post('event_end_time');
  log_message('debug', $event_end_time);
	$event_location = $this->input->post('event_location');
  log_message('debug', $event_location);
	$meetup_time = $this->input->post('meetup_time');
  log_message('debug', $meetup_time);
	$meetup_location = $this->input->post('meetup_location');
  log_message('debug', $meetup_location);
	$rsvp_link = $this->input->post('rsvp_link');
  log_message('debug', $rsvp_link);
	$rsvp_date = $this->input->post('rsvp_date');
  log_message('debug', $rsvp_date);
	$rsvp_time = $this->input->post('rsvp_time');
  log_message('debug', $rsvp_time);
	$event_description = $this->input->post('event_description');
  log_message('debug', $event_description);
	$account = $this->input->post('sponsored_by');
  log_message('debug', $account);
	$ca_name = $this->input->post('ca_name');
  log_message('debug', $ca_name);
	$ca_email = $this->input->post('ca_email');
  log_message('debug', $ca_email);
	$treasurer = $this->input->post('treasurer');
  log_message('debug', $treasurer);
		          
	return $this->evquickbase->add_event($account, $ca_name, $event_date, $event_name, $event_type, $event_description,
		$treasurer, $event_copay, $event_start_time, $event_end_time, $event_location, $meetup_time,
		$meetup_location, $rsvp_link, $rsvp_date, $rsvp_time, $ca_email, $attend=0, $effort='3-average', 
		$effect='3',$turnout='3',$again='3-maybe', $more5='no');
  }
}