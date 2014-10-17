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
    die('データベース選択失敗です。'.mysql_error());
}
//mysqlで使う文字コードをutf8に設定
mysql_set_charset('utf8');
//2つのgetパラメータがあるかどうか
if(isset($_GET['id']) && isset($_GET['pass'])){
	//idのパラメータを格納
	$id = $_GET['id'];
	//passのパラメータを格納
	$pass = $_GET['pass'];
	//入力したidとpassが一致する行がテーブルの中にあるか確認するクエリを発行
	$result = mysql_query('select * from account where id = \''.$id.'\'and pass = \''.$pass.'\'');
	//クエリーが行えたかどうか
	if (!$result) {
    	die('クエリーが失敗しました。'.mysql_error());
	}else{
		//クエリーの結果の行を1つを取り出す
		$row = mysql_fetch_assoc($result);
		//行があるかどうか
		if($row){
			$array = array('result'=>'1');
			echo json_encode($array);
		}
		else{
		print("認証失敗");
		}
	}
}else{
print("パラメータなし");
}
//データベースとの接続を切る
mysql_close($link);
?>