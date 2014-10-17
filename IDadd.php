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
if((isset($_GET['id'])) && (isset($_GET['pass']))){
	//idのパラメータを格納
	$id = $_GET['id'];
	//passのパラメータを格納
	$pass = $_GET['pass'];
	//入力したidがテーブルの中にあるか確認するクエリを発行
	$result = mysql_query('select * from account where id = \''.$id.'\'');
	//クエリーが行えたかどうか
	if($result){
		//クエリーの結果の行を1つを取り出す
		$row = mysql_fetch_assoc($result);
		//行がないかどうか
		if(!$row){
		//新規idを追加するクエリを発行
		 $addresult = mysql_query('insert into account values( \''.$id.'\',\''.$pass.'\')');
		//クエリが行えたどうか
		 if($addresult){
		   $array = array('result'=>'1');
                   echo json_encode($array);
		 }
		 else{
		  echo 'クエリ失敗';
		 }
		}
		else{
		 $array = array('result'=>'0');
		 echo json_encode($array);
		}
	}
	else{
		echo 'クエリ失敗';
	}
}
else{
	echo 'パラメータなし';
}
//データベースとの接続を切る
mysql_close($link);
?>