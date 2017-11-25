
<?php
include 'dbinfo.php'; 
?>  
<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$username = $_SESSION['username'];
?>

<html>
<head>
<style>
#td2 {
	padding-left:100px;
}
#submit1 {
    background-color: blue;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
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
#submitLogout {
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: red;
    font-family: 'Oswald';
    font-size: 20px;
    text-decoration: none;
    cursor: pointer;
    border:none;
}
body {background-color: #c4def2;}
h1 {color: red;}
</style>
</head>
<body>

<center>
	<br><br>
	<I><U><h1>Search for Users</h1></I></U>
	<br>
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
	<input type="submit" value="Search" id="submit1"/>
	</form>
</center>

<br><br>
<center>
<table>
	<tr>
		<td>
			<form action="SearchUserResult_admin.php" method="post">
				<input type="hidden" name="allstud" value="10">
				<input type="submit" value="List all Students" id="submit2">
			</form>
		</td>
		<td id="td2">
			<form action="SearchUserResult_admin.php" method="post">
				<input type="hidden" name="allfac" value="11">
				<input type="submit" value="List all Faculties" id="submit2">
			</form>
		</td>
	<tr>
</table>
</center>

<br><br><br>
<center>
<form action="AdminSummary.php" method="post">
<input type="submit" value="Back" id="submitBack"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Logout" id="submitLogout"/>
</form>
</center>

</body>
</html>
