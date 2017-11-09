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

if($_POST['checkedbooks'] != null)  {
	$checkedbooks = $_POST['checkedbooks'];  
	// store session data
	$_SESSION['checkedbooks']=$checkedbooks;
	//Our SQL Query
	$sql_query1 = "select issue.ISBN, Title, Edition, Publisher, Cost, IssueDate, ReturnDate, NoOfExtention, issue.Username, Name, UserType, Email from issue, book, stud_fac_emp as sf where issue.ISBN=book.ISBN and issue.Username=sf.Username";
	//Run our sql query
    $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));	
	if($result1 == false)
	{
		echo 'The query by Issued Books failed.';
		exit();
	}
					
} else {
	header('Location: AdminSummary.php');
}

?>

<html>
<body>

<h2>Unreturned Book Details</h2>
<table border="1" style="width:100%">
  <tr>
    <th>ISBN</th>
    <th>Title of Book</th>
    <th>Edition</th>
    <th>Publisher</th>
    <th>Cost</th>
    <th>IssueDate</th>
    <th>ReturnDate</th>
    <th># Extention Taken</th>
    <th>Username</th>
    <th>Name</th>
    <th>UserType</th>
    <th>Email</th>

  </tr>
  <?php while($row = mysqli_fetch_array($result1)){ 
	  
	$ISBN = $row['ISBN'];
	$Title = $row['Title'];
	$Edition = $row['Edition'];
	$Publisher = $row['Publisher'];
	$Cost = $row['Cost'];
	$IssueDate = $row['IssueDate'];
	$ReturnDate = $row['ReturnDate'];
	$NoOfExtention = $row['NoOfExtention'];
	$Username = $row['Username'];
	$Name = $row['Name'];
	$UserType = $row['UserType'];
	$Email = $row['Email'];
  ?>
  <tr>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $Edition; ?></td>
    <td><?php echo $Publisher; ?></td>
    <td><?php echo $Cost; ?></td>
    <td><?php echo $IssueDate; ?></td>
    <td><?php echo $ReturnDate; ?></td>
    <td><?php echo $NoOfExtention; ?></td>
    <td><?php echo $Username; ?></td>
    <td><?php echo $Name; ?></td>
    <td><?php echo $UserType; ?></td>
    <td><?php echo $Email; ?></td>
  </tr>
<?php
}
?>
</table>



<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>
