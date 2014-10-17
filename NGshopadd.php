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
//2つのgetパラメータがあるかどうか
if((isset($_GET['id'])) && (isset($_GET['shopid']))){
	//idのパラメータを格納
	$id = $_GET['id'];
	//shopidのパラメータを格納
	$shopid = $_GET['shopid'];
	//shopidの店を二度と行きたくないリストに登録するためクエリ発行
	$addNG = mysql_query('insert into ngshop values( \''.$id.'\',\''.$shopid.'\')');
	//idの履歴からshopidの店に行った履歴を削除するためのクエリ発行
	$hisdel = mysql_query('delete from history where id = \''.$id.'\' and shopid = \''.$shopid.'\'');
	//2つのクエリが行えたどうか
	if($addNG && $hisdel){
		  $array = array('result'=>'1');
	}
	else{
		$array = array('result'=>'0');
	}
	echo json_encode($array);
}
//データベースとの接続を切断
mysql_close($link);

?>
