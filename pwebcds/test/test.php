<?php
	require_once "../config/imports.all.php";

	try {

		/*echo "<h1>Cadastro de Usuário</h1>";
		$user = new User("Joao da Silva","joaosilva",crypt("123",CRYPT_SALT_LENGTH));
		$daouser = new DAOUser();
		echo $daouser->create($user);

		echo "<h1>Localizar Usuário Login</h1>";
		$daouser = new DAOUser();
		var_dump($daouser->readByLogin("joaosilva"));

		echo "<h1>Cadastro de Cantor</h1>";

		$singer = new Singer("Zeca Bagodinho");
		$daosinger = new DAOSinger();
		echo $daosinger->create($singer);

		echo "<h1>Localizar Cantor</h1>";
		$singer = $daosinger->read("Zeca Bagodinho");
		var_dump($singer);

		echo "<h1>Atualizar Cantor</h1>";
		$singer->setName("Zeca Pagodinho"); 
		var_dump($daosinger->update($singer));

		echo "<h1>Deletar Cantor</h1>";
		var_dump($daosinger->delete($singer));

		echo "<h1>Listar Cantores</h1>";
		var_dump($daosinger->readAll());

		echo "<h1>Cadastro de CD</h1>";
		$cd = new CD("Gorilas","","23/07/2017",3);
		$daocd = new DAOCD();
		echo $daocd->create($cd);

		echo "<h1>Localizar CD pelo título</h1>";
		$daocd = new DAOCD();
		$cd = $daocd->read($cd->getTitle());
		var_dump($cd);

		echo "<h1>Atualizar CD</h1>";
		$daocd = new DAOCD();
		
		$cd->setTitle("Gorilias 4");
		$cd->setPhoto("...");
		$cd->setReleaseYear("01/01/2016");
		var_dump($cd);
		var_dump($daocd->update($cd));

		echo "<h1>Listar CDs</h1>";
		$daocd = new DAOCD();
		
		var_dump($daocd->readAll());*/

		$daocd = new DAOCD();
		var_dump($daocd->read('bruno mars'));

	} catch (Exception $e) {
		echo $e->getMessage();		
	}

	

