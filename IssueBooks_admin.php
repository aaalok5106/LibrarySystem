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
	if(mysqli_num_rows($result0) > 0) echo '<center><B><br>One Copy of this Book is Already Issued on your name!</B></center><br><br>';
	else{
		$check_qry1="select * from user where Username='$username1'";
		$result00 = mysqli_query ($link, $check_qry1)  or die(mysqli_error($link));
		if(mysqli_num_rows($result00) == 0) echo '<center><B><br>Username does not exist!</B></center><br><br>';
		else{
			$check_qry2="select IsReserved, AvailableCopy from book where ISBN='$isbn'";
			$result000 = mysqli_query ($link, $check_qry2)  or die(mysqli_error($link));
			if(mysqli_num_rows($result000) == 0) echo '<center><B><br>Invalid ISBN! Please Enter valid ISBN.</B></center><br><br>';
			else{
				$row = mysqli_fetch_array($result000);
				$AvailableCopy = $row['AvailableCopy'];
				$IsReserved = $row['IsReserved'];
				if($AvailableCopy == 0) echo '<center><B><br>Currently NO copies of this Book are Available, Try Later.</B></center><br><br>';
				else if($IsReserved == "yes"){
					echo '<center><B><br>Sorry! Reserved Copy!!! cannot be issued!</B></center><br><br>';
				}
				else{
					$qry1 = "update book set AvailableCopy = AvailableCopy-1 where ISBN='$isbn'";
					$qry2 = "insert into issue(Username, ISBN, IssueDate, ReturnDate) values('$username1', '$isbn', current_date(), adddate(current_date(), interval 15 day) )";	// 15 days limit...
					$result1 = mysqli_query ($link, $qry1)  or die(mysqli_error($link));
					$result2 = mysqli_query ($link, $qry2)  or die(mysqli_error($link));
					if($result1 == false || $result2 == false) {
						echo '<center><B><br>The query failed!</B></center><br><br>';
						exit();
					} else {
						echo '<center><B><br>Book Issue successful:)</B></center><br><br>';
					}
				}
			}
		}
	}

} else if(isset($_POST['isbn2']) and isset($_POST['username2']) and isset($_POST['penalty2'])){
	$isbn = $_POST['isbn2'];
	$username = $_POST['username2'];
	$penalty = $_POST['penalty2'];
	
	$check_qry="select * from issue where ISBN='$isbn' and Username='$username'";
	$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
	if(mysqli_num_rows($result0) == 0) echo '<center><B><br>This Book is NOT Issued on your name!</B></center><br><br>';
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
					echo '<center><B><br>Book Return successful:)</B></center><br><br>';
				}
		}
	}

}

?>

<html>
<head>
<style>
#tableData2 {
    background-color:green;
    width:50%;
}
#tableData3 {
    background-color:red;
    width:50%;
}
#submit2 {
    background-color: green;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-family: 'Oswald';
    font-size: 18px;
    text-decoration: none;
    cursor: pointer;
    
}
#submit3 {
    background-color: red;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-family: 'Oswald';
    font-size: 18px;
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
    font-size: 20px;
    text-decoration: none;
    cursor: pointer;
    border:none;
}
body {background-color: #c4def2;}

</style>
</head>
<body>
<br>
<table style="width:100%">
	<tr>
		<td id="tableData2">
			<center>
				<I><U><h1>Book Issuing Panel</h1></I></U>
				<br>
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
				<br>
				<input type="submit" value="Update" id="submit2"/>
				</form>

			</center>
		</td>
		<td id="tableData3">
			<center>
				<U><I><h1>Book Returning Panel</h1></I></U>
				<br>
				<form action="" method="post">
				<table>
					<tr>
						<td>Username</td>
						<td><input type="text" name="username2" required/></td>
					</tr>

					<tr>
						<td>ISBN</td>
						<td><input type="text" name="isbn2" required/></td>
					</tr>

					<tr>
						<td>Penalty</td>
						<td><input type="number" name="penalty2" min="0" step="0.01" required/></td>
					</tr>
				</table>
				<br>
				<input type="submit" value="Submit" id="submit3"/>
				</form>

			</center>
		</td>
</table>


<br><br><br>
<center>
<form action="AdminSummary.php" method="post">
<input type="submit" value="Back" id="submitBack"/>
</form>
</center>




</body>
</html>
