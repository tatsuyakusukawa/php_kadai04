<?php   
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- ログイン画面 -->
    <form action="login_act.php" method="post">
        <div>
            <label>
                メールアドレス：
                <input type="text" name="user_id" required>
            </label>
        </div>
        <div>
            <label>
                パスワード：
                <input type="password" name="pass" required>
            </label>
        </div>
        <input type="submit" value="ログイン">
</body>
</html>