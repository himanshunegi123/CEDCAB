<?php
include_once 'Dbconn.php';
class Locations extends Dbconn
{
    public $id;
    public $name;
    public $distance;
    public $is_available;
    public $location_arr = array();
    public $conn;

    function __construct()
    {
        $connect = new Dbconn();
        $conn = $connect->connect();
        $this->conn = $conn;
    }
    public function locationGet()
    {
        $SQL = "SELECT * FROM `tbl_location`";
        $result = $this->conn->query($SQL);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $location_arr[$i] = $row;
                ++$i;
            }
        }
        return $location_arr;
    }
}
