
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
<I><U><h1>Search Books</h1></I></U>
<br>
<form action="SearchBooksResult_admin.php" method="post">
<table>
	<tr>
		<td>ISBN</td>
		<td><input type="text" name="isbn"/></td>
	</tr>

	<tr>
		<td>Category</td>
		<td><input type="text" name="dept"/></td>
	</tr>

	<tr>
		<td>BookTitle</td>
		<td><input type="text" name="title"/></td>
	</tr>

	<tr>
		<td>Author</td>
		<td><input type="text" name="author"/></td>
	</tr>
</table>
<br>
<input type="submit" value="Search" id="submit1"/>
</form>

<br><br>
<form action="AdminSummary.php" method="post">
<input type="submit" value="Back" id="submitBack"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Logout" id="submitLogout"/>
</form>
</center>

</body>
</html>
