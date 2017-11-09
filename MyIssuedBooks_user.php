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

if($_POST['myissuedbooks'] != null)  {
	$myissuedbooks = $_POST['myissuedbooks'];  
	// store session data
	$_SESSION['myissuedbooks']=$myissuedbooks;
	//Our SQL Query
	$sql_query1 = "select issue.ISBN, Title, Edition, Publisher, Dept, IssueDate, ReturnDate, NoOfExtention from issue, book where issue.ISBN=book.ISBN and Username='$username'";
	//Run our sql query
    $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));	
	if($result1 == false)
	{
		echo 'The query for Issued Books failed.';
		exit();
	}
					
} else {
	header('Location: UserSummary.php');
}

?>

<html>
<body>

<h2>Books Issues under your name</h2>
<table border="1" style="width:100%">
  <tr>
    <th>ISBN</th>
    <th>Title of Book</th>
    <th>Edition</th>
    <th>Publisher</th>
    <th>Department</th>
    <th>IssueDate</th>
    <th>ReturnDate</th>
    <th>NoOfExtention</th>
   

  </tr>
  <?php while($row = mysqli_fetch_array($result1)){ 
	  
	$ISBN = $row['ISBN'];
	$Title = $row['Title'];
	$Edition = $row['Edition'];
	$Publisher = $row['Publisher'];
	$Dept = $row['Dept'];
	$IssueDate = $row['IssueDate'];
	$ReturnDate = $row['ReturnDate'];
	$NoOfExtention = $row['NoOfExtention'];

  ?>
  <tr>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $Edition; ?></td>
    <td><?php echo $Publisher; ?></td>
    <td><?php echo $Dept; ?></td>
    <td><?php echo $IssueDate; ?></td>
    <td><?php echo $ReturnDate; ?></td>
    <td><?php echo $NoOfExtention; ?></td>
    
  </tr>
<?php
}
?>
</table>



<form action="UserSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>
