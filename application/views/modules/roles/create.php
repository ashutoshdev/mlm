<head></head>
<body>
    <form method="POST">
        <fieldset>
            <legend>Add role</legend>

            <p>
                <label for="name">Name</label><input type="text" name="name" value="">
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
                                        <td><input type="checkbox" name='permission[]' value='<?php echo $key . "/" . $v; ?>' /></td>	  
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
</body>

