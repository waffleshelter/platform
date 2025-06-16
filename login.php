<?php 
// setcookie("user_login", "");
$host = 'localhost';
$db = 'event_management';
$user = 'root';
$pass = '';
$link = mysqli_connect($host, $user, $pass, $db) or die('Невозможно связаться с БД! '.mysqli_error($link));

// Функция для получения аутпута из базы данных
function dbTableResult($query) {
    global $link;
    $result = mysqli_query($link, $query);
    // Проверка на случай INSERT INTO
    if(is_bool($result) == TRUE) {
        return 0;
    } elseif(is_int($result) == TRUE) {
        return $result;
    } else {
        $tbl = mysqli_fetch_array($result);
        if(isset($tbl["username"]) and empty($tbl["event_name"])) {
            return [$tbl["username"], $tbl["user_id"], $tbl["phone_number"]];
        } elseif(isset($tbl["username"]) and isset($tbl["event_name"])) {
            print_r("<tr><td>".$tbl["event_name"]."</td><td>".$tbl["event_date"]."</td><td>".$tbl["participants_count"]."</td><td>".$tbl["username"]."</td><td>".$tbl["phone_number"]."</td></tr>");
            while($tbl = mysqli_fetch_array($result)) {
                print_r("<tr><td>".$tbl["event_name"]."</td><td>".$tbl["event_date"]."</td><td>".$tbl["participants_count"]."</td><td>".$tbl["username"]."</td><td>".$tbl["phone_number"]."</td></tr>");
            }
        } else {
            // return [$tbl['event_name'], $tbl['event_date'], $tbl['participants_count'], $tbl['organizer_id']];
        }
        }
        
}

if($_GET["exit"]) {
    setcookie("user_login", "");
}


ob_start();
if(!empty($_GET)) {
    
    
    if(isset($_GET["username"])) {
        // Приём данных для авторизации
        $username = $_GET["username"];
        $password_first = $_GET["password_first"];
        $a = dbTableResult("SELECT * FROM users WHERE username = '$username' AND password = '$password_first'");
    } elseif(isset($_GET["event_name"])) {
        // Приём данных для создания ивента
        $event_name = $_GET["event_name"];
        $event_date = $_GET["event_date"];
        $username_cookie = $_COOKIE["user_login"];
        $participants_count = $_GET["participants_count"];
        $organizer_id = dbTableResult("SELECT * FROM users WHERE username = '$username_cookie'");
        $b = dbTableResult("INSERT INTO events (event_name, event_date, participants_count, organizer_id) VALUES ('$event_name', '$event_date', '$participants_count', '$organizer_id[1]')");
        if($b == 0) {
            print_r("Данные успешно записаны");
        }
    }
    // Проверка на совпадение введённых данных со значениями из БД и дальнейший вход в систему с началом сессии
    if($a[0] == $username) {
        if(!isset($_COOKIE["user_login"])) {
            setcookie("user_login", $a[0], time() + 3600);
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
        if(isset($_COOKIE["user_login"])) {
            if($_COOKIE["user_login"] == "admin") {
                include 'admin.php';
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