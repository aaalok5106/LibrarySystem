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

if($_POST['isbn'] != null)  { // ISBN
	$isbn = $_POST['isbn'];  
	// store session data
	//Our SQL Query
	$sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where ISBN = '$isbn' AND IsReserved = 'no'";
	//Run our sql query
    $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));	
	if($result1 == false)
	{
		echo 'The query by ISBN failed.';
		exit();
	}
	//Our SQL Query
	$sql_query2 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where ISBN = '$isbn' AND IsReserved = 'yes'";
	//Run our sql query
   $result2 = mysqli_query ($link, $sql_query2)  or die(mysqli_error($link));  
	if($result2 == false)
	{
		echo 'The query by ISBN failed.';
		exit();
	}	
	
						
} elseif ($_POST['dept'] != null) {
	$dept = $_POST['dept'];  
	// store session data
	$_SESSION['dept']=$dept;
	//Our SQL Query
	$sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Dept like '%$dept%' AND IsReserved = 'no'";
	 //Run our sql query
	   $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));  
		if($result1 == false)
		{
			echo 'The query by Title failed.';
			exit();
		}	
	$sql_query2 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Dept like '%$dept%' AND IsReserved = 'yes'";
	//Run our sql query
   $result2 = mysqli_query ($link, $sql_query2)  or die(mysqli_error($link));  
	if($result2 == false)
	{
		echo 'The query by Category failed.';
		exit();
	}	
	
		
}elseif ($_POST['title'] != null) {
	$title = $_POST['title'];  
	// store session data
	$_SESSION['title']=$title;
	//Our SQL Query
	$sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Title like '%$title%' AND IsReserved = 'no'";
	 //Run our sql query
	   $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));  
		if($result1 == false)
		{
			echo 'The query by Title failed.';
			exit();
		}	
	$sql_query2 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Title like '%$title%' AND IsReserved = 'yes'";
	//Run our sql query
   $result2 = mysqli_query ($link, $sql_query2)  or die(mysqli_error($link));  
	if($result2 == false)
	{
		echo 'The query by ISBN failed.';
		exit();
	}	
	
		
} elseif ($_POST['author'] != null) {	// author part not complete...
	$author = $_POST['author'];  
	// store session data
	$_SESSION['author']=$author;
	//Our SQL Query
	$sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Author like '%$author%' AND IsReserved = 'no'";
	 //Run our sql query
	   $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));  
		if($result1 == false)
		{
			echo 'The query by Author failed.';
			exit();
		}	
	//Our SQL Query
	$sql_query2 = "Select ISBN, Title, Edition, Publisher, Author, Dept, Cost, NoOfCopy, AvailableCopy From book Where Author like '%$author%' AND IsReserved = 'yes'";
	 //Run our sql query
	   $result2 = mysqli_query ($link, $sql_query2)  or die(mysqli_error($link));  
		if($result1 == false)
		{
			echo 'The query by Author failed.';
			exit();
		}	
		
				
} else {
	header('Location: SearchBooks_admin.php');
}

?>

<html>
<body>

<h2>Unreserved Books</h2>
<table border="1" style="width:100%">
  <tr>
    <th>ISBN</th>
    <th>Title of Book</th>
    <th>Edition</th>
    <th>Publisher</th>
    <th>Author</th>
    <th>Department</th>
    <th>Cost</th>
    <th># Total Copies</th>
    <th># Available Copies</th>

  </tr>
  <?php while($row = mysqli_fetch_array($result1)){ 
	  
	$ISBN = $row['ISBN'];
	$Title = $row['Title'];
	$Edition = $row['Edition'];
	$Publisher = $row['Publisher'];
	$Author = $row['Author'];
	$Dept = $row['Dept'];
	$Cost = $row['Cost'];
	$NoOfCopy = $row['NoOfCopy'];
	$AvailableCopy = $row['AvailableCopy'];
	
  ?>
  <tr>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $Edition; ?></td>
    <td><?php echo $Publisher; ?></td>
    <td><?php echo $Author; ?></td>
    <td><?php echo $Dept; ?></td>
    <td><?php echo $Cost; ?></td>
    <td><?php echo $NoOfCopy; ?></td>
    <td><?php echo $AvailableCopy; ?></td>
  </tr>
<?php
}
?>
</table>


<h2>Reserved Books</h2>
<table border="1" style="width:100%">
  <tr>
    <th>ISBN</th>
    <th>Title of Book</th>
    <th>Edition</th>
    <th>Publisher</th>
    <th>Author</th>
    <th>Department</th>
    <th>Cost</th>
    <th># Total Copies</th>
    <th># Available Copies</th>

  </tr>
  <?php while($row = mysqli_fetch_array($result2)){ 
    
	$ISBN = $row['ISBN'];
	$Title = $row['Title'];
	$Edition = $row['Edition'];
	$Publisher = $row['Publisher'];
	$Author = $row['Author'];
	$Dept = $row['Dept'];
	$Cost = $row['Cost'];
	$NoOfCopy = $row['NoOfCopy'];
	$AvailableCopy = $row['AvailableCopy'];
	
  ?>
  <tr>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $Edition; ?></td>
    <td><?php echo $Publisher; ?></td>
    <td><?php echo $Author; ?></td>
    <td><?php echo $Dept; ?></td>
    <td><?php echo $Cost; ?></td>
    <td><?php echo $NoOfCopy; ?></td>
    <td><?php echo $AvailableCopy; ?></td>
  </tr>
<?php
}
?>
</table>
</form>

<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>
