<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

if(isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email']) and isset($_POST['DOB']))  {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$name = "$firstname $lastname";
	$email = $_POST['email'];
	$DOB = $_POST['DOB'];
	$address = $_POST['address'];
	$gender = $_POST['gender'];
	$usertype = $_POST['usertype'];
	
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$dept = $_POST['dept'];
	
	
	$insertStatement1 = "INSERT INTO user (Username, Password) VALUES ('$username', '$password')";
	$result1 = mysqli_query ($link, $insertStatement1)  or die(mysqli_error($link));

	$insertStatement2 = "INSERT INTO stud_fac_emp (Username, Name, DOB, Email, Gender, Address,
	UserType, Dept) VALUES ('$username', '$name', '$DOB', '$email', '$gender', '$address', '$usertype', '$dept')";
	$result2 = mysqli_query ($link, $insertStatement2)  or die(mysqli_error($link)); 
	if($result1 == false || $result2 == false) {
		echo 'The query failed.';
		exit();
	} else {
		header('Location: Login.php');
	}
} 


?>

<html>
<body>
<h1>Create Profile</h1>

<form action="" method="post">
<table>
<tr>
    <td>First Name</td>
    <td><input type="text" name="firstname" required/></td>
</tr>
<tr>
    <td>Last Name</td>
    <td><input type="text" name="lastname" required/></td>
</tr>

<tr>
    <td>D.O.B (yyyy-mm-dd)</td>
    <td><input type="text" name="DOB" required/></td>
</tr>

<tr>
    <td>Email</td>
    <td><input type="text" name="email" required/></td>
</tr>

<tr>
    <td>Address</td>
    <td><textarea name="address" rows="5" cols="30"></textarea></td>
</tr>

</table>


<tr>
    <td>Gender</td>

</tr>


<select name="gender">
  <option value="M">Male</option>
  <option value="F">Female</option>
</select>


<tr>
    <td>You are</td>

</tr>

<table>
<select name="usertype">
  <option value="student">Student</option>
  <option value="faculty">Faculty</option>
</select>
</table>


<tr>
    <td>Associate Department</td>

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
</select>
</table>


<input type="submit" value="submit"/>
</form>
</body>
</html>
