<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$current_view = ($this->uri->segment(1))? $this->uri->segment(1): 'dashboard';
// 		echo '<pre>';
// 		print_r($current_view);
// 		echo '</pre>';
		$this->load->view('dashboard_view');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */