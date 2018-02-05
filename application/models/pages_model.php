<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_model extends FRONT_Crud
{

public $table = 'pages'; //Table name
public $idkey = 'page_id'; // ID

public $search_rules = array(
	array
   (
     'field' => 'search',
     'label' => 'Поиск',
     'rules' => 'required|xss_clean|max_length[1000]'
   ),
);

public $feedback_rules = array
(
   array
   (
     'field' => 'name',
     'label' => 'Имя',
     'rules' => 'trim|required|xss_clean|max_length[70]'
   ),
   array
   (
     'field' => 'email',
     'label' => 'Е-mail',
     'rules' => 'trim|required|valid_email|xss_clean|max_length[70]'
   ),
   array
   (
     'field' => 'message',
     'label' => 'Текст сообщения',
     'rules' => 'required|xss_clean|max_length[5000]'
   ),
   array
   (
     'field' => 'captcha',
     'label' => 'Цифры с картинки',
     'rules' => 'required|numeric|exact_length[6]'
   )
);

public $request_news_feedback = array
(
   array
   (
     'field' => 'name',
     'label' => 'Ваше имя',
     'rules' => 'trim|required|xss_clean|max_length[120]'
   ),
   array
   (
     'field' => 'email',
     'label' => 'Еmail',
     'rules' => 'trim|required|valid_email|xss_clean|max_length[70]'
   ),
   array
   (
     'field' => 'message',
     'label' => 'Сообщение',
     'rules' => 'xss_clean|max_length[5000]'
   ),
   array
   (
     'field' => 'userfile',
     'label' => 'Файл',
     'rules' => 'trim'
   ),
   array
   (
     'field' => 'captcha',
     'label' => 'Цифры с картинки',
     'rules' => 'required|numeric|exact_length[6]'
   )
);


public function __construct()
{
    parent::__construct();
    //Переменные с дирректориями хранения изображений;
    $this->file_path = realpath(APPPATH . '../assets/uploads/files/');
}

public function get_wellcome_page()
{
	$query = $this->db->get_where('pages', array('wp' => 1));
	return $query->row_array();
}

public function get_friends($lang)
{
    $this->db->select('friend_id, title_cz as title, img_url, link, priority');
    $this->db->order_by('priority','asc');
    $query = $this->db->get('friends');

    return $query->result_array();
}

public function get_newspapers($lang)
{
    $this->db->select('*');
    $this->db->order_by('date','desc');
    $query = $this->db->get('newspapers');

    return $query->result_array();
}

function userfile_check()
{
    $config['allowed_types']  = 'doc|docx|rtf|txt';
    $config['upload_path']    = $this->file_path;
    $config['max_size']    = '5120'; //5 megabytes

    $this->load->library('upload', $config);

    if ($this->upload->do_upload())
    {
        return $this->upload->data();
    } else {
        echo $this->upload->display_errors();
        return FALSE;
    }
}

public function get_slider_news($lang)
{
    $this->db->select('slide_id, title_cz as title, img_url, link, video');
    $this->db->from('slides');
    $this->db->order_by('slide_id','desc');
    $this->db->limit(10);
    $query = $this->db->get();

    return $query->result_array() ;
}

// Функция поиска
public function get_search($lang, $search, $limit = 10, $start_from = 0)
{
	$ret = array ();
	if ($search != '') {
		// Смотрим какие таблицы нужны будут для выборки
		$query = $this->db->select('table')
							->from('content')
							->group_by('table')
							->get();
		$tables = $query->result_array();
		// Перебираем найденные таблицы
		foreach ($tables as $key => $table) {
			// Название текушей таблицы
			$tbl = $table['table'];
			if ($tbl != 'sections' && $tbl != 'events'){
				// Обрезаем из названия таблицы последнюю букву для получения названия иднтификатора
				$id_tbl = substr($tbl, 0, strlen($tbl)-1);
				// Сам посисковый запрос
				$query = $this->db->select(array($tbl.'.*', 'c.title as c_title', 'c.text as c_text', 'c.language as c_language', 'c.anons as c_anons'))
								->from($tbl)
								->join('content c', 'c.fid = '.$tbl.'.'.$id_tbl.'_id', 'LEFT')
								->where('c.language',$lang)
								->where('UPPER(c.title) LIKE', '%'.mb_strtoupper($search).'%')
								->or_where('c.language',$lang)
								->where('UPPER(c.text) LIKE', '%'.mb_strtoupper($search).'%')
								->order_by('c.content_id','DESC')
	//							->limit($limit, $start_from)
								->get();
				$content = $query->result_array();
		//		echo '<pre>'.$this->db->last_query().'</pre>';
				// Соединяем результаты выборки из каждой из таблиц
				$ret = array_merge($ret, $content);
			}
		}
	}
//		echo '<pre>';
//		print_r($ret);
//		echo '</pre>';
    return  $ret;
}

// Функция поиска по тегу
public function get_tagsearch($lang, $search, $limit = 10, $start_from = 0)
{
	$ret = array ();
	if ($search != '') {
		// Смотрим какие таблицы нужны будут для выборки
		$query = $this->db->select('table')
							->from('content')
							->group_by('table')
							->get();
		$tables = $query->result_array();
//			echo '<pre>';
//			print_r($tables);
//			echo '</pre>';
		// Перебираем найденные таблицы
		foreach ($tables as $key => $table) {
			// Название текушей таблицы
			$tbl = $table['table'];
			if ($tbl != 'sections' && $tbl != 'events'){
				// Обрезаем из названия таблицы последнюю букву для получения названия иднтификатора
				$id_tbl = substr($tbl, 0, strlen($tbl)-1);
				// Сам посисковый запрос
				$query = $this->db->select(array($tbl.'.*', 'c.title as c_title', 'c.text as c_text', 'c.language as c_language', 'c.keywords as c_keywords'))
								->from($tbl)
								->join('content c', 'c.fid = '.$tbl.'.'.$id_tbl.'_id', 'LEFT')
								->where('c.language',$lang)
								->where('UPPER(c.keywords) LIKE', '%'.mb_strtoupper($search).'%')
	//							->limit($limit, $start_from)
								->get();
				$content = $query->result_array();
		//		echo '<pre>'.$this->db->last_query().'</pre>';
				// Соединяем результаты выборки из каждой из таблиц
				$ret = array_merge($ret, $content);
			}
		}
	}
//		echo '<pre>';
//		print_r($ret);
//		echo '</pre>';
    return  $ret;
}

public function get_photos_of_the_day($lang)
{
    /* SELECT MATERIAL WITH PHOTO SECTION */
    $results = $this->db->select('material_id, url, materials.title as title')
                        ->from('materials')   
                        ->join('content', 'content.fid = materials.material_id')                                
                        ->where('section',19)
                        ->where('date <=',date('Y-m-d'))
                        ->where('show',1)     
                        ->where('content.table','materials') 
                        ->where('content.language',$lang)                                          
                        ->order_by('material_id','random')
                        ->limit(1)
                        ->get();

    $sections	= array();

    foreach ($results->result_array() as $result)
	{
		$sections[$result['material_id']]['section']	  = $result;
		$sections[$result['material_id']]['children']	  = $this->get_photos($result['material_id']);
	}

    return $sections;


}

public function get_photos($material_id)
{
    /* SELECT PHOTOS WITH SELECTED MATERIAL_ID */
    $query = $this->db->where('material',$material_id)     
                      ->order_by('priority','asc')
                      ->limit(20)
                      ->get('photos');

    return $query->result_array();
}

public function get_latest_news_by_sec($lang)
{
    /* SELECT MATERIAL WITH PHOTO SECTION */
    $results = $this->db->select('sections.section_id, sections.url, content.title')
                        ->from('sections')
                        ->join('content', 'content.fid = sections.section_id')
                        ->where('sections.mp',1)
                        ->where('content.table','sections')
                        ->where('content.language',$lang)
                        ->order_by('section_id','random')
                        ->get();

    $sections	= array();

    foreach ($results->result_array() as $result)
	{
		$sections[$result['section_id']]['section']	  = $result;
		$sections[$result['section_id']]['hot']	      = $this->get_feed($result['section_id'], $lang, 3, 0);
        $sections[$result['section_id']]['latest']	  = $this->get_feed($result['section_id'], $lang, 10, 3);
	}

    return $sections;

}

public function get_feed($section_id, $lang, $limit, $start_from)
{
    $show_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 day'));
    $sections = $this->get_cihildrens_sections_with_parent($section_id);
                    
    /* SELECT PHOTOS WITH SELECTED MATERIAL_ID */
    $query = $this->db->select('materials.material_id, materials.url, materials.img_url, materials.date, content.title, content.anons')
                      ->from('materials')
                      ->where('materials.date <=',$show_date)
                      ->where_in('materials.section',$sections)
                      ->where('materials.show',1)                                            
                      ->join('content', 'content.fid = materials.material_id')
                      ->where('content.table','materials')
                      ->where('content.language',$lang)
                      ->order_by('materials.date','DESC')
                      ->limit($limit, $start_from)
                      ->get();

    return $query->result_array();
}

public function get_cihildrens_sections_with_parent($section_id)
{
    $query = $this->db->select('section_id')
                      ->where('parent_id',$section_id)  
		              ->order_by('sections.sequence', 'ASC')
                      ->get('sections')
                      ->result_array();
    
    if(count($query) > 0){
        
        foreach ($query as $key => $value){
            $sections[] = $value['section_id'];
        }

    }
    
    $sections[] = $section_id;             
                                                            
    return $sections;                                            
    
    
}

public function get_latest_news($lang)
{
    $show_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 day'));
    /* SELECT PHOTOS WITH SELECTED MATERIAL_ID */
    $query = $this->db->select('materials.material_id, materials.url, materials.img_url, materials.date, materials.section, content.title, content.anons')
                      ->from('materials')
                      ->join('content', 'content.fid = materials.material_id')
                      ->join('sections', 'sections.section_id = materials.section')
                      ->where('materials.date <=',$show_date)
                      ->where('materials.show',1)                                            
                      ->where('content.table','materials')
                      ->where('content.language',$lang)
                      ->where('sections.show_latest_news',1)
                      ->order_by('materials.date','DESC')
                      ->limit(LATEST_NEWS_NUM, 0)
                      ->get();

    $materials	= array();

    foreach ($query->result_array() as $result)
	{
		$materials[$result['material_id']]['material']	  = $result;
		$materials[$result['material_id']]['section']	  = $this->get_section($result['section'], $lang);
	}

    return $materials;

}

public function get_section($section_id, $lang)
{
    /* SELECT SECTIONS WITH SELECTED SECTION_ID BY LANGUAGE */
    $query = $this->db->select('sections.url, content.title')
                      ->from('sections')
                      ->join('content', 'content.fid = sections.section_id')
                      ->where('sections.section_id',$section_id)
                      ->where('content.table','sections')
                      ->where('content.language',$lang)
                      ->get();

    return $query->row_array();
}

public function get_top_materials($date_begin, $date_end, $lang)
{
    $query = $this->db->select('materials.material_id, materials.url, materials.img_url, materials.date, materials.section, materials.count_views, content.title, content.anons')
                  ->from('materials')
                  ->join('content', 'content.fid = materials.material_id')
                  ->join('sections', 'sections.section_id = materials.section')
                  ->where('date <=',$date_begin)
                  ->where('date >=',$date_end)
                  ->where('materials.show',1)                                            
                  ->where('content.table','materials')
                  ->where('content.language',$lang)
                  ->order_by('materials.count_views','DESC')
                  ->limit(LATEST_NEWS_NUM, 0)
                  ->get();

    $materials	= array();

    foreach ($query->result_array() as $result)
	{
		$materials[$result['material_id']]['material']	  = $result;
		$materials[$result['material_id']]['section']	  = $this->get_section($result['section'], $lang);
	}

    return $materials;

}




}

/* End of file pages_model.php */
/* Location: ./application/models/pages_model.php */