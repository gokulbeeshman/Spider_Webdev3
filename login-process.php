<?php
require_once('ClassUser.php');
//prevent access if they haven't submitted the form.
if (!isset($_POST['submit'])) {
	die(header("Location: login.php"));
}
$_SESSION['formAttempt'] = true;
if (isset($_SESSION['error'])) {
 unset($_SESSION['error']);
}
$_SESSION['error'] = array();
$required = array("username","password");
//Check required fields
foreach ($required as $requiredField) {
if (!isset($_POST[$requiredField]) || $_POST[$requiredField] 
== "") {
 $_SESSION['error'][] = $requiredField . " is 
required.";
 } 
}
if (!preg_match('/^[\w .]+$/',$_POST['username'])) {
 $_SESSION['error'][] = "Username must be letters and 
numbers only.";
}
if (count($_SESSION['error']) > 0) {
 die(header("Location: login.php"));
} else {
 $user = new User;
if ($user->authenticate($_POST['username'],$_POST['password'])) 
{
 unset($_SESSION['formAttempt']);
 die(header("Location: authenticated.php"));
 } else {
 $_SESSION['error'][] = "There was a problem 
with your username or password.";
 die(header("Location: login.php"));
 }
}
?>