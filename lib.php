<?php

function connectDB(){
	$dsn  = 'mysql:dbname=GameData;host=127.0.0.1';   //接続先
	$user = 'root';         //MySQLのユーザーID
	$pw   = 'H@chiouji1';   //MySQLのパスワード

	return(
		new PDO($dsn, $user, $pw)
	);
}

class APIBase{
	protected function sendjson($flag, $body=null){
		echo json_encode([
			"head" => [
				"status" => $flag
			]
			, "body"=> $body
		]);
	}
}

class ChatAPI extends APIBase{
	function auth($name, $score){
		$sql = "SELECT name, score FROM user WHERE name=?";

		try{
			$dbh = connectDB();   //接続
			$sth = $dbh->prepare($sql);            //SQL準備
			$sth->execute([$id]);                  //実行
		   $buff = $sth->fetch(PDO::FETCH_ASSOC);

		   if( $buff && $buff["pw"] === $pw){
		   		session_start();
		   		$_SESSION['id']   = $id;
		   		$_SESSION['name'] = $buff['name'];
		   		$flag = true;
		   }
		   else{
		   		$flag = false;
		   }
		}
		catch( PDOException $e ){
			$flag = false;
		}
		$this->sendjson($flag);
	}

	function get($name=null){
		$result = [];
		$value = [];


		if{
			$sql = "SELECT * FROM Score WHERE name=?";
			$value[] = $name;
		}
		$flag = false;
		try{
			$dbh = connectDB();   //接続
			$sth = $dbh->prepare($sql);         //SQL準備
			$sth->execute($value);             //実行

			//取得した内容を表示する
			while(true){
				//ここで1レコード取得
				$buff = $sth->fetch(PDO::FETCH_ASSOC);
				if( $buff === false ){
					break;    //データがもう存在しない場合はループを抜ける
				}

				$result[] = [
					  "name"    => $buff["name"]
					, "score" => $buff["score"]
				];
			}
			$flag = true;
		}
		catch( PDOException $e ){
			$flag = false;
		}
		$this->sendjson($flag, $result);
	}

	function set($message){
		session_start();
		if( !array_key_exists('id', $_SESSION) ){
			$this->sendjson(false);
			return(false);
		}

		$sql = 'INSERT INTO log(name,score) VALUES(?,?)';
		try{
			$dbh = connectDB();                 //接続
			$dbh->beginTransaction();
			$sth = $dbh->prepare($sql);         //SQL準備
			$sth->execute([  						 //実行
					  $_SESSION['name']
					, $message
					, date("score", time())]
			);
			$dbh->commit();
			$flag = true;
		}
		catch( PDOException $e ){
			$dbh->rollBack();
			$flag = false;
		}
		$this->sendjson($flag);
	}

}
