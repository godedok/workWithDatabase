<?php 
function createTable($result, $options = 0) 
{ ?>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>YearOfBirth</th>
            <th>Genre</th>
            <th>IsInGroup</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["Id"]); ?></td>
            <td><?php echo escape($row["FirstName"]); ?></td>
            <td><?php echo escape($row["LastName"]); ?></td>
            <td><?php echo escape($row["Gender"]); ?></td>
            <td><?php echo escape($row["YearOfBirth"]); ?></td>
            <td><?php echo escape($row["Genre"]); ?></td>
            <td><?php echo escape($row["IsInGroup"]); ?> </td>
            <td><a href="update-single.php?Id=<?php echo escape($row["Id"]); ?>">Edit</a></td>
            <td><a href="delete.php?Id=<?php echo escape($row["Id"]); ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php } ?>