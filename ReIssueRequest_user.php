<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

$username = $_SESSION['username'];
if(isset($_POST['isbn1']) ){
	$isbn1 = $_POST['isbn1'];
	
	$check_qry = "select * from issue where Username='$username' and ISBN='$isbn1'";
	$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
	if(mysqli_num_rows($result0) == 0) echo 'This book is not issued on your name, Please enter valid ISBN';
	else{
		$row = mysqli_fetch_array($result0);
		$ExtRequest = $row['ExtRequest'];
		if($ExtRequest == "requested"){
			echo 'You have already Requested for Re-Issue, But it is not yet approved :(';
		} else{
			$qry1 = "update issue set ExtRequest='requested' where Username='$username' and ISBN='$isbn1'";
			$result1 = mysqli_query ($link, $qry1)  or die(mysqli_error($link));
			if($result1 == true) echo 'Re-Issue request successfully sent, It will be approved/rejected by Admin. Meanwhile you can see your approval status.';
			else echo 'Query for Re-Issue request Failed!';
		}
	}

} else if(isset($_POST['isbn2'])){
	$isbn2 = $_POST['isbn2'];
	
	$check_qry = "select * from issue where Username='$username' and ISBN='$isbn2'";
	$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
	if(mysqli_num_rows($result0) == 0) echo 'This book is not issued on your name, Please enter valid ISBN';
	else{
		$row = mysqli_fetch_array($result0);
		$ExtRequest = $row['ExtRequest'];
		if($ExtRequest == "requested"){
			echo 'Your last Re-Issue request is not yet approved :(';
		} else if($ExtRequest == "rejected"){
			echo 'Your last Re-Issue request has been Rejected, Please contact Admin or You can send re-issue request again.';
		} else if($ExtRequest == "accepted"){
			echo 'Your last Re-Issue request has been Accepted :) . You can see your Return deadlines in *My Issued Book* section.';
		
		} else echo 'No Re-Issue request has been sent for this Book.';
		
	}

}

?>



<html>
<body>

<h1>Request Re-Issuing an Issued Book</h1>
<form action="" method="post">
<table>
<tr>
    <td>ISBN</td>
    <td><input type="text" name="isbn1" required/></td>
</tr>
</table>
<input type="submit" value="Send Request" />
</form>


<h1>Check Re-Issue Approval Status</h1>
<form action="" method="post">
<table>
<tr>
    <td>ISBN</td>
    <td><input type="text" name="isbn2" required/></td>
</tr>
</table>
<input type="submit" value="Check Status" />
</form>


<form action="UserSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>
