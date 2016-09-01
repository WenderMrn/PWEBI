<?php
	/* import conection class*/
	require_once "../connection/connection.class.php";
	/* import DAOS */
	require_once "../DAO/DAO.interface.php";
	require_once "../DAO/cd.dao.php";
	require_once "../DAO/singer.dao.php";
	require_once "../DAO/user.dao.php";
	/* Models class */
	require_once "../models/cd.class.php";
	require_once "../models/singer.class.php";
	require_once "../models/user.class.php";

	$connFile = file("../config/conn.txt",FILE_IGNORE_NEW_LINES);
	
	define("HOSTNAME", $connFile[0]);
	define("DBNAME",$connFile[1]);
	define("DBUSER",$connFile[2]);
	define("DBPASS",array_key_exists(3,$connFile)?$connFile[3]:"");

?>