<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sections extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('sections_model'));
	}
    
    public function index()
	{
		redirect(base_url());
	}

	public function view($section_url = '', $start_from = 0)
	{
		if(LANGUAGE == 'cz'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;
        
        if(!isset($section_url) || $section_url == ''){
            
            redirect(base_url());
            
        }else{
            
            $data['info']       = $this->sections_model->get_by_url($section_url);
            $data['content']    = $this->sections_model->get_content($data['info']['section_id'], LANGUAGE);
            
            $childrens          = $this->sections_model->get_childrens($data['info']['section_id']); 

            if (empty($data['info'])||empty($data['content']))
        	{
                show_404();
                
        	}else{
        	       //All materials
                   if($section_url == 'all'){
                    
                        $total_segments = $this->uri->total_segments();
                        $last_segment   = $this->uri->segment($total_segments);
                        
                        if (is_numeric($last_segment)): $start_from = $last_segment; else: $start_from = 0; endif;
                        
                        $this->load->library(array('pagination','pagination_lib'));
                        
                        /* URI SEGMENT */
                        if(LANGUAGE == 'ru'): $uri_segment = 2; else: $uri_segment = 3; endif;
                        $limit       = MATERIALS_PER_PAGE;
                        $total       = $this->sections_model->count_all_materials('materials',LANGUAGE);
                        $link        = $data['lang'].$section_url;
                        $settings    = $this->pagination_lib->get_settings('materials',$link,$total,$limit,$uri_segment);
                        
                        //Применяем настройки;
                        $this->pagination->initialize($settings);
                        $data['page_nav']    = $this->pagination->create_links();
                        $data['breadcrumb']  = array('1' => array('url' => '', 'title' => $data['content']['title']));
                        $data['materials']   = $this->sections_model->get_all_materials($limit,$start_from,'materials',LANGUAGE);
                        
                        $name = 'sections/section';
                        
                        $this->display_lib->front_page($data,$name);  
                    
                   }else{ 
        	       
                       switch($data['info']['type'])
                       {
                            
                            /* Videos */
                            case 2:
                                
                                $total_segments = $this->uri->total_segments();
                                $last_segment   = $this->uri->segment($total_segments);
                                
                                if (is_numeric($last_segment)): $start_from = $last_segment; else: $start_from = 0; endif;
                                                        
                                $this->load->library(array('pagination','pagination_lib'));
                                
                                /* URI SEGMENT */
                                if(LANGUAGE == 'ru'): $uri_segment = 2; else: $uri_segment = 3; endif;
                                $limit       = MATERIALS_PER_PAGE;
                                $total       = $this->sections_model->count_materials_by($data['info']['section_id'],'materials',$childrens,LANGUAGE);
                                $link        = $data['lang'].$section_url;
                                $settings    = $this->pagination_lib->get_settings('materials',$link, $total, $limit, $uri_segment);
                                
                                //Применяем настройки;
                                $this->pagination->initialize($settings);
                                $data['page_nav']    = $this->pagination->create_links();
                                $data['breadcrumb']  = array('1' => array('url' => '', 'title' => $data['content']['title']));
                                $data['materials']   = $this->sections_model->get_materials_by($data['info']['section_id'],$limit,$start_from,'materials',$childrens,LANGUAGE);
                                
                                
                                
                                $name = 'sections/videos';
                                
                                $this->display_lib->front_page($data,$name); 
                            
                            break;
                            
                            /* Links */
                            case 3:
                            
                                redirect(base_url(LANGUAGE.$data['info']['url']));
                            
                            break;
                            
                            /* Photos */
                            case 4:
                            
                                $total_segments = $this->uri->total_segments();
                                $last_segment   = $this->uri->segment($total_segments);
                                
                                if (is_numeric($last_segment)): $start_from = $last_segment; else: $start_from = 0; endif;
                            
                                $this->load->library(array('pagination','pagination_lib'));
                                
                                /* URI SEGMENT */
                                if(LANGUAGE == 'ru'): $uri_segment = 2; else: $uri_segment = 3; endif;
                                $limit       = MATERIALS_PER_PAGE;
                                $total       = $this->sections_model->count_materials_by($data['info']['section_id'],'materials',$childrens,LANGUAGE);
                                $link        = $data['lang'].$section_url;
                                $settings    = $this->pagination_lib->get_settings('materials',$link, $total, $limit, $uri_segment);
                                
                                //Применяем настройки;
                                $this->pagination->initialize($settings);
                                $data['page_nav']    = $this->pagination->create_links();
                                $data['breadcrumb']  = array('1' => array('url' => '', 'title' => $data['content']['title']));
                                $data['materials']   = $this->sections_model->get_materials_by($data['info']['section_id'],$limit,$start_from,'materials',$childrens,LANGUAGE);
                                
                                $name = 'sections/section';
                                
                                $this->display_lib->front_page($data,$name); 
                            
                            break;
                            
                            /* Materials || Photos : case 1 || case 4 */
                            default:
                            
                                $total_segments = $this->uri->total_segments();
                                $last_segment   = $this->uri->segment($total_segments);
                                
                                if (is_numeric($last_segment)): $start_from = $last_segment; else: $start_from = 0; endif;
                            
                                $this->load->library(array('pagination','pagination_lib'));
                           
                                /* URI SEGMENT */
                                if(LANGUAGE == 'ru'): $uri_segment = 2; else: $uri_segment = 3; endif;
                                $limit       = MATERIALS_PER_PAGE;
                                $total       = $this->sections_model->count_materials_by($data['info']['section_id'],'materials',$childrens,LANGUAGE);
                                $link        = $data['lang'].$section_url;
                                $settings    = $this->pagination_lib->get_settings('materials',$link, $total, $limit, $uri_segment);
                                
                                //Применяем настройки;
                                $this->pagination->initialize($settings);
                                $data['page_nav']    = $this->pagination->create_links();
                                $data['breadcrumb']  = array('1' => array('url' => '', 'title' => $data['content']['title']));
                                $data['materials']   = $this->sections_model->get_materials_by($data['info']['section_id'],$limit,$start_from,'materials',$childrens,LANGUAGE);
                                
                                $name = 'sections/section';
                                
                                $this->display_lib->front_page($data,$name); 
                            
                            break;
                        
                       }
        	   
                   
                    }
                   
         
        	}    
        }
	}
    
}

/* End of file materials.php */
/* Location: ./application/controllers/materials.php */