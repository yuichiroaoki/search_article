<?php
//変数の初期化
$start_date = '';
$end_date = '';
$title = '';
$url = '';
$data=[];
$total = [];
$searchflg = false;

require_once(dirname(__FILE__) . '/../include/conf/const.php'); //設定ファイル読み込み
require_once(dirname(__FILE__) . '/../include/model/model.php'); //関数ファイル読み込み
require_once(dirname(__FILE__) . '/../include/phpQuery-onefile.php'); //設定ファイル読み込み
$link = get_db_connect();

if ($link) {
    mysqli_set_charset($link, DB_CHARACTER_SET); //文字化け防止
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        if(isset($_GET['search']) === TRUE) {
            
            $searchflg = TRUE;
        }

        $start_date = get_get_data('start_date'); //それぞれの検索条件取得
        $end_date = get_get_data('end_date');
        $title = get_get_data('title');
        $url = get_get_data('url');

        if($start_date === '' && $end_date === '') { //日付の絞り込みかたによってSQL文を調整
            $query = "SELECT * FROM news WHERE title LIKE '%" . $title . "%' AND link LIKE '%" . $url . "%'";
        } else if($start_date === '') {
            $query = "SELECT * FROM news WHERE title LIKE '%" . $title . "%' AND link LIKE '%" . $url . "%' AND date <= '" . $end_date ."'";
        } else if($end_date === '') {
            $query = "SELECT * FROM news WHERE title LIKE '%" . $title . "%' AND link LIKE '%" . $url . "%' AND date >= '" . $start_date ."'";
        } else {
            $query = "SELECT * FROM news WHERE title LIKE '%" . $title . "%' AND link LIKE '%" . $url . "%' AND date >= '" . $start_date . "' AND date <= '" . 
            $end_date ."'";
        }
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $total[] = $row;
        }
        if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
            $now = 1; // 設定されてない場合は1ページ目にする
        } else {
            $now = $_GET['page_id'];
            $searchflg = TRUE;
        }
        $start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか
        $max_page = ceil(count($total) / MAX); // トータルページ数※ceilは小数点を切り捨てる関数
        $total = array_reverse($total); //新着順に並び替え
        $data = array_slice($total, $start_no, MAX, true); 
        if($max_page == $now) {
            $last_page = count($total);
        } else {
            $last_page = $now * MAX;
        }

        mysqli_free_result($result);
        mysqli_close($link);

    } 
    if(isset($_GET['clear']) === TRUE) { //検索条件のクリアの処理
        $start_date = '';
        $end_date = '';
        $title = '';
        $url = '';
    }

} else {
    print 'データベース接続失敗';
}

//テンプレートを表示する
include_once dirname(__FILE__) . "/../include/view/hello.php";
