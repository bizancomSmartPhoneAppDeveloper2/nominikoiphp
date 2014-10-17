<?php
//データベースのユーザー名
$user ='u551671545_nomi';
//データベースのパスワード
$password ='bizan07';
//データベースと接続する変数を生成
$link = mysql_connect('mysql.miraiserver.com',$user,$password);
//接続が失敗していないかどうか
if(!$link){
echo '接続失敗';
}
//利用したいデータベース選択
$db_selected = mysql_select_db('u551671545_nomi', $link);
//データベースを選択することができたか
if (!$db_selected){
    die('database'.mysql_error());
}
//mysqlで使う文字コードをutf8に設定
mysql_set_charset('utf8');
//getパラメータがあるかどうか
if(isset($_GET['id'])){
	//idのパラメータを格納
	$id = $_GET['id'];
	//入力したidと一致する二度と行きたくない店のIDをすべて表示するクエリを発行
	$result = mysql_query('select shopid from ngshop where id = \''.$id.'\'');
	//クエリが行えたかどうか
	if($result){
		//配列の初期化
		$array = array();
		//クエリの結果に対する行がなくなるまで処理を実行
		while($row = mysql_fetch_assoc($result)){
		//フィールドshopidの値を配列に追加
		  $array[] = $row['shopid'];
		}
		//配列をjson形式で出力
		echo json_encode($array);
	}
	else{
	  die('query error'.mysql_error());
	}
}
//データベースとの接続を切断
mysql_close($link);
?>