<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ct_Ajax extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$sql = "select * from ct_workloads order by department_id, year_no";
		$query = $this->db->query($sql);
		$result_array = $query->result_array();
		echo json_encode($result_array);
	}

	public function do_insert_chromosome() {
		try {
			$sql = "insert into ct_chromosomes (row_id, created_at, created_by, last_updated_at, last_updated_by, chromosome_no, sub_chromosome_no) values (null, now(), 'SYSADM', now(), 'SYSADM', ?, ?);";
			$query = $this->db->query($sql, array($this->input->post('chromosomeNo'), $this->input->post('subChromosomeNo')));
		} catch (exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		//echo $this->input->post('chromosomeNo');
		//echo 'TEST';
	}

}

/* End of file ct_ajax.php */
/* Location: ./application/controllers/ct_ajax.php */