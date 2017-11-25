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

<center><I><h1>Books Issued on your Account</h1></I></center>
<table id="booksResult">
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


<br><br>
<center>
<form action="UserSummary.php" method="post">
<input type="submit" value="Back" id="submitForm"/>
</form>
</center>

</body>
</html>
