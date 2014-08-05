<form method="POST">
    <table id="transaction_table">
        <tr>
            <td>Transaction Type</td>
            <td>
                <select>
                    <option value="0">SALE</option>
                    <option value="1">PURCHASE</option>
                </select>
            </td>
            <td></td>
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
            <td></td>
        </tr>
        <?php echo $items_html; ?>
    </table>
    <table>
        <tr>
            <td><button type="submit" >Submit</button></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</form>
