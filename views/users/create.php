<form method="POST">
    <table>
        <tr>
            <td>Introducer</td>
            <td>
                <select name="introducer">
                    <?php foreach($html as $v){ ?>
                    <option value="<?php echo $v["user_id"] ?>"><?php echo $v["user_name"] ?></option>
                   <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>User Name</td>
            <td><input type="text" name="username" /></td>
        </tr>
        <tr>
            <td>User Email</td>
            <td><input type="text" name="useremail" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"</td>
        </tr>
        <tr>
            <td><button type="submit">submit</button></td>
            <td></td>
        </tr>
    </table>
</form>