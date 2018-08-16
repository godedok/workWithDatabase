<?php

require "../config.php";
require "../common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "Id"          => $_POST['Id'],
      "FirstName"   => $_POST['FirstName'],
      "LastName"    => $_POST['LastName'],
      "Gender"      => $_POST['Gender'],
      "YearOfBirth" => $_POST['YearOfBirth'],
      "Genre"       => $_POST['Genre'],
      "IsInGroup"   => $_POST['IsInGroup']
    ];

    $sql = "UPDATE Cubans 
            SET Id = :Id, 
              FirstName = :FirstName, 
              LastName = :LastName, 
              Gender = :Gender, 
              YearOfBirth = :YearOfBirth, 
              Genre = :Genre, 
              IsInGroup = :IsInGroup 
            WHERE Id = :Id";
  
  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      $error = $error->getMessage();
  }
}
  
if (isset($_GET['Id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['Id'];
    $sql = "SELECT * FROM Cubans WHERE Id = :Id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':Id', $id);
    $statement->execute();
    
    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $err) {
      $err = $err->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement && !isset($error)) { ?>
	<blockquote><?php echo escape($_POST['FirstName']); ?> successfully updated.</blockquote>
<?php } elseif(isset($error)) {
    echo "Ошибочка вышла, запись не добавлена.";
} ?>

<h2>Edit a musician</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'Id' ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>