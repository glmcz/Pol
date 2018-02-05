<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sections_model extends FRONT_Crud
{    
    
    public $table = 'sections'; //Table name	
    public $idkey = 'section_id'; // ID
    
    
    public function __construct()
    {       
        parent::__construct();
    }
    
    function get_sections($parent = false, $lang = 'ru')
	{
		if ($parent !== false)
		{
			$this->db->where('parent_id', $parent);
		}
		$this->db->select('section_id');
        $this->db->where('show',1);
		$this->db->order_by('sections.sequence', 'ASC');

		//this will alphabetize them if there is no sequence
		$this->db->order_by('title', 'ASC');
		$result	= $this->db->get('sections');

		$sections	= array();
		foreach($result->result() as $sec)
		{
			$sections[]	= $this->get_section($sec->section_id, $lang);
		}

		return $sections;
	}
    
    function get_section($id, $lang = 'ru')
	{
		return $this->db->select('sections.section_id as section_id, 
                                  sections.parent_id as parent_id,                  
                                  sections.url as url,
                                  sections.sequence as sequence,                                                                    
                                  content.title as title')
                        ->from('sections')
                        ->join('content', 'content.fid = sections.section_id')                                                                        
                        ->where('sections.section_id', $id)
                        ->where('content.table','sections')
                        ->where('content.language',$lang) 
                        ->get()                                               
                        ->row();

	}

	//this is for building a menu
	function get_sections_tierd($parent=0,$lang = 'ru')
	{
		$sections	= array();
		$result	= $this->get_sections($parent, $lang);
        
		foreach ($result as $section)
		{
			$sections[$section->section_id]['section']	= $section;
			$sections[$section->section_id]['children']	= $this->get_sections_tierd($section->section_id, $lang);
		}
		return $sections;
	}
    
    function get_childrens($section_id)
	{
		return $this->db->select('section_id')->get_where('sections', array('parent_id'=>$section_id))->result_array();
	}
    
    public function get_latest($limit)
    {
        $query = $this->db->order_by('date','desc')
                          ->limit($limit)
                          ->get('materials');
        return $query->result_array();
    }

    public function count_materials_by($section_id, $table, $childrens, $language)
    {
        $show_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 day'));
        $this->db->select('materials.*');
        $this->db->from('materials');
        $this->db->join('content', 'content.fid = materials.material_id');
        
        if(isset($childrens) && count($childrens) > 0){
            
            foreach ($childrens as $key => $value){
                $sections[] = $value['section_id'];
            }
            
            $sections[] = $section_id;

            $this->db->where_in('materials.section',$sections);

            
        }else{
            $this->db->where('materials.section',$section_id); 
        }
        
        $this->db->where('materials.show',1);
        $this->db->where('materials.date <=',$show_date);
        $this->db->where('content.table',$table); 
        $this->db->where('content.language',$language);        
        return $this->db->count_all_results();
    }
    
    public function get_materials_by($section_id, $limit, $start_from, $table, $childrens, $language)
    {                     
        $show_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 day'));
        $this->db->select('materials.material_id as material_id, materials.url as url, materials.img_url as img_url, materials.video_url as video_url, materials.date as date, materials.section as section, materials.count_views as count_views, materials.like as likes, materials.author_id as author_id, content.fid as fid, content.title as title, content.keywords as keywords, content.anons as anons, content.language as language, authors.name as author_name');
        $this->db->from('materials');
        $this->db->join('content', 'content.fid = materials.material_id');
        $this->db->join('authors', 'materials.author_id = authors.author_id', 'LEFT');
        
        if(isset($childrens) && count($childrens) > 0){
            
            foreach ($childrens as $key => $value){
                $sections[] = $value['section_id'];
            }
            
            $sections[] = $section_id;

            $this->db->where_in('materials.section',$sections);

            
        }else{
            $this->db->where('materials.section',$section_id); 
        }
        
        $this->db->where('materials.show',1);
        $this->db->where('materials.date <=',$show_date);
        $this->db->where('content.table',$table); 
        $this->db->where('content.language',$language); 
        $this->db->order_by('materials.date','desc');
        $this->db->order_by('materials.material_id','desc');
        $this->db->limit($limit, $start_from);  
        $query = $this->db->get();                          
        
        $query_with_comment = array();
        
        foreach($query->result_array() as $material){
            
            $query_with_comment[$material['material_id']] = $material;
            
            $comments_num_and_rating =  $this->get_num_and_rating_comments($material['material_id']);
            
            $query_with_comment[$material['material_id']]['comments_num']       = $comments_num_and_rating['num'];
            $query_with_comment[$material['material_id']]['comments_rating']    = $comments_num_and_rating['rating'];
            
        }
        
        return $query_with_comment;
    }
    
    public function count_all_materials($table, $language)
    {
        $show_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 day'));
        $this->db->select('materials.*');
        $this->db->from('materials');
        $this->db->join('content', 'content.fid = materials.material_id');
        $this->db->where('materials.show',1);
        $this->db->where('materials.date <=',$show_date);
        $this->db->where('content.table',$table); 
        $this->db->where('content.language',$language);        
        return $this->db->count_all_results();
    }
    
    public function get_all_materials($limit, $start_from, $table, $language)
    {                     
        $show_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 day'));
        $this->db->select('materials.material_id as material_id, materials.url as url, materials.img_url as img_url, materials.video_url as video_url, materials.date as date, materials.section as section, materials.count_views as count_views, materials.like as likes, materials.author_id as author_id, content.fid as fid, content.title as title, content.keywords as keywords, content.anons as anons, content.language as language, authors.name as author_name');
        $this->db->from('materials');
        $this->db->join('content', 'content.fid = materials.material_id');
        $this->db->join('authors', 'materials.author_id = authors.author_id', 'LEFT');
        $this->db->where('materials.show',1);
        $this->db->where('materials.date <=',$show_date);
        $this->db->where('content.table',$table); 
        $this->db->where('content.language',$language); 
        $this->db->order_by('materials.date','desc');
        $this->db->order_by('materials.material_id','desc');
        $this->db->limit($limit, $start_from);  
        $query = $this->db->get();                          
        
        $query_with_comment = array();
        
        foreach($query->result_array() as $material){
            
            $query_with_comment[$material['material_id']] = $material;
            
            $comments_num_and_rating =  $this->get_num_and_rating_comments($material['material_id']);
            
            $query_with_comment[$material['material_id']]['comments_num']       = $comments_num_and_rating['num'];
            $query_with_comment[$material['material_id']]['comments_rating']    = $comments_num_and_rating['rating'];
            
        }
        
        return $query_with_comment;
    }
    
    public function get_num_and_rating_comments($material_id)
    {
        $query = $this->db->select('SUM(`rating`) AS rating', false)
                          //->group_by('CODE')
                          //->order_by('Ratings', 'desc')
                          ->where('foreign_id',$material_id)
                          ->where('active',1)
                          ->get('comments')
                          ->row_array();
                          
        $query['num'] = $this->db->where('foreign_id',$material_id)->where('active',1)->count_all_results('comments');
        
        return $query;
    } 
    
    public function count_comments($material_id)
    {
        $this->db->where('foreign_id',$material_id);
        $this->db->where('active',1); 
        
        return $this->db->count_all_results('comments');
    }
    
    public function get_subs($section_id)
    {
        $this->db->order_by('sequence','asc');
        $this->db->where('parent_id',$section_id);
        $query = $this->db->get('sections');
        
        return $query->result_array();
    }
    
    public function sections_reorder($items)
    {
        $total_items = count($this->input->post('item'));  
        
        for($item = 0; $item < $total_items; $item++ )
            {
                $data = array(
                'section_id' => $items[$item],
                'sequence' => $rank = $item
                );
            
            $this->db->where('section_id', $data['section_id']);
            $this->db->update('sections', $data);
        
            }
            
        return;
    
    }
    
   	// Получение данных автора;
	public function get_author($author_id)
	{
		$this->db->where('author_id', $author_id);
		$query = $this->db->get('authors');

		return $query->row_array();
	}
    
    public function count_author_materials($author_id, $language)
    {
        $show_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 day'));
        $this->db->select('materials.*');
		$this->db->from('materials');
        $this->db->where('materials.author_id', $author_id);
        $this->db->where('materials.show',1);
        $this->db->where('materials.date <=',$show_date);
        $this->db->where('content.table', 'materials');
        $this->db->where('content.language',$language);
        $this->db->join('content', 'content.fid = materials.material_id', 'LEFT');
        return $this->db->count_all_results();
    }

    public function get_author_materials($author_id, $limit, $start_from, $language)
    {
        $show_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 day'));
        $this->db->select('materials.material_id as material_id, materials.url as url, materials.img_url as img_url, materials.video_url as video_url, materials.date as date, materials.section as section, materials.author_id, materials.count_views as count_views, materials.like as likes, content.fid as fid, content.title as title, content.keywords as keywords, content.anons as anons, content.language as language, authors.name as author_name');
        $this->db->from('materials');
        $this->db->join('content', 'content.fid = materials.material_id', 'LEFT');
        $this->db->join('authors', 'materials.author_id = authors.author_id', 'LEFT');

        $this->db->where('materials.author_id',$author_id);
        $this->db->where('materials.show',1);
        $this->db->where('materials.date <=',$show_date);
        $this->db->where('content.table', 'materials');
        $this->db->where('content.language',$language);
        $this->db->order_by('materials.date','desc');
        $this->db->order_by('materials.material_id','desc');
        $this->db->limit($limit, $start_from);
        $query = $this->db->get();
//		dump($this->db->last_query());

        $query_with_comment = array();

        foreach($query->result_array() as $material){

            $query_with_comment[$material['material_id']] = $material;

            $comments_num_and_rating =  $this->get_num_and_rating_comments($material['material_id']);

            $query_with_comment[$material['material_id']]['comments_num']       = $comments_num_and_rating['num'];
            $query_with_comment[$material['material_id']]['comments_rating']    = $comments_num_and_rating['rating'];

        }

        return $query_with_comment;
    }

}

/* End of file sections_model.php */
/* Location: ./application/models/sections_model.php */