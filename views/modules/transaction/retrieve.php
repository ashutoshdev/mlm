<h1>Transation Master</h1>
<table>
    <tr>
        <td>Transaction Id</td>
        <td>Transaction Date</td>
        <td>Debit</td>
        <td>Credit</td>
        <td>Note</td>
    </tr>

    <?php
    foreach ($result["transaction_master"] as $value) {
        ?>
        <tr>
            <td><?php echo $value["transaction_id"] ?></td>
            <td><?php echo $value["transaction_date"] ?></td>
            <td><?php echo $value["debit"] ?></td>
            <td><?php echo $value["credit"] ?></td>
            <td><?php echo $value["note"] ?></td>
        </tr>
        <?php
    }
    ?>    
</table>
<h1>Transation Details</h1>
<table>
    <tr>
        <td>Transation Id</td>
        <td>Item Name</td>
        <td>Item Qnty</td>
        <td>Item Price</td>
        <td>Note</td>
    </tr>
    <?php foreach ($result["transaction_details"] as $value) { ?>
        <tr>
            <td><?php echo $value["transaction_id"] ?></td>
            <td><?php echo $value[""] ?></td>
            <td><?php echo $value["item_quantity"] ?></td>
            <td><?php echo $value["item_price"] ?></td>
            <td><?php echo $value["note"] ?></td>
        </tr>
    <?php } ?>
</table>

