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
	$sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, AvailableCopy From book Where ISBN = '$isbn' AND IsReserved = 0";
	//Run our sql query
    $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));
    
	if($result1 == false)
	{
		echo 'The query by ISBN failed.';
		exit();
	}
							
} elseif ($_POST['title'] != null) {
	$title = $_POST['title'];  
	// store session data
	$_SESSION['title']=$title;
	//Our SQL Query
	$sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, AvailableCopy From book Where Title like '%$title%' AND IsReserved = 0";
	 //Run our sql query
	   $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));  
		if($result1 == false)
		{
			echo 'The query by Title failed.';
			exit();
		}	
			
} elseif ($_POST['dept'] != null) {
	$title = $_POST['dept'];  
	// store session data
	$_SESSION['dept']=$dept;
	//Our SQL Query
	$sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, AvailableCopy From book Where Title like '%$dept%' AND IsReserved = 0";
	 //Run our sql query
	   $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));  
		if($result1 == false)
		{
			echo 'The query by Department failed.';
			exit();
		}	
			
} elseif ($_POST['author'] != null) {	//ChecK it Later...
	$author = $_POST['author'];  
	// store session data
	$_SESSION['author']=$author;
	//Our SQL Query
	$sql_query1 = "Select ISBN, Title, Edition, Publisher, Author, Dept, AvailableCopy From book Where Author like '%$author%' AND IsReserved = 0";
	 //Run our sql query
	   $result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));  
		if($result1 == false)
		{
			echo 'The query by Author failed.';
			exit();
		}	
		
} else {
	header('Location: SearchBooks_user.php');
}
$numrow = mysqli_num_rows($result1);
if($numrow == 0){
	echo 'There are no available copies right now.';
}
?>
<html>
<body>
<h1>Search Results for Books</h1>

<table border="1" style="width:100%">
  <tr>
    <th>ISBN</th>
    <th>Title of the book</th>
    <th>Edition</th>
    <th>Publisher</th>
    <th>Authors</th>
    <th>Department</th>
    <th># copies available</th>

  </tr>
  <?php while($row = mysqli_fetch_array($result1)){ 
	  
	$ISBN = $row['ISBN'];
	$Title = $row['Title'];
	$Edition = $row['Edition'];
	$publisher = $row['Publisher'];
	$Author = $row['Author'];
	$dept = $row['Dept'];
	$available = $row['AvailableCopy'];
  ?>
  <tr>
    <td><?php echo $ISBN; ?></td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $Edition; ?></td>
    <td><?php echo $publisher; ?></td>
    <td><?php echo $Author; ?></td>
    <td><?php echo $dept; ?></td>
    <td><?php echo $available; ?></td>
  </tr>
<?php
}
?>
</table>


<form action="SearchBooks_user.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>
