<?php

require "musician.php";
require "../common.php";
if (isset($_POST['submit'])) {
  try {
    $newMusician = new Musician($_POST['Id'], $_POST['FirstName'], $_POST['LastName'],
     $_POST['Gender'], $_POST['YearOfBirth'], $_POST['Genre'], $_POST['IsInGroup']);
    $newMusician->updateRecord();
  } catch(PDOException $error) {
      
  }
}
  
if (isset($_GET['Id'])) {
  $newMusician = new Musician;
  $newMusician->id = $_GET['Id'];
  $user = $newMusician->selectRecord();
} 
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && !isset($error)) { ?>
	<blockquote><?php echo escape($_POST['FirstName']); ?> successfully updated.</blockquote>
<?php } elseif(isset($error)) { ?>
    <blockquote> Data not update. Check the entered data.  </blockquote>
<?php } ?>

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