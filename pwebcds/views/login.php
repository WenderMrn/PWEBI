<div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div id="panel-login" class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-heading">Entrar no PWEB CDS</div>
        <div class="panel-body">
          <form id="form-login" method="POST" class="form-horizontal">
            <div class="form-group">
              <label for="login" class="col-sm-2 control-label">Login</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="login" placeholder="Login" name="login">
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-2 control-label">Senha</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="password" placeholder="Senha" name="password">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Remember me
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Entrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div id="server-message" class="col-md-4 col-md-offset-4">
   
  </div>
  <footer class="container-fluid">
    <a href="api/public.php?cds=json" class="btn btn-info btn-xs" role="button">API JSON</a>
    <a href="api/public.php?cds=xml" class="btn btn-warning btn-xs" role="button">API XML</a>
  </footer>
<script>
    // Attach a submit handler to the form
    $("#form-login").submit(function( event ) {
     
      // Stop form from submitting normally
      event.preventDefault();
      $.ajax({
         url: 'controllers/login.controller.php?operation=login',
         type: 'POST',
         data:$(this).serialize(),
         success: function(data) {
            console.log(data);
            if(data.response.status == "success"){
               location.reload();
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