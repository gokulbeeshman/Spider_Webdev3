<?php
class User {
 public $id;
 public $email;
 public $firstName;
 public $lastName;
 public $userName;
 public $githublink;
 public $department;
 public $interests;
 public $gender;
 public $dateofbirth;
 public $isLoggedIn = false;
 function __construct() {
 if (session_id() == "") {
 session_start();
 }
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] 
== true) {
 $this->_initUser();
 }
 } //end __construct
 public function authenticate($user,$pass) {
 if (session_id() == "") {
 session_start();
 }
 $_SESSION['isLoggedIn'] = false;
 $this->isLoggedIn = false;
 $mysqli = new mysqli("localhost","root","","UserData");
 if ($mysqli->connect_errno) {
 error_log("Cannot connect to MySQL: " . 
$mysqli->connect_error);
 return false;
 }
 $safeUser = $mysqli->real_escape_string($user);
 $incomingPassword = $mysqli->real_escape_string($pass);
 $query = "SELECT * from User WHERE userName = 
'{$safeUser}'";
 if (!$result = $mysqli->query($query)) {
 error_log("Cannot retrieve account for {$user}");
 return false;
 }
 // Will be only one row, so no while() loop needed
 $row = $result->fetch_assoc();
 $dbPassword = $row['password'];
 if (crypt($incomingPassword,$dbPassword) != 
$dbPassword) {
 error_log("Passwords for {$user} don't match");
 return false;
 }
 $this->id = $row['id'];
 $this->email = $row['email'];
 $this->firstName = $row['first_name'];
 $this->lastName = $row['last_name'];
 $this->username = $row['username'];
 $this->interests = $row['interests'];
 $this->gender = $row['gender'];
 $this->githublink = $row['github_link'];
 $this->dateofbirth = $row['date_of_birth'];
 $this->department = $row['department'];
 $this->isLoggedIn = true;
 $this->_setSession();
 return true;
 } //end function authenticate
 private function _setSession() {
 if (session_id() == '') {
 session_start();
 }
 $_SESSION['id'] = $this->id;
 $_SESSION['email'] = $this->email;
 $_SESSION['firstName'] = $this->firstName;
 $_SESSION['lastName'] = $this->lastName;
 $_SESSION['username'] = $this->username;
 $_SESSION['interests'] = $this->interests;
 $_SESSION['gender'] = $this->gender;
 $_SESSION['githublink'] = $this->githublink;
 $_SESSION['dateofbirth'] = $this->dateofbirth;
 $_SESSION['department'] = $this->department;
 $_SESSION['isLoggedIn'] = $this->isLoggedIn;
 } //end function setSession
 private function _initUser() {
 if (session_id() == '') {
 session_start();
 }
 $this->id = $_SESSION['id'];
 $this->email = $_SESSION['email'];
 $this->firstName = $_SESSION['firstName'];
 $this->username = $_SESSION['username'];
 $this->interests = $_SESSION['interests'];
 $this->gender = $_SESSION['gender'];
 $this->githublink = $_SESSION['githublink'];
 $this->dateofbirth = $_SESSION['dateofbirth'];
 $this->department = $_SESSION['department'];
 $this->lastName = $_SESSION['lastName'];
 $this->isLoggedIn = $_SESSION['isLoggedIn'];
 } //end function initUser

public function logout() {
 $this->isLoggedIn = false;
 if (session_id() == '') {
 session_start();
 }
 $_SESSION['isLoggedIn'] = false;
 foreach ($_SESSION as $key => $value) {
 	$_SESSION[$key] = "";
 unset($_SESSION[$key]);
 }
 $_SESSION = array();
 if (ini_get("session.use_cookies")) {
 $cookieParameters = session_get_cookie_params();
 setcookie(session_name(), '', time() - 28800,
 $cookieParameters['path'],$cookieParameters['domain'],
 $cookieParameters['secure'],$cookieParameters['httponly']
 );
 } //end if
 session_destroy();
 } //end function logout

 } //end class User