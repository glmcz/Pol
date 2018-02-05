<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends MY_Controller
{

public function __construct()
{
   parent::__construct();
}

public function index($year = null, $month = null, $day = null)
{

    if(LANGUAGE == 'cz'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;

    if(!isset($year) || !isset($month)){
        $year   = date('Y');
        $month  = date('m');
    }

    $data['info']       = $this->sections_model->get_by_url('calendar');
    $data['content']    = $this->sections_model->get_content($data['info']['section_id'], LANGUAGE);

    if (empty($data['info'])){

        show_404();

	}else{

		if ($day){
		    
            $data['breadcrumb'] = array('1' => array('url' => '', 'title' => $data['info']['title']));  
          
			if ($day > 0 && $day < 10){
				$day = '0'.$day;
			}
            
            $data['content']['title'] = $data['content']['title'].' за '.$day.'/'.$month.'/'.$year;
            
            $cal_data           = $this->calendar_model->get_my_calendar_data($year, $month);
			$data['calendar']   = $this->calendar_model->generate_my_calendar($year,$month,$cal_data);
            
			$data['date'] = $day.'.'.$month.'.'.$year;
			$data['events'] = $this->calendar_model->get_day_events($year, $month, $day, LANGUAGE);

			$name = 'calendar/events';
			$this->display_lib->front_welcome_page($data,$name);
		}
		else {
			$data['breadcrumb'] = array('1' => array('url' => '', 'title' => $data['info']['title']));

			$data['year']   = $year; // ADD THIS
			$data['month']  = $month; // ADD THIS

			$cal_data           = $this->calendar_model->get_my_calendar_data($year, $month);

			$data['calendar']   = $this->calendar_model->generate_my_calendar($year,$month,$cal_data);
            
            $name = 'calendar';
     
            $this->display_lib->user_one_page($data,$name);

		}
    }

}

}
?>