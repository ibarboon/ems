<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workloads_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_s_g() {
		$sql = "select distinct department_id, year_no from ct_workloads order by department_id, year_no;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_subject_list($in_array) {
		$sql = "select * from ct_workloads where department_id = ? and year_no = ? order by row_id;";
		$query = $this->db->query($sql, $in_array);
		return $query->result_array();
	}
}

/* End of file workloads_model.php */
/* Location: ./application/models/workloads_model.php */