<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error_404 extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('pages_model');
	}

    public function index()
	{
		//language for links
        if(LANGUAGE == 'ru'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;

		$this->output->set_status_header('404');

		$data['content'] = array(
			'title'          => $this->lang->line('404_title'),
			'description'    => '',
			'keywords'       => '',
            'text'           => $this->lang->line('404_text')
		);

        $name = 'pages/error_404';

        $this->display_lib->front_welcome_page($data,$name);
	}



}

/* End of file error_404.php */
/* Location: ./application/controllers/error_404.php */