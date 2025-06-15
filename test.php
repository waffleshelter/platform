<?php 
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
    } else {
            while($tbl = mysqli_fetch_array($result)) {
                // Проверка на случай авторизации
                if($tbl["username"] != "") {
                    return [$tbl["username"], $tbl["user_id"]];
                }
                // Вывод для таблицы администратора
                print_r("<tr><td>".$tbl['event_name']."</td><td>".$tbl['event_date']."</td><td>".$tbl['participants_count']."</td><td>".$tbl['username']."</td><td>".$tbl['phone_number']."</td></tr>");
            }
        }
        
}
$username_cookie = $_COOKIE["user_login"];
$a = dbTableResult("SELECT * FROM users WHERE username = '$username_cookie'");
print_r($a); ?>