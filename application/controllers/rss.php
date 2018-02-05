<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
	}

    public function index($limit = 20, $start_from = 0, $startDate = NULL)
	{
		//language for links
        if(LANGUAGE == 'ru'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;

		$data = array('feeds' => $this->front_crud->feeds_info(LANGUAGE, $startDate, $limit, $start_from));
		$this->load->view('rss_view', $data);
	}


}

/* End of file rss.php */
/* Location: ./application/controllers/rss.php */