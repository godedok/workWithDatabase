<?php
/**
 * We are waiting for data entry and if they are correct
 * we add the entry to the database
 */
require "../../common.php";
require "../classes/musician.php";
require "../classes/genreClass.php";
require "../templates/header.php";

$newMusician = new Musician;
$listGenres = new Genre;
$arrayGenres = $listGenres->readGenre();

if (isset($_POST['submit'])) {
	try {
		$newMusician = new Musician($_POST);
		$newMusician->createRecord(); ?>
		<blockquote> <?php echo escape($_POST['FirstName']); ?> successfully added.</blockquote>
	<?php } catch(PDOException $error) {
		echo "Ошибка: " . $error->getMessage();
	}
}
?>

<h2>New musician</h2>
<form method="post">
	<label for="FirstName">First Name</label>
	<input type="text" name="FirstName" id="FirstName" value="<?php echo $_POST["FirstName"]; ?>">
	<label for="LastName">Last Name</label>
	<input type="text" name="LastName" id="LastName" value="<?php echo $_POST["LastName"]; ?>">
	<label for="Gender">Gender</label>
	<input type="text" name="Gender" id="Gender" value="<?php echo $_POST["Gender"]; ?>">
	<label for="YearOfBirth">YearOfBirth</label>
	<input type="text" name="YearOfBirth" id="YearOfBirth" value="<?php echo $_POST["YearOfBirth"]; ?>">
    <label for="IsInGroup">IsInGroup</label>
	<input type="text" name="IsInGroup" id="IsInGroup" value="<?php echo $_POST["IsInGroup"]; ?>"><br>
	<label for="IdGenre">Genre</label>
	    <select name="IdGenre">
	        <option value="">Select a genre</option>
	        <?php foreach ($arrayGenres as $genre){ ?>
    	        <option value="<?php echo $genre['id']?>"><?php echo $genre['Name']?></option>
            <?php } ?>
	    </select>
	<input type="submit" name="submit" value="Submit">
</form>
<br>
<a href="../index.php">Back to home</a>

<?php require "../templates/footer.php"; ?>