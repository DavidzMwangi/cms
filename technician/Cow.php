<?php
class Cow {
  private $id;
  private $name;
  private $breed;
  private $dob;

  private $con;


  public function __construct($id, $name, $breed, $dob){
    $this->id = $id;
    $this->name = $name;
    $this->breed = $breed;
    $this->dob = $dob;
    $this->con = new PDO("mysql:host=localhost;dbname=tap","root","");
  }

  public function add(){
    try {
        $sql ="INSERT INTO cow(id,name,breed,dob) VALUES (:id,:name,:breed,:dob)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute (["id"=>$this->id,"name"=>$this->name,"breed"=>$this->breed,"dob"=>$this->dob]);
        return true;

    } catch (PDOException $e){
        echo $e->getMessage();
        return false;

    }
  }



}
