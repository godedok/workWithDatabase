<?php

class Connect
{
    public $user = "root";
    public $password = "us19";
    public $dsn = "mysql:host=localhost;dbname=Musicians";
    public $options    = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    public $connect;
    
    public function __construct()
    {
        /**
         * Connect to database
        */
        try {
            $this->connect = new PDO($this->dsn, $this->user, $this->password, $this->options);
        } 
        catch (PDOException $e) {
            echo "Невозможно установить соединение с базой данных: " . $e->getMessage();
        }
    }
}