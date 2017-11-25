<html>
<head>
<style>
#td1 {
    background-color:green;
    padding-left:200px;
    padding-right:200px;
    padding-top:50px;
    padding-bottom:50px;
}
#submit1 {
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
body {background-color: black;}
h1 {font-size:55px; color:#1c0063;}
</style>
</head>
<body>

<br><br><br><br><br><br>
<center>
<table>
	<tr>
		<td id="td1">
		<center>
			<h1>LOGIN</h1>
			<form method="post" action="Login_validate.php">
			<table cellspacing="12">
				<tr>
					<td><B>USERNAME</B></td>
					<td><input type="text" name="username" required/></td>
				</tr>
				<tr>
					<td><B>PASSWORD</B></td>
					<td><input type="password" name="password" required/></td>
				</tr>
			</table>
			<br>
			<input type="submit" value="Login" id="submit1"/>
			</form></center>
		</td>
	</tr>
</table>
</center>
<!--
<form action="NewUserRegistration.php" method="post">
<input type="submit" value="Create Account"/>
</form>
-->


</body>
</html>
