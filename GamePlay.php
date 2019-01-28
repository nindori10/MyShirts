<!DOCTYPE html>
<html>
<head>
	<title>GamePlay</title>
		<style>
		body{
			overflow: hidden;
			margin: 30px 30px 30px 30px;
			border: 3px solid #266666;
			padding: 10px;
			font-size: 18pt;
		}
	</style>
	  <script type="text/javascript">
    var ElapseTime = 0;   //経過時間(秒)
    var PushCount = 0;    //キーを押した回数
    var StartChecker = 0;


    //繰り返し処理の中身
    function gameUpdate() {
      var msg = ElapseTime + "秒経過";
      document.getElementById("PassageArea").innerHTML = msg;
      //試しに5秒でリセット
      if (ElapseTime == 10) {
        StartChecker++;
        gameStop();
      }
      ElapseTime++;   //カウントアップ
    }
    //繰り返し処理の開始
    function gameStart() {
       ElapseTime = 1;   //カウンタのリセット
       PassageID = setInterval('gameUpdate()',1000);   //タイマーをセット(1000ms間隔)
       document.getElementById("startcount").disabled = true;   //開始ボタンの無効化
    }
    //繰り返し処理の中止
    function gameStop() {
       clearInterval( PassageID );   //タイマーのクリア
       document.getElementById("endcount").disabled = false;   //開始ボタンの有効化

       createCookie();
    }

  	document.addEventListener('keyup', (event) => {
  		const keyName = event.key;

  		target = document.getElementById("messageSpace");
  		// if (document.getElementById("startcount").disabled == false) {
  		//   	target.innerHTML = "スタートボタンを押してね＞_＜";
  		//   	return;
  		// }
      if (keyName == ' ' && StartChecker == 0) {
        StartChecker++;
        gameStart();
      }
      else if (keyName == ' ' && StartChecker == 1) {
  		    target.innerHTML = "Spaceキーが押されたよ";
  		    PushCount++;
  		    var msg = PushCount + "回押されたよ";
  		    document.getElementById("pushCount").innerHTML = msg;
  		}
  		else {
  		    arget.innerHTML = "押すキーを間違ってるよ＞_＜";
  		}
  	}, false);

    //クッキーを保存する
    function createCookie(){
      //cookieの保持期限を設定
      //nullの場合には、セッション終了まで有効。
      var days = null;
      if(days){
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires=" +date.toGMTString();
      }else{
        var expires = PushCount;
      };
      //cookieを書きこむ
      document.cookie = "hensu"+"="+expires+"; path=/";
    };

  </script>
</head>
<body>
  <p>
    <div> スペースキーを押してスタート</div>
    <!-- ボタン表示 -->
    <!-- <input type="button" value="ゲームスタート" id="startcount" onclick="gameStart();"> -->
  </p>
  <p id="PassageArea">(ここに経過時間を表示)</p>
  <br>
  <!-- キー入力表示 -->
  <div id="message"></div>
  <div id="messageSpace"></div>
  <div id="pushCount">(ここに押した回数を表示)</div>
  <br>
  <form action="Result.php" method="GET">
    <input type="text" name="name" value="name"></input>
    <input type="submit" value="リザルトへ" id="endcount" disabled=true onclick="gameStop();">
  </form>


</body>
</html>
