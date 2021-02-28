<?php 
session_start();
if(isset($_SESSION['user']['email'])){
    header('location:Index.php');

}
else{
    header('location:../Signup.php');
}
?>