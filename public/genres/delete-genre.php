<h2>Confirm deletion</h2>
<form method="post">
    <input type="submit" name="delete" value="Delete">
    <input type="submit" name="cancel" value="Cancel">
</form>

<?php
/**
 * Take the id and in case of confirmation delete the record
 */
require "genreClass.php";

if (isset($_GET["id"]) && isset($_POST["delete"])) {
    try {
        $newGenre = new Genre;
        $newGenre->deleteGenre($_GET["id"]);
        $success = "Genre successfully deleted";
        header ('Location: ../index.php');
    } catch(PDOException $error) {
        echo "Ошибка: " . $error->getMessage();
    }
} elseif (isset($_POST["cancel"])) {
    header ('Location: ../index.php');
}
?>