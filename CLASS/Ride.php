<?php

include_once 'Dbconn.php';
session_start();
class Locationss extends Dbconn
{
    public $id;
    public $name;
    public $distance;
    public $is_available;
    public $location_arr = array();
    public $details = array();
    public $conn;
    public $firstPoint;
    public $secondPoint;

    function __construct()
    {
        $connect = new Dbconn();
        $conn = $connect->connect();
        $this->conn = $conn;
    }
    public function CalculateFare($pickUpPoint, $dropPoint, $cabType, $luggage = 0)
    {
        $firstDis = 0;
        $lastDiss = 0;
        $sql = "Select * from `tbl_location` where id in  ('$pickUpPoint','$dropPoint')";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $location_arr[$i] = $row;
                ++$i;
            }
        }
        if ($location_arr[0]['id'] == $pickUpPoint) {
            $firstDis = $location_arr[0]['distance'];
            $firstPoint = $location_arr[0]['name'];
        }
        if ($location_arr[1]['id'] == $dropPoint) {
            $lastDiss = $location_arr[1]['distance'];
            $secondPoint = $location_arr[1]['name'];
        }
        $TotalDis = abs($firstDis - $lastDiss);
        $_SESSION['user']['TotalDis'] = $TotalDis;
        $_SESSION['user']['firstPoint'] = $firstPoint;
        $_SESSION['user']['secondPoint'] = $secondPoint;
        $_SESSION['user']['cabType'] = $cabType;

        switch ($cabType) {
            case ("CedMini"):
                $Bookingprice = 150;
                if ($luggage > 20) {
                    $luggagePrice = 200;
                } else if ($luggage > 10 && $luggage < 20) {
                    $luggagePrice = 100;
                } else if ($luggage < 10 && $luggage != 0) {
                    $luggagePrice = 50;
                } else {
                    $luggagePrice = 0;
                }

                if ($TotalDis >= 160) {
                    $TotalDis -= 160;
                    $totalFare = 1915;
                    $totalFare += ($TotalDis * 9.50);
                } else if ($TotalDis < 10) {
                    $totalFare  =   $TotalDis * 14.50;
                } else if ($TotalDis >= 10) {
                    $TotalDis -= 10;
                    $totalFare = 145;
                    $totalFare += ($TotalDis * 13.00);
                } else if ($TotalDis >= 60) {
                    $TotalDis -= 60;
                    $totalFare = 795;
                    $totalFare += ($TotalDis * 11.20);
                }
                $totalFare += $luggagePrice + $Bookingprice;

                break;

            case ("CedMicro"):
                $Bookingprice = 50;
                if ($luggage > 20) {
                    $luggagePrice = 200;
                } else if ($luggage > 10 && $luggage < 20) {
                    $luggagePrice = 100;
                } else if ($luggage < 10 && $luggage != 0) {
                    $luggagePrice = 50;
                } else {
                    $luggagePrice = 0;
                }

                if ($TotalDis >= 160) {
                    $TotalDis -= 160;
                    $totalFare = 1755;
                    $totalFare = $totalFare + ($TotalDis * 8.50);
                } else if ($TotalDis >= 60) {
                    $TotalDis -= 60;
                    $totalFare = 735;
                    $totalFare = $totalFare + ($TotalDis * 10.20);
                } else if ($TotalDis >= 10) {
                    $TotalDis -= 10;
                    $totalFare = 135;
                    $totalFare = $totalFare + ($TotalDis * 12.00);
                } else if ($TotalDis < 10) {
                    $totalFare =  $TotalDis * 13.50;
                }
                $totalFare += $luggagePrice + $Bookingprice;
                break;

            case ("CedRoyal"):
                $Bookingprice = 200;
                if ($luggage > 20) {
                    $luggagePrice = 200;
                } else if ($luggage > 10 && $luggage < 20) {
                    $luggagePrice = 100;
                } else if ($luggage < 10 && $luggage != 0) {
                    $luggagePrice = 50;
                } else {
                    $luggagePrice = 0;
                }

                if ($TotalDis >= 160) {
                    $TotalDis -= 160;
                    $totalFare = 2075;
                    $totalFare = $totalFare + ($TotalDis * 10.50);
                } else if ($TotalDis >= 60) {
                    $TotalDis -= 60;
                    $totalFare = 855;
                    $totalFare = $totalFare + ($TotalDis * 12.20);
                } else if ($TotalDis >= 10) {
                    $TotalDis -= 10;
                    $totalFare = 155;
                    $totalFare = $totalFare + ($TotalDis * 14.00);
                } else if ($TotalDis < 10) {
                    $totalFare =   $TotalDis * 15.50;
                }
                $totalFare += $luggagePrice + $Bookingprice;
                break;

            case ("CedSUV"):
                $Bookingprice = 250;
                $luggagePrice = 0;
                if ($luggage > 20) {
                    $luggagePrice = 200;
                } else if ($luggage > 10 && $luggage < 20) {
                    $luggagePrice = 100;
                } else if ($luggage < 10 && $luggage != 0) {
                    $luggagePrice = 50;
                } else {
                    $luggagePrice = 0;
                }
                $luggagePrice += 200;

                if ($TotalDis >= 160) {
                    $TotalDis -= 160;
                    $totalFare = 2235;
                    $totalFare = $totalFare + ($TotalDis * 11.50);
                } else if ($TotalDis >= 60) {
                    $TotalDis -= 60;
                    $totalFare = 915;
                    $totalFare = $totalFare + ($TotalDis * 13.20);
                } else if ($TotalDis >= 10) {
                    $TotalDis -= 10;
                    $totalFare = 145;
                    $totalFare = $totalFare + ($TotalDis * 15.00);
                } else if ($TotalDis < 10) {
                    $totalFare =   $TotalDis * 16.50;
                }
                $totalFare += $luggagePrice + $Bookingprice;

                break;
        }
        $s = "Select * from `tbl_location` where id in  ('$pickUpPoint','$dropPoint')";
        $r = $this->conn->query($s);
        if ($r->num_rows > 0) {
            $i = 0;
            while ($row = $r->fetch_assoc()) {
                $this->location_arr[$i] = $row;
                ++$i;
            }
        }
        $_SESSION['user']['TotalFare'] = $totalFare;
        $_SESSION['user']['luggage'] = $luggage;
        return array("totalfare" => $totalFare, "luggageprice" => $luggagePrice, "TotalDis" => $TotalDis, "pickUpPoint" => $firstPoint, "DropPoint" => $secondPoint, "cabType" => $cabType);
    }

    public function RideConfirm($carType, $luggage)
    {
        if (isset($_SESSION['user']['TotalDis']) && isset($_SESSION['user']['email'])) {

            $email = $_SESSION['user']['email'];
            $SQL = "SELECT `user_id` FROM `tbl_user` WHERE `email_id` = '$email'";
            $result = $this->conn->query($SQL);
            $re =  $result->fetch_assoc();
            $usser_id = $re['user_id'];

            // if ($result == TRUE) {
            //     return 1;
            // } else {
            //     return $this->conn->error;
            // }
            $_SESSION['user']['carType'] = $carType;
            $_SESSION['user']['luggage'] = $luggage;
            $totaldis = $_SESSION['user']['TotalDis'];
            $firstPoint =  $_SESSION['user']['firstPoint'];
            $secondPoint = $_SESSION['user']['secondPoint'];
            $lugga =  $_SESSION['user']['luggage'];
            $TotalFare =  $_SESSION['user']['TotalFare'];

            $s = "INSERT INTO `tbl_ride`(`from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`)
             VALUES ('$firstPoint','$secondPoint','$totaldis','$lugga','$TotalFare',1,'$usser_id')";
            $result = $this->conn->query($s);

            if ($result == TRUE) {
                return 1;
            } else {
                return $this->conn->error;
            }


            return 1;
        } else if (isset($_SESSION['user']['TotalFare'])) {
            return 1;
        } else {
            return 0;
        }
    }

    public function PRides()
    {
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            $SQL = "SELECT * FROM `tbl_ride` WHERE customer_user_id = $id AND `status` = 1";
            $result = $this->conn->query($SQL);
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $details[$i] = $row;
                    ++$i;
                }
                return $details;
            }
        } else {
            return 0;
        }
    }

    public function CRides()
    {
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            $SQL = "SELECT * FROM `tbl_ride` WHERE customer_user_id = $id AND `status` = 2";
            $result = $this->conn->query($SQL);
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $details[$i] = $row;
                    ++$i;
                }
                return $details;
            }
        } else {
            return 0;
        }
    }
    public function TRides()
    {
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            $SQL = "SELECT * FROM `tbl_ride` WHERE customer_user_id = $id ";
            $result = $this->conn->query($SQL);
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $details[$i] = $row;
                    ++$i;
                }
                return $details;
            }
        } else {
            return 0;
        }
    }
    public function TARides()
    {
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            $SQL = "SELECT * FROM `tbl_ride` WHERE customer_user_id = $id  AND `status` = 0";
            $result = $this->conn->query($SQL);
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $details[$i] = $row;
                    ++$i;
                }
                return $details;
            }
        } else {
            return 0;
        }
    }

    public function viewDetails($ride_id)
    {
        $SQL = "SELECT * FROM `tbl_ride` WHERE ride_id = $ride_id";
        $result = $this->conn->query($SQL);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $details[$i] = $row;
                ++$i;
            }
            return $details;
        } else {
            return 0;
        }
    }

    public function cancel($ride_id)
    {
        $SQL = "UPDATE `tbl_ride` SET `status` = 0 WHERE `ride_id` = '$ride_id';";
        $result = $this->conn->query($SQL);
        if ($result ==  TRUE) {
            return 1;
        } else {
            return 0;
        }
    }


    public function info()
    {
        $id = $_SESSION['user']['id'];
        $SQL = "SELECT * FROM `tbl_ride` WHERE customer_user_id = $id ";
        $result = $this->conn->query($SQL);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $details[$i] = $row;
                ++$i;
            }
            return $details;
        } else {
            return $this->conn->error;
        }
    }


    public function ARides()
    {
        $sql = "SELECT * FROM `tbl_ride`";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $details[$i] = $row;
                ++$i;
            }
            return $details;
        } else {
            return $this->conn->error;
        }
    }

    public function AUsers()
    {
        $sql = "SELECT * FROM `tbl_user` WHERE `is_admin` = 0";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $details[$i] = $row;
                ++$i;
            }
            return $details;
        } else {
            return $this->conn->error;
        }
    }

    public function TEarnings()
    {
        $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 2";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $details[$i] = $row;
                ++$i;
            }
            return $details;
        } else {
            return $this->conn->error;
        }
    }

    public function ACaRides()
    {
        $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 0";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $details[$i] = $row;
                ++$i;
            }
            return $details;
        } else {
            return $this->conn->error;
        }
    }

    public function APRides()
    {
        $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $details[$i] = $row;
                ++$i;
            }
            return $details;
        } else {
            return $this->conn->error;
        }
    }

    public function approve($e)
    {
        $sql = "UPDATE `tbl_ride` SET `status`= 2 WHERE `ride_id` = '$e'; ";
        $result = $this->conn->query($sql);
        if ($result == TRUE) {



            return 1;
        } else {
            return $this->conn->error;
        }
    }

    public function cancell($e)
    {
        $sql = "UPDATE `tbl_ride` SET `status`= 0 WHERE `ride_id` = '$e'; ";
        $result = $this->conn->query($sql);
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }
}


#1 for pending , 2 for complete & 0 for cancelled 