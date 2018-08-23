<?php
/**
 * Choose record, waiting for data entry and
 * if they are correct we add changes to the database 
 */

require "musician.php";
require "../../common.php";
require "../genres/genreClass.php";
require "../templates/header.php";

$listMusicians = new Musician;
$listGenres = new Genre;
$arrayGenres = $listGenres->readGenre();

if (isset($_POST['submit'])) {
    try {
        $listMusicians = new Musician(array_merge($_GET, $_POST));
        $listMusicians->updateRecord(); ?>
        <blockquote><?php echo escape($_POST['FirstName']); ?> successfully updated.</blockquote>
    <?php } catch(PDOException $error) {
        echo "Ошибка: " . $error->getMessage();
    }
}
if (isset($_GET['Id'])) {
    $listMusicians = new Musician($_GET);
    $musician = $listMusicians->selectRecord();
} 
?>

<h2>Edit a musician</h2>
<form method="post">
    <?php foreach ($musician as $key => $value) : 
        if ($key == "Id") {
            continue;
        } elseif ($key == "IdGenre") {
            $idGenre = $value;
            $inputGenre = $listGenres->selectGenre($idGenre);
            continue;
        } ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>">
    <?php endforeach; ?>
<br>
    <label for="IdGenre">Genre</label>
        <select name="IdGenre">
            <option value="<?php echo $idGenre; ?>" ><?php echo $inputGenre["Name"]; ?></option>
            <?php foreach ($arrayGenres as $genre){ ?>
                <option value="<?php echo $genre['id']?>"><?php echo $genre['Name']?></option>
            <?php } ?>
        </select>
    <input type="submit" name="submit" value="Submit">
</form>
<br>
<a href="../index.php">Back to home</a>

<?php require "../templates/footer.php"; ?>