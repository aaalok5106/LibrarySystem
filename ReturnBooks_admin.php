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
					echo 'The query failed.';
					exit();
				} else {
					//header('Location: Login.php');
					echo 'Book Return successful:)';
				}
		}
	}

}

?>

<html>
<body>
<h1>Book Returning Window</h1>
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
<input type="submit" value="Submit"/>
</form>


<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>
