<?php
session_start();
// var_dump($_SESSION);
$err = $_SESSION;

// 空の配列を入れてセッションを消す
$_SESSION = array();
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン画面</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>ログインフォーム</h2>
  <?php if (isset($err['msg'])) : ?>
    <p><?php echo $err['msg']; ?></p>
  <?php endif; ?>
  <!-- emailと一致するユーザ検索へ-->
  <form action="login.php" method="POST">
  <p>
    <label for="email">メールアドレス：</label>
    <input type="email" name="email">
    <?php if (isset($err['email'])) : ?>
        <p><?php echo $err['email']; ?></p>
    <?php endif; ?>
  </p>
  <p>
    <label for="password">パスワード：</label>
    <input type="password" name="password">
    <?php if (isset($err['password'])) : ?>
        <p><?php echo $err['password']; ?></p>
    <?php endif; ?>
  </p>
  <p>
    <input type="submit" value="ログイン">
  </p>
  </form>
  <a href="signup_form.php">新規登録はこちら</a>
  <div class="login_sec">
    <p>ログイン機能作成の流れ</p>
    <ul>
      <li>1. emailとpasswordを受け取る</li>
      <li>2. emailと一致するユーザ検索</li>
      <li>3. passwordが一致するか検証</li>
      <li>4. ユーザ情報をセッションに格納→ログイン</li>
    </ul>
  </div>

  <div class="login_pass">
    <p>パスワード照会の方法</p>
    <ul>
      <li>ユーザ入力とDBの値を照会...password_verify(パス、ハッシュ)</li>
      <li>パスワードがハッシュにマッチするか？</li>
      <li>マッチしたらTrue,しなかったらFalseを返す</li>
    </ul>
  </div>
</body>
</html>