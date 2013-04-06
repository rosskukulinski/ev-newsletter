<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_Create extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper(array('form'));
		$this->load->model('Event_create_model');
		
		// has the form been submitted and with valid form info (not empty values)
		if($this->input->post('create_event'))
		{
			$error = $this->Event_create_model->event_create();
			if (''==$error)
			{
				// display what was created TODO: Change this to the gen_event_email
				$data = $this->get_data();	
				$this->load->view('event_viewer', $data);
			}
			else
			{
				//display error
				echo 'Your event may or not have been created due to the following error.  Please copy and paste this page and send to rossk@stanford.edu'.'<br>';
				echo $error.'<br>';
        log_message('error', $error);
				//echo 'Your event was not created.  Please hit the back button and try again';
			}
		
        }
        else
        {
	     	$data['event_types'] = $this->evquickbase->get_event_types();
	     	$data['sponsors']    = $this->evquickbase->get_accounts();
	     	$data['cas']		 = $this->evquickbase->get_cas();
	     	$data['treasurers']  = $this->evquickbase->get_treasurers();
		  	$this->load->view('event_create_form', $data);   
	        
        }
	}
	
	private function get_data()
	{
		$data = array(
			'event_name'=>$this->input->post('event_name'),
			'event_type'=>$this->input->post('event_type'),
			'event_copay'=>$this->input->post('event_copay'),
			'event_date'=>$this->input->post('event_date'),
			'event_start_time'=>$this->input->post('event_start_time'),
			'event_end_time'=>$this->input->post('event_end_time'),
			'event_location'=>$this->input->post('event_location'),
			'meetup_time'=>$this->input->post('meetup_time'),
			'meetup_location'=>$this->input->post('meetup_location'),
			'rsvp_link'=>$this->input->post('rsvp_link'),
			'rsvp_date'=>$this->input->post('rsvp_date'),
			'rsvp_time'=>$this->input->post('rsvp_time'),
			'event_description'=>$this->input->post('event_description'),
			'account'=>$this->input->post('sponsored_by'),
			'ca_name'=>$this->input->post('ca_name'),
			'ca_email'=>$this->input->post('ca_email'),
			'treasurer'=>$this->input->post('treasurer')
		);
		return $data;	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */