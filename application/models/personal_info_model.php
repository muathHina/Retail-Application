<?php 

class Personal_info_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	function get_employee_info()
	{
		$emp_id = $this->session->get_emp_id();
		$query = $this->db->get_where('employee', array('emp_id' => $emp_id));
		$data = array();
		if($query->num_rows == 1)
		{
			foreach($query->result() as $row) 
			{
				$data['emp_id'] = $row->emp_id;
				$data['fname'] = $row->fname;
				$data['lname'] = $row->lname;
				$data['dob'] = $row->dob;
				$data['phone'] = $row->phone;
				$data['email'] = $row->email;
				$data['password'] = '**************';
				$data['house_no'] = $row->house_no;
				$data['street'] = $row->street;
				$data['city'] = $row->city;
				$data['county'] = $row->county;
				$data['post_code'] = $row->post_code;
				$data['jobtype'] = $row->jobtype;
				$data['date_joined'] = $row->date_joined;
				$data['dep_name'] = $this->get_dep_name();
				$data['shift_id'] = $row->shift_id;	
			}
			return $data;
		}
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	function get_dep_name()
	{
		$emp_id = $this->session->get_emp_id();
		$this->db->select('department.name');
		$this->db->from('department');
		$this->db->join('employee', 'employee.dep_id = department.dep_id');
		$this->db->WHERE('employee.emp_id', $emp_id);
		
		$query = $this->db->get();
				
		if($query->num_rows == 1)
		{
			foreach($query->result() as $row) 
			{
				return $row->name;
			}
		}
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param array $data
	 */
	function update_personal_info($data = '')
	{
		$emp_id = $this->session->get_emp_id();
		$this->db->where('emp_id', $emp_id);
		$this->db->update('employee', $data);
	}
	
}

?>