<?php

class Routes_model extends CI_Model {

	function __construct()
	{
		parent::__construct();		
	}
	

	// save or update a route and return the id
	function save($route)
	{
		if(!empty($route['id']))
		{
			$this->db->where('id', $route['id']);
			$this->db->update('routes', $route);
			
			return $route['id'];
		}
		else
		{
			$this->db->insert('routes', $route);
			return $this->db->insert_id();
		}
	}
	
	function check_url($url, $id=false)
	{
		if($id)
		{
			$this->db->where('id !=', $id);
		}
		$this->db->where('url', $url);
		
		return (bool) $this->db->count_all_results('routes');
	}
	
	function validate_url($url, $id=false, $count=false)
	{
		if($this->check_url($url.$count, $id))
		{
			if(!$count)
			{
				$count	= 1;
			}
			else
			{
				$count++;
			}
			return $this->validate_url($url, $id, $count);
		}
		else
		{
			return $url.$count;
		}
	}
	
	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('routes');
	}
}