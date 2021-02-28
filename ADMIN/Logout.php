<?php
session_start();
if(isset($_SESSION['admin']['email'])){
session_destroy();
header("location:../Index.php");
}else{
echo "Logout will not work";
}