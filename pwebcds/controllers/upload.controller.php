<?php
	function uploadPhoto($arquivo){

		$tamanho_maximo = 15728640; // em bytes
		$tipos_aceitos = array("image/gif","image/jpeg","image/png","image/bmp");
		$destino = "../assets/img/capas/";	
		$destinoCompleto = "";
		$messageUploadInfo = null;
		$r = array();
		
			if($arquivo['error'] > 0 ){

					switch($arquivo['error']) {
						case  UPLOAD_ERR_INI_SIZE:
							$messageUploadInfo = 'O Arquivo excede o tamanho máximo permitido';
						break;
						case UPLOAD_ERR_FORM_SIZE:
							$messageUploadInfo = 'O Arquivo enviado é muito grande';
						break;
						case  UPLOAD_ERR_PARTIAL:
							$messageUploadInfo = 'O upload não foi completo';
						break;
						case UPLOAD_ERR_NO_FILE:
							$messageUploadInfo = 'Nenhum arquivo foi informado para upload';	
						break;
						default: 
							$messageUploadInfo = "Erro ao processar arquivo!";
					}

					$r['path'] = "";
					$r['message'] = $messageUploadInfo;
					$r['status'] =false;

			}else if(!array_search($arquivo['type'],$tipos_aceitos)) {
					
					$r['path'] = "";
					$r['message'] = 'O Arquivo enviado não é do tipo (' . 
								$arquivo['type'] . ') aceito para upload';
					$r['status'] =false;			

			}else{

					if (!file_exists($destino)) {
    					mkdir($destino,0755);
					}

					$extensao = strtolower(strrchr($arquivo['name'], '.'));
					$destinoCompleto = $destino.md5(uniqid(rand(),True)).$extensao;
					if(!move_uploaded_file($arquivo['tmp_name'],$destinoCompleto)) {
						
						$r['path'] = "";
						$r['message'] = 'Ocorreu um erro ao salvar a imagem da capa do cd.';
						$r['status'] =false;

					}else{
						
						$r['path'] = $destinoCompleto;
						$r['message'] = "ok";
						$r['status'] = true;
					}

					return $r;
			}



	}
?>