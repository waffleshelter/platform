<?php 
// $result = 
?>
<?php print_r($result); ?>
<table>
    <h1>Панель администратора</h1>
    <thead>
        <tr>
            <th>Событие</th>
            <th>Дата</th>
            <th>Участники</th>
            <th>Организатор</th>
            <th>Номер телефона</th>
        </tr>
    </thead>
    <tbody>
        <?php 
// Вывод в панель администратора
        dbTableResult("SELECT 
        e.event_name,
        e.event_date,
        e.participants_count,
        u.username,
        u.phone_number
    FROM 
        events e
    JOIN 
        users u ON e.organizer_id = u.user_id");
        ?>
    </tbody>
</table>