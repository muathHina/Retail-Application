<?php

class News_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('login_model');
	}
	
	/**
	 * will save data posted from the news form. Data will
	 * be saved temporary in the database under session 
	 * table. Once processing is finished the data is deleted.
	 * 
	 * @param string
	 * @param string
	 */
	function save_form_data_temp($title, $msg)
	{
		$data = array( 'short_text' => $title,
   						'long_text1' => $msg,
						'emp_id' => $this->session->get_emp_id());
		$this->db->insert('session', $data);
	}
	
	/**
	 * will retrieve the news form data which is temporary saved
	 * for processing.
	 * 
	 * @access public
	 * @return array
	 */
	function get_form_data_temp()
	{
		$this->db->SELECT('short_text, long_text1');
		$this->db->FROM('session');
		$this->db->WHERE('emp_id', $this->session->get_emp_id());
		$query = $this->db->get();
		$data = array();
		if($query->num_rows == 1)
		{
			foreach($query->result() as $row) 
			{
				$data['n_id'] = '';
				$data['title'] = $row->short_text;
				$data['message'] = $row->long_text1;
				return $data;
			}
		}
		else 
		{
			$data['title'] = 'title not found';
			$data['message'] = 'message not found';
			return $data;
		}
	}
	
	/**
	 * This method will check if the news form data exist (saved successfully)
	 * Enter description here ...
	 */
	function form_data_exist()
	{
		$this->db->SELECT('short_text, long_text1');
		$this->db->FROM('session');
		$this->db->WHERE('emp_id', $this->session->get_emp_id());
		$query = $this->db->get();
		$data = array();
		if($query->num_rows == 1)
		{
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}
	
	/**
	 * will empty the session table to allow new
	 * data to be saved.
	 * 
	 * @access public
	 */
	function empty_session_table()
	{
		$this->db->empty_table('session');
	}
	
	/**
	 * will save data posted from the news form permanently
	 * in database in the news table. Temporary news data 
	 * will be deleted in the session table.
	 * 
	 * @param string
	 * @param string
	 */
	function save_form_data_permanently($n_id = '')
	{
		//retrieve data from session table
		$this->db->SELECT('short_text, long_text1');
		$this->db->FROM('session');
		$this->db->WHERE('emp_id', $this->session->get_emp_id());
		$query = $this->db->get();
		$data = array();
		if($query->num_rows == 1)
		{
			foreach($query->result() as $row) 
			{
				$data['title'] = $row->short_text;
				$data['message'] = $row->long_text1;
			}
		}
		// save data permanently to news table
		$new_data = array(
						'date_created' => date("Y-m-d"),
						'title' => $data['title'],
						'message' => $data['message'],
						'emp_id' => $this->session->get_emp_id());
		// update data permanently to news table
		$update_data = array(
						'title' => $data['title'],
						'message' => $data['message']);
		
		if(empty($n_id))
		{
			$this->db->insert('news', $new_data);
			
		}
		else
		{
			$this->db->where('n_id', $n_id);
			$this->db->update('news', $update_data);
		}
		//empty session table
		$this->empty_session_table();
	}
	
	/**
	 * this will get an article from the database with the
	 * specified id number 'n_id'.
	 * 
	 * @access public
	 * @param integer
	 * @return array
	 */
	function read_article($n_id)
	{
		$query = $this->db->get_where('news', array('n_id' => $n_id));
		$data = array();
		
		if($query->num_rows == 1)
		{
			foreach($query->result() as $row) 
			{
				$name = $this->login_model->get_name($row->emp_id);
				$data['n_id'] = $row->n_id;
				$data['date_created'] = $row->date_created;
				$data['title'] = $row->title;
				$data['message'] = $row->message;
				$data['no_of_views'] = $row->no_of_views;
				$data['author'] = $name;
			}
			return $data;
		}
		else
		{
			return $data['error'] = 'cannot find article';
		}
	}
	
	/**
	 * This will retrieve all articles saved in the database.
	 * 
	 * @access public
	 * @return array
	 */
	function read_all_articles()
	{	
		$this->db->order_by('n_id', 'desc'); 
		$query = $this->db->get('news');
		$data = array();
		if ($query->num_rows > 0)
		{
			foreach($query->result() as $row)
			{	
				$name = $this->login_model->get_name($row->emp_id);
				$data[$row->n_id] = array(
					'n_id' => $row->n_id,
					'date_created' => $row->date_created,
					'title' => $row->title,
					'message' => substr($row->message, 0, 100).' ....', // return first 100 character
					'author' => $name);
			}
		}
		else 
		{
			$data[0] = array(
					'n_id' => '',
					'date_created' => date("Y-m-d"),
					'title' => 'No articles found.',
					'message' => '',
					'author' => 'Admin');
		}
		return $data;
	}
	
	/**
	 * this will delete an article with the specified id number.
	 * 
	 * @access public
	 * @param string
	 */
	function delete_article($n_id = '')
	{
		$this->db->delete('news', array('n_id' => $n_id));
		return ($this->article_exist($n_id) ? TRUE : FALSE);
	}
	
	/**
	 * This will check if an article with the specified id
	 * number exist in the database.
	 * 
	 * @access public
	 * @param string
	 */
	function article_exist($n_id = '')
	{
		return $this->db->get_where('news', array('n_id' => $n_id));
	}
}
?>