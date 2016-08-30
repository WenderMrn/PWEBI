<div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-body">
          <form id="form-cadastro" method="POST">
            <h1>Novo Usuário</h1>
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" class="form-control" id="nome" placeholder="Nome" name="name">
            </div>
            <div class="form-group">
              <label for="login">Login</label>
              <input type="text" class="form-control" id="login" placeholder="Login" name="login">
            </div>
            <div class="form-group">
              <label for="password">Senha</label>
              <input type="password" class="form-control" id="password" placeholder="Senha" name="password">
            </div>
            <div class="form-group">
              <label for="password2">Confirmar Senha</label>
              <input type="password" class="form-control" id="password2" placeholder="Confirmar senhar">
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
   <div id="server-message" class="col-md-4 col-md-offset-4">   
  </div>  
  <script>
    // Attach a submit handler to the form
    $("#form-cadastro").submit(function( event ) {
     
      // Stop form from submitting normally
      event.preventDefault();
      $.ajax({
         url: '../controllers/user.controller.php?operation=cadastrar',
         type: 'POST',
         data:$(this).serialize(),
         success: function(data) {
            if(data.response.status == "success"){
              $("#nome").val("");
              $("#login").val("");
              $("#password").val("");
              $("#password2").val(""); 
              $("#server-message").html(showSuccessMsg("Sucesso!",data.response.message));
            }else{
               $("#server-message").html(showDangerMsg("Atenção!","Login em uso por outro usuário.")); 
            }   
         },
         error: function(error) {
           console.log(error);
         }
      });
    });
  </script>
