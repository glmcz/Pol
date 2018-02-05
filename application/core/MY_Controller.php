<?php

/**
 * MY Controller class
 *
 * Расширяет основной класс и загружает QS_Controller
 *
 */
class  MY_Controller  extends  CI_Controller  {
    
    private $language;
    
    var $sections	= '';
    var $banners	= '';
    var $modules    = '';
    var $farewell	= '';
    var $main_comments = '';

    function __construct ()  {
        
        parent::__construct();
        
        // определяем язык
        $lang = $this->uri->segment(1);
        
        // если язык не украинский по умолчанию ставим русский
        if($lang != 'ua' && $lang != 'en' && $lang != 'ru'): $lang = 'cz'; endif;
        
        $this->language = $lang;
        
        // подгружаем нужный язык
        switch($lang):
            
            case 'cz':
            $this->lang->load('interface', 'czech');
            $this->config->set_item('language', 'czech');
            break;
            
            case 'ru':
            $this->lang->load('interface', 'russian');
            $this->config->set_item('language', 'russian');
            break;
            
            case 'ua':
            $this->lang->load('interface', 'ukranian');
            $this->config->set_item('language', 'ukranian');
            break;
            
            case 'en':
            $this->lang->load('interface', 'english');
            $this->config->set_item('language', 'english');
            break;

            default:
            $this->lang->load('interface', 'czech');
            $this->config->set_item('language', 'czech');
            break;
        
        endswitch;
        
        //dump($lang);
        
        if($lang == ''): $lang = 'cz'; endif;
        
        $this->_load_settings($lang);
        
        $this->sections	 = $this->sections_model->get_sections_tierd(0,$lang);
        $this->banners	 = $this->front_crud->get_banners($lang);
        $this->modules	 = $this->front_crud->get_modules();
        $this->farewell  = $this->front_crud->get_farewell($lang);
        $this->main_comments = $this->front_crud->get_main_comments(20);
        
        
        
	}


	/**
	 * Загружаем настройки сайта;
	 *
	 * @access	private
	 * @return	void
	 */
    function _load_settings($lang)
    {

		$this->db->where('setting_id', 1);
		$this->db->limit(1);
		$query = $this->db->get('settings');

		if($query->num_rows())
		{
			$row = $query->row();
            
            define("LANGUAGE", $lang);
            if($lang == 'cz'){
                define("SITE_NAME", $row->site_name_cz);
            }elseif($lang == 'ru'){
                define("SITE_NAME", $row->site_name_ru);
            }elseif($lang == 'ua'){
                define("SITE_NAME", $row->site_name_ua);
            }else{
                define("SITE_NAME", $row->site_name_en);
            }
			define("PHONE_1", $row->phone_1);
			define("PHONE_2", $row->phone_2);
			define("MOB_PHONE_1", $row->mob_phone_1);
			define("MOB_PHONE_2", $row->mob_phone_2);
            define("EMAIL_1", $row->email_1);
			define("EMAIL_2", $row->email_2);
            define("VK", $row->vk);
            define("FACEBOOK", $row->facebook);
            define("TW", $row->tw);
            define("YOUTUBE", $row->youtube);
            define("GOOGLE_PLUS", $row->google_plus);
            define("MATERIALS_PER_PAGE", $row->materials_per_page);
            define("LATEST_NEWS_NUM", $row->latest_news_num);
            
        }
        
        

    }



}