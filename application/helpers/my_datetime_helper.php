<?php
/*--Функция для преобразования даты формата ДД.ММ.ГГГГ в формат ГГГГ-ММ-ДД--*/
function date_ru_human_to_mysql($datephp)
{
    if (empty($datephp)) {
        return NULL;
    } else {
        return substr($datephp, 6, 4)."-".substr($datephp, 3, 2)."-".substr($datephp, 0, 2);
    }
}

/*--Функция для преобразования даты формата ГГГГ-ММ-ДД в формат ДД.ММ.ГГГГ--*/
function date_mysql_to_ru_human($datemysql)
{
    if (empty($datemysql)) {
        return NULL;
    } else {
        return substr($datemysql, 8, 2).".".substr($datemysql, 5, 2).".".substr($datemysql, 0, 4);
    }
}

function differenceDates($date1, $date2) {

    $arr1 = explode(" ", $date1);
    $arr2 = explode(" ", $date2);

    $arrdate1 = explode("-", $arr1[0]);
    $arrdate2 = explode("-", $arr2[0]);

    $timestamp2 = (mktime(0, 0, 0, $arrdate2[1],  $arrdate2[2],  $arrdate2[0]));
    $timestamp1 = (mktime(0, 0, 0, $arrdate1[1],  $arrdate1[2],  $arrdate1[0]));
    $difference = floor(($timestamp2 - $timestamp1)/86400);

    return $difference;
}

function convertDatetimeToUnix($date_str) {

    list($date, $time) = explode(' ', $date_str);
    list($year, $month, $day) = explode('-', $date);
    list($hour, $minute, $second) = explode(':', $time);

    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);

    return $timestamp;
}
