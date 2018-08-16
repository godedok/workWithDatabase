<?php

if (isset($_POST['submit'])) {
	require "../config.php";
	require "../common.php";

	try {
		$connection = new PDO($dsn, $username, $password, $options);
		$new_user = array(
			"FirstName"   => $_POST['FirstName'],
			"LastName"    => $_POST['LastName'],
			"Gender"      => $_POST['Gender'],
			"YearOfBirth" => $_POST['YearOfBirth'],
            "Genre"       => $_POST['Genre'],
            "IsInGroup"   => $_POST['IsInGroup']
		);
		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"Cubans",
				implode(", ", array_keys($new_user)),
				":" . implode(", :", array_keys($new_user))
		);
		$statement = $connection->prepare($sql);
		var_dump($statement);
		$statement->execute($new_user);
		var_dump($new_user);
	} catch(PDOException $error) {
		$error = $error->getMessage();
	}
	
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && !isset($error) && $statement) { ?>
    <blockquote><?php echo $_POST['FirstName']; ?> successfully added.</blockquote>
<?php } elseif(isset($error)) {
    echo "Ошибочка вышла, запись не добавлена.";
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