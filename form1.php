<?php
//echo "<pre>";
//var_dump($_POST);
//echo"</pre>";

//こちらの本を参考にしました↓
//DESIGNMAP. PHP入門 確認画面付きのお問い合わせフォームをつくりながらPHPを学ぶ（第2版） (DESIGNMAP BOOKS) DESIGNMAP. 
session_start();

$errors = array();//errorはここにしまう

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    
    $name = htmlspecialchars($name, ENT_QUOTES);//ENT_QUOTES必須
    $email = htmlspecialchars($email, ENT_QUOTES);//ENT_QUOTES必須
    $subject = htmlspecialchars($subject, ENT_QUOTES);//ENT_QUOTES必須
    $body = htmlspecialchars($body, ENT_QUOTES);//ENT_QUOTES必須
        
    if($name === ""){
        $errors['name'] = "お名前が空欄です。";
    }
    if($email === ""){
        $errors['email'] = "メールアドレスが空欄です。";
    }
    if($body === ""){
        $errors['body'] = "コメントが空欄です。";
    }
    if(count($errors) === 0){
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['subject'] = $subject;
        $_SESSION['body'] = $body;
        
        header('Location:http://localhost/php_form/form2.php');
        exit();
        
    }
    
}

if(isset($_GET['action']) && $_GET['action'] === 'edit'){
    $name = $_SESSION['name']; 
    $email = $_SESSION['email']; 
    $subject = $_SESSION['subject']; 
    $body = $_SESSION['body']; 
}


?>
<!doctype html> 
<html> 
    <head> 
        <meta charset="utf-8"> 
        <title>ようこそ</title> </head> 
    <body> 
        <?php
        echo "<ul>";
        foreach($errors as $value) {
            echo"<li>";
            echo $value;
            echo"</li>";           
        }
        echo"</ul>";
        ?>
        
        <form action="form1.php" method="post"> 
            <table> 
                <tr>  
                    <th>お名前</th>
                    <td><input type="text" name="name" value="<?php if(isset($name)){echo $name;} ?>"></td> </tr> 
                <tr>  
                    <th>メールアドレス</th>
                    <td><input type="text" name="email" value="<?php if(isset($email)){echo $email;} ?>"></td> </tr> 
                <tr>  
                    <th>セレクトボックスによる選択</th>
                    <td>  <select name="subject">  
                        <option value="セレクト１">セレクト１</option>  
                        <option value="セレクト２">セレクト２</option>  </select>
                    </td> 
                </tr> 
                <tr>  
                    <th>コメントをどうぞ</th>  
                    <td>
                        <textarea name="body" cols="40" rows="10"><?php if(isset($body)){echo $body;} ?></textarea>
                    </td> 
                </tr> 
                <tr>  
                    <td colspan="2">
                        <input type="submit" name="submit" value="確認画面へ">
                    </td> 
                </tr> 
            </table> 
        </form> 
    </body> 
</html>
