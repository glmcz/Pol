<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagination_lib
{

//id - для чего навигация, name - имя для подстановки к base_url (только для категорий),всего, ограничение)
public function get_settings($id,$name,$total,$limit,$uri_segment)
{
    $config = array();
    $config['total_rows'] = $total;
    $config['per_page'] = $limit;
    $config['first_link'] = '&laquo;Первая';
    $config['last_link'] = 'Последняя&raquo;';
    $config['next_link'] = '&raquo;';
    $config['prev_link'] = '&laquo;';

    // открывющий тэг перед навигацией
    $config['full_tag_open'] = '<ul class="pagination">';

    // закрывающий тэг после навигации
    $config['full_tag_close'] = '</ul>';

    // первая страница открывающий тэг
    $config['first_tag_open'] = '<li>';

    // первая страница закрывающий тэг
    $config['first_tag_close'] = '</li>';

    // последняя страница открывающий тэг
    $config['last_tag_open'] = '<li>';

    // последняя страница закрывающий тэг
    $config['last_tag_close'] = '</li>';

    // предыдущая страница открывающий тэг
    $config['prev_tag_open'] = '<li>';

    // предыдущая страница закрывающий тэг
    $config['prev_tag_close'] = '</li>';

    // текущая страница открывающий тэг
    $config['cur_tag_open'] = '<li class = "active"><a>';

    // текущая страница закрывающий тэг
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>'; // цифровая ссылка открывающий тэг
    $config['num_tag_close'] = '</li>'; // цифровая ссылка закрывающий тэг

    // следующая страница открывающий тэг
    $config['next_tag_open'] = '<li>';

    // следующая страница закрывающий тэг
    $config['next_tag_close'] = '</li>';


    switch($id)
    {
        case 'materials':

            $config['base_url']     = base_url().$name;
            $config['uri_segment']  = /*$uri_segment*/2;

            //количество "цифровых" ссылок по бокам от текущей
            $config['num_links']    = 5;

            return $config;
            break;

    }
}

public function search_settings(){
	$config['first_link'] = '&laquo;Первая';
	$config['last_link'] = 'Последняя&raquo;';
	$config['next_link'] = '&raquo;';
	$config['prev_link'] = '&laquo;';

	// открывющий тэг перед навигацией
	$config['full_tag_open'] = '<ul class="pagination">';

	// закрывающий тэг после навигации
	$config['full_tag_close'] = '</ul>';

	// первая страница открывающий тэг
	$config['first_tag_open'] = '<li>';

	// первая страница закрывающий тэг
	$config['first_tag_close'] = '</li>';

	// последняя страница открывающий тэг
	$config['last_tag_open'] = '<li>';

	// последняя страница закрывающий тэг
	$config['last_tag_close'] = '</li>';

	// предыдущая страница открывающий тэг
	$config['prev_tag_open'] = '<li>';

	// предыдущая страница закрывающий тэг
	$config['prev_tag_close'] = '</li>';

	// текущая страница открывающий тэг
	$config['cur_tag_open'] = '<li class = "active"><a>';

	// текущая страница закрывающий тэг
	$config['cur_tag_close'] = '</a></li>';

	$config['num_tag_open'] = '<li>'; // цифровая ссылка открывающий тэг
	$config['num_tag_close'] = '</li>'; // цифровая ссылка закрывающий тэг

	// следующая страница открывающий тэг
	$config['next_tag_open'] = '<li>';

	// следующая страница закрывающий тэг
	$config['next_tag_close'] = '</li>';

	return $config;
}

}
?>