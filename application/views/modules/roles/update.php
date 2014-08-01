<form method="POST">
    <fieldset>
        <legend>Edit user</legend>

        <p>
            <label for="name">Name</label><input type="text" name="name" value="<?php echo $role_data[0]->name ?>">
        </p>

        </fiedlset>


        <h2>Add role action</h2>
        <table border="1" style="width:100%;">
            <tr>
                <td>Controller</td>
                <td>Actions</td>
            </tr>
            <?php foreach ($clist as $key => $value): ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td>
                        <?php foreach ($value as $v): ?> 
                            <table>
                                <tr>
                                    <?php 
                                     $flag=false;
                                     foreach($role_actions as $_v):
                                         if($_v->actions== $key . "/" . $v) $flag=true;
                                     endforeach;
                                    ?>
                                    <td><input type="checkbox" name='permission[]' <?php if ($flag){ ?> checked="true" <?php } ?> value='<?php echo $key . "/" . $v; ?>' /></td>	  
                                    <td><?php echo $v; ?></td>   
                                </tr>
                            </table>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <input type="submit" name="sent" value="Accept"/>

</form>

