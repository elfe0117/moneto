<?php
if (!defined('_GNUBOARD_')) exit;

// 파라메터 언어 구하기
function get_language_parameter() {
    return isset($_REQUEST['lang']) && !is_array($_REQUEST['lang']) && $_REQUEST['lang'] ? preg_replace('/[^a-z0-9-]/i', '', trim($_REQUEST['lang'])) : '';
}

// HTTP_ACCEPT_LANGUAGE 대표 언어 구하기
function get_language_http_accept() {
    $default_language = '';
    $default_weight = 0;
    $array_language = array();

    $http_accept_language = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    foreach($http_accept_language as $row) {
        list($lang, $tmp) = explode(';', $row);
        $weight = (float)($tmp ? substr($tmp, 2) : 1.0);

        array_push($array_language, array('language' => $lang, 'weight' => $weight));
    
        if ($weight > $default_weight) {
            $default_language = $lang;
            $default_weight = $weight;
        }
    }

    return array('default_language' => $default_language
        , 'default_weight' => $default_weight
        , 'http_accept_language' => $array_language);
}

// 세션 언어 구하기
function get_language_session() {
    $lang = (isset($_SESSION['ss_lang']) && $_SESSION['ss_lang']) ? $_SESSION['ss_lang'] : '';
    if (!$lang) {
        $lang_http_accept = get_language_http_accept();
        if (!($lang = is_language_available($lang_http_accept['default_language']))) {
            foreach($lang_http_accept['http_accept_language'] as $row) {
                if (is_language_available($row['language'])) {
                    $lang = $row['language'];
                    break;
                }
            }
        }
    }

    return $lang;
}

// 사용 가능 언어 구하기
function get_language_available() {
    return array(
        'ko-KR',
        'en-KR'
    );
}

// 언어 사용가능 여부
function is_language_available($lang) {
    return in_array($lang, get_language_available()) ? $lang : '';
}

// 언어 구하기
function get_language() {
    $lang = get_language_parameter();
    $lang = $lang ? $lang : get_language_session();
    
    return $lang ? $lang : G5_DEFAULT_LANGUAGE;
}