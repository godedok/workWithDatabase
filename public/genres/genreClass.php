<?php

class Genre
{
    private $user = "root";
    private $password = "us19";
    private $dsn = "mysql:host=localhost;dbname=Musicians";
    private $options    = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );
    private $connect;
    
    public function __construct()
    {
        /**
         * Connect to database
        */
        if (!isset($this->connect)) {
            try {
                $this->connect = new PDO($this->dsn, $this->user, $this->password, $this->options);
            } 
            catch (PDOException $e) {
                echo "Невозможно установить соединение с базой данных: " . $e->getMessage();
            }
        }
    }
    /**
     * Create a new entry in the genre table
     */
    public function createGenre($genre)
    {
        $sql = "INSERT INTO Genre (Name) values ('$genre')";
        $statement = $this->connect->prepare($sql);
        $statement->execute();
    }
    /**
     * Update record in the genre table
     */
    public function updateGenre($id, $genre)
    {
        $sql = "UPDATE Genre SET Name = '$genre' WHERE id = $id";
        $statement = $this->connect->prepare($sql);
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
        $sql = "DELETE FROM Genre WHERE id = $id";
        $statement = $this->connect->prepare($sql);
        $statement->execute();
    }
    public function selectGenre($id)
    {
        $sql = "SELECT * FROM Genre WHERE id = $id";
        $statement = $this->connect->prepare($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}