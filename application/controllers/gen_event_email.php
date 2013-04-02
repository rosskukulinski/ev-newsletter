<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gen_Event_Email extends CI_Controller {

	public function index()
	{
		//$this->load->library('evquickbase');
		$data['events'] = $this->evquickbase->get_events();
		$this->load->view('gen_event_email', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */