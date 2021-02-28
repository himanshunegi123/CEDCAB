<?php 
session_start();
if(!isset($_SESSION['user']['email'])){
    header('location:Signup.php');

}
else{
    header('location:Index.php');
}
?>