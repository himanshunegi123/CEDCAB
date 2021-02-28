<?php

class Dbconn
{
    public $servername;
    public $username;
    public $password;
    public $database;
    public $conn;

    function __construct($servername = "localhost", $username = "root", $password = "", $database = "CEDCAB")
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        return $this->conn;
    }
}
