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
        $events_data = dbTableResult("SELECT * FROM events"); 
        $user_data = dbTableResult("SELECT * FROM users WHERE user_id = '$events_data[3]'");
        // print_r($events_data);
        // print_r($user_data);
        $result = array_merge($events_data, $user_data);
        unset($result["3"]);
        unset($result["5"]);
        print_r($result);
        foreach($result as $el) {
            print_r("<td>".$el."</td>");
            
        }
        ?>
    </tbody>
</table>