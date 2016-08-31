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
</style>
<div class="container">
	<div class="row">
		<h1>Meus CDS</h1>
	</div>
	<div class="row">
		<div id="campo_busca" class="row">
		  <div class="col-md-offset-3 col-lg-6 ">
		    <div class="input-group">
		      <input type="text" class="form-control" placeholder="Search for...">
		      <span class="input-group-btn">
		        <button class="btn glyphicon glyphicon-search" type="button"></button>
		      </span>
		    </div><!-- /input-group -->
	  	  </div><!-- /.col-lg-6 -->
		</div>
		<div id="capas-content" class="row">
		</div>
	</div>	
</div>	
<script>
	  // carregar cantores
    $.ajax({
         url: '../controllers/cd.controller.php',
         type: 'POST',
         data:{'operation':'listar'},
         success: function(data) {
           console.log(data);
            if(data.response.hasOwnProperty('cds')){
            	var cds = data.response.cds;
            	for( n in cds){
            		$("#capas-content").append(
            			$("<div class='col-xs-6 col-md-4'>"+
            				"<form action='../controllers/cd.controller.php' method='POST' >"+
            				"<input type='hidden' value='excluir' name='operation'>"+
            				"<input type='hidden' value='"+cds[n].code+"' name='code'>"+
            				"<div class='capa panel panel-default'>"+
						  	  "<div class='capa-bg' style=\"background-image: url('"+(cds[n].photo != ""?cds[n].photo:'../assets/img/cd-default.jpg')+"');\">"+
						  		"<img src='../assets/img/cd.png') alt='..' class='img-circle'>"+	
						  	  "</div>"+
							  "<div class='panel-body'>"+
							    "<dl class='dl-horizontal'>"+
				  					"<dt>Título</dt><dd>"+cds[n].title+"</dd>"+
				  					"<dt>Lançamento</dt><dd>"+cds[n].release_year+"</dd>"+
				  					"<dt>Cantor</dt><dd>"+cds[n].singer.name+"</dd>"+
								"</dl>"+
								"<button type='button' class='btn-cd col-md-3 col-md-offset-3 btn btn-success'>Editar</button>"+
							  	"<button type='submit' class='btn-cd col-md-3 btn btn-danger '>Excluir</button>"+
							  "</div></div></form></div>"));	
            	}
            }
         },
         error: function(error) {
           console.log(error);
         }
     });
</script>	