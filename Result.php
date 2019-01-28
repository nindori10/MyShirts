<?php
	setcookie("id", $_POST["id"], time()+(60*60*24*7));

	$name = $_POST["name"];
	$score = $_POST["score"];

?><!DOCTYPE html>
<html>
<head>
	<title>チャット</title>
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
    var PlayerName = "";

    window.onload = function init(){
      // ページ読み込み時に実行したい処理
      var msg = readCookie() + "回押したよ";
      document.getElementById("pushCount").innerHTML = msg;
      readForm();
      PlayerName = PlayerName + " さん";
      document.getElementById("playerName").innerHTML = PlayerName;
    }

    //cookieを読み込む
    function readCookie(){
      //cookieのhensuの値を返す
      var name ="hensu" + "=";
      var ca = document.cookie.split(';');
      for(var i=0;i < ca.length;i++){
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(name ) == 0){
          return c.substring(name.length,c.length);
        };
      };
      return null;
    };

    function readForm() {
      var arr=Array();

      var ss = "";
      var querys=location.search;
      if(querys) {
        var q = querys.replace(/^\?/,'').split('&');
        for(i=0 ; i<q.length ; i++){
          var pair=q[i].split('=');
          // arr[pair[0]]=pair[1];
          ss += pair[1] + "\n";
        }
      }
      PlayerName = ss;
      //alert(ss);
    }


  </script>
</head>
<body>

<h1>Reasult</h1>




<script>
// window.onload = function(){
  // auth();

  // getLog();
  // document.querySelector("#sbmt").addEventListener("click",function(){
  //     var uname = document.querySelector("#name").value;
  //     var msg   = document.querySelector("#score").value;
  //
  //     var request = new XMLHttpRequest();
  //       request.open('POST', 'http://127.0.0.1/TeamWork/set.php', false);
  //       request.onreadystatechange = function(){
	// 	   if (request.status === 200 || request.status === 304 ) {
	// 		  var response = request.responseText;
	// 		  var json     = JSON.parse(response);
  //
	// 	  	  if( json["head"]["status"] === false ){
	// 			alert("失敗しました");
	// 			return(false);
	// 		  }
  //
	// 	     getLog();
	// 	   }
	// 	  else if(request.status >= 500){
	// 		 alert("ServerError");
	// 	  }
	//     };
    //
    //    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //
    //    request.send(
    // 	    "name=" + encodeURIComponent(uname) + "&"
    // 	  + "score="   + encodeURIComponent(msg)
    //     );
    // });
// };

// function auth(){
//   var request = new XMLHttpRequest();
//   request.open('POST', 'http://127.0.0.1/TeamWork/auth.php', false);
//   request.onreadystatechange = function(){
//     if (request.status === 200 || request.status === 304 ) {
//       var response = request.responseText;
//       var json     = JSON.parse(response);
//
//       if( json["head"]["status"] === false ){
//          alert("ログインに失敗しました");
//          location.href = "/TeamWork/Game.php";
//        }
//       else{
//          alert("ログインに成功しました");
//        }
//      }
//    };
//
//   request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//   request.send(
//     	  "name=" + encodeURIComponent("<?php echo $name; ?>") + "&"
//     	+ "score=" + encodeURIComponent("<?php echo $score; ?>")
//   );
// }

// function getLog(){
// 	var request = new XMLHttpRequest();
// 	request.open('GET', 'http://127.0.0.1/TeamWork/get.php', false);
//
// 	request.onreadystatechange = function(){
// 		if (request.status === 200 || request.status === 304 ) {
// 			var response = request.responseText;
// 			var json     = JSON.parse(response);
// 			if( json["head"]["status"] === false ){
// 				alert("失敗しました");
// 				return(false);
// 			}
//
// 			var html="";
// 			for(i=0; i<json["body"].length; i++){
// 				html += json["body"][i]["name"] +":"+ json["body"][i]["message"] + "<br>";
// 			}
// 			document.querySelector("#chatlog").innerHTML = html;
// 		}
// 		else if(request.status >= 500){
// 			alert("ServerError");
// 		}
// 	};
//
// 	request.onerror = function(e){
// 		console.log(e);
// 	};
// 	request.send();
}
</script>

  <br>
  <div id = "playerName">(ここにプレイヤー名を表示)</div>
  <div id = "pushCount">(ここに押した回数を表示)</div>
  <br>

  <form action="Game.php" method="GET">
    <input type="submit" value="もう一度プレイする" id="endcount" onclick="gameStop();">
  </form>

  <br>
  <div>ランキング</div>
</body>
</html>
