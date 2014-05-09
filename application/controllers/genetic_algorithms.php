<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genetic_Algorithms extends CI_Controller {

	public function index() {
		//
	}

	public function initialization() {
		
		$c_no = $this->input->post('c_no');
		$s_c_no = $this->input->post('s_c_no');
		//declare variable
		$chromosome = array(
			"created_at" => date('Y-m-d H:i:s'),
			"created_by" => "SYSADM",
			"last_updated_at" => date('Y-m-d H:i:s'),
			"last_updated_by" => "SYSADM",
			"chromosome_no" => $c_no,
			"sub_chromosome_no" => $s_c_no
		);

		//get subject list
		$sql = "select subject_id, group_no, employee_id, number_of_periods, times_per_week, number_of_student from ct_workloads where department_id = ? and year_no = ? and active_flag = 'Y' order by row_id;";
		$query = $this->db->query($sql, split('#', $this->input->post('s_c_no')));
		$subject_list = $query->result_array();
		
		//log_message('info', '# '.$this->input->post('s_c_no').' #########################################');
		
		if(count($subject_list) > 0) {
			foreach($subject_list as $subject) {
				do {
					//random room number
					$rand_room = rand(0, 4);
					
					//hc#1
					$sql = "select room_no from ct_rooms where class_seats >= ? and status_flag = 'Y' limit 0, 5;";
					$query = $this->db->query($sql, $subject['number_of_student']);
					$rooms = $query->result_array();

					//random period number
					$rand_period[0] = rand(1,90);
					
					$is_available = FALSE;
					
					if(($rand_period[0]%3) == 1) {
						
						if($subject['number_of_periods'] <= 3) {
							if(!isset($chromosome['gene_'.$rand_period[0]]) && 
							(!isset($chromosome['gene_'.($rand_period[0] - 3)]) || !isset($chromosome['gene_'.($rand_period[0] + 3)]))) {
								$is_available = TRUE;
								
								//
								/*$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".$rand_period[0]." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$rooms[$rand_room]['room_no']));
								if($query->num_rows() > 0) {
									$is_available = FALSE;
								}*/
								
								//
								$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".$rand_period[0]." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$subject['employee_id'].':%'));
								if($query->num_rows() > 0) {
									$is_available = FALSE;
								}
							}
						}
						
						if($subject['number_of_periods'] > 3 && $subject['number_of_periods'] <= 6 && ($rand_period[0]%18) <= 13) {
							if((!isset($chromosome['gene_'.$rand_period[0]]) && !isset($chromosome['gene_'.($rand_period[0] + 3)]))
								&& (!isset($chromosome['gene_'.($rand_period[0] - 3)]) && !isset($chromosome['gene_'.($rand_period[0] + 6)]))) {
								$is_available = TRUE;
								
								$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".$rand_period[0]." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$rooms[$rand_room]['room_no']));
								$num_rows[0] = $query->num_rows();
								$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".($rand_period[0] + 3)." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$rooms[$rand_room]['room_no']));
								$num_rows[1] = $query->num_rows();
								if($num_rows[0] + $num_rows[1] > 0) {
									$is_available = FALSE;
								}
								
								/*$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".$rand_period[0]." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$subject['employee_id'].':%'));
								$num_rows[0] = $query->num_rows();
								$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".($rand_period[0] + 3)." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$subject['employee_id'].':%'));
								$num_rows[1] = $query->num_rows();
								if($num_rows[0] + $num_rows[1] > 0) {
									$is_available = FALSE;
								}*/
							}
						}
						
						if($subject['number_of_periods'] > 6 && ($rand_period[0]%18) <= 10) {
							if((!isset($chromosome['gene_'.$rand_period[0]]) && !isset($chromosome['gene_'.($rand_period[0] + 3)]) && !isset($chromosome['gene_'.($rand_period[0] + 6)]))
							&& (!isset($chromosome['gene_'.($rand_period[0] - 3)]) && !isset($chromosome['gene_'.($rand_period[0] + 9)]))) {
								$is_available = TRUE;
								
								$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".$rand_period[0]." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$rooms[$rand_room]['room_no']));
								$num_rows[0] = $query->num_rows();
								$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".($rand_period[0] + 3)." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$rooms[$rand_room]['room_no']));
								$num_rows[1] = $query->num_rows();
								$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".($rand_period[0] + 6)." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$rooms[$rand_room]['room_no']));
								$num_rows[2] = $query->num_rows();
								if($num_rows[0] + $num_rows[1] + $num_rows[2] > 0) {
									$is_available = FALSE;
								}
								
								/*$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".$rand_period[0]." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$subject['employee_id'].':%'));
								$num_rows[0] = $query->num_rows();
								$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".($rand_period[0] + 3)." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$subject['employee_id'].':%'));
								$num_rows[1] = $query->num_rows();
								$sql = "select * from ct_chromosomes where chromosome_no = ? and gene_".($rand_period[0] + 6)." like ?;";
								$query = $this->db->query($sql, array($c_no, '%:'.$subject['employee_id'].':%'));
								$num_rows[2] = $query->num_rows();
								if($num_rows[0] + $num_rows[1] + $num_rows[2] > 0) {
									$is_available = FALSE;
								}*/
							}
						}
					}
				} while(!$is_available);
	
				//encode data to chromosome
				for($n = 0; $n < $subject['number_of_periods']; $n += 1) {
					$chromosome['gene_'.($rand_period[0] + $n)] = $subject['subject_id'].':'.$subject['employee_id'].':'.$rooms[$rand_room]['room_no'];
					/*if(isset($periods[1])) {
						$chromosome['gene_'.($rand_period[1] + $n)] = $subject['subject_id'].':'.$subject['employee_id'].':'.$rooms[$rand_room]['room_no'];
					}*/
				}
				
				unset($rand_room);
				unset($rand_period);
			}
			
			//insert into ct_chromosomes and return insert result
			echo $this->db->insert('ct_chromosomes', $chromosome);
		}
	}
	
	public function fitness_evaluation() {
		$c_no = $this->input->post('c_no');
		$fitness_value = 0;
		
		$ct_result = array(
				"created_at" => date('Y-m-d H:i:s'),
				"created_by" => "SYSADM",
				"last_updated_at" => date('Y-m-d H:i:s'),
				"last_updated_by" => "SYSADM",
				"chromosome_no" => $c_no
		);
		//processing time
		$t = microtime(true);
		
		$sql = "select option_name, option_value from sys_options where option_type = 'GA_CONFIG' and option_name in ('MAXIMUM_PERIOD_OF_STUDENT','MAXIMUM_PERIOD_OF_TEACHER');";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		foreach($rows as $row) {
			$option_list[$row['option_name']] = $row['option_value'];
		}
		
		//$sql = "select distinct e.row_id, e.free_periods, e.meeting_periods from ct_workloads w, hr_employees e where w.employee_id = e.row_id and w.active_flag = 'Y' order by e.row_id;";
		$sql = 'select distinct w.employee_id as "row_id", e.free_periods, e.meeting_periods from ct_workloads w, tbl_employees e where w.employee_id = e.employee_name order by w.employee_id;';
		$query = $this->db->query($sql);
		$teachers = $query->result_array();
		foreach($teachers as $teacher) {
			$in_params = array_fill(0,30,'%:'.$teacher['row_id'].':%');
			$in_params[] = $c_no;
			$sql = 'select gene_1, gene_4, gene_7, gene_10, gene_13, gene_16, gene_19, gene_22, gene_25, gene_28, gene_31, gene_34, gene_37, gene_40, gene_43, gene_46, gene_49, gene_52, gene_55, gene_58, gene_61, gene_64, gene_67, gene_70, gene_73, gene_76, gene_79, gene_82, gene_85, gene_88 from ct_chromosomes where (gene_1 like ? or gene_4 like ? or gene_7 like ? or gene_10 like ? or gene_13 like ? or gene_16 like ? or gene_19 like ? or gene_22 like ? or gene_25 like ? or gene_28 like ? or gene_31 like ? or gene_34 like ? or gene_37 like ? or gene_40 like ? or gene_43 like ? or gene_46 like ? or gene_49 like ? or gene_52 like ? or gene_55 like ? or gene_58 like ? or gene_61 like ? or gene_64 like ? or gene_67 like ? or gene_70 like ? or gene_73 like ? or gene_76 like ? or gene_79 like ? or gene_82 like ? or gene_85 like ? or gene_88 like ?) and chromosome_no = ?;';
			$query = $this->db->query($sql, $in_params);
			if($query->num_rows() > 0) {
				$in_key = array(1,4,7,10,13,16,19,22,25,28,31,34,37,40,43,46,49,52,55,58,61,64,67,70,73,76,79,82,85,88);
				$week_view = array_fill_keys($in_key, 0);
				$chromosomes = $query->result_array();
				//convert to teacher view
				foreach($chromosomes as $chromosome) {
					foreach($chromosome as $gene_name => $gene_value) {
						$search_value = ":$teacher[row_id]:";
						if(strpos($gene_value, $search_value)) {
							$week_view[substr($gene_name, 5)] = $gene_value;
						}
					}
				}
				
				/* sc # 1 ################################################################################ */
				foreach(array_chunk($week_view, 6) as $day_view) {
					$result = array_count_values($day_view);
					if($result[0] < (6 - $option_list['MAXIMUM_PERIOD_OF_TEACHER'])) {
						++ $fitness_value;
					}
				}
				
				/* sc # 2 ################################################################################ */
				if(!is_null($teacher['free_periods'])) {
					$var_free_periods = explode(',', $teacher['free_periods']);
					foreach($var_free_periods as $period) {
						if($week_view[$period] != 0) {
							++ $fitness_value;
						}
					}
				}
				
				/* sc # 3 ################################################################################ */
				if(!is_null($teacher['meeting_periods'])) {
					$var_free_periods = explode(',', $teacher['meeting_periods']);
					foreach($var_free_periods as $period) {
						if($week_view[$period] != 0) {
							++ $fitness_value;
						}
					}
				}
			}
		}
		
		/* sc # 4 ################################################################################ */
		$sql = 'select gene_1, gene_4, gene_7, gene_10, gene_13, gene_16, gene_19, gene_22, gene_25, gene_28, gene_31, gene_34, gene_37, gene_40, gene_43, gene_46, gene_49, gene_52, gene_55, gene_58, gene_61, gene_64, gene_67, gene_70, gene_73, gene_76, gene_79, gene_82, gene_85, gene_88 from ct_chromosomes where chromosome_no = ? order by sub_chromosome_no;';
		$query = $this->db->query($sql, $c_no);
		foreach($query->result_array() as $chromosome) {
			foreach(array_chunk($chromosome, 6) as $day_view) {
				$result = array_count_values($day_view);
				if($result[0] < (6 - $option_list['MAXIMUM_PERIOD_OF_STUDENT'])) {
					++ $fitness_value;
				}
			}
		}
		$ct_result['fitness_value'] = $fitness_value;
		echo $this->db->insert('ct_results', $ct_result);
		/* fitness_value ################################################################################ */
		//echo "<br>fitness_value = {$fitness_value}";
		//echo '<br>processing time # '.(microtime(true) - $t);
	}
}

/* End of file genetic_algorithms.php */
/* Location: ./application/controllers/genetic_algorithms.php */