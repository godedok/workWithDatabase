<h2>Confirm deletion</h2>
<form method="post">
  <input type="submit" name="delete" value="Delete">
  <input type="submit" name="cancel" value="Cancel">
</form>

<?php
require "musician.php";
/**
 * Take the id and in case of confirmation delete the record
 */

if (isset($_GET["id"]) && isset($_POST["delete"])) {
  try {
    //$newMusician = new Musician($_GET);
    $newMusician = new Musician;
    $newMusician->deleteGenre($_GET["id"]);
    $success = "Genre successfully deleted";
    header ('Location: index.php');
  } catch(PDOException $error) {

  }
} elseif (isset($_POST["cancel"])) {
  header ('Location: index.php');
}
?>