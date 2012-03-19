<?php 

class Login_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */
	function verify_login($emp_id, $pass)
	{
		$this->db->SELECT('emp_id, dep_id, password');
		$this->db->FROM('employee');
		$this->db->WHERE('emp_id', $emp_id);
		$this->db->WHERE('password', MD5($pass)); 
			
		$query = $this->db->get();
		if($query->num_rows == 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_name($emp_id)
	{
		$this->db->SELECT('fname, lname');
		$this->db->FROM('employee');
		$this->db->WHERE('emp_id', $emp_id);
		$query = $this->db->get();
		
		if($query->num_rows == 1)
		{
			foreach($query->result() as $row) 
			{
				return ucfirst($row->fname).' '.ucfirst($row->lname);
			}
		}
		else 
		{
			return 'Name Unknow';
		}
	}
	
	function get_jobtype($emp_id)
	{
		$this->db->SELECT('jobtype');
		$this->db->FROM('employee');
		$this->db->WHERE('emp_id', $emp_id);
		$query = $this->db->get();
		
		if($query->num_rows == 1)
		{
			foreach($query->result() as $row) 
			{
				return ucfirst($row->jobtype);
			}
		}
		else 
		{
			return 'JobType Unknow';
		}
	}
	
	function update_log($emp_id)
	{
		$data = array( 'date' => date("Y-m-d"),
   						'time' => date("H:i:s"),
   						'emp_id' => $emp_id);
		$this->db->insert('systemlog', $data);
	}
}
?> 