<?php
	session_start();
	require_once "../config/imports.all.php";
	if(isset($_GET['operation'])){
		switch ($_GET['operation']) {
			case 'cadastrar':
				try {
					$daouser = new DAOUser();
					$user = new User($_POST['name'],$_POST['login'],crypt($_POST['password'],CRYPT_SALT_LENGTH));
					$result = $daouser->create($user);
					if($result == 1){
						//header("Location: ../views/index.php?page=cadastrar-usuario&alert=usuario_cadastrado");
						$response['response'] = array(
    						'status' => 'success',
    						'code' => '1',
    						'message' => 'Usuário cadastrado.',
  						);
					}else{
						//header("Location: ../views/index.php?page=cadastrar-usuario&alert=usuario_cadastrado_error");
						$response['response'] = array(
    						'status' => 'error',
    						'code' => '-1',
    						'message' => $result,
  						);
					}

					$encoded = json_encode($response);
					header('Content-type: application/json');
					exit($encoded);

				} catch (Exception $e) {
					exit($e.getMessage());
				}
			break;
		}
		
	}

?>