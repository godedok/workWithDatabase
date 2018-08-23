<?php
/**
 * Choose record, waiting for data entry and
 * if they are correct we add changes to the database 
 */

require "musician.php";
require "../../common.php";
require "../genres/genreClass.php";
require "../templates/header.php";

$newMusician = new Musician;
$newGenre = new Genre;
$genre = $newGenre->readGenre();

if (isset($_POST['submit'])) {
    try {
        $newMusician = new Musician(array_merge($_GET, $_POST));
        $newMusician->updateRecord(); ?>
        <blockquote><?php echo escape($_POST['FirstName']); ?> successfully updated.</blockquote>
    <?php } catch(PDOException $error) {
        echo "Ошибка: " . $error->getMessage();
    }
}
  
if (isset($_GET['Id'])) {
    $newMusician = new Musician($_GET);
    $user = $newMusician->selectRecord();
} 
?>

<h2>Edit a musician</h2>
<form method="post">
    <?php foreach ($user as $key => $value) : 
        if ($key == "Id") {
            continue;
        } elseif ($key == "IdGenre") {
            $gen = $value;
            $g = $newGenre->selectGenre($gen);
            continue;
        } ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>">
    <?php endforeach; ?>
<br>
    <label for="IdGenre">Genre</label>
        <select name="IdGenre">
            <option value="<?php echo $gen; ?>" ><?php echo $g["Name"]; ?></option>
            <?php foreach ($genre as $value){ ?>
                <option value="<?php echo $value['id']?>"><?php echo $value['Name']?></option>
            <?php } ?>
        </select>
    <input type="submit" name="submit" value="Submit">
</form>
<br>
<a href="../index.php">Back to home</a>

<?php require "../templates/footer.php"; ?>