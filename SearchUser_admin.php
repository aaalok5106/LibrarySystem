<html>
<?php
include 'dbinfo.php'; 
?>  
<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$username = $_SESSION['username'];
?> 
<body>
<h1>Search for Users</h1>

<form action="SearchUserResult_admin.php" method="post">
<table>
<tr>
    <td>Username</td>
    <td><input type="text" name="username"/></td>
</tr>

<tr>
    <td>Department</td>
    <td><input type="text" name="department"/></td>
</tr>


<tr>
    <td>Name</td>
    <td><input type="text" name="name"/></td>
</tr>

</table>
<input type="submit" value="Search"/>

</form>


<form action="SearchUserResult_admin.php" method="post">
	<input type="hidden" name="allstud" value="10">
	<input type="submit" value="List all Students">
</form>

<form action="SearchUserResult_admin.php" method="post">
	<input type="hidden" name="allfac" value="11">
	<input type="submit" value="List all Faculties">
</form>



<form action="AdminSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Close"/>
</form>

</body>
</html>
