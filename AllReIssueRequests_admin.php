<?php
include 'dbinfo.php'; 
?>  
<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 

$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");
$username = $_SESSION['username'];

if ($_POST['allreissue'] != null) {
	# code...
	$allreissue = $_POST['allreissue'];
	//Our SQL Query
	$sql_query2 = "select issue.Username, ISBN, Name, Email, UserType, Dept, Penalty, IssueDate, ReturnDate, NoOfExtention FROM issue inner join stud_fac_emp on issue.Username=stud_fac_emp.Username WHERE ExtRequest='requested'";
	 //Run our sql query
	   $result2 = mysqli_query ($link, $sql_query2)  or die(mysqli_error($link));  
		if($result2 == false)
		{
			echo 'The query by AllStudent failed.';
			exit();
		}			

}
else{
	echo 'Sorry! Request cannot be performed.';
}


?>


<html>
<body>

<h2>List of Users</h2>
<table border="1" style="width:100%">
  <tr>
  	<th>Select</th>
    <th>Username</th>
    <th>ISBN</th>
    <th>Name of User</th>
    <th>Email</th>
    <th>Type of User</th>
    <th>Department</th>
    <th>Penalty Amount</th>
    <th>IssueDate</th>
    <th>ReturnDate</th>
    <th>NoOfExtention</th>

  </tr>
  <?php while($row = mysqli_fetch_array($result2)){ 
    
	$Username = $row['Username'];
	$ISBN = $row['ISBN'];
	$Name = $row['Name'];
	$Email = $row['Email'];
	$UserType = $row['UserType'];
	$Department = $row['Dept'];
	$PenaltyAmount = $row['Penalty'];
	$IssueDate = $row['IssueDate'];
	$ReturnDate = $row['ReturnDate'];
	$NoOfExtention = $row['NoOfExtention'];
	
  ?>
  
  <tr>
  	<td>
  		<select name="selection">
		  <option value="accepted">Accept</option>
		  <option value="rejected">Reject</option>
		</select>
		</form>
	</td>
    <td><?php echo $Username; ?></td>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $Name; ?></td>
    <td><?php echo $Email; ?></td>
    <td><?php echo $UserType; ?></td>
    <td><?php echo $Department; ?></td>
    <td><?php echo $PenaltyAmount; ?></td>
    <td><?php echo $IssueDate; ?></td>
    <td><?php echo $ReturnDate; ?></td>
    <td><?php echo $NoOfExtention; ?></td>
  </tr>
<?php
}
?>
</table>


<br><br>
<form action="ReissueBooks_admin.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>
