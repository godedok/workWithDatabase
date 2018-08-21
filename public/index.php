<?php
/**
 * Home page with a search by genre, a link to create a record,
 *  and information from the database
 */
include "templates/header.php";
require "musician.php";
require "../common.php";
require "table.php";
$newMusician = new Musician;
$result = $newMusician->readTable();

if (isset($_POST['submit'])) {
	$newMusician->genre = $_POST['IdGenre'];
	$result = $newMusician->findRecord();
}

?>

<ul>
    <li><a href="create.php"><strong>Create</strong></a> - add a Musician</li>
</ul>

<h2>Find user by genre</h2>

<form method="post">
	<label for="IdGenre">Genre</label>
	<input type="text" id="IdGenre" name="IdGenre">
	<input type="submit" name="submit" value="View Results">
</form>

<h2>List of musicians</h2>

<?php createTable($result); ?>

<?php include "templates/footer.php"; ?>