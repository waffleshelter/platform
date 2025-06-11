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
        </tr>
    </thead>
    <tbody>
        <?php dbTableResult("SELECT * FROM events"); ?>
    </tbody>
</table>