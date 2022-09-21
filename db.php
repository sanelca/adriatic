<?php 
//Kod za spajanje sa bazom podataka koja ima naziv adriatic_test i username i password adriatic
class Connection {
    public $servername = "localhost";
    public $username = "adriatic";
    public $password = "adriatic";
    public $database = "adriatic_test";
    
    function db_connection(){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
          } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

}



?>