<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materials_model extends FRONT_Crud
{    
    
public $table = 'materials'; //Table name	
public $idkey = 'material_id'; // ID


public function __construct()
{       
    parent::__construct();
}

// Обновление значения счетчика просмотров
public function update_counter($material_id,$counter_data)
{
    $this->db->where('material_id',$material_id);
    $this->db->update('materials',$counter_data);
}

// Обновление значения счетчика лайков
public function update_like($material_id,$like_data)
{
    $this->db->where('material_id',$material_id);
    $this->db->update('materials',$like_data);
}

public function get_photos($material_id)
{
    $query = $this->db->where('material',$material_id)
                      ->order_by('priority','asc')
                      ->get('photos');
    return $query->result_array();
}

public function get_audios($material_id)
{
    $query = $this->db->select('title, audio_url as mp3')
                      ->where('material',$material_id)
                      ->order_by('sequence','asc')
                      ->get('audios');
    
    $music = array();
    $i = 0;                  
    foreach($query->result_array() as $track){
        $music[$i]['title'] = $track['title'];
        $music[$i]['mp3']   = base_url('assets/uploads/audio/'.$track['mp3']);
        $i++;
    }
    
    return $music;
}
   
public function get_similars($section_id, $material_id, $language)
{
    $query = $this->db->select('materials.material_id as material_id, 
                       materials.url as url, 
                       materials.img_url as img_url, 
                       materials.video_url as video_url, 
                       materials.date as date, 
                       materials.section as section, 
                       materials.count_views as count_views, 
                       content.fid as fid, 
                       content.title as title, 
                       content.keywords as keywords, 
                       content.anons as anons, 
                       content.language as language')
                      ->from('materials')
                      ->join('content', 'content.fid = materials.material_id')
                      ->where('materials.show',1)
                      ->where('materials.section',$section_id)
                      ->where('content.table','materials')
                      ->where('content.language',$language)
                      ->not_like('materials.material_id',$material_id)
                      ->order_by('materials.date','desc')
                      ->order_by('materials.material_id','desc')
                      ->limit(4)
                      ->get(); 
    
    return $query->result_array();  
}


public function get_prev_and_next($section_id, $material_id, $language)
{
    
    $results = $this->db->select('materials.material_id as material_id, materials.url as url, content.title as title')
                      ->from('materials')
                      ->join('content', 'content.fid = materials.material_id')
                      ->where('materials.show',1)
                      ->where('materials.section',$section_id)
                      ->where('content.table','materials')
                      ->where('content.language',$language)
                      ->order_by('materials.date','desc')
                      ->order_by('materials.material_id','desc')
                      ->get()
                      ->result_array(); 
    //echo "<pre>";                  
    //var_dump($results);
    //echo "</pre>";                                                 
    
    $index = 1;

    for($index = 0; $index < count($results); $index++){
        if($results[$index]['material_id'] == $material_id){
            $materials_number = $index;           
        }     
    }        
    
    $material = array();

                        
    if(isset($materials_number) && $materials_number != 0){
        $material['next'] =  $results[$materials_number-1];
    }
    
    if(isset($materials_number) && $materials_number != count($results) - 1){
        $material['prev'] =  $results[$materials_number+1];
    }


    return $material;  

}  

public function get_count_and_rating_comments($material_id)
{
    $query = $this->db->select('SUM(`rating`) AS rating', false)
                      //->group_by('CODE')
                      //->order_by('Ratings', 'desc')
                      ->where('foreign_id',$material_id)
                      ->where('active', 1)
                      ->get('comments')
                      ->row_array();
                      
    $query['num'] = $this->db->where('foreign_id',$material_id)->where('active', 1)->count_all_results('comments');
    
    return $query;
}   
   

}

/* End of file materials_model.php */
/* Location: ./application/models/materials_model.php */