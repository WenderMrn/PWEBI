<?php
	require_once "../config/imports.all.php";
	require_once "upload.controller.php";

	if(isset($_POST['operation']))
	switch ($_POST['operation']) {
		case 'cadastrar':
			try{
				
				$daocd = new DAOCD();
				$uploadresult = uploadPhoto($_FILES['photo']);
				$cd = new CD($_POST['title'],$uploadresult['path'],$_POST['release_year'],$_POST['singer']);
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
		case 'pesquisar':
			try{
				# code...
				$daocd = new DAOCD();
				$result = $daocd->read($_POST['key']);
				
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
		case 'editar':
			try{
				# code...
				$daocd = new DAOCD();
				$photo = $_POST['photo_old'];
				if($_FILES['photo_new']['error'] == 0){
					
					$uploadresult = uploadPhoto($_FILES['photo_new']);
					if($uploadresult['status']==true){
						$photo = $uploadresult['path'];

						if(!empty($_POST['photo_old']))
						  unlink($_POST['photo_old']);
					}
				}

				$cd = new CD($_POST['title'],$photo,$_POST['release_year'],$_POST['singer']);
				$cd->setCode($_POST['code']);

				$result = $daocd->update($cd);
				if($result == 1){
					$response['response'] = array(
	    					'status' => 'success',
	    					'code' => '1',
	    					'message' => 'CD atualizado.',
	  					);
				}else{
					$response['response'] = array(
	    					'status' => 'error',
	    					'code' => '-1',
	    					'message' => 'error',
	  					);
				}
				
			
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
				
				$cd = $daocd->readByCode($_POST['code']);
				
				if($cd instanceof CD){
					$result = $daocd->delete($_POST['code']);
					if($result == 1 && !empty($cd->photo)){
						unlink($cd->photo);
					}

					$response['response'] = array(
	    					'status' => 'success',
	    					'code' => '1',
	    					'message' => 'CD removido.',
	  					);	
				}else{
					$response['response'] = array(
	    					'status' => 'error',
	    					'code' => '-1',
	    					'message' => 'Impossível excluir CD.',
	  					);
				}
				
			
				$encoded = json_encode($response);
				header('Content-type: application/json');
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