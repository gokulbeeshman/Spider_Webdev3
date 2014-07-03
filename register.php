<!doctype html>
<html>
<head>
<script type="text/javascript" src="https://ajax.googleapis.
com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="register.js"></script> 
<link rel="stylesheet" type="text/css" href="form.css">
<title>A form</title>
</head>
<body>
<form id="userForm" enctype="multipart/form-data" method="POST" action="register-process.php" >
<div>
 <fieldset>
 <legend>Registration Information</legend> 
 <div id="errorDiv">
<?php 
if (isset($_SESSION['error']) && isset($_SESSION['formAttempt']))
 {
 unset($_SESSION['formAttempt']);
 print ("Errors encountered");
 foreach ($_SESSION['error'] as $error) {
 print $error . "";
 } //end foreach
 } //end if 
?>
</div>
 <label for="fname">First Name:* </label>
 <input type="text" id="fname" name="fname">
 <span class="errorFeedback errorSpan" 
id="fnameError">First Name is required</span>
 <br />
 <label for="lname">Last Name:* </label>
 <input type="text" id="lname" name="lname">
 <span class="errorFeedback errorSpan" 
id="lnameError">Last Name is required</span>
 <br />
 <label for="username">Username* </label>
 <input type="text" id="username" name="username">
 <span class="errorFeedback errorSpan" 
id="usernameError">Username is required</span>
 <br />
 <label for="email">E-mail Address:* </label>
 <input type="text" id="email" name="email">
 <span class="errorFeedback errorSpan" 
id="emailError">E-mail is required</span>
 <br />
 <label for="dob">Date of Birth:*</label>
 <input type="date" id="dob" name="dob">
 <br />
 <label for="password1">Password:* </label>
 <input type="password" id="password1" 
name="password1">
 <span class="errorFeedback errorSpan" 
id="password1Error">Password required</span>
 <br />
 <label for="password2">Verify Password:* </label>
 <input type="password" id="password2" 
name="password2">
 <span class="errorFeedback errorSpan" 
id="password2Error">Passwords don't match</span>
 <br />
  <label for="githubprofile">Github Link: </label>
 <input type="text" id="githubprofile" name="githubprofile">
<br />
<label for="department">Department:* </label>
  <select name="department" id="Department">
 <option></option>
 <option value="Architecture">Architecture</option>
 <option value="Chemical Engineering">Chemical Engineering</option>
 <option value="Civil Engineering">Civil Engineering</option>
 <option value="Computer Science and Engineering">Computer Science and Engineering</option>
 <option value="Computer Applications">Computer Applications</option>
 <option value="Electrical and Electronics Engineering">Electrical and Electronics Engineering</option>
 <option value="Electronics and Communication Engineering">Electronics and Communication Engineering</option>
 <option value="Management Studies">Management Studies</option>
 <option value="Instrumentation and Control Engineering">Instrumentation and Control Engineering</option>
 <option value="Mechanical Engineering">Mechanical Engineering</option>
 <option value="Metallurgical and Materials Engineering">Metallurgical and Materials Engineering</option>
 <option value="Production Engineering">Production Engineering</option>
 </select>
 <br />
 <label for="sex">Sex:* </label>
 <select name="sex" id="sex">
 <option></option>
 <option value="Male">Male</option>
 <option value="Female">Female</option>
 <option value="Other">Other</option>
 </select>
 <br />
<label for="Interests">Interests: </label>
 <input type="text" id="interests" name="interests">
 <br />
 <label for="filein">Profile Picture: </label>
 <input type="file" id="filein" name="filein">
 <br />
 <input type="submit" id="submit" name="submit">
 </fieldset>
</div>
</form>
</body>
</html>