<?php

// DB接続関数（PDO）
function db_conn(){
    try {
        $pdo = new PDO('mysql:dbname=php_kadai02;charset=utf8;host=localhost','root','');
        return $pdo;
    } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
    }
}

// SQLエラー関数
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

// リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

// ログインチェック＆管理者確認処理 loginCheck()
function loginCheck(){
    if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
        exit("LOGIN ERROR");
    }else{
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();

        if($_SESSION["kanri_flg"]!=1){
            exit("LOGIN ERROR");
        }else{
            return $_SESSION["name"];
        }
        
    }
}

