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
			$i = 0;
			foreach ($query->result() as $row)
			{
				$data[$i] = $row->name;
				$i++;
			}
			return $data;
		}
    }
	
	
}

?>