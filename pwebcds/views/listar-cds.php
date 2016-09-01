<style>
	.capa img{
		height: 200px;
		display: block;
    	margin: auto;
	}
	.capa{
		padding-top: 5%;
		box-shadow: 1px 2px 10px #888888;
	}
	.capa .capa-bg{
		background-size: 200px 200px;
    	background-repeat: no-repeat;
    	display: block;
    	margin: auto;
    	width: 200px;
    	height: 200px;
    	border-radius: 360px;
	}
	.btn-cd{
		
	}
	#campo_busca{
		margin: 5%;
	}
	#campo_busca #fild_busca{
		font-size: 2em;
    	height: 50px;
	}
</style>
<div class="container">
	<div class="row">
		<h1>Meus CDS</h1>
	</div>
	<div class="row">
		<div id="campo_busca" class="row">
		  <div class="col-md-offset-3 col-lg-6 ">
		    <div class="input-group">
		       <input onkeypress="PesquisarCD(this)" id="fild_busca" type="text" class="form-control" placeholder="título, cantor, lançametno">
		      <span class="input-group-btn">
		        <button style="height: 50px;" class="btn glyphicon glyphicon-search" type="button"></button>
		      </span>
		    </div><!-- /input-group -->
	  	  </div><!-- /.col-lg-6 -->
		</div>
		<div id="capas-content" class="row"></div>
		<div id="capas-busca" class="row"></div>
		<div id="server-message" class="row col-md-offset-3 col-lg-6">
		</div>
	</div>
	<!-- Modal -->
	<form id="edit-form-cds" enctype="multipart/form-data">
		<input type="hidden" value="editar" name="operation">
		<input type="hidden" id="code" value="" name="code">
		<input type="hidden" id="photo_old" value="" name="photo_old">
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Editar CD</h4>
		      </div>
		      <div class="modal-body">     
			        <input type="hidden" name="MAX_FILE_SIZE" value="15728640">
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
			<div id="foto-old" class="form-group">
				
			</div>	
	         <div class="form-group">
			   <label for="foto">Foto</label>
			   <input type="file" id="foto" name="photo_new">
			   <p class="help-block">selecione a foto de capa do CD.</p>
			 </div>
			<div id="server-message2" class="form-group col-lg-6"></div>	
			 </div>
		     <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		        <button type="submit" class="btn btn-success">Salvar</button>
		      </div>
		    </div>
		  </div>
		</div>
		</form>
		<!--Modal-->
	</div>	
	<script>
	function OpenEditModal(obj){
		$("#code").val(obj.code);
		$("#titulo").val(obj.title);
		$("#data").val(obj.release_year);
		$('#cantores option[value='+obj.singer.code+']').attr('selected','selected');
		$('#foto-old').html($("<img  src="+(obj.photo != ""?obj.photo:'../assets/img/cd.png')+" class='img-rounded' alt='capa' width='150' height='150'>"));
		$("#photo_old").val(obj.photo);
	}

	function PesquisarCD(input){
		 // carregar cantores
    $.ajax({
         url: '../controllers/cd.controller.php',
         type: 'POST',
         data:{
         	'operation':'pesquisar',
         	'key':input.value
         },
         success: function(data) {
         	console.log(data);
           	if(data.response.hasOwnProperty('cds')){
            	var cds = data.response.cds;
            	$("#capas-content").hide();
            	$("#capas-busca").empty();
            	for( n in cds){
            		$("#capas-busca").append(
            			$("<div id='cd-"+cds[n].code+"' class='col-xs-6 col-md-4'>"+
            				"<div class='capa panel panel-default'>"+
						  	  "<div class='capa-bg' style=\"background-image: url('"+(cds[n].photo != "" && cds[n].photo != " "?cds[n].photo:'../assets/img/cd-default.jpg')+"');\">"+
						  		"<img src='../assets/img/cd.png') alt='..' class='img-circle'>"+	
						  	  "</div>"+
							  "<div class='panel-body'>"+
							    "<dl class='dl-horizontal'>"+
				  					"<dt>Título</dt><dd>"+cds[n].title+"</dd>"+
				  					"<dt>Lançamento</dt><dd>"+cds[n].release_year+"</dd>"+
				  					"<dt>Cantor</dt><dd>"+cds[n].singer.name+"</dd>"+
								"</dl>"+
								"<button type='button' class='btn-cd col-md-3 col-md-offset-3 btn btn-success' data-toggle='modal' data-target='#myModal' onclick='OpenEditModal("+JSON.stringify(cds[n])+")'>Editar</button>"+
							  	"<button type='button' onclick='excluirCD("+cds[n].code+")' class='col-md-3 btn btn-danger'>Excluir</button>"+
							  "</div></div></div>"));	
            	}
            }
         },
         error: function(error) {
           console.log(error);
         }
     });
	}
	
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

    // Attach a submit handler to the form
    $("#edit-form-cds").submit(function( event ) {
     
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
            
            if(data.response.status == "success"){
               $("#server-message2").html(showSuccessMsg("Sucesso!",data.response.message));
               location.reload();
            }else{
               $("#server-message2").html(showDangerMsg("Atenção!",data.response.message)); 
            }   
         },
         error: function(error) {
           console.log(error);
         }
      });
    });
     
      // carregar cds
    $.ajax({
         url: '../controllers/cd.controller.php',
         type: 'POST',
         data:{'operation':'listar'},
         success: function(data) {
            if(data.response.hasOwnProperty('cds')){
            	var cds = data.response.cds;
            	$("#capas-content").empty();
            	$("#capas-content-resultado-busca").empty();
            	for( n in cds){
            		
            		$("#capas-content").append(
            			$("<div id='cd-"+cds[n].code+"' class='col-xs-6 col-md-4'>"+
            				"<div class='capa panel panel-default'>"+
						  	  "<div class='capa-bg' style=\"background-image: url('"+(cds[n].photo != "" && cds[n].photo != " "?cds[n].photo:'../assets/img/cd-default.jpg')+"');\">"+
						  		"<img src='../assets/img/cd.png') alt='..' class='img-circle'>"+	
						  	  "</div>"+
							  "<div class='panel-body'>"+
							    "<dl class='dl-horizontal'>"+
				  					"<dt>Título</dt><dd>"+cds[n].title+"</dd>"+
				  					"<dt>Lançamento</dt><dd>"+cds[n].release_year+"</dd>"+
				  					"<dt>Cantor</dt><dd>"+cds[n].singer.name+"</dd>"+
								"</dl>"+
								"<button type='button' class='btn-cd col-md-3 col-md-offset-3 btn btn-success' data-toggle='modal' data-target='#myModal' onclick='OpenEditModal("+JSON.stringify(cds[n])+")'>Editar</button>"+
							  	"<button type='button' onclick='excluirCD("+cds[n].code+")' class='col-md-3 btn btn-danger'>Excluir</button>"+
							  "</div></div></div>"));	
            	}
            }
         },
         error: function(error) {
           console.log(error);
         }
     });

    function excluirCD(code){
		$.ajax({
         url: '../controllers/cd.controller.php',
         type: 'POST',
         data:{
         	'code':code,
         	'operation':'excluir',
         },
         success: function(data) {
            
            if(data.response.status == "success"){
               $("#server-message").html(showSuccessMsg("Sucesso!",data.response.message));
               $("#cd-"+code).remove();
            }else{
               $("#server-message").html(showDangerMsg("Atenção!",data.response.message)); 
            }   
         },
         error: function(error) {
           console.log(error);
         }
      });
	  // Attach a submit handler to the form
	}

</script>	