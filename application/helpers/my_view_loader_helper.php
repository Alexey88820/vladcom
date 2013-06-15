<?php

// $content = array(
//                     array($controller => $view);
//                     );

function view_loader($data, $content = NULL) {
    $CI =& get_instance();
    $CI->load->view('templates/head', $data['meta']);
    $CI->load->view('templates/header', $data);
    $CI->load->view('templates/left_navigation', $data);
    $CI->load->view('templates/open_article');
    $CI->load->view('templates/breadcrumbs');

    if (!empty($content)) {
        foreach ($content as $value) {
            $CI->load->view($value[0] . '/' . $value[1], $data);
        }
    }
    $CI->load->view('templates/close_article');
    $CI->load->view('blocks/hero_unit_leaders_block');

    $CI->load->view('templates/div_close');
    $CI->load->view('templates/div_close');
    $CI->load->view('templates/footer', $data);
}

function staff_view_loader($data, $content = NULL, $catalog = FALSE) {
    $CI =& get_instance();
    $CI->load->view('staff/templates/head', $data['meta']);
    $CI->load->view('staff/templates/header');
    $CI->load->view('staff/templates/navigation');
    $CI->load->view('templates/open_article');

    if ($catalog) {
        $CI->load->view('staff/templates/catalog_menu');
    }

    $CI->load->view('staff/templates/success', $data['messages']);
    $CI->load->view('staff/templates/error', $data['messages']);
    if (!empty($content)) {
        foreach ($content as $value) {
            $CI->load->view($value[0] . '/' . $value[1], $data);
        }
    }

    if ($catalog) {
        $CI->load->view('templates/div_close');
        $CI->load->view('templates/div_close');
    }

    $CI->load->view('templates/close_article');
    $CI->load->view('staff/templates/footer', $data);
}

?>