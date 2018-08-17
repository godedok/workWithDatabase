<?php
class Musician
{
    public $id;
    public $firstName;
    public $lastName;
    public $gender;
    public $yearOfBirth;
    public $genre;
    public $group;

    private $user = "root";
    private $password = "us19";
    private $dsn = "mysql:host=localhost;dbname=Musicians";
    private $options    = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );
    private $connect;

    public function __construct($id = null, $firstName = null, $lastName = null, $gender = null,
    $yearOfBirth = null, $genre = null, $group = null)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->gender = $gender;
        $this->genre = $genre;
        $this->group = $group;
        if (strlen($yearOfBirth) == 4 && $yearOfBirth > 1900 && $yearOfBirth < 2020) {
            $this->yearOfBirth = $yearOfBirth;
        }
        if (!isset($this->connect)) {
            try {
                $this->connect = new PDO($this->dsn, $this->user, $this->password, $this->options);
            } 
            catch (PDOException $e) {
                echo "Невозможно установить соединение с базой данных: " . $e->getMessage();
            }
        }
    }

    public function arrayKeysValues()
    {
        return array(
			"FirstName"   => $this->firstName,
			"LastName"    => $this->lastName,
			"Gender"      => $this->gender,
			"YearOfBirth" => $this->yearOfBirth,
            "Genre"       => $this->genre,
            "IsInGroup"   => $this->group
		);
    }

    public function createRecord()
    {
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)", "Cubans",
            implode(", ", array_keys($this->arrayKeysValues())),
            ":" . implode(", :", array_keys($this->arrayKeysValues()))
        );
        $statement = $this->connect->prepare($sql);
		$statement->execute($this->arrayKeysValues());
    }

    public function findRecord()
    {
        $sql = "SELECT * FROM Cubans WHERE Genre LIKE '%$this->genre%' ";
        $statement = $this->connect->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function readTable()
    {
        $sql = "SELECT * FROM Cubans";
        $statement = $this->connect->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function selectRecord()
    {
        $sql = "SELECT * FROM Cubans WHERE Id = :Id";
        $statement = $this->connect->prepare($sql);
        $statement->bindValue(':Id', $this->id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRecord() 
    {
        $str = "Id = :Id";
        array_walk($this->arrayKeysValues(), function ($value, $key) use (&$str) {
             $str .= ", $key = :$key";
        });
        $sql = sprintf("UPDATE Cubans SET %s WHERE Id = :Id", $str);
        $statement = $this->connect->prepare($sql);
        $statement->execute(array_merge([":Id" => $this->id], $this->arrayKeysValues()));
    }

    public function deleteRecord()
    {
        $sql = "DELETE FROM Cubans WHERE Id = :Id";
        $statement = $this->connect->prepare($sql);
        $statement->bindValue(':Id', $this->id);
        $statement->execute();
    }
}