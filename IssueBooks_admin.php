<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

if(isset($_POST['isbn']) and isset($_POST['username1']) ){
	$isbn = $_POST['isbn'];
	$username1 = $_POST['username1'];
	
	$check_qry="select * from issue where ISBN='$isbn' and Username='$username1'";
	$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
	if(mysqli_num_rows($result0) > 0) echo 'One Copy of this Book is Already Issued on your name!';
	else{
		$check_qry1="select * from user where Username='$username1'";
		$result00 = mysqli_query ($link, $check_qry1)  or die(mysqli_error($link));
		if(mysqli_num_rows($result00) == 0) echo 'Username does not exist!';
		else{
			$check_qry2="select IsReserved, AvailableCopy from book where ISBN='$isbn'";
			$result000 = mysqli_query ($link, $check_qry2)  or die(mysqli_error($link));
			if(mysqli_num_rows($result000) == 0) echo 'Invalid ISBN! Please Enter valid ISBN.';
			else{
				$row = mysqli_fetch_array($result000);
				$AvailableCopy = $row['AvailableCopy'];
				$IsReserved = $row['IsReserved'];
				if($AvailableCopy == 0) echo 'Currently NO copies of this Book are Available, Try Later.';
				else if($IsReserved == "yes"){
					echo 'Sorry! Reserved Copy!!! cannot be issued!';
				}
				else{
					$qry1 = "update book set AvailableCopy = AvailableCopy-1 where ISBN='$isbn'";
					$qry2 = "insert into issue(Username, ISBN, IssueDate, ReturnDate) values('$username1', '$isbn', current_date(), adddate(current_date(), interval 15 day) )";	// 15 days limit...
					$result1 = mysqli_query ($link, $qry1)  or die(mysqli_error($link));
					$result2 = mysqli_query ($link, $qry2)  or die(mysqli_error($link));
					if($result1 == false || $result2 == false) {
						echo 'The query failed.';
						exit();
					} else {
						//header('Location: Login.php');
						echo 'Book Issue successful:)';
					}
				}
			}
		}
	}

}

?>

<html>
<body>
<h1>Book Issuing Window</h1>
<form action="" method="post">
<table>
<tr>
    <td>Username</td>
    <td><input type="text" name="username1" required/></td>
</tr>

<tr>
    <td>ISBN</td>
    <td><input type="text" name="isbn" required/></td>
</tr>
</table>
<input type="submit" value="Update"/>
</form>


<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>
