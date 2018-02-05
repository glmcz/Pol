<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('events_model'));
	}
    
    public function index()
	{
		redirect(base_url());
	}

	public function view($event_url = '')
	{

        //language for links
        if(LANGUAGE == 'cz'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;
        
        //$this->output->enable_profiler(TRUE);

        if(!isset($event_url) || $event_url == ''){

            redirect(base_url());

        }else{

            $data['info']     = $this->events_model->get_by_url($event_url);
            $data['content']  = $this->events_model->get_content($data['info']['event_id'], LANGUAGE);

            if (empty($data['info']) || empty($data['content']))
        	{
                show_404();

        	}else{

               if (empty($data['info']))
               {
                    show_404();

               }else{
                    
                   //$this->output->enable_profiler(TRUE);

                   //Формируем массив для обновления поля count_views (текущее число показов материала +1)
                   $counter_data = array('count_views' => $data['info']['count_views'] + 1);
                   //Запускаем функцию обновления, меняющую значение счетчика в базе
                   $this->events_model->update_counter($data['info']['event_id'],$counter_data);

                   $data['breadcrumb']  = array(
                        '1' => array('url' => '', 'title' => $data['content']['title'])
                   );
                   
                   $date = date('Y/m/d', strtotime($data['info']['date']));
                   
                   $data['breadcrumb']  = array(
                        '1' => array('url' => 'calendar/'.$date, 'title' => 'Календарь'),
                        '2' => array('url' => '', 'title' => $data['content']['title'])
                   );

                   $name = 'calendar/event';

                   $this->display_lib->front_page($data,$name);

               }

        	}
        } 

	}
    
}

/* End of file events.php */
/* Location: ./application/controllers/events.php */