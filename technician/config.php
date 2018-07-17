<?php


class DB_FACADE{

    private $conn=null;
    private $host="localhost";
    private $user="root";
    private $password="";
    private $database="cms";

    public function __construct()
    {
        //create_the connection variable
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die('could not connect');

    }




    public function connect()
    {
//        if (!$this->conn) {
//            return die("Connection failed: " . mysqli_connect_error());
//        }
        return $this->conn;
    }

    public function disconnect()
    {
        $this->conn->close();
    }

}

?>