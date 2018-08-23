<?php
/**
 * We are waiting for data entry and if they are correct
 * we add the entry to the database
 */
if (isset($_POST['submit'])) {
	require "../../common.php";
	require "genreClass.php";

	try {
		$newGenre = new Genre;
		$newGenre->createGenre($_POST['Name']);
	} catch(PDOException $error) {
	
	}
}
?>

<?php require "../templates/header.php"; ?>

<?php if (isset($_POST['submit']) && !isset($error)) { ?>
    <blockquote> <?php echo escape($_POST['Name']); ?> successfully added.</blockquote>
<?php } elseif(isset($error)) {
    echo "Ошибка: " . $error->getMessage();	
} ?>

<h2>New genre</h2>

<form method="post">
	<label for="Name">Genre name</label>
	<input type="text" name="Name" id="Name">
	<input type="submit" name="submit" value="Submit">
</form>

<a href="../index.php">Back to home</a>

<?php require "../templates/footer.php"; ?>