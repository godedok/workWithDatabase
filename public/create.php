<?php
/**
 * We are waiting for data entry and if they are correct
 * we add the entry to the database
 */

require "../common.php";
require "musician.php";

$newMusician = new Musician;
$genre = $newMusician->readGenre();

if (isset($_POST['submit'])) {


	try {
		$newMusician = new Musician($_POST);
		$newMusician->createRecord();
	} catch(PDOException $error) {
		echo "Ошибка: " . $error->getMessage();
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
    <label for="IsInGroup">IsInGroup</label>
	<input type="text" name="IsInGroup" id="IsInGroup"><br>
	<label for="IdGenre">Genre</label>
	<select name="IdGenre">
	<option value="0">Select a genre</option>
	<?php foreach ($genre as $value){ ?>
    	<option value="<?php echo $value['id']?>"><?php echo $value['Name']?></option>
    <?php } ?>
	</select>

	<input type="submit" name="submit" value="Submit">
</form>
<br>
<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>