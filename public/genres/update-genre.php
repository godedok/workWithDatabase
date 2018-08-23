<?php
/**
 * Choose record, waiting for data entry and
 * if they are correct we add changes to the database 
 */

require "genreClass.php";
require "../../common.php";
require "../templates/header.php";

if (isset($_POST['submit'])) {
    try {
        $newGenre = new Genre;
        $newGenre->updateGenre($_GET['id'], $_POST['Name']); ?>
        <blockquote><?php echo escape($_POST['Name']); ?> successfully updated.</blockquote>
    <?php } catch(PDOException $error) {
        echo "Ошибка: " . $error->getMessage();
    }
}
if (isset($_GET['id'])) {
    $newGenre = new Genre;
    $user = $newGenre->selectGenre($_GET['id']);
} 
?>

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
<a href="../index.php">Back to home</a>

<?php require "../templates/footer.php"; ?>