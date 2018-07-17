<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'cms');

class DB
{
    private $con;
    function __construct() {
        $this->con = mysqli_connect(HOST, USER, PASS,DB) or die('Connection Error! '.mysql_error());
//        mysql_select_db(DB, $con) or die('DB Connection Error: ->'.mysql_error());
    }

    public function getCon()
    {
        return $this->con;
    }

}
?>