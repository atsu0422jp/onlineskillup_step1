<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>POSTのサンプル</title>
  </head>
  <body bgcolor=lightgreen>
    <div bclass="header">
      <div class="header-left">シミアツファンクラブ❤︎</div>
    </div>
    <?php

      //mysqliクラスのオブジェクトを作成
      $mysqli = new mysqli('localhost', 'atsu0422jp', 'aaaa', 'atsu0422jp');
      //エラーが発生したら
      if ($mysqli->connect_error){
      print("接続失敗：" . $mysqli->connect_error);
      exit();
      }

      //commentがPOSTされているなら
      if(isset($_POST["comment"])){
        //エスケープしてから表示
        $comment = htmlspecialchars($_POST["comment"]);
        $message = htmlspecialchars($_POST["message"]);

        $text=htmlspecialchars($message);
        if(get_magic_quotes_gpc()){
          $text=stripslashes($text);
        }
        $message=nl2br($text);
            print("${comment}のコメントは「 ${message} 」です。");

        //プリペアドステートメントを作成　ユーザ入力を使用する箇所は?にしておく
        $stmt = $mysqli->prepare("INSERT INTO datas (name, message) VALUES (?, ?)");
        //$_POST["name"]に名前が、$_POST["message"]に本文が格納されているとする。
        //?の位置に値を割り当てる
        $stmt->bind_param('ss', $_POST["comment"], $_POST["message"]);
        //実行
        $stmt->execute();




      } else {
    ?>
        <p>シミアツへの応援メッセージはこちら　左に名前、右にメッセージ</p>
        <form method="POST" action="post.php">
          <input name="comment" />
          <textarea name="message"></textarea>
          <input type="submit" value="送信" />
        </form>
        <p><? echo $data; ?></p>


    <?php
      }


    ?>

    <?php
//datasテーブルから日付の降順でデータを取得
$result = $mysqli->query("SELECT * FROM datas ORDER BY created DESC");
if($result){
  //1行ずつ取り出し
  while($row = $result->fetch_object()){
    //エスケープして表示
    $name = htmlspecialchars($row->name);
    $message = htmlspecialchars($row->message);
    $created = htmlspecialchars($row->created);

    $text=htmlspecialchars($message);
    if(get_magic_quotes_gpc()){
      $text=stripslashes($text);
    }
    $message=nl2br($text);
    print("$name : $message ($created)<br>");
  }
}
?>


    <?php

          $mysqli->close();
      ?>

  </body>
</html>
