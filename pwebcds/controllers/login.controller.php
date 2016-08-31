<?php
	session_start();
	require_once "../config/imports.all.php";
	
	if(isset($_GET['operation'])){
		switch ($_GET['operation']) {
			case 'login':
				try {
					$daouser = new DAOUser();
					$user = $daouser->readByLogin($_POST['login']);
					
					if($user != null && $user instanceof User){
						 
						if($user->getPassword() == crypt($_POST['password'],CRYPT_SALT_LENGTH)){
							$_SESSION['user'] = $user;
							$response['response'] = array(
    							'status' => 'success',
    							'code' => '1',
    							'message' => 'logado sucesso!',
  							);

						}else{
							
							$response['response'] = array(
    							'status' => 'error',
    							'code' => '-1',
    							'message' => 'Usuário ou senhar incorretos.',
  							);
						}
					}else{
						
						$response['response'] = array(
    							'status' => 'error',
    							'code' => '-2',
    							'message' => 'Usuário ou senha inválidos!',
  							);
					}

					$encoded = json_encode($response);
					header('Content-type: application/json');
					exit($encoded);

				} catch (Exception $e) {
					exit($e.getMessage());
				}

			break;
			case 'logout';
				if(isset($_SESSION['user'])){
					session_unset($_SESSION['user']); 
				}
				header("Location:../index.php");
			break;
		}
		
	}

?>