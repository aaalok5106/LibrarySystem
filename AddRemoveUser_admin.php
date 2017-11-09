<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

if(isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email']) and isset($_POST['DOB']) and isset($_POST['u_name']) and isset($_POST['passwd']) and isset($_POST['cnf_passwd']))  {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$name = "$firstname $lastname";
	$email = $_POST['email'];
	$DOB = $_POST['DOB'];
	$address = $_POST['address'];
	$gender = $_POST['gender'];
	$usertype = $_POST['usertype'];
	$dept = $_POST['dept'];
	
	$u_name = $_POST['u_name'];
	$passwd = $_POST['passwd'];
	$cnf_passwd = $_POST['cnf_passwd'];
	
	if($passwd == $cnf_passwd){
		$check_qry = "select * from user where Username='$u_name'";
		$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
		
		if(mysqli_num_rows($result0) > 0){
			echo 'This Username already exists, Try another Username!';
		} else{
			$insertStatement1 = "INSERT INTO user (Username, Password) VALUES ('$u_name', '$passwd')";
			$insertStatement2 = "INSERT INTO stud_fac_emp (Username, Name, DOB, Email, Gender, Address, UserType, Dept) VALUES ('$u_name', '$name', '$DOB', '$email', '$gender', '$address', '$usertype', '$dept')";
			$result1 = mysqli_query ($link, $insertStatement1)  or die(mysqli_error($link));
			$result2 = mysqli_query ($link, $insertStatement2)  or die(mysqli_error($link)); 
			if($result1 == false || $result2 == false) {
				echo 'The query failed.';
				exit();
			} else {
				//header('Location: Login.php');
				echo 'User Successfully Added';
			}
		}
	} else echo 'Password mismatch ERROR!';
} else if(isset($_POST['u_name1'])){
	$u_name1 = $_POST['u_name1'];
	
	$check_qry = "select * from user where Username='$u_name1'";
	$result0 = mysqli_query ($link, $check_qry)  or die(mysqli_error($link));
	
	if(mysqli_num_rows($result0) == 0){
		echo 'This Username does not exist. Please Enter valid Username.';
	} else{
		$deleteStatement1 = "delete from user where Username='$u_name1'";
		$deleteStatement2 = "delete from stud_fac_emp where Username='$u_name1'";
		
		$result1 = mysqli_query ($link, $deleteStatement1)  or die(mysqli_error($link));
		$result2 = mysqli_query ($link, $deleteStatement2)  or die(mysqli_error($link)); 
		if($result1 == false || $result2 == false) {
				echo 'The query failed.';
				exit();
			} else {
				//header('Location: Login.php');
				echo 'User Successfully Removed from Database';
			}
	}
}

?>

<html>
<body>

<h1>Add a User</h1>
<h3>Fill User Details</h3>
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
    <td>Username</td>
    <td><input type="text" name="u_name" required/></td>
</tr>

<tr>
    <td>Password</td>
    <td><input type="password" name="passwd" required/></td>
</tr>

<tr>
    <td>Confirm Pasword</td>
    <td><input type="password" name="cnf_passwd" required/></td>
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
    <td>User Type</td>
</tr>

<table>
<select name="usertype">
  <option value="student">Student</option>
  <option value="faculty">Faculty</option>
</select>
</table>

<tr>
    <td>User Department</td>
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


<h1>Delete a User from Database</h1>
<h3>Fill User Details</h3>
<form action="" method="post">
<table>
<tr>
    <td>Username</td>
    <td><input type="text" name="u_name1" required/></td>
</tr>
</table>
<input type="submit" value="Remove"/>
</form>

<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>


</body>
</html>
