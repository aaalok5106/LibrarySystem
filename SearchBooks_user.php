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
<h1>Search Books</h1>

<form action="SearchBooksResult_user.php" method="post">
<table>
<tr>
    <td>ISBN</td>
    <td><input type="text" name="isbn"/></td>
</tr>

<tr>
    <td>BooksTitle</td>
    <td><input type="text" name="title"/></td>
</tr>

<tr>
    <td>Department</td>
    <td><input type="text" name="dept"/></td>
</tr>

<tr>
    <td>Author</td>
    <td><input type="text" name="author"/></td>
</tr>

</table>
<input type="submit" value="Search"/>

</form>

<form action="UserSummary.php" method="post">
<input type="submit" value="Back"/>
</form>

<form action="Login.php" method="post">
<input type="submit" value="Close"/>
</form>

</body>
</html>
