<?php
session_start();
  if(isset($_SESSION['user']))
    header("Location:views/index.php");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PWEBCDS</title>
  <!-- CSS app-->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/lib/bootstrap/dist/css/bootstrap.css">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="assets/css/carousel.css">

  <link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
  <!-- JQuery -->
  <script src="assets/lib/jquery/dist/jquery.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="assets/lib/bootstrap/dist/js/bootstrap.js" ></script>
  <script type="text/javascript" src="assets/js/script.js"></script>  
</head>
<body>
   <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="contact-list.php" id="home">
            <!--<img alt="Home" src="#">-->
            Agenda
          </a>
        </div>
      </div>
    </nav>
  <?php
    include "views/login.php";
  ?>
</body>
</html>
