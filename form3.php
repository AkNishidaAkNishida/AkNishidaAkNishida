<?php
session_start();
//form2.phpからPOSTメソッドで送られたワンタムチケットの値と、セッションに保存されているワンタイムチケットの値を比較
if(isset($_POST['token'], $_SESSION['token']) && ($_POST['token'] === $_SESSION['token'])){
    unset($_SESSION['token']);
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $subject = $_SESSION['subject'];
    $body = $_SESSION['body'];
    
    $dsn ='mysql:dbname=contact_form;host=localhost;charset=utf8'; 
    $user = 'root'; 
    $password = '';
    $dbh = new PDO($dsn, $user, $password);//new PODでクラスをインスタンス化
    $dbh->query('SET NAMES utf8');// ->は、メソッドの呼び出し
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = 'INSERT INTO inquiries (name, email, subject, body) VALUES (?, ?, ?, ?)';
    //VALUES(?, ?, ?, ?)の?はプレースホルダ。SQLインジェクションを防ぐ。
    $stmt = $dbh->prepare($sql);
    //PDOSオブジェクトのprepareメソッド
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    //PDOStatementオブジェクトのbindValueメソッドを呼び出し、変数の値とプレースホルダを結び付けている
    $stmt->bindValue(2, $email, PDO::PARAM_STR);
    $stmt->bindValue(3, $subject, PDO::PARAM_STR);
    $stmt->bindValue(4, $body, PDO::PARAM_STR);
    
    $stmt->execute();
    //PDOStatementオブジェクトのexcuteメソッドを呼び出し、準備したSQLが実行される
    
    $dbh = null;//データベースと切断
        
}else{//直接、form3.phpにアクセスがあった場合は、form1.phpに切り替える
    header('Location: http://localhost/php_form/form1.php');
    exit();
}
?>

<?doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <title>確認画面</title>
    <body>
    終了する場合は、ウィンドウを閉じてください。
    </body>
</html>
