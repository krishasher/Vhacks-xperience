<?php
$errors = array();
if(isset($_POST['signup'])) {
    $username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
    $grade = $_POST['grade'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['conf_password'];
  
    if(file_exists('users/' .$username. '.xml')){
        $errors[] = 'Username already exists';
    }
    if ($username == '') {
        $errors[] = 'Please put a username';
    }
    if ($grade == '') {
        $errors[] = 'Please put your grade';
    }
    if ($id == '') {
        $errors[] = 'Please put your id';
    }
    if ($email == '') {
        $errors[] = 'Please put your name';
    }
    if ($password == '' || $c_password == '') {
        $errors[] = 'Please set a password';
    }
    if ($password != $c_password) {
        $errors[] = 'Passwords do not match';
    }
    if(count($errors) == 0){
        $xml = new SimpleXMLElement('<user></user>');
        $xml -> addChild('password', md5($password));
        $xml -> addChild('email', $email);
        $xml -> addChild('id', $id);
        $xml -> addChild('grade', $grade);
        $xml -> asXML('users/' .$username. '.xml');
        session_start();
        $_SESSION['username'] = $username;
        header('Location: index.html');
        die;
    }
}
?>
<!DOCTYPE html>
<html lang="en-US">
<title>Enroll</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
  background-color: lightblue;
}

.bgimg-1 {
  background-position: center;
  background-size: cover;
  background-image: url("https://lh3.googleusercontent.com/bP0jPkR0jlsQTAyeEFCQV32GceSDKOxE9xNABeH9InvlwtX7oSeXmAo50kBfnVi447V95Oo=w16383");
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
.Header{
  position: relative;
  top: 200px;
  left: 380px;
  padding-bottom: 50px;
}
.w3-rightw3-hide-small{
  background-color: darkblue;
}
.login_div {
    text-align: center;
    border: 1px solid #bedee8;
    background-color: #bedee8;
    width: 500px;
    padding: 50px 20px;
    margin: 0 auto;
    box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.5), 0 12px 20px 0 rgba(0, 0, 0, 0.3);
        }
.login {
    width: 300px;
    height: 40px;
    padding: 12px;
    margin: 8px 0;
    border-radius: 30px;
    line-height: 10px;
    font-size: 20px
}
	</style>
</head>
<body>
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="#home" class="w3-bar-item w3-button w3-wide"></a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="about.html" class="w3-bar-item w3-button">ABOUT</a>
      <a href="team.html" class="w3-bar-item w3-button"><i class="fa fa-user"></i> TEAM</a>
      <a href="work.html" class="w3-bar-item w3-button"><i class="fa fa-th"></i> WORK</a>
      <a href="pricing.html" class="w3-bar-item w3-button"><i class="fa fa-usd"></i> PRICING</a>
      <a href="contact.html" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT</a>
      <a href="enroll.php" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> ENROLL NOW!</a>
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>
<br>
<br>
    <h1 align="center">Sign Up</h1>
    <hr>
    <div class="login_div">
    <form method="POST" action="">
        <select name="grade" style="width:400px; height:30px; font-size:20px">
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>
        <br>
        <br>
        <br>
        <input autocomplete="off" placeholder="Full Name" style="width:400px; height:30px; font-size:20px" type="text" name="email">
        <br>
        <br>
        <br>
        <input autocomplete="off" placeholder="ID" style="width:400px; height:30px; font-size:20px" type="text" name="id">
        <br>
        <br>
        <br>
        
        <input autocomplete="off" placeholder="Username" style="width:400px; height:30px; font-size:20px" type="text" name="username">
        <br>
        <br>
        <br>
        <input placeholder="Password" style="width:400px; height:30px; font-size:20px" type="password" name="password">        
        <br>
        <br>
        <br>
        <input placeholder="Confirm Password" style="width:400px; height:30px; font-size:20px" type="password" name="conf_password">
        <br>
        <br>
        <br>
        <input class="login" type="submit" value="Login" name="signup">
    </form>
    </div>
    <?php
    if(count($errors) > 0){
        echo '<ul style="list-style-type:none; color:red">';
    foreach($errors as $e) {
        echo '<li>' .$e. '</li>';
        }
    }
    ?>
    
</body>
</html>
