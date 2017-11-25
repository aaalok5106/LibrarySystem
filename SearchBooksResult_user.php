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

<center><I><h1>Search Results for Books</h1></I></center>
<table id="booksResult">
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

<br><br>
<center>
<form action="SearchBooks_user.php" method="post">
<input type="submit" value="Back" id="submitForm"/>
</form>
</center>

</body>
</html>
