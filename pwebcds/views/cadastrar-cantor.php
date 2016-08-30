<div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-body">
          <form id="form-cantor" method="POST">
            <input type="hidden" value="cadastrar" name="operation">
            <h1>Novo Cantor</h1>
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" class="form-control" id="nome" placeholder="Nome" name="name">
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
    $("#form-cantor").submit(function( event ) {
     
      // Stop form from submitting normally
      event.preventDefault();
      $.ajax({
         url: '../controllers/singer.controller.php',
         type: 'POST',
         data:$(this).serialize(),
         success: function(data) {
            $("#nome").html("");
            if(data.response.status == "success"){
               $("#server-message").html(showSuccessMsg("Sucesso!",data.response.message));
            }else{
               $("#server-message").html(showDangerMsg("Atenção!",data.response.message)); 
            }   
         },
         error: function(error) {
           console.log(error);
         }
      });
    });
  </script>
