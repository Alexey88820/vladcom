<?php
    function convertDollarToRubel($money, $course, $output = 'both') {
        if ($money[0]=='$') {
            $money = preg_replace("([^0-9])", "", $money);
        } elseif ($money=='по запросу') {
            return $money;
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

?>