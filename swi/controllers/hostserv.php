<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/****************************************************************/
/* SWI3 Inferface by siniStar @ IRC4Fun                         */
/*                                                              */
/* author: 	Austin (siniStar)                                   */
/* web:		http://sinistar7boy.github.io/SWI/					*/
/* email: 	siniStar [at] IRC4Fun [dot] net                     */
/* irc: 	irc.IRC4Fun.net                                     */
/* version: 3.2.7                                               */
/****************************************************************/


/**
 * Hostserv Controller
 * 
 */
class Hostserv extends CI_Controller {

	//========================================================
	// PRIVATE VARS
	//========================================================
	
	
	//========================================================
	// PUBLIC VARS
	//========================================================
	
	
	//========================================================
	// PUBLIC FUNCTIONS
	//========================================================
	

	/**
	 * Constructor
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('is_authed'))
			redirect('main');
	}
	// --------------------------------------------------------
	
	
	/**
	 * Index Page
	 *
	 */
	public function index()
	{
		// durp?
	}
	// --------------------------------------------------------
	
	
	/**
	 * Hostserv Offer List Page
	 * Page allows users to view the current Hostserv offer list.
	 *
	 */
	public function offerlist()
	{
		$page_data = array();
		
		$callback = $this->hostserv_model->host_offerlist();
			
		if (!$this->atheme->valid_authcookie($callback))
			redirect('main/logout');
			
		$page_data['response'] = $callback['data'];
		
		$this->load->view('hostserv/list', $page_data);
	}
	// --------------------------------------------------------
	
	
	/**
	 * Request Page
	 * Page allows users to request a host via Hostserv
	 *
	 */
	public function request()
	{
		$page_data = array();
		
		// set form validation rules
		$this->form_validation->set_rules('hostname', 'Hostname', 'required');
		
		// did the user submit?
		if ($this->form_validation->run())
		{
			$callback = $this->hostserv_model->host_request($this->input->post('hostname'));
			
			// validate the call
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}
		
		$this->load->view('hostserv/request', $page_data);
	}
	// --------------------------------------------------------


	/**
	 * Hostserv Take Page
	 * This page allows users to take a network allows hostname offered by Hostserv
	 *
	 */
	public function take()
	{
		$page_data = array();

		// set form validation rules
		$this->form_validation->set_rules('hostname', 'Hostname', 'required');

		// did the user submit?
		if ($this->form_validation->run())
		{
			$callback = $this->hostserv_model->host_take($this->input->post('hostname'));

			// validate the call
			if (!$this->atheme->valid_authcookie($callback))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}

		$this->load->view('hostserv/take', $page_data);
	}
	// --------------------------------------------------------
	
	
	//========================================================
	// CALLBACK FUNCTIONS
	//========================================================
	
	
	//========================================================
	// PRIVATE FUNCTIONS
	//========================================================
	
}
