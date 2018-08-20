<?php

require "table.php";
require "musician.php";
require "../common.php";

if (isset($_GET["Id"])) {
  try {
    $newMusician = new Musician($_GET);
    $newMusician->deleteRecord();
    $success = "Musician successfully deleted";
  } catch(PDOException $error) {

  }
}
$newMusician = new Musician;
$result = $newMusician->readTable();

?>
<?php require "templates/header.php"; ?>
        
<h2>Delete musicians</h2>

<?php if ($success) echo $success; ?>

<?php createTable($result, "delete"); ?>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>