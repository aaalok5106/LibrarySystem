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
<head>
<style>
#booksResult {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
#booksResult td, #booksResult th {
    border: 1px solid #ddd;
    padding: 8px;
}
#booksResult tr:nth-child(even){background-color: #dbf4f9;}
#booksResult tr:nth-child(odd){background-color: #dcdff7;}
#booksResult tr:hover {background-color: #aaf7bd;}
#booksResult th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
#submitForm {
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
body {background-color: #e8eff9;}
h1 {color:red;}

</style>
</head>
<body>

<center><I><h1>Re-Issue Requests</h1></I></center>
<table id="booksResult">
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
<center>
<form action="ReissueBooks_admin.php" method="post">
<input type="submit" value="Back" id="submitForm"/>
</form>
</center>

</body>
</html>
