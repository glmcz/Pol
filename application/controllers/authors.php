<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authors extends MY_Controller {

   	protected $max_commented_limit = 5;

    public function __construct()
	{
		parent::__construct();
		$this->load->model(array('pages_model','sections_model'));
	}

    public function index($author = 0)
	{
		if(LANGUAGE == 'cz'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;
		$author_id = explode('_', $author);

        if( empty($author_id[0]) ||
			$author_id[0] != 'id' ||
			empty($author_id[1]) ||
			!is_numeric($author_id[1])
			){

            redirect(base_url());

        }else{
			$author_id = force_int($author_id[1]);

            $data['author'] = $this->sections_model->get_author($author_id);
            $data['info']               = $this->pages_model->get_by_url('avtor');
            $data['content']            = $this->pages_model->get_content($data['info']['page_id'], LANGUAGE);

            $data['content']['title']         = $data['content']['title'].' - '.$data['author']['name'];
            $data['content']['description']   = $data['content']['description'].' - '.$data['author']['name'];

//			dump_exit($data['content'], 'content');
            if (empty($data['info']) || empty($data['content']))
        	{
                show_404();

        	}else{

				$total_segments = $this->uri->total_segments();
				$last_segment   = $this->uri->segment($total_segments);

				if (is_numeric($last_segment)): $start_from = $last_segment; else: $start_from = 0; endif;

				$this->load->library(array('pagination','pagination_lib'));

				/* URI SEGMENT */
				if(LANGUAGE == 'ru'): $uri_segment = 3; else: $uri_segment = 4; endif;
				$limit       = MATERIALS_PER_PAGE;
				$total       = $this->sections_model->count_author_materials($author_id, LANGUAGE);
				//dump($total);
				$link        = $data['lang'].'author/'.'id_'.$author_id;
				$settings    = $this->pagination_lib->get_settings('materials',$link, $total, $limit, $uri_segment);

				//Применяем настройки;
				$this->pagination->initialize($settings);
				$data['page_nav']    = $this->pagination->create_links();
				$data['breadcrumb']  = array('1' => array('url' => '', 'title' => 'Все статьи автора <b>'.$data['author']['name'].'</b>'));
				$data['materials']   = $this->sections_model->get_author_materials($author_id, $limit, $start_from, LANGUAGE);
				//dump($data['materials']);

				$name = 'sections/author';
				$this->display_lib->front_page($data, $name);
        	}
        }
	}

}

/* End of file materials.php */
/* Location: ./application/controllers/materials.php */