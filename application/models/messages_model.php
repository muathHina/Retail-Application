<?php 

class Messages_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}
	
	function read_all_messages()
	{
		$recipient_id = $this->session->get_emp_id();
		$this->db->order_by('date_sent desc, time_sent desc'); 
		$query = $this->db->get_where('message', array('recipient_id' => $recipient_id));
		$data = array();
		if ($query->num_rows > 0)
		{
			foreach($query->result() as $row)
			{	
				$sender_name = $this->login_model->get_name($row->sender_id);
				$recipient_name = $this->login_model->get_name($row->recipient_id);
				$data[$row->msg_id] = array(
					'msg_id' => $row->msg_id,
					'date_sent' => $row->date_sent,
					'time_sent' => $row->time_sent,
					'subject' => $row->subject,
					'body' => substr($row->body, 0, 100).' ....',
					'from' => $sender_name,
					'to' => $recipient_name,
					'recipient_id' => $row->recipient_id,
					'sender_id' => $row->sender_id);
			}
		}
		else 
		{
			$data[0] = array(
					'msg_id' => '',
					'date_sent' => date("Y-m-d"),
					'time_sent' => date("H:i:s"),
					'subject' => 'You have no messages.',
					'body' => '',
					'from' => 'Admin',
					'to' => '');
		}
		// count how many unread messages we got
		return $data;
	}
	
	function read_message($msg_id)
	{
		$query = $this->db->get_where('message', array('msg_id' => $msg_id));
		$data = array();
		if($query->num_rows == 1)
		{
			foreach($query->result() as $row) 
			{
				$sender_name = $this->login_model->get_name($row->sender_id);
				$recipient_name = $this->login_model->get_name($row->recipient_id);
				$data['msg_id'] = $row->msg_id;
				$data['date_sent'] = $row->date_sent;
				$data['time_sent'] = $row->time_sent;
				$data['subject'] = $row->subject;
				$data['body'] = $row->body;
				$data['sender_id'] = $row->sender_id;
				$data['recipient_id'] = $row->recipient_id;
				$data['from'] = $sender_name;
				$data['to'] = $recipient_name;
			}
			$this->mark_message_as_read($msg_id);
			return $data;
		}
		else
		{
			return $data['error'] = 'Message not found.';
		}
	}
	
	/**
	 * return a list of recipients in the database from 'employee' table.
	 * 
     * @access public
     * @return array
     */
    function list_recipients()
    {
    	$this->db->SELECT('emp_id');
		$this->db->FROM('employee');
		$query = $this->db->get();
		
		foreach ($query->result() as $row)
		{
			
			$data[$row->emp_id] = $this->login_model->get_name($row->emp_id);
		}
		$data[''] = '.Select recipient ... ';
		asort($data); //sort array low - high
		return $data;
    }
    
    /**
     * 
     * Enter description here ...
     * @param string $sub
     * @param string $body
     * @param int $recipient
     */
    function send_message($sub, $body, $recipient)
    {
    	
    	$data = array(
					'date_sent' => date("Y-m-d"),
					'time_sent' => date("H:i:s"),
					'subject' => $sub,
					'body' => $body,
					'recipient_id' => $recipient,
					'sender_id' => $this->session->get_emp_id());
    	
		$this->db->insert('message', $data);
    }
    
    /**
     * 
     * Enter description here ...
     * @param $msg_id
     */
    function delete_message($msg_id = '')
	{
		$this->db->delete('message', array('msg_id' => $msg_id));
		//return ($this->article_exist($n_id) ? TRUE : FALSE);
    }
    
    /**
     * This will mark the message as read, meaning it has been 
     * retrieved by the recipient for reading.
     * 
     * @access public
     * @param int $msg_id
     * 
     */
    function mark_message_as_read($msg_id = '')
    {
    	$data = array('read' => 'yes');
		$this->db->where('msg_id', $msg_id);
		$this->db->update('message', $data);
    }
    
    /**
     * will count how many messages has not been retrieved from the database,
     * meaning they have 'no' value under 'read' column.
     * 
     * @access public
     * @return array
     * 
     */
    function count_unread_messages()
    {
    	$this->db->like('read', 'no');
		$this->db->from('message');
		$data['unread_messages'] = $this->db->count_all_results();
		return $data;
    }
}
?>