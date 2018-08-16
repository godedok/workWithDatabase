<?php
class Musician
{
    private $id;
    private $firstName;
    private $lastName;
    private $gender;
    private $yearOfBirth;
    private $genre;
    private $group;
    private $pdo;
    public function createRecord()
    {
        $str = "$this->id, '$this->firstName', '$this->lastName', '$this->gender', 
        $this->yearOfBirth, '$this->genre', '$this->group'";
        $this->pdo->exec("insert into Cubans values ($str)");
    }
    public function updateRecord($id, $arrayNames, $arrayValue)
    {

    }
}