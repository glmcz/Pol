<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {

	protected $search_limit = 10;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('pages_model');
	}

    public function index()
	{
		//language for links
        if(LANGUAGE == 'cz'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;

        $data['info']                   = $this->pages_model->get_wellcome_page();
        $data['content']                = $this->pages_model->get_content(1, LANGUAGE);
        $data['slides']                 = $this->pages_model->get_slider_news(LANGUAGE);
        $data['photos_of_the_day']      = $this->pages_model->get_photos_of_the_day(LANGUAGE);
        $data['latest_news_by_sec']     = $this->pages_model->get_latest_news_by_sec(LANGUAGE);
        $data['latest_news']            = $this->pages_model->get_latest_news(LANGUAGE);
        
        $data['top_weeks']              = $this->pages_model->get_top_materials(date("Y-m-d",strtotime("+1 day")),date("Y-m-d",strtotime("-1 week")),LANGUAGE);
        $data['top_months']             = $this->pages_model->get_top_materials(date("Y-m-d",strtotime("+1 day")),date("Y-m-d",strtotime("-1 month")),LANGUAGE);                        
        $data['top_years']              = $this->pages_model->get_top_materials(date("Y-m-d",strtotime("+1 day")),date("Y-m-d",strtotime("-1 year")),LANGUAGE);


        //print_r($data['latest_news']);

        if (empty($data['info']) || empty($data['content']))
    	{
    		show_404();
    	}

        $name = 'pages/wellcome_page';

        $this->display_lib->front_welcome_page($data,$name);
	}

    public function search()
	{
		$data['search'] = array();
		$data['total'] = 0;
		$this->load->library('form_validation');
		//language for links
        if(LANGUAGE == 'cz'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;

		$data['content'] = array(
			'title' => 'Hledat',
			'description' => 'Hledat polahoda.cz',
			'keywords' => 'dobrá zpráva',
			);

		if ( isset($_POST['send_search']))
		{
			//Установка правил валидации
			$this->form_validation->set_rules($this->pages_model->search_rules);

			//Если валидация пройдена
			if ($this->form_validation->run() == TRUE)
			{
				$data['searchword'] = $this->input->post('search', TRUE);
				$ses_data['search'] = $data['searchword'];
				$this->session->set_userdata($ses_data);
				$data['search'] = $this->pages_model->get_search(LANGUAGE, $data['searchword']);
				$data['total'] = count($data['search']);
			}
		}
		else {
			$data['searchword'] = $this->session->userdata('search');
			$data['search'] = $this->pages_model->get_search(LANGUAGE, $data['searchword']);
			$data['total'] = count($data['search']);
		}

		$total_segments = $this->uri->total_segments();
		$last_segment   = $this->uri->segment($total_segments);

		if (is_numeric($last_segment)): $start_from = $last_segment; else: $start_from = 0; endif;

		$this->load->library(array('pagination','pagination_lib'));

		if(LANGUAGE == 'ru'): $uri_segment = 2; else: $uri_segment = 3; endif;
		$limit = $this->search_limit;
		$total = $data['total'];
		$data['search'] = array_slice($data['search'], $start_from, $limit);
		$config = $this->pagination_lib->search_settings();
		$config['base_url'] = base_url('search');
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;

		//Применяем настройки
		$this->pagination->initialize($config);
		$data['page_nav']    = $this->pagination->create_links();
		$data['breadcrumb']  = array('1' => array('url' => base_url('search'), 'title' => 'Hledat'));
        $name = 'pages/search';
//		echo '<pre>';
//		print_r($data);
//		echo '</pre>';
        $this->display_lib->front_search($data, $name);
	}

    public function tagsearch()
	{
		$data['tagsearch'] = array();
		$data['total'] = 0;
		// Языки для ссылки
        if(LANGUAGE == 'cz'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;

		$data['content'] = array(
			'title' => 'Vyhledávání podle značky',
            'description' => 'Hledat polahoda.cz',
            'keywords' => 'dobrá zpráva',
			);

		if ( isset($_GET['send_tagsearch']) && strlen($_GET['send_tagsearch']) <= 1000)
		{
			$data['tagsearchword'] = $this->input->get('send_tagsearch', TRUE);
			$ses_data['tagsearch'] = $data['tagsearchword'];
			$this->session->set_userdata($ses_data);
			$data['tagsearch'] = $this->pages_model->get_tagsearch(LANGUAGE, $data['tagsearchword']);
			$data['total'] = count($data['tagsearch']);
			$data['content']['title'] .= ' &bull;'.$data['tagsearchword'].'&bull; ';
		}
		else {
			$data['tagsearchword'] = $this->session->userdata('tagsearch');
			$data['tagsearch'] = $this->pages_model->get_tagsearch(LANGUAGE, $data['tagsearchword']);
			$data['total'] = count($data['tagsearch']);
			$data['content']['title'] .= ' &bull;'.$data['tagsearchword'].'&bull; ';
		}

		// Определение последнего сегмента
		$total_segments = $this->uri->total_segments();
		$last_segment   = $this->uri->segment($total_segments);
		// Определение стартовго элемента в массиве поиска
		if (is_numeric($last_segment)): $start_from = $last_segment; else: $start_from = 0; endif;

		$this->load->library(array('pagination','pagination_lib'));
		// Если любой язык кроме базового, русского, смещаем ури сегмент на 1
		if(LANGUAGE == 'ru'): $uri_segment = 2; else: $uri_segment = 3; endif;
		$limit = $this->search_limit;
		$total = $data['total'];
		$data['tagsearch'] = array_slice($data['tagsearch'], $start_from, $limit);
		$config = $this->pagination_lib->search_settings();
		$config['base_url'] = base_url('tagsearch');
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;

		//Применяем настройки
		$this->pagination->initialize($config);
		$data['page_nav']    = $this->pagination->create_links();
		$data['breadcrumb']  = array('1' => array('url' => base_url('tagsearch'), 'title' => 'Vyhledávání podle značky'));
        $name = 'pages/tagsearch';
//		echo '<pre>';
//		print_r($data);
//		echo '</pre>';
        $this->display_lib->front_search($data, $name);
	}

	public function view($url)
	{
        //language for links
        if(LANGUAGE == 'cz'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;

        $data['info']     = $this->pages_model->get_by_url($url);
        $data['content']  = $this->pages_model->get_content($data['info']['page_id'], LANGUAGE);

        if (empty($data['info']) || empty($data['content']))
    	{
    		show_404();
    	}

        if($data['info']['wp'] == 1){

            redirect(base_url());

        }

        $data['breadcrumb']         = array('1' => array('url' => '', 'title' => $data['info']['title']));

        switch($url)
        {

            case 'feedback':

                $this->load->library(array('captcha_lib','form_validation'));

                //Установка правил валидации
                $this->form_validation->set_rules($this->pages_model->feedback_rules);

            	$val_res = $this->form_validation->run();

                //Если валидация пройдена
                if ($val_res == TRUE)
                {
                     //Получаем значение поля капча
               	     $entered_captcha = $this->input->post('captcha');

                     if ($entered_captcha == $this->session->userdata('rnd_captcha')){

                         $this->load->library('typography');

                         //Имя отправителя
                         $name = $this->input->post('name');

                         //Указанный отправителем email
                         $email = $this->input->post('email');

                         //Текст сообщения
                         $text = $this->input->post('message');

                         //Переносы после 70 знаков (ограничение mail в PHP)
                         $text = wordwrap($text,70);

                         // TRUE - более двух переводов строк все равно                            считаются за два перевода строки
                         $text = $this->typography->auto_typography($text,TRUE);
                         // Удаляем html-тэги для удобства чтения
                         $text = strip_tags($text);

                         //Куда отправляется письмо
                         $address = EMAIL_1;

                         //Тема письма как ее видит получатель
                         $subject = "Сообщение из формы обратной связи";
                         $message = "Написал(а):$name\nEmail отправителя: $email\nСообщение:\n$text\n";

                         //Отправляем письмо
            	         mail ($address,$subject,$message,"Content-type:text/plain;charset = UTF-8\r\n");

                         $data['alert'] = 'Vaše zpráva byla odeslána. Pokud to vyžaduje odpověď, budeme vás kontaktovat co nejdříve!';
                         $name = 'info';

                         $this->display_lib->front_page($data,$name);


                     }else{

                        //Получаем код картинки;
                        $data['imgcode'] = $this->captcha_lib->captcha_actions();

                        $data['alert'] = 'Z obrázku jste zadali nesprávná čísla';
                        $name = 'pages/feedback';

                        $this->display_lib->front_page($data,$name);

                     }


                }

                //Если валидация не пройдена
                else
                {

                    //Получаем код картинки;
                    $data['imgcode'] = $this->captcha_lib->captcha_actions();

                    $data['alert']      = ''; //Информационное сообщение
                    $name               = 'pages/feedback';

                    $this->display_lib->front_page($data,$name);
                }



            break;

            case 'request-news':

                 $this->load->library(array('captcha_lib','form_validation'));

                // Не нажата кнопка "Отправить"
                if ( ! isset($_POST['send_message']))
                {

                    //Получаем код картинки
                    $data['imgcode'] = $this->captcha_lib->captcha_actions();
                    $data['alert'] = ''; //Информационное сообщение
                    $name = 'pages/request-news';

                    $this->display_lib->front_page($data,$name);
                }

                // Нажата кнопка "Отправить"
                else
                {
                    //Установка правил валидации
                    $this->form_validation->set_rules($this->pages_model->request_news_feedback);

                	$val_res = $this->form_validation->run();

                    //Если валидация пройдена
                    if ($val_res == TRUE)
                    {
                         //Получаем значение поля капча
                	     $entered_captcha = $this->input->post('captcha');

                         //Если капча совпадает, отправляем письмо
                	     if ($entered_captcha == $this->session->userdata('rnd_captcha'))
                         {

                             if ($_FILES['userfile']['tmp_name']) {

                                	$this->pages_model->userfile_check();

                                	$upload_data = $this->pages_model->userfile_check();
                                }

                                $this->load->library('typography');

                                 $config = array(
                                    'charset' => 'utf8',
                                    'wordwrap' => true
                                 );

                                 $this->load->library('email', $config);

                                 $name      = $this->input->post('name');
                                 $email     = $this->input->post('email');
                                 //////////////////////////////////////////////
                                 $message = $this->input->post('message');
                                 //Переносы после 70 знаков (ограничение mail в PHP)
                                 $message = wordwrap($message,70);
                                 // TRUE - более двух переводов строк все равно считаются за два перевода строки
                                 $message = $this->typography->auto_typography($message,TRUE);
                                 // Удаляем html-тэги для удобства чтения
                                 $message = strip_tags($message);

                                 $content  = "От: $name <$email>\n";
                                 $content .= "Дата и время: ".date("Y/m/d h:m:s A")."\n\n";
                                 $content .= "-------------------------------\n\n";
                                 $content .= "Email отправителя: $email \n";
                                 $content .= "Комментарии: \n$message \n";
                                 $content .= "-------------------------------\n\n";

                                 // Add file data to the message if it is set
                                 if ($upload_data) {
                                	 $content .= "file name : ".$upload_data['file_name'] ."\n";
                                	 $content .= "file type : ".$upload_data['file_type'] ."\n";
                                 }

                                 $this->email->from('info@allatravesti.com', 'Portál "Polahoda.cz"');
                                 $this->email->to(EMAIL_1);

                                 $this->email->subject('Новая новость');
                                 $this->email->message($content);

                                 // Attach the uploaded file if it is set
                                 if ($upload_data) {
                                	 $this->email->attach($upload_data["full_path"]);
                                 }

                                 $this->email->send();

                                 $data['alert'] = "Vaše zpráva byla odeslána!";
                                 $name = 'info';

                                 $this->display_lib->front_page($data,$name);

                         }

                         // Если капча не совпадает
                         else
                         {
                             //Получаем код картинки;
                             $data['imgcode'] = $this->captcha_lib->captcha_actions();

                             $data['alert'] = 'Z obrázku jste zadali nesprávná čísla';
                             $name = 'pages/request-news';

                             $this->display_lib->front_page($data,$name);
                         }
                    }

                    //Если валидация не пройдена
                    else
                    {
                        //Получаем код картинки;
                        $data['imgcode'] = $this->captcha_lib->captcha_actions();
                        $data['alert'] = ''; //Информационное сообщение
                        $name = 'pages/request-news';

                        $this->display_lib->front_page($data,$name);
                    }
                }

            break;

            case 'friends':

                $data['friends'] = $this->pages_model->get_friends(LANGUAGE);

                $name = 'pages/friends';

                $this->display_lib->front_page($data,$name);

            break;
            
            case 'vydani':

                $data['newspapers'] = $this->pages_model->get_newspapers(LANGUAGE);

                $name = 'pages/newspapers';

                $this->display_lib->front_page($data,$name);

            break;
            
            case 'books':

                $name = 'pages/books';

                $this->display_lib->front_page($data,$name);

            break;
            
            case 'kontakty':

                $name = 'pages/contacts';

                $this->display_lib->front_page($data,$name);

            break;


            case 'error_404':

                $name = 'pages/page';

                $this->display_lib->front_page($data,$name);

            break;

            default:

                $name = 'pages/page';

                $this->display_lib->front_page($data,$name);

            break;
        }


	}

}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */