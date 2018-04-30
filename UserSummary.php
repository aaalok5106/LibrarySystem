<?php
include 'dbinfo.php'; 
?>  
<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 
$username = $_SESSION['username'];
unset($_SESSION['isbn']);
unset($_SESSION['copyid']);	
?>


<html>
<head>
	<title>Welcome</title>
	<style type="text/css">
		.button input[type=submit]{
	width: 260px;
	height: 50px;
	background: green;
	border: 1px solid #fff;
	cursor: pointer;
	border-radius: 5px;
	color: #a18d6c;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 6px;
	margin-top: 10px;
	</style>
</head>
<body>
<h1>User Summary</h1>
<center>

<div class="button">

<form action="SearchBooks_user.php" method="post">
	<input type="submit" value="Search Books"/>
</form>

<form action="MyIssuedBooks_user.php" method="post">
	<input type="hidden" name="myissuedbooks" value="69">
	<input type="submit" value="My Issued Books"/>
</form>


<form action="ReIssueRequest_user.php" method="post">
	<input type="hidden" name="myissuedbooks" value="89">
	<input type="submit" value="Re-Issue Request"/>
</form>
</div>
</center>





<form action="Login.php" method="post">
<input type="submit" value="Logout"/>
</form>

</body>
</html>
