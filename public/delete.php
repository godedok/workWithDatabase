<?php

require "musician.php";

if (isset($_GET["Id"])) {
  try {
    $newMusician = new Musician($_GET);
    $newMusician->deleteRecord();
    $success = "Musician successfully deleted";
    header ('Location: index.php');
  } catch(PDOException $error) {

  }
}
?>