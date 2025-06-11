<?php 
// $result = 
?>
<?php print_r($result); ?>
<table>
    <thead>
        <tr>
            <th>Событие</th>
            <th>Дата</th>
            <th>Участники</th>
        </tr>
    </thead>
    <tbody>
        <?php dbTableResult("SELECT * FROM events WHERE id > 0"); ?>
    </tbody>
</table>