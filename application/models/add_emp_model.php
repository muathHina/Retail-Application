<?php 

class Add_emp_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * will return an array with all the values for the
	 * jobtype column (enum type)
	 * 
	 * @access public
	 * @return array
	 */
	
	function enum_select($table , $field)
    {
        //$query = "SHOW COLUMNS FROM ".$table." LIKE '$field'";
        $row = $this->db->query("SHOW COLUMNS FROM ".$table." LIKE '$field'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enums[$value] = $value; 
        }
        return $enums;
    }
    
    /**
     * return a list of department names in Array
     * 
     * @access public
     * @return array
     */
    function get_list_department()
    {
    	$this->db->SELECT('name');
		$this->db->FROM('department');
		$query = $this->db->get();
		
		if($query->num_rows > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[$row->name] = $row->name;
			}
			return $data;
		}
    }
    /**
     * This will add employee details to the database
     * 
     * @param array
     * @return boolean
     */
    function add_employee_to_db($data)
    {
    	$dep_id = $this->get_dep_id($data['department']);
    	$db = array( 	'fname' => $data['fname'],
   						'lname' => $data['lname'],
   						'dob' => $data['dob'],
   						'phone' => $data['phone'],
   						'email' => $data['email'],
   						'house_no' => $data['house_no'],
   						'street' => $data['street'],
   						'city' => $data['city'],
   						'county' => $data['county'],
   						'post_code' => $data['post_code'],
   						'jobtype' => $data['jobtype'],
    					'date_joined' => date("Y-m-d"),
    					'dep_id' => $dep_id);
    	//return true if added successfully
		$this->db->insert('employee', $db);
    }
    
    /**
     * will return the department id for the given
     * department name.
     * 
     * @param string
     * @return integer
     */
    function get_dep_id($dep_name)
    {
    $this->db->SELECT('dep_id');
		$this->db->FROM('department');
		$this->db->WHERE('name', $dep_name);
		$query = $this->db->get();
		foreach($query->result() as $row)
		{
			return $row->dep_id;
		}
    }
}
?>