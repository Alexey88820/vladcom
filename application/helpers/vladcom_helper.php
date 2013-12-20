<?php

function add_meta_title ($string)
{
	$CI =& get_instance();
	$CI->data['meta_title'] = esc($string) . ' - ' . $CI->data['meta_title'];
}

function btn_edit ($uri)
{
	return anchor($uri, '<span class="glyphicon glyphicon-edit"></span>');
}

function btn_delete ($uri)
{
	return anchor($uri, '<span class="glyphicon glyphicon-remove"></span>', array(
		'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
	));
}

function esc($string){


    return $string;
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function get_menu ($array)
{
	$CI =& get_instance();
	$str = '';

	if (count($array)) {
		$str .= '<ul class="nav navbar-nav">' . PHP_EOL;
		foreach ($array as $item) {
			$active = $CI->uri->segment(1) == $item->slug ? TRUE : FALSE;

			$str .= $active ? '<li class="active">' : '<li>';
            $link = (empty($item->slug)) ? site_url($item->slug) : site_url($item->slug) . '/';
			$str .= '<a href="' . $link . '" title="Владком | ' . esc($item->title) . '">' . esc($item->title) . '</a>';
			$str .= '</li>' . PHP_EOL;
		}

		$str .= '</ul>' . PHP_EOL;
	}

	return $str;
}

function get_sidebar($sections, $groups)
{
    $CI =& get_instance();
    $str = '';

    $str .= '<ul class="nav nav-pills nav-stacked">';
    foreach ($sections as $section) {
        $active = $CI->uri->segment(2) == $section->slug ? TRUE : FALSE;
        $str .= $active ? '<li class="active sidebar-section">' : '<li class="sidebar-section">';
        $str .= '<a href="' . site_url('catalog/' . $section->slug) . '/" title="' . $section->title . '">' . $section->title . '</a></li>';
        foreach ($groups as $group) {
            if ($group->section_id != $section->id) continue;
            $active = $CI->uri->segment(2) == $group->slug ? TRUE : FALSE;
            $str .= $active ? '<li class="active sidebar-group">' : '<li class="sidebar-group">';
            $str .= '<a href="' . site_url('catalog/' . $group->slug) . '/" title="' . $group->title . '">' . $group->title . '</a></li>';
        }
    }
    $str .= '</ul>';

    return $str;
}


/*--Функция для преобразования даты формата ГГГГ-ММ-ДД ЧЧ:MM:CC в формат ДД.ММ.ГГГГ ЧЧ:MM:CC --*/
function date_mysql_to_ru_human($datemysql)
{
    if (empty($datemysql)) {
        return NULL;
    } elseif (strlen($datemysql) == 10) {
        return substr($datemysql, 8, 2) . '.' . substr($datemysql, 5, 2) . '.' . substr($datemysql, 0, 4);
    } elseif (strlen($datemysql) == 19) {
    	return substr($datemysql, 8, 2) . '.' . substr($datemysql, 5, 2) . '.' . substr($datemysql, 0, 4) . ' ' . substr($datemysql, 11, 5);
    }

    return $datemysql;
}

function transliteration($russian_text) {

    $abc = array(
       "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D",
       "Е"=>"E","Ё"=>"JO","Ж"=>"ZH",
       "З"=>"Z","И"=>"I","Й"=>"JJ","К"=>"K","Л"=>"L",
       "М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R",
       "С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"KH",
       "Ц"=>"C","Ч"=>"CH","Ш"=>"SH","Щ"=>"SHH","Ъ"=>"'",
       "Ы"=>"Y","Ь"=>"","Э"=>"EH","Ю"=>"YU","Я"=>"YA",
       "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d",
       "е"=>"e","ё"=>"jo","ж"=>"zh",
       "з"=>"z","и"=>"i","й"=>"jj","к"=>"k","л"=>"l",
       "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
       "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"kh",
       "ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"shh","ъ"=>"",
       "ы"=>"y","ь"=>"","э"=>"eh","ю"=>"yu","я"=>"ya",
       " "=>"-"
    );

    $english_text = str_replace(array_keys($abc), array_values($abc), $russian_text);
    $english_text = strtolower($english_text);

    return $english_text;
}

function convert_dollars_to_rubels ($money, $course = false, $output = 'both')
{
    if ($course == false) {
        $course = getExchangeRatesCBRF('USD');
    }

    if ($money[0]=='$') {
        $money = preg_replace("([^0-9])", "", $money);
    } elseif ($money=='по запросу') {
        return $money;
    } elseif (substr($money, 0, 6) == 'от $') {

        $money_explode = explode(' ', $money);
        foreach ($money_explode as $key => $value) {
            if ($value[0] == '$') {
                $money_explode[$key] = round(substr($value, 1) * $course, 2) . ' руб.';
            }
        }
        $money_implode = implode(' ', $money_explode);

        return $money_implode;
    } elseif (!is_numeric($money)) {
        return $money;
    } else {
        return number_format($money, 0 , '.', ' ') . ' руб.';
    }

    $rubel = $money * $course;

    switch ($output) {
        case 'both':
            return number_format(round($rubel),  0 , '.', ' ') . ' руб.' . ' / $ ' . number_format($money, 0 , '.', ' ');
            break;
        case 'd':
            return '$ ' . number_format($money, 0 , '.', ' ');
            break;
        case 'r':
            return number_format(round($rubel),  0 , '.', ' ') . ' руб.';
            break;
    }
}

function getExchangeRatesCBRF ($code) {

    $today = date("d/m/Y");
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $today);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $response_xml = simplexml_load_string($output);

    $result = false;

    foreach ($response_xml as $key => $value) {
        $arr = $value->attributes();
        if ((isset($arr['ID'])) && ($arr['ID'] == 'R01235')) {
            $result = $value->Value;
        }
    }

    $result = str_replace(',', '.', $result);

    return $result;
}

?>
