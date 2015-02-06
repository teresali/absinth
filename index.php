<?php 
  // include('php/DB.php');
  function __autoload($class_name) {
    include 'php/' . $class_name . '.php';
  }

?>

<html lang="en">
<head>
  <!-- Basic Metas -->
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="author" content="Teresa Li">
  <meta name="description" content="Databases Project">

  <title>Databases Project</title>

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

  <!-- CSS Files -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" type="text/css">

  <!-- JS -->
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> <!-- jQuery --> 
  <script type="text/javascript" src="js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script> <!-- angularJS -->

  <!-- Google Web Fonts -->


  <!-- Favicon -->

</head>


<body>
  <div id="wrapper">

  Hello World!
<?php
  $db = new DB();

  $r = $db->query("SELECT * FROM test");
  $data = $r->fetch_assoc();
  echo $data["id"];

  // $a = new Assessment;


    // $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // if($db->error) {
    //   echo("Connection Error");
    // }
    // echo("Connected to Database");

    // $q = "CREATE TABLE test (id INT(3))";
    
    // $db->query($q);

    // $sql = "INSERT INTO test (id) VALUES (456)";

    // if ($db->query($sql) === TRUE) {
    //   echo "New record created successfully";
    // } else {
    //   echo "Error: " . $sql . "<br>" . $db->error;
    // }

    // $dataQ = "SELECT * FROM test";

    // $result = $db->query($dataQ);

    // $data = $result->fetch_assoc();

    // echo $data["id"];

    // echo("DONE")

?>


  </div> <!-- wrapper end -->
</body>

<script>
  // testing jQuery
  $(document).ready(function() {
    if (typeof jQuery == 'undefined') {
      console.log("jQuery not loaded");
    } else {
      console.log("WOOHOO!");
    }
  });



</script>





