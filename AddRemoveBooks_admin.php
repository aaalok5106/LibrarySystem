<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

if(isset($_POST['isbn']) and isset($_POST['title']) and isset($_POST['edition']) and isset($_POST['publisher']) and isset($_POST['cost']) and isset($_POST['noofcopies']))  {
	$isbn = $_POST['isbn'];
	$title = $_POST['title'];
	$edition = $_POST['edition'];
	$publisher = $_POST['publisher'];
	$cost = $_POST['cost'];
	$noofcopies = $_POST['noofcopies'];
	$AvailableCopy = $noofcopies;
	$isreserved = $_POST['isreserved'];
	$dept = $_POST['dept'];
	
	$check_qry="select * from book where ISBN='$isbn'";
	$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
	if(mysqli_num_rows($result0) > 0) echo 'Book with this ISBN already exists, Try Updating!';
	else{
		$insertStatement1 = "INSERT INTO book (ISBN, Title, Edition, Publisher, Dept, Cost, IsReserved, NoOfCopy, AvailableCopy) VALUES ('$isbn', '$title', '$edition', '$publisher', '$dept', '$cost', '$isreserved', '$noofcopies', '$AvailableCopy')";
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
<body>
<h1>Add Book Section</h1>
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
    <td>Cost</td>
    <td><input type="number" name="cost" min="0" step="0.01" required/></td>
</tr>

<tr>
    <td># of copies</td>
    <td><input type="number" name="noofcopies" min="1" step="1" required/></td>
</tr>

</table>



<tr>
    <td>Is the Book Reserved</td>
</tr>

<select name="isreserved">
  <option value="no">No</option>
  <option value="yes">Yes</option>
</select>

<tr>
    <td>Book Category</td>
</tr>
</table>
<table>
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
</table>


<input type="submit" value="Submit"/>
</form>



<h1>Update Book Section</h1>
<h3>Fill Book Details</h3>
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
<input type="submit" value="Update"/>
</form>


<h1>Delete a Book from Database</h1>
<h3>Fill Book Details</h3>
<form action="" method="post">
<table>
<tr>
    <td>ISBN</td>
    <td><input type="text" name="isbn2" required/></td>
</tr>
</table>
<input type="submit" value="Delete"/>
</form>

<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

</body>
</html>
