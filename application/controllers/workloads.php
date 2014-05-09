<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workloads extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		//
	}

	public function get_s_g() {
		$sql = "truncate table ct_chromosomes;";
		$result = $this->db->query($sql);
		
		$sql = "select distinct department_id, year_no from ct_workloads where active_flag = 'Y' order by department_id, year_no;";
		$query = $this->db->query($sql);
		$result_array = $query->result_array();
		echo json_encode($result_array);
	}

}

/* End of file workloads.php */
/* Location: ./application/controllers/workloads.php */