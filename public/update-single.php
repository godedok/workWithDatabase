<?php
/**
 * Choose record, waiting for data entry and
 * if they are correct we add changes to the database 
 */

require "musician.php";
require "../common.php";

if (isset($_POST['submit'])) {
  try {
    $newMusician = new Musician(array_merge($_GET, $_POST));
    $newMusician->updateRecord();
  } catch(PDOException $error) {
      
  }
}
  
if (isset($_GET['Id'])) {
  $newMusician = new Musician($_GET);
  $user = $newMusician->selectRecord();
} 
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && !isset($error)) { ?>
	<blockquote><?php echo escape($_POST['FirstName']); ?> successfully updated.</blockquote>
<?php } elseif(isset($error)) { 
  $newMusician = new Musician($_POST);
  echo $newMusician->outputError();
} ?>

<h2>Edit a musician</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : 
      if ($key == "Id") {
        continue;
      }?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>">
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>