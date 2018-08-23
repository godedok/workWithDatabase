<?php 
/**
 * Create table with database and escape data
 */
function createTable($result) 
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
            <td><?php echo escape($row["Name"]); ?></td>
            <td><?php echo escape($row["IsInGroup"]); ?> </td>
            <td><a href="cubans/update-single.php?Id=<?php echo escape($row["Id"]); ?>">Edit</a></td>
            <td><a href="cubans/delete.php?Id=<?php echo escape($row["Id"]); ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php } ?>