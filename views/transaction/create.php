<form method="POST">
    <table>
        <tr>
            <td>Transaction Type</td>
            <td>
                <select>
                    <option value="0">SALE</option>
                    <option value="1">PURCHASE</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Users</td>
            <td>
                <select name="users">
                    <?php foreach ($html as $v) { ?>
                        <option value="<?php echo $v["user_id"] ?>"><?php echo $v["user_name"] ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Items</td>
            <td>
                <select name="items">
                    <?php foreach ($items_html as $value) { ?>
                      <option value="<?php echo $value["item_id"] ?>"><?php echo $value["item_name"] ?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td><button type="submit" >Submit</button></td>
            <td></td>
        </tr>
    </table>
</form>