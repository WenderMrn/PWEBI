<?php
	require_once "../config/imports.all.php";

	if(isset($_POST['operation']))
	switch ($_POST['operation']) {
		case 'cadastrar':
			try{
				# code...
				$daosinger = new DAOSinger();
				$result = $daosinger->create(new Singer($_POST['name']));
				if($result == 1){
					$response['response'] = array(
	    							'status' => 'success',
	    							'code' => '1',
	    							'message' => 'Cantor(a) '.$_POST['name'].', cadastrado com sucesso.',
	  							);
				}else{
					$response['response'] = array(
	    							'status' => 'error',
	    							'code' => '-1',
	    							'message' => 'Cantor(a) '.$_POST['name'].', já está cadastrado.',
	  							);
				}
				$_POST['operation'] = null;
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
				$daosinger = new DAOSinger();
				$result = $daosinger->readAll();
				
				$response['response'] = array(
	    					'status' => 'success',
	    					'code' => '1',
	    					'message' => '',
	    					'singers' => $result,
	  					);
			
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