<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha_lib
{

public function __construct()
{
    $this->ci =& get_instance ();

}

public function captcha_actions()
{

    //Загружаем плагин Капча
    $this->ci->load->helper('captcha');

    //Загружаем хэлпер для генерирования случайной строки
    $this->ci->load->helper('string');
    $rnd_str = random_string('numeric',6);

    //Записываем строку в сессию
    $ses_data = array();
    $ses_data['rnd_captcha'] = $rnd_str;
//	echo "1111<pre>";
//		print_r($this->ci->session->userdata('rnd_captcha'));
//	echo "</pre>";
    $this->ci->session->set_userdata($ses_data);
//	echo "222<pre>";
//		print_r($this->ci->session->userdata('rnd_captcha'));
//	echo "</pre>";

    //Параметры картинки
    $settings = array('word'	   => $rnd_str,
     				  'img_path'   => './assets/img/captcha/',
       				  'img_url'	   => base_url().'assets/img/captcha/',
       				  'font_path'  => './system/fonts/cour.ttf',
      				  'img_width'  => 130,
      				  'img_height' => 32,
       				  'expiration' => 10);

    //Создаем капчу
    $captcha = create_captcha($settings);
//    echo '<pre>333';
//		print_r($this->ci->session->all_userdata());
//    echo '</pre>';
//    echo '444<pre>';
//		print_r($captcha);
//    echo '</pre>';
    //Получаем в переменную код картинки
    $imgcode = $captcha['image'];
    return $imgcode;
}

}
?>