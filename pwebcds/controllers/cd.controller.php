<?php
	require_once "../config/imports.all.php";
	if(isset($_POST['operation']))
	switch ($_POST['operation']) {
		case 'cadastrar':
			try{
				# code...
				$daocd = new DAOCD();
				$cd = new CD($_POST['title'],'',$_POST['release_year'],$_POST['singer']);
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
				$_POST['operation'] = null;
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