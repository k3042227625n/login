<?php

/**
 * XSS対策：エスケープ処理
 * クロスサイトスクリプティング
 * ログイン中、あるリンクをクリックしたらアカウントを乗っ取られてしまう、不正なスクリプトでCookieが盗まれた
 * @param string $str 対象の文字列
 * @return string $str 処理された文字列
 */
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * CSRF対策
 * ログイン中、あるツィートのリンクをクリックしたら、意図しないスパムツィートが送信される、スパムツィートを生成するリンクだった。
 * @param void(引数がないということ)
 * @return string $csrf_token
 */
function setToken() {
    // トークンを生成
    // フォームからトークンを送信
    // 送信後の画面でそのトークンを照会
    // トークンを削除
    session_start();
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;

    return $csrf_token;
}