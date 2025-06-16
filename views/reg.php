<?php
$host = 'localhost';
$db = 'event_management';
$user = 'root';
$pass = '';
$link = mysqli_connect($host, $user, $pass, $db) or die('Невозможно связаться с БД! '.mysqli_error($link));

function dbTableResult($query) {
    global $link;
    $result = mysqli_query($link, $query);
    if(is_bool($result) == true) {
        print_r("Успешно");
    } else {
        while($ret = mysqli_fetch_array($result)) {
            return $ret["username"];
        }
    }
   
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php include '../templates/header.php'; ?>
        <article>
            <?php 
            if(empty($_GET)) {
                include '../forms/form_reg.php';
            } else {
                $username = $_GET["username"];
                $password_first = $_GET["password_first"];
                $password_repeat = $_GET["password_repeat"];
                $phone_number = $_GET["phone"];
                if($password_first == $password_repeat) {
                    $a = dbTableResult("SELECT username FROM users WHERE username = '$username'");
                    if($a == $username) {
                        print_r("Такой пользователь уже есть!");
                    } else {
                        dbTableResult("INSERT INTO users (username, password, phone_number) VALUES ('$username', '$password_first', '$phone_number')");
                    }
                }
            }
            ?>
        </article>
        <?php include '../templates/footer.php'; ?>
    </div>
    
</body>
</html>