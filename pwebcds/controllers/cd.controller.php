<?php
	require_once "../config/imports.all.php";
	if(isset($_POST['operation']))
	switch ($_POST['operation']) {
		case 'cadastrar':
			try{
				
				$daocd = new DAOCD();

				$tamanho_maximo = 15728640; // em bytes
				$tipos_aceitos = array("image/gif","image/jpeg","image/png",	"image/bmp");
				$destino = "../assets/img/capas/";	
				$destinoCompleto = "";
				$arquivo = $_FILES['photo'];
				
				$messageUploadInfo = null;

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
							//$messageUploadInfo = 'Nenhum arquivo foi informado para upload';	
						break;
						default: 
							$messageUploadInfo = "Erro ao processar arquivo!";
					}

				}else if(!array_search($arquivo['type'],$tipos_aceitos)) {
					
					$messageUploadInfo = 'O Arquivo enviado não é do tipo (' . 
								$arquivo['type'] . ') aceito para upload';

				}else{

					if (!file_exists($destino)) {
    					mkdir($destino,0755);
					}

					$extensao = strtolower(strrchr($arquivo['name'], '.'));
					$destinoCompleto = $destino.md5(uniqid(rand(),True)).$arquivo['name'];
					if(!move_uploaded_file($arquivo['tmp_name'],$destinoCompleto)) {
						
						$messageUploadInfo = 'Ocorreu ao salvar a imagem da capa do cd.';

					}
				}

				if($messageUploadInfo != null){
					
					$response['response'] = array(
	    							'status' => 'error',
	    							'code' => '-2',
	    							'message' => $messageUploadInfo,
	  							);

					$encoded = json_encode($response);
					header('Content-type: application/json');
					exit($encoded);

				}

				$cd = new CD($_POST['title'],$destinoCompleto,$_POST['release_year'],$_POST['singer']);
				$result = $daocd->create($cd); 
				
				if($result == 1){
					$response['response'] = array(
	    							'status' => 'success',
	    							'code' => '1',
	    							'message' => 'CD '.$_POST['title'].', cadastrado com sucesso.',
	  							);
				}else{
					$response['response'] = array(
	    							'status' => 'error',
	    							'code' => '-1',
	    							'message' => 'CD '.$_POST['title'].', já está cadastrado.',
	  							);
				}
				
				$encoded = json_encode($response);
				header('Content-type: application/json');
				exit($encoded);

			} catch (Exception $e) {
				exit($e.getMessage());
			}		
		break;
		case 'listar':
			try{
				# code...
				$daocd = new DAOCD();
				$result = $daocd->readAll();
				
				$response['response'] = array(
	    					'status' => 'success',
	    					'code' => '1',
	    					'message' => '',
	    					'cds' => $result,
	  					);
			
				$encoded = json_encode($response);
				header('Content-type: application/json');
				exit($encoded);

			} catch (Exception $e) {
				exit($e.getMessage());
			}
		break;
		case 'excluir':
			try{
				# code...
				$daocd = new DAOCD();
				$result = $daocd->delete($_POST['code']);
				
				$response['response'] = array(
	    					'status' => 'success',
	    					'code' => '1',
	    					'message' => '',
	    					'cds' => $result,
	  					);
			
				$encoded = json_encode($response);
				header('Content-type: application/json');
				header("Location:../index.php");
				exit($encoded);

			} catch (Exception $e) {
				exit($e.getMessage());
			}
		break;
		default:
			# code...
		break;
	}
?>