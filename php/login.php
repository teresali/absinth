<?php
  session_start();
  include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
  include_once(DOC_ROOT.'/php/functions.php');
 
  function __autoload($class_name) {
    include($_SERVER['DOCUMENT_ROOT'].'/includes/class.' . strtolower($class_name) . '.php');
  }

  if(isset($_POST['submit'])) {

    if (empty($_POST['email']) || empty($_POST['password'])) {
      $errors = "Username or Password is invalid"; //Username or Password not provided
    } else {
      $DB = Database::Instance();
      $email = $DB->escape_string(htmlentities(trim($_POST['email'])));
      $password = $DB->escape_string(htmlentities(trim($_POST['password'])));

      $result = $DB->query("SELECT * from users where email='{$email}'"); 

      if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();

        $entered_password = hash('sha256', $password);
        $stored_password = $data['password'];
        
        if ($entered_password == $stored_password){
          $user = new User($data);
          $_SESSION['user'] = $user;

          if ($data['isAdmin'] == 1) {
            $_SESSION['isAdmin'] = 1;
            
          } else {
            $_SESSION['isAdmin'] = 0;
          }

          header('Location: ../index.php');
          exit(); 

        } else {
          $errors = "Username or Password is invalid";  // Incorrect password
        }
      } else {
        $errors = "Username or Password is invalid"; // Email not associated with any user
      }
    }
  
  }

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <!-- Basic Metas -->
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="author" content="Rebecca Howarth, Teresa Li, Tomasz Stefaniak">
  <meta name="description" content="Absinth is a group peer assessment website that allows students to submit reports and receive feedback from their peers. With a simple and easy-to-use interface, Absinth is a perfect tool for teachers to use in order to engage students.">

  <title>Absinth | Peer Assessment</title>

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

  <!-- CSS Files -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <link href="../css/style.css" rel="stylesheet" type="text/css">

  <!-- JS -->
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> <!-- jQuery --> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> <!-- Bootstrap -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> <!-- Font awesome -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script> <!-- angularJS -->

  <!-- Google Web Fonts -->


  <!--Favicon -->

</head>
 
<body>

  <div class="jumbotron">
    <div id="login-box" class="white-box container-fluid text-center">
      <img src="../img/logo-in.png" alt="Absinth">
      <div class="errors"> <?php if($errors) { echo $errors; } ?> </div>
      <form class="form-horizontal form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
        <div class="form-group">
          <input id="email" class="form-control" type="email" placeholder="Email" name="email" required>
        </div>
        <div class="form-group">
          <input id="password" class="form-control" type="password" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
          <button id="submit" type="submit" class="btn btn-primary btn-block" name="submit">Sign in</button>
        </div>
          Not a Member? <a href="register.php">Register Here</a>
      </form>
    </div>
  </div>
</body>

</html>
