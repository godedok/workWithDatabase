<?php
/**
 * Choose record, waiting for data entry and
 * if they are correct we add changes to the database 
 */

require "musician.php";
require "../common.php";

if (isset($_POST['submit'])) {
  try {
    $newMusician = new Musician;
    $newMusician->updateGenre($_GET['id'], $_POST['Name']);
  } catch(PDOException $error) {
      
  }
}
  
if (isset($_GET['id'])) {
  $newMusician = new Musician;
  $user = $newMusician->selectGenre($_GET['id']);
} 
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && !isset($error)) { ?>
	<blockquote><?php echo escape($_POST['Name']); ?> successfully updated.</blockquote>
<?php } elseif(isset($error)) { 
  $newMusician = new Musician($_POST);
  echo $newMusician->outputError();
} ?>

<h2>Edit a genre</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : 
      if ($key == "id") {
        continue;
      }?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>">
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>