<?php 
include "templates/header.php";
require "musician.php";
require "../common.php";
require "table.php";
$newMusician = new Musician;
$result = $newMusician->readTable();

if (isset($_POST['submit'])) {
	$newMusician->genre = $_POST['Genre'];
	$result = $newMusician->findRecord();
}

?>

<ul>
    <li><a href="create.php"><strong>Create</strong></a> - add a Musician</li>
</ul>

<h2>Find user by genre</h2>

<form method="post">
	<label for="Genre">Genre</label>
	<input type="text" id="Genre" name="Genre">
	<input type="submit" name="submit" value="View Results">
</form>

<h2>List of musicians</h2>

<?php createTable($result); ?>

<?php include "templates/footer.php"; ?>