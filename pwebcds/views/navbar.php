<? require_once "../config/imports.all.php";
session_start();
  if(!isset($_SESSION['user']))
    header("Location:../index.php");
?>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php" id="home">
            <!--<img alt="Home" src="#">-->
            PWEB CDS
          </a>
        </div>
         <div class="nav-collapse in collapse" style="height: auto;">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Meus CDs</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastrar<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="?page=cadastrar-cds">CD</a></li>
                <li><a href="?page=cadastrar-cantor">Cantor</a></li> 
                <li><a href="?page=cadastrar-usuario">Usuário</a></li>   
              </ul>
            </li>
            <!--<li class="active"><a href="contact-insert.php">Adicionar Contato</a></li>-->
         </ul>
          <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user']->getName();?><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><b class="col-md-10"><?php echo $_SESSION['user']->getLogin();?></b></li>
              <li role="separator" class="divider"></li> 
              <li><a href="../controllers/login.controller.php?operation=logout">sair</a></li>                   
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>