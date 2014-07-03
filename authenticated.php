<?php
require_once("ClassUser.php");
$user = new User;
if (!$user->isLoggedIn) {
 die(header("Location: login.php"));
}
?>
<!doctype html>
<html>
<head>
<title>Super Secret Authenticated Page</title>
</head>
<body>
<div>
<?php print "Welcome {$user->firstName} {$user->lastName} <br />\n"; ?>
</div>
<div>
 <a href="logout.php">Click here to logout</a>
</div>
</body>
</html>