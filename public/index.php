<?php
session_start();
if(isset($_SESSION['error'])){
    $error = $_SESSION['error'][0];
  }else{
    $error = "error";
  }

// ログアウトがリクエストされた場合、セッションを破棄
if (isset($_POST['logout'])) {
      // セッションの全変数を解除
      $_SESSION = array();      
  }

if(isset($_SESSION['u_name'])){
  $loginuser = $_SESSION['u_name'][0];
}else{
  $loginuser = "なし";
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>トップ</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="header">
        <p><?php echo $loginuser; ?></p>
        <a href="chat.php">chat</a>
        <?php if(isset($_SESSION['u_name'])){ ?>
            <a class="logout_window">ログアウト</a>
            <?php }else{?>
            <a class="login_window">ログイン</a>
        <?php } ?>
    </nav>

    <div class="modal"></div>
    <div class="login_modal">
    <h2>ログイン</h2>
        <form id="login_form" method="POST" action="logincheck.php">
            <label for="baseid">物流拠点ID</label>
            <input type="text" id="baseid" name="baseid" required>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">ログイン</button>
        </form>
    </div>

    
    <div class="modal"></div>
    <div class="logout_modal">
    <h3>ログアウトします。<br>よろしいですか？</h2>
        <form id="logout_form" method="post">
            <button type="submit" name="logout">はい</button>
            <button type="submit">いいえ</button>
        </form>
    </div>

    <div class="container">
        <a href="loading.php">
            <div class="button">
                積込状況管理
            </div>
        </a>
        <a href="reservation.php">
            <div class="button">
                予約状況管理
            </div>
        </a>
    </div>
    
<!-- ログイン用 -->
<script>
    $(document).on('click', '.login_window', function() {
        // 背景をスクロールできないように & スクロール場所を維持
        scroll_position = $(window).scrollTop();
        $('body').addClass('fixed').css({ 'top': -scroll_position });
        // モーダルウィンドウを開く
        $('.login_modal').fadeIn();
        $('.modal').fadeIn();
    });

    $(document).on('click', '.modal', function() {
        // 背景スクロールを再開し、モーダルを閉じる
        $('body').removeClass('fixed').css({ 'top': '' });
        $(window).scrollTop(scroll_position);
        $('.login_modal').fadeOut();
        $('.modal').fadeOut();
    });
</script>

<!-- ログアウト用 -->
<script>
    $(document).on('click', '.logout_window', function() {
        // 背景をスクロールできないように & スクロール場所を維持
        scroll_position = $(window).scrollTop();
        $('body').addClass('fixed').css({ 'top': -scroll_position });
        // モーダルウィンドウを開く
        $('.logout_modal').fadeIn();
        $('.modal').fadeIn();
    });

    $(document).on('click', '.modal', function() {
        // 背景スクロールを再開し、モーダルを閉じる
        $('body').removeClass('fixed').css({ 'top': '' });
        $(window).scrollTop(scroll_position);
        $('.logout_modal').fadeOut();
        $('.modal').fadeOut();
    });
</script>
</body>
</html>
