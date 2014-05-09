<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		//$data = $this->workloads_model->get_s_g();
		$this->load->view('home');
	}

	public function ajax() {
		usleep(100000);
		echo true;
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */