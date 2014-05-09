<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SYS_Options extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		//
	}

	public function get_options_list() {
		$sql = "select option_name, option_value from sys_options where option_type = ?;";
		$query = $this->db->query($sql, 'GA_CONFIG');
		foreach($query->result_array() as $row) {
			$result_array[$row['option_name']] = $row['option_value'];
		}
		echo json_encode($result_array);
	}

}

/* End of file sys_options.php */
/* Location: ./application/controllers/sys_options.php */