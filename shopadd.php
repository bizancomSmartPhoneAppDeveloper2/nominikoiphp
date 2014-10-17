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
//3つのgetパラメータがあるかどうか
if((isset($_GET['id'])) && (isset($_GET['shopid'])) && (isset($_GET['shopname']))){
	//idのパラメータを格納
	$id = $_GET['id'];
	//shopidのパラメータを格納
	$shopid = $_GET['shopid'];
	//shopnameのパラメータを格納
	$shopname = $_GET['shopname'];
	//テーブルhistoryの中から入力したidとshopidがともに一致する行がないかどうか確認するクエリ発行
	$result = mysql_query('select * from history where id = \''.$id.'\' and shopid = \''.$shopid.'\'');
	//クエリが行えたどうか
	if (!$result) {
    	die('query error'.mysql_error());
	}
	else{
		//クエリに対する結果の1行を格納
		$row = mysql_fetch_assoc($result);
		$array = array();
		//行がないかどうか
		if(!$row){
		   //現在の時刻を格納
		   $date = date("Y-m-d H:i:s");
		//履歴を追加するためのクエリを発行
		   $addresult = mysql_query('insert into history values(\''.$id.'\',\''.$shopname.'\',\''.$shopid.'\' ,\''.$date.'\')');
		//クエリが行えたどうか
		   if($addresult){
		    $array = array('result'=>'1');
		    echo json_encode($array);
		   }
		   else{
		   die('query error'.mysql_error());
		  }
		}
		else{
		   $array = array('result'=>'0');
		   echo json_encode($array);
		}
	}
}
//データベースとの接続を切断
mysql_close($link);
?>