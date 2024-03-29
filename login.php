<?php
require_once("ClassUser.php");
$user = new User;
$user->logout();
?>

<!doctype html>
<html>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="login.js"></script> 
<link rel="stylesheet" type="text/css" href="form.css">
<title>Login</title>
</head>
<body>
<form id="loginForm" method="POST" action="login-process.php">
<div>
 <fieldset>
 <legend>Login</legend>
 <div id="errorDiv">
<?php 
 if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) {
 unset($_SESSION['formAttempt']);
 print "Errors encountered<br />\n";
 foreach ($_SESSION['error'] as $error) {
 print $error . "<br />\n";
 } //end foreach
 } //end if
?>
</div>
 <label for="username">Username:* </label>
 <input type="text" id="username" name="username">
 <span class="errorFeedback errorSpan" 
id="usernameError">Username is required</span>
 <br />
 <label for="password">Password:* </label>
 <input type="password" id="password" name="password">
 <span class="errorFeedback errorSpan" 
id="passwordError">Password required</span>
 <br />
 <input type="submit" id="submit" name="submit">
 </fieldset>
</div>
</form>
</body>
</html>