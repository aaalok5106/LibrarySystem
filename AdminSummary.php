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
<body>
<h1>Admin Summary</h1>

<form action="SearchUser_admin.php" method="post">
	<input type="submit" value="Search among Users"/>
</form>

<form action="SearchBooks_admin.php" method="post">
	<input type="submit" value="Search Books"/>
</form>

<form action="TrackUnreturnedBooks_admin.php" method="post">
	<input type="hidden" name="checkedbooks" value="99">
	<input type="submit" value="Track Unreturned Books">
</form>

<form action="AddRemoveBooks_admin.php" method="post">
	<input type="submit" value="Add or Remove Books"/>
</form>

<form action="AddRemoveUser_admin.php" method="post">
	<input type="submit" value="Add or Remove Users"/>
</form>

<form action="IssueBooks_admin.php" method="post">
	<input type="submit" value="Issue Books"/>
</form>

<form action="ReissueBooks_admin.php" method="post">
	<input type="submit" value="Re-Issue Books"/>
</form>

<form action="ReturnBooks_admin.php" method="post">
	<input type="submit" value="Return Books"/>
</form>






<form action="Login.php" method="post">
<input type="submit" value="Close"/>
</form>

</body>
</html>
