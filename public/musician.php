<?php
/**
 * Class for working with the database
 */
class Musician
{
    public $id;
    public $firstName;
    public $lastName;
    public $gender;
    public $yearOfBirth;
    public $genre;
    public $group;
    public $error;

    private $user = "root";
    private $password = "us19";
    private $dsn = "mysql:host=localhost;dbname=Musicians";
    private $options    = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );
    private $connect;

    public function __construct($POST)
    {
        /**
         * Input validation and adding data to a class object
         */
        foreach ($POST as $key => $value) {
            switch ($key) {
                case "Id":
                    if ($value == "") {
                        $this->id = null;
                        $this->error[] = $key;
                    } else {
                            $this->id = $value;
                    }
                    break;
                case "FirstName":
                    if ($value == "") {
                        $this->firstName = null;
                        $this->error[] = $key;
                    } else {
                        $this->firstName = $value;
                    }
                    break;
                case "LastName":
                    if ($value == "") { 
                        $this->lastName = null;
                        $this->error[] = $key;
                    } else {
                        $this->lastName = $value;
                    }
                    break;
                case "Gender":
                    if ($value == "") {
                        $this->gender = null;
                        $this->error[] = $key;
                    } else {
                        $this->gender = $value;
                    }
                    break;
                case "YearOfBirth":
                    if (strlen($value) == 4 && $value > 1900 && $value < 2020 && is_numeric($value)) {
                        $this->yearOfBirth = $value;
                    } else {
                        $this->yearOfBirth = null;
                        $this->error[] = $key;
                    }
                    break;
                case "Genre":
                    if ($value == "") {
                        $this->genre = null;
                        $this->error[] = $key;
                    } else { 
                        $this->genre = $value;
                    }
                    break;
                case "IsInGroup":
                    if ($value == "") {
                        $this->group = null;
                        $this->error[] = $key;
                    } else {
                        $this->group = $value;
                    }
                    break;
            }
        }
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
     * Return an array of data 
     */
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
    /**
     * Create new record into database
     */
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
    /**
     * Musician search by genre
     */
    public function findRecord()
    {
        $sql = "SELECT * FROM Cubans WHERE Genre LIKE '%$this->genre%' ";
        $statement = $this->connect->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    /**
     * Reading data from the database
     */
    public function readTable()
    {
        $sql = "SELECT * FROM Cubans";
        $statement = $this->connect->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    /**
     * Data selection by Id
     */
    public function selectRecord()
    {
        $sql = "SELECT * FROM Cubans WHERE Id = :Id";
        $statement = $this->connect->prepare($sql);
        $statement->bindValue(':Id', $this->id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Change the musicians data in the database
     */
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
    /**
     * Deleting an entry in the database
     */
    public function deleteRecord()
    {   
        $sql = "DELETE FROM Cubans WHERE Id = :Id";
        $statement = $this->connect->prepare($sql);
        $statement->bindValue(':Id', $this->id);
        $statement->execute();
    }
    /**
     * Displays information about the error of the entered data
     */
    public function outputError()
    {
        $result = "";
        foreach ($this->error as $value) {
            $result .= "{$value}, ";
        }
        $result = "Input error in " . substr($result, 0, -2) . ".";
        return $result;
    }
}