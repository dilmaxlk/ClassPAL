<?php

// Some servers, header syntax not working,..Use this code if php header not working...
ob_start();


// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];


//linked with viewallattendance.inc.php
include_once '../php-includes/connect.inc.php'; 

//Select multi recodes

 if(isset($_GET["SearchKey"])){

     $rowCount = count($_POST["checkbox"]);

            for($i=0;$i<$rowCount;$i++) {


            //Delete Student
            $stmt = $db->prepare("DELETE FROM cp_attendance WHERE id='" . $_POST["checkbox"][$i] . "'");
            $stmt->execute();

            $stmt->close();




            }


// We get page number to redirect the user to the same records page that the user entered..
$SearchKey = $_GET["SearchKey"];

//Jump to the same page after.
header('Location: ../index.php?page=ViewAllAttendance&SearchKey=' . $SearchKey);

 } else {

$rowCount = count($_POST["checkbox"]);

            for($i=0;$i<$rowCount;$i++) {

            $stmt = $db->prepare("DELETE FROM cp_attendance WHERE id='" . $_POST["checkbox"][$i] . "'");
            $stmt->execute();
            $stmt->close();
            }


// We get page number to redirect the user to the same records page that the user entered..
$PNo = $_GET["PageNo"];

//Jump to the same page after.
header('Location: ../index.php?page=ViewAllAttendance&PageNo=' . $PNo);


 }




// If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}

// Some servers header syntax not working,..Use this code if php header not working...
ob_end_flush();

?>
