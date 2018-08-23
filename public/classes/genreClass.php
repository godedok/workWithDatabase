<?php
require_once "connect.php";
class Genre extends Connect
{
    /**
     * Create a new entry in the genre table
     */
    public function createGenre($genre)
    {
        $sql = "INSERT INTO Genre (Name) values (:Name)";
        $statement = $this->connect->prepare($sql);
        $statement->bindValue(':Name', $genre);
        $statement->execute();
    }
    /**
     * Update record in the genre table
     */
    public function updateGenre($id, $genre)
    {
        $sql = "UPDATE Genre SET Name = :Name WHERE id = :id";
        $statement = $this->connect->prepare($sql);
        $statement->bindValue(':Name', $genre);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }
    /**
     * Reading the genre table
     */
    public function readGenre()
    {
        $sql = "SELECT * FROM Genre";
        $statement = $this->connect->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Delete a record from the genre table
     */
    public function deleteGenre($id)
    {
        $sql = "DELETE FROM Genre WHERE id = :id";
        $statement = $this->connect->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }
    public function selectGenre($id)
    {
        $sql = "SELECT * FROM Genre WHERE id = :id";
        $statement = $this->connect->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}