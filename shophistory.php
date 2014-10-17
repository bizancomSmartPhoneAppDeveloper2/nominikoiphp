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
//getパラメータがあるかどうか
if(isset($_GET['id'])){
	//idのパラメータを格納
	$id = $_GET['id'];
	//入力したidと一致する履歴のデータを取得するクエリ発行
	$result = mysql_query('select * from history where id = \''.$id.'\' order by date');
	if (!$result) {
    	die('クエリーが失敗しました。'.mysql_error());
	}
	else{
		//配列の初期化
	   	$array = array();
		//クエリに対する結果の行があるまで処理を実行
	   	while($row = mysql_fetch_assoc($result)){
			//配列に行のデータを追加
			 $array[] = $row;
	   	}
		//配列をJSONで記述
	   	echo json_encode($array);
	}
}
//データベースとの接続を切断
mysql_close($link);
?>