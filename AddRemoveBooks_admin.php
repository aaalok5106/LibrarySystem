<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

if(isset($_POST['isbn']) and isset($_POST['title']) and isset($_POST['author']) and isset($_POST['edition']) and isset($_POST['publisher']) and isset($_POST['cost']) and isset($_POST['noofcopies']))  {
	$isbn = $_POST['isbn'];
	$title = $_POST['title'];
	$edition = $_POST['edition'];
	$publisher = $_POST['publisher'];
	$author = $_POST['author'];
	$cost = $_POST['cost'];
	$noofcopies = $_POST['noofcopies'];
	$AvailableCopy = $noofcopies;
	$isreserved = $_POST['isreserved'];
	$dept = $_POST['dept'];
	
	$check_qry="select * from book where ISBN='$isbn'";
	$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
	if(mysqli_num_rows($result0) > 0) echo 'Book with this ISBN already exists, Try Updating!';
	else{
		$insertStatement1 = "INSERT INTO book (ISBN, Title, Edition, Publisher, Author, Dept, Cost, IsReserved, NoOfCopy, AvailableCopy) VALUES ('$isbn', '$title', '$edition', '$publisher', '$author', '$dept', '$cost', '$isreserved', '$noofcopies', '$AvailableCopy')";
		$result1 = mysqli_query ($link, $insertStatement1)  or die(mysqli_error($link));
	 
		if($result1 == false ) {
			echo 'The query failed.';
			exit();
		} else {
			//header('Location: Login.php');
			echo 'Book Insertion successful';
		}
	}
} else if(isset($_POST['isbn1']) and isset($_POST['noofcopies1'])) {
	$isbn1 = $_POST['isbn1'];
	$noofcopies1 = $_POST['noofcopies1'];
	
	$check_qry="select * from book where ISBN='$isbn1'";
	$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
	if(mysqli_num_rows($result0) == 0) echo 'Book with this ISBN does not exist';
	else{
		$updateStatement1 = "update book set NoOfCopy=NoOfCopy+'$noofcopies1', AvailableCopy=AvailableCopy+'$noofcopies1' where ISBN='$isbn1'";
		$result1 = mysqli_query ($link, $updateStatement1)  or die(mysqli_error($link));
	 
		if($result1 == false ) {
			echo 'The query failed.';
			exit();
		} else {
			//header('Location: Login.php');
			echo 'Book Updation successful';
		}
	}
	
} else if(isset($_POST['isbn2'])) {
	$isbn2 = $_POST['isbn2'];
	
	$check_qry="select * from book where ISBN='$isbn2'";
	$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
	if(mysqli_num_rows($result0) == 0) echo 'Book with this ISBN does not exist';
	else{	// delete that ISBN from all tables...
		$deleteStatement1 = "delete from issue where ISBN='$isbn2'";
		$deleteStatement2 = "delete from book where ISBN='$isbn2'";
		$result1 = mysqli_query ($link, $deleteStatement1)  or die(mysqli_error($link));
		$result2 = mysqli_query ($link, $deleteStatement2)  or die(mysqli_error($link));
	 
		if($result1 == false || $result2 == false) {
			echo 'The query failed.';
			exit();
		} else {
			//header('Location: Login.php');
			echo 'Book Data Deletion successful';
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
#submit1 {
    background-color: #939aed;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: black;
    font-family: 'Oswald';
    font-size: 18px;
    text-decoration: none;
    cursor: pointer;
    
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
body {background-color: #939aed;}

</style>
</head>
<body>
<center>
<U><h1>Add Book Section</h1></U>
<h3>Fill Book Details</h3>
<form action="" method="post">
<table>
	<tr>
		<td>ISBN</td>
		<td><input type="text" name="isbn" required/></td>
	</tr>
	<tr>
		<td>Title of Book</td>
		<td><input type="text" name="title" required/></td>
	</tr>

	<tr>
		<td>Edition</td>
		<td><input type="text" name="edition" required/></td>
	</tr>

	<tr>
		<td>Publisher</td>
		<td><input type="text" name="publisher" required/></td>
	</tr>

	<tr>
		<td>Authors</td>
		<td><input type="text" name="author" required/></td>
	</tr>

	<tr>
		<td>Cost</td>
		<td><input type="number" name="cost" min="0" step="0.01" required/></td>
	</tr>

	<tr>
		<td># of copies</td>
		<td><input type="number" name="noofcopies" min="1" step="1" required/></td>
	</tr>

	<tr>
		<td>Is the Book Reserved</td>
		<td>
			<select name="isreserved">
			  <option value="no">No</option>
			  <option value="yes">Yes</option>
			</select>
		</td>
	</tr>

	<tr>
		<td>Book Category</td>
		<td>
			<select name="dept">
			  <option value="Computer Science & Engineering">Computer Science & Engineering</option>
			  <option value="Electrical Engineering">Electrical Engineering</option>
			  <option value="Mechanical Engineering">Mechanical Engineering</option>
			  <option value="Civil Engineering">Civil Engineering</option>
			  <option value="Chemical Engineering">Chemical Engineering</option>
			  <option value="Mathematics & Computing">Mathematics & Computing</option>
			  <option value="Mathematics">Mathematics</option>
			  <option value="HSS Department">HSS Department</option>
			  <option value="Mathematics">Mathematics</option>
			  <option value="Physics">Physics</option>
			  <option value="Chemistry">Chemistry</option>
			  <option value="Fictional Books">Fictional Books</option>
			  <option value="Biography">Biography</option>
			</select>
		</td>
	</tr>
</table>
<br>
<input type="submit" value="Submit" id="submit1"/>
</form>
</center>

<br>


<table style="width:100%">
	<tr>
		<td id="tableData2">
			<center>
				<U><h1>Update Book Section</h1></U>
				<h3>Enter Book Details</h3>
				<form action="" method="post">
				<table>
					<tr>
						<td>ISBN</td>
						<td><input type="text" name="isbn1" required/></td>
					</tr>

					<tr>
						<td># of copies added</td>
						<td><input type="number" name="noofcopies1" min="1" step="1" required/></td>
					</tr>
				</table>
				<br>
				<input type="submit" value="Update" id="submit2"/>
				</form>
			</center>
		</td>
		<td id="tableData3">
			<center>
				<U><h1>Delete Book Section</h1></U>
				<h3>Enter Book Details</h3>
				<form action="" method="post">
				<table>
					<tr>
						<td>ISBN</td>
						<td><input type="text" name="isbn2" required/></td>
					</tr>
				</table>
				<br>
				<input type="submit" value="Delete" id="submit3"/>
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
