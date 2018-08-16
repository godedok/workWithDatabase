<?php



require "../config.php";
require "../common.php";

if (isset($_GET["Id"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_GET["Id"];

    $sql = "DELETE FROM Cubans WHERE Id = :Id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':Id', $id);
    $statement->execute();

    $success = "User successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Cubans";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>Delete musicians</h2>

<?php if ($success) echo $success; ?>

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
      <td><a href="delete.php?Id=<?php echo escape($row["Id"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>