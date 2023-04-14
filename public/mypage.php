<?php
session_start();
require_once '../classes/UserLogic.php';
require_once '../functions.php';

// ログインしているか判定し、していなかったら新規登録画面へ返す
$result = UserLogic::checkLogin();

if (!$result) {
  $_SESSION['login_err'] = 'ユーザを登録してログインしてください！';
  header('Location: signup_form.php');
  return;
}

$login_user = $_SESSION['login_user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>マイページ</h2>
  <p>ログインユーザ：<?php echo h($login_user['name']) ?></p>
  <p>メールアドレス:<?php echo h($login_user['email']) ?></p>

  <p>ユーザ登録が完了しました。</p>
<a href="./signup_form.php">戻る</a>

<h3>#07 ログイン後の画面を作ってログインチェックしよう</h3>

<div class="login_check">
    <p>ログイン後の流れ</p>
    <ul>
      <li>1. ログインユーザを表示する画面へ</li>
      <li>2. ログインしているかはSessionで判定</li>
      <li>3. ログインしていなかったら新規画面へ</li>
      <li>4. ログインしていたらユーザを表示</li>
    </ul>
</div>

<div>
  <p>ログインチェックのやり方</p>
  <ul>
    <li>$_SESSION['login_user'];(セッションに入れたユーザをチェック)</li>
    <li>セクションの中身がセットされているか、チェックする関数を作る</li>
    <li>作った関数を最初に埋め込む。ログインと新規登録にも入れる</li>
  </ul>
</div>
  
</body>
</html>