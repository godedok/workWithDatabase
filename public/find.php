<?php

if (isset($_POST['submit'])) {
	require "musician.php";
	require "../common.php";
	require "table.php";
	$newMusician = new Musician;
	$newMusician->genre = $_POST['Genre'];
	$result = $newMusician->findRecord();
}
?>
<?php require "templates/header.php"; ?>
		
<?php  
if (isset($_POST['submit'])) {
	if ($result) { ?>
		<h2>Results</h2>

	<?php createTable($result); ?>

	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['Genre']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Find user by genre</h2>

<form method="post">
	<label for="Genre">Genre</label>
	<input type="text" id="Genre" name="Genre">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>