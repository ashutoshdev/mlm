<head></head>
<body>

    <a href="/modules/roles/create">Add new role</a>&nbsp;
    <a href="/admin/profile">Home</a>

    <table>
        <caption>Roles</caption>
        <thead>
        <th scope="col">name</th>
        <th scope="col">&nbsp;</th>
    </thead>

    <tbody>

        <?php foreach ($roles_list as $item): ?>
            <tr>
                <td><?php echo $item->name ?></td>
                <td>
                    <a href="/modules/roles/update/<?php echo $item->id ?>">Edit</a>&nbsp;
                    <a href="/modules/roles/delete/<?php echo $item->id ?>">Delete</a>&nbsp;
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>

</body>