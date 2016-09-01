<div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-body">
          <form id="form-cds" enctype="multipart/form-data">
          	<input type="hidden" value="cadastrar" name="operation">
            <input type="hidden" name="MAX_FILE_SIZE" value="15728640">
            <h1>Novo CD</h1>
            <div class="form-group">
              <label for="titilo">Título</label>
              <input type="text" class="form-control" id="titulo" placeholder="Título" name="title">
            </div>
            <div class="form-group">
              <label for="data">Data lançamento</label>
              <input type="date" class="form-control" id="data" placeholder="Data" name="release_year">
            </div>
            <div class="form-group">
            	<label for="cantores">Cantor</label>
	            <select id="cantores" class="form-control" name="singer" placeholder="cantor">
				      </select>
			</div>	
            <div class="form-group">
			   <label for="foto">Foto</label>
			   <input type="file" id="foto" name="photo">
			   <p class="help-block">selecione a foto de capa do CD.</p>
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
    function getDate(){
      var date = new Date();
      var month = (eval(date.getMonth()+1) < 10?"0"+eval(date.getMonth()+1):eval(date.getMonth()+1));
      var day = (date.getDate() < 10)?"0"+date.getDate():"";

      return date.getFullYear()+"-"+month+"-"+day;
    }
    $("#data").val(getDate());
    // Attach a submit handler to the form
    $("#form-cds").submit(function( event ) {
     
      // Stop form from submitting normally
      event.preventDefault();
      var form = $(this);
      var formdata = false;
      if (window.FormData){
          formdata = new FormData(form[0]);
      }
      $.ajax({
         url: '../controllers/cd.controller.php',
         type: 'POST',
         data: formdata ? formdata : form.serialize(),
         cache       : false,
         contentType : false,
         processData : false,
         success: function(data) {
            console.log(data);
            if(data.response.status == "success"){
              $("#titulo").val("");
              $("#data").val(getDate());
              $("#cantores").val("");
              $("#foto").val("");
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
    // carregar cantores
    $.ajax({
         url: '../controllers/singer.controller.php',
         type: 'POST',
         data:{'operation':'listar'},
         success: function(data) {
           
            if(data.response.hasOwnProperty('singers')){
            	var singers = data.response.singers
            	for( n in singers){
            		$("#cantores").html($("#cantores").html()+"<option value='"+singers[n].code+"'>"+singers[n].name+"</option>");	
            	}
            }
         },
         error: function(error) {
           console.log(error);
         }
     });
  </script>
