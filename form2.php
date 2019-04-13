<?php

session_start();
if(isset($_SESSION['name'])){
    
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $subject = $_SESSION['subject'];
    $body = $_SESSION['body'];
}
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(48));
$token = htmlspecialchars($_SESSION['token'], ENT_QUOTES);
//$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(48));
//$token = htmlspecialchars($_SESSION['token'], ENT_QUOTES);

?>
<!doctype html>
<html>
<head>
<meta charset ="utf-8"> 
    <title>入力内容をご確認ください</title>
    </head> 
    <body> <form action="form3.php" method="post">
        <input type ="hidden" name="token" value="<?php echo $token?>">
     
        <table> 
                <tr> 
                    <th>お名前</th><td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <th>メールアドレス</th><td><?php echo $email; ?></td>
                </tr> 
                <tr>
                    <th>選択したセレクトボックスの内容</th><td><?php echo $subject; ?></td>
                </tr>
                <tr>
                    <th>コメント</th><td><?php echo nl2br($body); ?></td>
                </tr>
                <tr>
                    <td colspan ="2"><input type ="submit" name ="submit" value ="送信する"></td> 
                </tr> 
            
            </table> 
        </form> 
        <p><a href ="form1.php?action=edit"> 入力画面へ戻る </a></p>
    
    </body>
</html>
