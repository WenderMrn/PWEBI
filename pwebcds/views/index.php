<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PWEBCDS</title>
  <!-- CSS app-->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../assets/lib/bootstrap/dist/css/bootstrap.css">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="../assets/css/carousel.css">

  <link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>

  <!-- Optional theme -->
  <!--<link rel="stylesheet" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">-->
  <!-- JQuery -->
  <script src="../assets/lib/jquery/dist/jquery.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script type="text/javascript" src="../assets/lib/bootstrap/dist/js/bootstrap.js" ></script>
  <script type="text/javascript" src="../assets/js/jquery.maskedinput.min.js" ></script>
  <script type="text/javascript" src="../assets/js/script.js"></script>

</head>
<body>
  <?php
    include "navbar.php";
    if(isset($_GET['page'])){
      switch ($_GET['page']) {
        case 'cadastrar-usuario':
          include "cadastrar-usuario.php";
        break;
        case 'cadastrar-cantor':
          include "cadastrar-cantor.php";
        break;
        case 'cadastrar-cds':
          include "cadastrar-cds.php";
        break;
        default:
          # code...
        break;
      }
    }else{
      include "listar-cds.php";
    }
  ?>
</body>
</html>
