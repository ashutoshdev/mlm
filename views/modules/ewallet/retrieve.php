<table>
    <thead>
    <th>ID</th>
    <th>TRACTION ID</th>
    <th>DEBIT</th>
    <th>CREDIT</th>
    <th>NOTE</th>
</thead>
<tbody>
    <?php
    foreach ($result as $value) {
        ?>
        <tr>
            <td><?php echo $value["id"]; ?></td>
            <td><?php echo $value["transaction_id"]; ?></td>
            <td><?php echo $value["debit"] ?></td>
            <td><?php echo $value["credit"] ?></td>
            <td><?php echo $value["note"] ?></td>
        </tr>
        <?php
    }
    ?>
</tbody>
</table>