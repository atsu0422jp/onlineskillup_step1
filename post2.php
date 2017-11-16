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
      //commentがPOSTされているなら
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

      } else {
    ?>
        <p>コメントしてください。</p>
        <form method="POST" action="post.php">
          <input name="comment" />
          <input type="submit" value="送信" />
        </form>
    <?php
      }
    ?>
  </body>
</html>
