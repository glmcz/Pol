<?php
// Переводим переменную в положитеное float число
if (!function_exists('force_float')) {
	function force_float($id){
		// Из любого типа делаем положительное целое число
		$id = abs((float)trim($id));

		return $id;
	}
}
// Переводим переменную в положитеное число
if (!function_exists('force_int')) {
	function force_int($id){
		// Из любого типа делаем положительное целое число
		$id = abs((int) trim($id));

		return $id;
	}
}

// Проверяем строчную переменную
if (!function_exists('alpha_dash')) {
	function alpha_dash($str){
		return ( ! preg_match("/^([-a-zа-яёіїє0-9_.\-\s])+$/ui", $str)) ? FALSE : TRUE;
	}
}

// Создаём массив из строки с разделителями
if (!function_exists('arr_from_str')) {
	function arr_from_str($str, $separator = '|'){
		// Разбираем строку $str разделённую $separator при этом удаляя из массива пустые значения
		$res = array_diff(explode($separator, $str), array(''));

		return $res;
	}
}

function care_unserial($val, $separator = ', '){
	$ret = '';

	$ret = @ unserialize($val) ? implode($separator,unserialize($val)): $val;

	return $ret;
}


function rus_date() {
	// Перевод
	 $translate = array(
	 "am" => "дп",
	 "pm" => "пп",
	 "AM" => "ДП",
	 "PM" => "ПП",
	 "Monday" => "Понедельник",
	 "Mon" => "Пн",
	 "Tuesday" => "Вторник",
	 "Tue" => "Вт",
	 "Wednesday" => "Среда",
	 "Wed" => "Ср",
	 "Thursday" => "Четверг",
	 "Thu" => "Чт",
	 "Friday" => "Пятница",
	 "Fri" => "Пт",
	 "Saturday" => "Суббота",
	 "Sat" => "Сб",
	 "Sunday" => "Воскресенье",
	 "Sun" => "Вс",
	 "January" => "Января",
	 "Jan" => "Янв",
	 "February" => "Февраля",
	 "Feb" => "Фев",
	 "March" => "Марта",
	 "Mar" => "Мар",
	 "April" => "Апреля",
	 "Apr" => "Апр",
	 "May" => "Мая",
	 "May" => "Мая",
	 "June" => "Июня",
	 "Jun" => "Июн",
	 "July" => "Июля",
	 "Jul" => "Июл",
	 "August" => "Августа",
	 "Aug" => "Авг",
	 "September" => "Сентября",
	 "Sep" => "Сен",
	 "October" => "Октября",
	 "Oct" => "Окт",
	 "November" => "Ноября",
	 "Nov" => "Ноя",
	 "December" => "Декабря",
	 "Dec" => "Дек",
	 "st" => "ое",
	 "nd" => "ое",
	 "rd" => "е",
	 "th" => "ое"
	 );
	 // если передали дату, то переводим ее
	 if (func_num_args() > 1) {
	 $timestamp = func_get_arg(1);
	 return strtr(date(func_get_arg(0), $timestamp), $translate);
	 } else {
	// иначе текущую дату
	 return strtr(date(func_get_arg(0)), $translate);
	 }
 }

function ukr_date() {
	// Перевод
	 $translate = array(
	 "am" => "дп",
	 "pm" => "пп",
	 "AM" => "ДП",
	 "PM" => "ПП",
	 "Monday" => "Понеділок",
	 "Mon" => "Пн",
	 "Tuesday" => "Вівторок",
	 "Tue" => "Вт",
	 "Wednesday" => "Середа",
	 "Wed" => "Ср",
	 "Thursday" => "Четвер",
	 "Thu" => "Чт",
	 "Friday" => "П'тниця",
	 "Fri" => "Пт",
	 "Saturday" => "Субота",
	 "Sat" => "Сб",
	 "Sunday" => "Неділя",
	 "Sun" => "Нд",
	 "January" => "Січня",
	 "Jan" => "Січ",
	 "February" => "Лютого",
	 "Feb" => "Лют",
	 "March" => "Березня",
	 "Mar" => "Бер",
	 "April" => "Квітня",
	 "Apr" => "Кві",
	 "May" => "Травня",
	 "May" => "Тра",
	 "June" => "Червня",
	 "Jun" => "Чер",
	 "July" => "Липня",
	 "Jul" => "Лип",
	 "August" => "Серпня",
	 "Aug" => "Сер",
	 "September" => "Вересня",
	 "Sep" => "Вер",
	 "October" => "Жовтня",
	 "Oct" => "Жов",
	 "November" => "Листопада",
	 "Nov" => "Лис",
	 "December" => "Грудня",
	 "Dec" => "Гру",
	 "st" => "е",
	 "nd" => "е",
	 "rd" => "є",
	 "th" => "е"
	 );
	 // если передали дату, то переводим ее
	 if (func_num_args() > 1) {
	 $timestamp = func_get_arg(1);
	 return strtr(date(func_get_arg(0), $timestamp), $translate);
	 } else {
	// иначе текущую дату
	 return strtr(date(func_get_arg(0)), $translate);
	 }
 }

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
		// Определяем количество выводимых символов в var_dump()
		ini_set('xdebug.var_display_max_data', 2048);
        // Помещаем дамп в переменную
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Добавляем форматирование
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Вывод
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}

if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}