<?php
include 'dbinfo.php'; 

//always start the session before anything else!!!!!! 
session_start(); 

if(isset($_POST['username']) and isset($_POST['password']))  { //check null
	$username = $_POST['username']; // text field for username 
	$password = $_POST['password']; // text field for password
	
// store session data
$_SESSION['username']=$username;

//connect to the db 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

$flag = 1 ;	// if admin is found don't check for student

         	//Our SQL Query
           	$sql_query1 = "Select Username From admin Where Username = '$username' AND Password = '$password'";  
            //Run our sql query
            $result1 = mysqli_query($link, $sql_query1)  or die(mysqli_error($link));
			if($result1 == false)
				{
				echo 'The query failed.';
				exit();
			}
			if($result1){
				if(mysqli_num_rows($result1) == 1){ 
				//the username and password matches the admin database 
				//move them to the page to which they need to go 
					$flag = 0 ;
					header('Location: AdminSummary.php');
				}
			}

if($flag){
			$sql_query = "Select Username From user Where Username = '$username' AND Password = '$password'";
            //Run our sql query
            $result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
			if($result == false)
				{
				echo 'The query failed.';
				exit();
			}

			//this is where the actual verification happens 
			if(mysqli_num_rows($result) == 1){ 
			//the username and password matches the  student database 
			//move them to the page to which they need to go 
				header('Location: UserSummary.php');
			   
			}else{ 
			$err = 'Incorrect username or password' ; 
			} 
		}
			//then just above your login form or where ever you want the error to be displayed you just put in 
			echo "$err";

    } 
	
?>
