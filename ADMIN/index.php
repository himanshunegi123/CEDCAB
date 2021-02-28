<?php 
session_start();
if(!isset($_SESSION['admin']['email'])){
    header('location:../Login.php');

}
else{
    header('location:Index.php');
}
?>