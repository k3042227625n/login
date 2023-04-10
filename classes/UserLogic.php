<?php
// ①ログインロジック作成
// ②emailからユーザ取得ロジック作成
// ③パスワード照会・セッションハイジャック対策
// ④エラー分岐

require_once '../dbconnect.php';

class UserLogic
{
    /**
    * ユーザを登録する
    * @param array  $userData
    * @return bool $result
    */
    public static function createUser($userData)
    {
        $result = false;

        $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

        // ユーザデータを配列に入れる
        $arr = [];
        $arr[] = $userData['username'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);

        try {
            $stmt = connect()->prepare($sql);
            $result = $stmt->execute($arr);
            return $result;       
        } catch(\Exception $e) {
            return $result;
        }

    }

    /**
    * ログイン処理
    * @param string  $email
    * @param string  $password
    * @return bool $result
    */
    public static function login($email, $password)
    {
        // 結果
        $result = false;
        // ユーザをemailから検索して取得
        $user = self::getUserByEmail($email);

        if (!$user) {
            $_SESSION['msg'] = 'emailが一致しません。';
            return $result;
        }

        // パスワードの照会
        if (password_verify($password, $user['password'])) {
           
            /**
            * セッションハイジャック対策
            * セッションIDを盗まれて、なりすましをされること
            * 対策としてセッションIDを再作成する
            */
            session_regenerate_id(true);
            // ログイン成功
            $_SESSION['login_user'] = $user;
            $result = ture;
            return $result;
        }

        $_SESSION['msg'] = 'パスワードが一致しません。';
        return $result;
    }

    /**
    * emailからユーザを取得
    * @param string  $email
    * @return array|bool $user|false
    */
    public static function getUserByEmail($email)
    {
        // SQLの準備
        // SQLの実行
        // SQLの結果を返す
        $sql = 'SELECT * FROM users WHERE email = ?';

        // emailを配列に入れる
        $arr = [];
        $arr[] = $email;
        
        try {
            $stmt = connect()->prepare($sql);
            $stmt->execute($arr);
            // SQLの結果を返す
            $user = $stmt->fetch();
            return $user;       
        } catch(\Exception $e) {
            return false;
        }

        
        $result = false;
        // ユーザをemailから検索して取得
        $user = self::getUserByEmail($email);
    }
}
