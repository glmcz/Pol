<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FRONT_Crud extends CI_Model
{
    
public $table = ''; //Имя таблицы	
public $idkey = ''; //Имя ID	


function __construct()
 {
     // Call the Model constructor
     parent::__construct();
 }

// Получение данных об одной записи по id;
public function get($obj_id)
{
    $this->db->where($this->idkey,$obj_id);
    $query = $this->db->get($this->table);
    
    return $query->row_array();
}

// Получение данных об одной записи по url;
public function get_by_url($url)
{
    $this->db->where('url',$url);
    $query = $this->db->get($this->table);
    
    return $query->row_array();
}

public function get_content($obj_id, $lang)
{
    $this->db->where('fid',$obj_id);
    $this->db->where('table',$this->table);
    $this->db->where('language',$lang);
    $query = $this->db->get('content');
    
    return $query->row_array();
}

public function get_modules()
{
    $this->db->order_by('priority','asc');
    $query = $this->db->get('modules');
    
    return $query->result_array();
}

public function get_banners($lang)
{
    if($lang == 'ua'){
        $this->db->select('banner_id, title_ua as title, img_url, link, position, priority');
    }elseif($lang == 'en'){
        $this->db->select('banner_id, title_en as title, img_url, link, position, priority');
    }else{
        $this->db->select('banner_id, title_ru as title, img_url, link, position, priority');
    }
    $this->db->where('lang',$lang);
    $this->db->order_by('priority','asc');
    $query = $this->db->get('banners');
    
    return $query->result_array();
}

// Подсчет общего числа записей
public function count_all()
{
    return $this->db->count_all($this->table);
}

public function count_by($section)
{
    $this->db->where('section',$section);
    
    return $this->db->count_all_results($this->table);
}

public function slides()
{
    $query = $this->db->get('slides');
    return $query->result_array();
}

public function get_pref()
{
    $query = $this->db->get('preferences');

    return $query->result_array();
}

public function get_farewell($lang)
{
    
    if($lang == 'ua'){
        $this->db->select('text_ua as text');
    }elseif($lang == 'en'){
        $this->db->select('text_en as text');
    }elseif($lang == 'ru'){
        $this->db->select('text_ru as text');
    }else{     
        $this->db->select('text_cz as text');
    }
    $this->db->where('date', date('Y-m-d'));
    $query = $this->db->get('farewells');

    if(count($query->row_array()) > 0){

        return $query->row_array();

    }else{

        if($lang == 'ua'){
            $this->db->select('text_ua as text');
        }elseif($lang == 'en'){
            $this->db->select('text_en as text');
        }elseif($lang == 'ru'){
            $this->db->select('text_ru as text');
        }else{     
            $this->db->select('text_cz as text');
        }
        $this->db->order_by("date", "random");
        $this->db->limit(1);
        $query = $this->db->get('farewells');


        return $query->row_array();
    }


}

function get_main_comments($limit = FALSE)
{
	$this->db->select('comments.*, materials.title, materials.url, materials.img_url');
	$this->db->where('comments.active', 1);
	$this->db->order_by('date', 'DESC');
	if($limit){
		$this->db->limit($limit);
	}
	$this->db->join('materials', 'comments.foreign_id = materials.material_id', 'left');
	$result = $this->db->get('comments')->result();

	return $result;
}

// Формирование RSS-ленты
public function feeds_info($language, $startDate = NULL, $limit = 20, $start_from)
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
                      ->where('content.table','materials')
                      ->where('content.language',$language)
                      ->order_by('materials.date','desc')
                      ->order_by('materials.material_id','desc')
                      ->limit($limit,$start_from)
                      ->get();

    return $query->result_array();
}


function delete_content($id)
{
	$this->db->where('content_id', $id);
	$this->db->delete('content');
} 
    
}
?>