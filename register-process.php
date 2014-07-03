
<?php
if (!isset($_POST['submit'])) {
die(header("Location: register.php"));
}
$_SESSION['formAttempt'] = true;
if (isset($_SESSION['error'])) {
 unset($_SESSION['error']);
}
$_SESSION['error'] = array();
$required = array("lname","fname","username","email","password1","password2","sex","dob","department");
//Check required fields
foreach ($required as $requiredField) {
if (!isset($_POST[$requiredField]) ) {
}
if($_POST[$requiredField] 
== "")
{
 $_SESSION['error'][] = $requiredField . " is 
required.";
 }
}
if (!preg_match('/^[\w .]+$/',$_POST['fname'])) {
 $_SESSION['error'][] = "First Name must be letters and 
numbers only.";
}
if (!preg_match('/^[\w .]+$/',$_POST['lname'])) {
 $_SESSION['error'][] = "Last Name must be letters and 
numbers only.";
}
if (!preg_match('/^[\w .]+$/',$_POST['username'])) {
 $_SESSION['error'][] = "Username must be letters and 
numbers only.";
}
if (!isset($_POST['department']) || $_POST['department'] == "") {
 $_SESSION['error'][] = "Please choose a department";
}

if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
 $_SESSION['error'][] = "Invalid e-mail address";
}
if ($_POST['password1'] != $_POST['password2']) {
 $_SESSION['error'][] = "Passwords don't match";
}
//final disposition
if (count($_SESSION['error']) > 0) {
 die(header("Location: register.php"));
} else {
 if(registerUser($_POST)) {
unset($_SESSION['formAttempt']);
die(header("Location: success.php"));
 } else {
error_log("Problemtt registering user: {$_POST['email']}");
$_SESSION['error'][] = "Problem registering account";
 }
}
function registerUser($userData) {
 $mysqli = new mysqli("localhost","root","","UserData");
 if ($mysqli->connect_errno) {

error_log("Cannot connect to MySQL: " . $mysqli->connect_error);
return false;
 }
 $email = $mysqli->real_escape_string($_POST['email']);
 //check for an existing user
 $findUser = "SELECT id from user where email = 
'{$email}'";
 $findResult = $mysqli->query($findUser);
 $findRow = $findResult->fetch_assoc();
 if (isset($findRow['id']) && $findRow['id'] != "") {

 $_SESSION['error'][] = "A user with that e-mail 
address already exists";
 return false;
 }
 $userName = $mysqli->real_escape_string($_POST['username']);
 $findusername="SELECT id from user where username ='{$userName}'";
 $findResult2= $mysqli->query($findusername);
 $findRow2= $findResult2->fetch_assoc();
 if (isset($findRow2['id']) && $findRow2['id'] != "") {

 $_SESSION['error'][] = "A user with that username already exists";
 return false;
 }
 $lastName = $mysqli->real_escape_string($_POST['lname']);

 $lastName = $mysqli->real_escape_string($_POST['lname']);
 $firstName = $mysqli->real_escape_string($_POST['fname']);
 $Department = $mysqli->real_escape_string($_POST['department']);
 $Sex = $mysqli->real_escape_string($_POST['sex']);
 $Dateofbirth = $mysqli->real_escape_string($_POST['dob']);
 $cryptedPassword = crypt($_POST['password1']);
 $password = $mysqli->real_escape_string($cryptedPassword);
 if (isset($_POST['githubprofile'])) {
 $githprofile = $mysqli->real_escape_string($_POST['githubprofile']);
 } else {
 $githprofile = "";
 }
 if (isset($_POST['interests'])) {
 $Interests = $mysqli->real_escape_string($_POST['interests']);
 } else {
 $Interests = "";
 }
 
 $query = "INSERT INTO User (email,first_name,last_name,username,password,github_link,department,interests,gender,date_of_birth) " . " VALUES ('{$email}','{$firstName}','{$lastName}','{$userName}'" .",'{$password}','{$githprofile}','{$Department}','{$Interests}','{$Sex}','{$Dateofbirth}')";
 if ($mysqli->query($query)) {
 $id = $mysqli->insert_id;
 error_log("Inserted {$email} as ID {$id}");
 return true;
 } else {
 	error_log("Problem inserting {$query}");
 	return false;
 }
} //end function registerUser