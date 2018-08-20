<?php

if (isset($_POST['submit'])) {
	require "../common.php";
	require "musician.php";

	try {
		$newMusician = new Musician($_POST);
		$newMusician->createRecord();
	} catch(PDOException $error) {
		
	}
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && !isset($error)) { ?>
    <blockquote> <?php echo escape($_POST['FirstName']); ?> successfully added.</blockquote>
<?php } elseif(isset($error)) {
    	echo $newMusician->outputError();	
} ?>

<h2>New musician</h2>

<form method="post">
	<label for="FirstName">First Name</label>
	<input type="text" name="FirstName" id="FirstName">
	<label for="LastName">Last Name</label>
	<input type="text" name="LastName" id="LastName">
	<label for="Gender">Gender</label>
	<input type="text" name="Gender" id="Gender">
	<label for="YearOfBirth">YearOfBirth</label>
	<input type="text" name="YearOfBirth" id="YearOfBirth">
	<label for="Genre">Genre</label>
    <input type="text" name="Genre" id="Genre">
    <label for="IsInGroup">IsInGroup</label>
	<input type="text" name="IsInGroup" id="IsInGroup">
	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>