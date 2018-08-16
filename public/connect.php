<?php
class Connection
{
    private $user = "root";
    private $password = "us19";
    private $dsn = "mysql:host=localhost;dbname=Musicians";
    private $options    = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );
    private static $connect;
    public function getConnect()
    {
        if (!isset(self::$connect)) {
            try {
                self::$connect = new PDO($this->dsn, $this->user, $this->password, $this->options);
            } 
            catch (PDOException $e) {
                echo "Невозможно установить соединение с базой данных: " . $e->getMessage();
            }
        }
        return self::$connect;
    }
}
?>