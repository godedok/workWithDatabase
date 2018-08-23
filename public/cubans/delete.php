<h2>Confirm deletion</h2>
<form method="post">
    <input type="submit" name="delete" value="Delete">
    <input type="submit" name="cancel" value="Cancel">
</form>

<?php
/**
 * Take the id and in case of confirmation delete the record
 */
require "../classes/musician.php";

if (isset($_GET["Id"]) && isset($_POST["delete"])) {
    try {
        $newMusician = new Musician($_GET);
        $newMusician->deleteRecord();
        $success = "Musician successfully deleted";
        header ('Location: ../index.php');
    } catch(PDOException $error) {
        echo "Ошибка: " . $error->getMessage();
  }
} elseif (isset($_POST["cancel"])) {
    header ('Location: ../index.php');
}
?>