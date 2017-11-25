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
<body>
<h1>User Summary</h1>

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





<form action="Login.php" method="post">
<input type="submit" value="Logout"/>
</form>

</body>
</html>
