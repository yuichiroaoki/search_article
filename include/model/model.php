<?php

/**
* DBハンドルを取得
* @return obj $link DBハンドル
*/
function get_db_connect() {
 
    // コネクション取得
    if (!$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME)) {
        die('error: ' . mysqli_connect_error());
    }
 
    // 文字コードセット
    mysqli_set_charset($link, DB_CHARACTER_SET);
 
    return $link;
}
function get_post_data($key) {
    $str = '';
    if (isset($_POST[$key]) === TRUE) {
        $str = $_POST[$key];
    }
    return $str;
}
function get_get_data($key) {
    $str = '';
    if (isset($_GET[$key]) === TRUE) {
        $str = $_GET[$key];
    }
    return $str;
}
function entity_str($str) {
    return htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
}
function cookie_check($cookie) {
    if(isset($_COOKIE[$cookie]) === TRUE) {
        return $_COOKIE[$cookie];
    } else {
        return '';
    }
}