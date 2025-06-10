<?php 
// setcookie("user_login", "");
$host = 'localhost';
$db = 'platform';
$user = 'root';
$pass = '';
$link = mysqli_connect($host, $user, $pass, $db) or die('Невозможно связаться с БД! '.mysqli_error($link));

function dbTableResult($query) {
    global $link;
    $result = mysqli_query($link, $query);
    while($tbl = mysqli_fetch_array($result)) {
        return $tbl["username"];
    }
}
   
ob_start();
if(!empty($_GET)) {
    $username = $_GET["username"];
    $password_first = $_GET["password_first"];
    $a = dbTableResult("SELECT * FROM users WHERE username = '$username' AND password = '$password_first'");
    if($a == $username) {
        print_r("Данные совпали!");
        if(!isset($_COOKIE["user_login"])) {
            $expire = time() + (86400 * 30);
            setcookie("user_login", $a, time() + 3600);
        }
        
    } else {
        print_r("ЧТО_ТО ПОШЛО НЕ ТАК");
    }
}  
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php include 'header.php'; ?>
        <article>
        <?php 
        print_r($_COOKIE["user_login"]);
        if(isset($_COOKIE["user_login"])) {
            if($_COOKIE["user_login"] == "admin") {
                include 'admin.php';
            } elseif($_COOKIE["user_login"] == "admin1") {
                include 'user.php';
            } else {
                include 'user.php';
            }
            
        } else {
            include 'form_login.php'; 
           
            
        } 
         ?>
        </article>
        <?php include 'footer.php'; ?>
    </div>
    
</body>
</html>