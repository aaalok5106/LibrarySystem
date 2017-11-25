<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

if(isset($_POST['isbn']) and isset($_POST['username']) and isset($_POST['penalty'])){
	$isbn = $_POST['isbn'];
	$username = $_POST['username'];
	$penalty = $_POST['penalty'];
	
	$check_qry="select * from issue where ISBN='$isbn' and Username='$username'";
	$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
	if(mysqli_num_rows($result0) == 0) echo 'This Book is NOT Issued on your name!';
	else{
		$check_qry1="select * from user where Username='$username'";
		$result00 = mysqli_query ($link, $check_qry1)  or die(mysqli_error($link));
		if(mysqli_num_rows($result00) == 0) echo 'Username does not exist!';
		else{
			
				$qry1 = "update book set AvailableCopy = AvailableCopy+1 where ISBN='$isbn'";
				$qry2 = "delete from issue where ISBN='$isbn' and Username='$username'";
				$qry3 = "update stud_fac_emp set Penalty=Penalty+'$penalty' where Username='$username'";
				$result1 = mysqli_query ($link, $qry1)  or die(mysqli_error($link));
				$result2 = mysqli_query ($link, $qry2)  or die(mysqli_error($link));
				$result3 = mysqli_query ($link, $qry3)  or die(mysqli_error($link));
				if($result1 == false || $result2 == false || $result3 == false) {
					echo '<center><B><br>The query failed!</B></center><br><br>';
					exit();
				} else {
					//header('Location: Login.php');
					echo '<center><B><br>Book Return successful:)</B></center><br><br>';
				}
		}
	}

}

?>

<html>
<head>
<style>
#submit1 {
    background-color: blue;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-family: 'Oswald';
    font-size: 17px;
    text-decoration: none;
    cursor: pointer;
    
}
#submitBack {
    background-color: #000000;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-family: 'Oswald';
    font-size: 18px;
    text-decoration: none;
    cursor: pointer;
    border:none;
}
body {background-color: #c4def2;}
h1 {color: red;}
</style>
</head>
<body>

<center>
	<br><br>
	<U><I><h1>Book Returning Window</h1></I></U>
	<br>
	<form action="" method="post">
	<table>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username" required/></td>
		</tr>

		<tr>
			<td>ISBN</td>
			<td><input type="text" name="isbn" required/></td>
		</tr>

		<tr>
			<td>Penalty</td>
			<td><input type="number" name="penalty" min="0" step="0.01" required/></td>
		</tr>
	</table>
	<br>
	<input type="submit" value="Submit" id="submit1"/>
	</form>

	<br><br>
	<form action="AdminSummary.php" method="post">
	<input type="submit" value="Back" id="submitBack"/>
	</form>
</center>

</body>
</html>
