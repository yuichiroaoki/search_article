<?php

$date = date('Y-m-d'); //日付取得
$data = [];
$article = [];
$html = file_get_contents("https://www.newsweekjapan.jp/story/rss.xml");

require_once(dirname(__FILE__) . '/../include/conf/const.php'); //設定ファイル読み込み
require_once(dirname(__FILE__) . '/../include/model/model.php'); //関数ファイル読み込み
require_once(dirname(__FILE__) . '/../include/phpQuery-onefile.php'); //スクレイピングファイル読み込み

//記事データ取得
$i = 0;
while(phpQuery::newDocument($html)->find("item:eq($i)")->find("title")->text() !== '') {
    $data[] = [
        'title' => phpQuery::newDocument($html)->find("item:eq($i)")->find("title")->text(), //タイトル
        'description' => phpQuery::newDocument($html)->find("item:eq($i)")->find("description")->text(), //記事内容
        'url' => phpQuery::newDocument($html)->find("item:eq($i)")->find("link")->text() //URL
    ];
    $i++;   
}
$link = get_db_connect(); //データベース接続
if($link) {
    mysqli_set_charset($link, DB_CHARACTER_SET);
    print 'データベース接続完了';
    //データベースにデータ挿入
    for($j = 0; $j < count($data); $j++) {
        $query = "INSERT INTO news(date,title,description,link) VALUES ('" . $date . "', '" . $data[$j]['title'] . "', '" 
                . $data[$j]['description'] . "', '" . $data[$j]['url'] . "');";
        mysqli_query($link, $query);
    }
    // 接続を閉じます
    mysqli_close($link);
} else {
    print 'データベース接続失敗';
}






