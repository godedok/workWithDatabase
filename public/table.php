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
            <?php // if($options == "update") { ?>
                <th>Edit</th>
            <?php // } elseif ($options == "delete") { ?>
                <th>Delete</th>
                <?php  //} ?>
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
            <?php //if($options == "update") { ?>
                <td><a href="update-single.php?Id=<?php echo escape($row["Id"]); ?>">Edit</a></td>
            <?php //} elseif ($options == "delete") { ?>
                <td><a href="delete.php?Id=<?php echo escape($row["Id"]); ?>">Delete</a></td>
                <?php //} ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php } ?>