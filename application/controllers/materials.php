<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materials extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('comments_model','materials_model','sections_model'));
	}

    public function index()
	{
		redirect(base_url());
	}

	public function view($material_url = '')
	{

		//language for links
        if(LANGUAGE == 'cz'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;
        
        //$this->output->enable_profiler(TRUE);

        if(!isset($material_url) || $material_url == ''){

            redirect(base_url());

        }else{

            $data['info']     = $this->materials_model->get_by_url($material_url);
            $data['content']  = $this->materials_model->get_content($data['info']['material_id'], LANGUAGE);
            $data['similars'] = $this->materials_model->get_similars($data['info']['section'], $data['info']['material_id'], LANGUAGE);

            if (empty($data['info']) || empty($data['content']))
        	{
                show_404();

        	}else{
                   
                   $data['author']             = $this->sections_model->get_author($data['info']['author_id']); 
                    
                   //$this->output->enable_profiler(TRUE);
                                      
                   $this->load->library('captcha_lib');
                   
                   //Получаем следующий и предыдущий материалы
                   $data['prev_and_next']  =  $this->materials_model->get_prev_and_next($data['info']['section'], $data['info']['material_id'], LANGUAGE);
                   
                   //Количество комментариев
                   $data['info']['comments_num'] =  $this->sections_model->count_comments($data['info']['material_id']);
                   $data['info']['comments']     =  $this->comments_model->get_by($data['info']['material_id']);
                   
                   $data['info']['comments_num_and_rating'] =  $this->materials_model->get_count_and_rating_comments($data['info']['material_id']);

                   $data['photos']               =  $this->materials_model->get_photos($data['info']['material_id']);
                   $data['audios']               =  $this->materials_model->get_audios($data['info']['material_id']);
                   //Формируем массив для обновления поля count_views (текущее число показов материала +1)
                   $counter_data = array('count_views' => $data['info']['count_views'] + 1);
                   //Запускаем функцию обновления, меняющую значение счетчика в базе
                   $this->materials_model->update_counter($data['info']['material_id'],$counter_data);
                   $data['section']     = $this->sections_model->get($data['info']['section']);
                   $data['section_content']     = $this->sections_model->get_content($data['info']['section'], LANGUAGE);
                   $data['breadcrumb']  = array(
                        '1' => array('url' => $data['section']['url'], 'title' => $data['section_content']['title']),
                        '2' => array('url' => '', 'title' => $data['content']['title'])
                   );
                   
                   if($data['info']['show'] == 0){
                        //redirect(base_url());
                   }
                   
                   $name = 'materials/material';
                   
                   //if 'photos_list'
                   if($data['section']['type'] == 6){
                    
                      $name = 'materials/material_dif';
                    
                   }
                   
                   //var_dump($data['section']);

                   $data['imgcode']              =  $this->captcha_lib->captcha_actions();

                   $this->display_lib->front_page($data,$name);


        	}
        }
	}
    
    
    public function add_like()
	{
      
        $material_url     = $this->input->post('url');
        
        $data['info']     = $this->materials_model->get_by_url($material_url);

        if (empty($data['info']))
    	{
            
            echo json_encode(array('err' => 1, 'content' => $this->lang->line('no_material').':('));

            die;

    	}else{
            
            // Проверяем существует ли в сессии массив с лайками
            $likes = $this->session->userdata('likes');

            if(empty($likes)){
                $likes = array(
                    'likes' => array()
                );
				// Если не существует - созадём его
                $this->session->set_userdata($likes);
            }
            
            $likes = $this->session->userdata('likes');
            
            if(!in_array($data['info']['material_id'],$likes)){
                
                array_push($likes, $data['info']['material_id']);
                
                $this->session->set_userdata('likes',$likes);
                
                //Формируем массив для обновления поля like (текущее число лайков +1)
                $like_data = array('like' => $data['info']['like'] + 1);
                //Запускаем функцию обновления, меняющую значение счетчика в базе
                $this->materials_model->update_like($data['info']['material_id'],$like_data);
                
                echo json_encode(array('err' => 0, 'content' => '<i class="fa fa-heart"></i> '.$this->lang->line('material_thank_you_for_like').' <i class="fa fa-heart"></i> +'.($data['info']['like'] + 1)));
                
                die;
                
            }else{
                
                echo json_encode(array('err' => 1, 'content' => $this->lang->line('material_already_liked').' =)'));
                
                die;
                
            }
            


    	}

	}

}

/* End of file materials.php */
/* Location: ./application/controllers/materials.php */