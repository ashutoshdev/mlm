<form method="POST">
    <table>
        <tr>
            <td>Id</td>
            <td>User Name</td>
            <td>Debit</td>
            <td>Credit</td>    
            <td>Note</td>
            <td>Accept</td>
        </tr>
        <?php
        foreach ($result as $value) {
            ?>

            <tr>
                <td><?php echo $value["id"] ?></td>
                <td><?php echo $value["user_name"] ?></td>
                <td><?php echo $value["debit"] ?></td>
                <td><?php echo $value["credit"] ?></td>
                <td><?php echo $value["note"] ?></td>
                <td><input type="checkbox" value="<?php echo $value["id"] ?>" name="accept[]" <?php if ($value["status"]) { ?> checked="true" <?php } ?>  /></td>
            </tr>

            <?php
        }
        ?>
        <tr>
            <td>
                <button type="submit">Save</button>
            </td>
        </tr>
    </table>
</form>