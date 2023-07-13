<?php

session_start();

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//２．ログイン処理
$user_id = $_POST["user_id"];
$pass = $_POST["pass"];

//1.  DB接続します
$pdo = db_conn();

//2. データ登録SQL作成
// gs_user_tableに、IDとWPがあるか確認する。
$stmt = $pdo->prepare('SELECT * FROM user WHERE user_id = :user_id AND pass = :pass');
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status === false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();

//if(password_verify($pass, $val['pass'])){ //* PasswordがHash化の場合はこっちのIFを使う

if( $val['id'] != ''){
    //Login成功時 該当レコードがあればSESSIONに値を代入
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['kanri_flg'] = $val['kanri_flg'];
    $_SESSION['name'] = $val['name'];
    $_SESSION['id'] = $val['id'];
    header('Location: index.php');
}else{
    //Login失敗時(Logout経由)
    // ログインに失敗した場合は、ログイン画面に戻り、エラーメッセージを表示する。
    $error = "ユーザーIDあるいはパスワードに誤りがあります。";
    $_SESSION["error"] = $error;;
    header('Location: login.php');
    
}

exit();

