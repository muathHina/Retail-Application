<?php 

class MY_Session extends CI_Session {

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * check if a session object with the name 
     * specified exist.
     */
    function session_live()
    {
    	return $this->userdata('login_session');
    }
    /**
     * get the name of the employee from the session object
     */
	function get_name()
	{
		$session_data = $this->userdata('login_session');
		return $session_data['name'];
	}
	
	/**
     * get the job type for the employee from the session object
     */
	function get_jobtype()
	{
		$session_data = $this->userdata('login_session');
		return $session_data['jobtype'];
	}
	
	/**
     * get the employee id from the session object
     */
	function get_emp_id()
	{
		$session_data = $this->userdata('login_session');
		return $session_data['employee_id'];
	}
	
	/**
     * get the date when the session object was created.
     */
	function get_date()
	{
		$session_data = $this->userdata('login_session');
		return $session_data['date'];
	}
	
	/**
     * get the time when the session object was created.
     */
	function get_time()
	{
		$session_data = $this->userdata('login_session');
		return $session_data['time'];
	}
	
	/**
     * destroy the session object and redirect user to the login page
     */
	function logout()
	{
		$this->session->unset_userdata('login_session');
		session_destroy();
		redirect('login', 'refresh');
	}
}


?>