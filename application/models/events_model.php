<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends FRONT_Crud
{    
    
public $table = 'events'; //Table name	
public $idkey = 'event_id'; // ID


public function __construct()
{       
    parent::__construct();
}

// Обновление значения счетчика просмотров
public function update_counter($event_id,$counter_data)
{
    $this->db->where('event_id',$event_id);
    $this->db->update('events',$counter_data);
}       

}

/* End of file events_model.php */
/* Location: ./application/models/events_model.php */