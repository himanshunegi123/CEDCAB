<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "Mailer/PHPMailer.php";
require_once "Mailer/SMTP.php";
require_once "Mailer/Exception.php";
include_once 'Dbconn.php';

// session_start();
class User extends Dbconn

{
    public $user_id;
    public $email_id;
    public $name;
    public $dateofsignup;
    public $mobile;
    public $status;
    public $password;
    public $is_admin;
    public $conn;

    function __construct()
    {
        $connect = new Dbconn();
        $this->conn = $connect->connect();
    }
    public function Register_User($inputEmail, $inputName, $inputNumber, $inputPassword, $location)
    {
        $sql = "INSERT INTO `tbl_user`(`email_id`,`name`,`mobile`,`password`,`status`,`is_admin`,`profile`)
        VALUES ('$inputEmail','$inputName','$inputNumber','$inputPassword',0,0,'$location')";
        $res = $this->conn->query($sql);
        if ($res == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }
    public function CheckUser($email, $pass)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE email_id = '$email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['email_id'] == "admin@gmail.com" && $row['password'] == 'password123$') {
                $_SESSION['admin']['email'] = $email;
                $_SESSION['admin']['password'] = $pass;
                return 2;
            } else if ($row['password'] == $pass) {
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['password'] = $pass;
                $_SESSION['user']['id'] = $row['user_id'];

                #user exist and store details in db

                if (isset($_SESSION['user']['TotalDis'])) {
                    $pickUpPoint = $_SESSION['user']['firstPoint'];
                    $dropPoint = $_SESSION['user']['secondPoint'];
                    $TotalDis = $_SESSION['user']['TotalDis'];
                    $luggage = $_SESSION['user']['luggage'];
                    $TotalFare = $_SESSION['user']['TotalFare'];
                    $id = $_SESSION['user']['id'];

                    $SQL = "INSERT INTO `tbl_ride`(`from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`)
                 VALUES ('$pickUpPoint','$dropPoint','$TotalDis','$luggage','$TotalFare',1,'$id')";
                    $result = $this->conn->query($SQL);
                    if ($result == TRUE) {
                        return 1;
                    } else {
                        return $this->conn->error;
                    }
                }
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function CheckUserEmail($inputEmail)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE email_id = '$inputEmail'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function SendOtp($email)
    {

        $otp = rand(1000, 9999);
        $_SESSION["OTP"] = $otp;

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "himanshunegi12319@gmail.com";
        $mail->Password = "8958@#Himans";
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        $mail->isHTML(true);
        $mail->setFrom("himanshunegi12319@gmail.com");
        $mail->addaddress($email);

        $mail->Subject = ("Verification of Account");
        $mail->Body = 'Verify your OTP ' . $otp;
        if ($mail->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function VerifyOtp($otp)
    {
        if ($otp == $_SESSION["OTP"]) {
            return 1;
        } else {
            return 0;
        }
    }
    public function Logout()
    {
        if (isset($_SESSION['user'])) {
            session_destroy();
            return 1;
        } else {
            return 0;
        }
    }

    public function CPassword($CPassword)
    {
        if (isset($_SESSION['user']['email'])) {
            $email = $_SESSION['user']['email'];
            $sql = "SELECT * FROM `tbl_user` WHERE `email_id` = '$email' AND `password` = '$CPassword'";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                return 1;
            } else {
                return $this->conn->error;
            }
        }
    }

    public function update($password, $name, $number)
    {
        $email = $_SESSION['user']['id'];
        $sql = "UPDATE `tbl_user` SET `name`='$name',`mobile`='$number',`password`= '$password' WHERE `user_id` = '$email'";
        $result = $this->conn->query($sql);
        // return $result;
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }
    public function block($e){
        $sql = "UPDATE `tbl_user` SET `status`= 0 WHERE `user_id` = '$e'; ";
        $result = $this->conn->query($sql);
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }
    public function unblock($e){
        $sql = "UPDATE `tbl_user` SET `status`= 1 WHERE `user_id` = '$e'; ";
        $result = $this->conn->query($sql);
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }

   
}
