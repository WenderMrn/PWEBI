<?php
class DAOUser implements IDAO{
 	public function create($obj){
		try {
		          $sql = "INSERT INTO user(
		          	  code,  
		              name,
		              login,
		              password)
		              VALUES (
		              null,
		              :name,
		              :login,
		              :password)";
		   
		          $p_sql = Connection::getInstance()->prepare($sql);

		          $name = $obj->getName();
		          $login = $obj->getLogin();
		          $password = $obj->getPassword();	
		   			
		          $p_sql->bindParam(":name", $name,PDO::PARAM_STR);
		          $p_sql->bindParam(":login", $login,PDO::PARAM_STR);
		          $p_sql->bindParam(":password",$password,PDO::PARAM_STR);
		        
		      return $p_sql->execute();      

		    } catch (Exception $e) {
		      //throw $e->getMessage();
		      return $e->getMessage();
		    }
	}
	public function read($chave){
		try {
		          $sql = "SELECT * FROM user WHERE code = :code";
		   
		          $p_sql = Connection::getInstance()->prepare($sql);
		   
		          $p_sql->bindParam(":code",$chave,PDO::PARAM_INT);
		          $p_sql->execute();

		          $p_sql->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"User");
		          
		          $result = $p_sql->fetch();
		          if($result instanceof User)
		          	return $result;
		      	  else
		      	  	return null;
		         
		    } catch (Exception $e) {
		      //throw $e->getMessage();
		      return $e->getMessage();
		    }
		
	}
	public function readByLogin($chave){
		try {
		          $sql = "SELECT * FROM user WHERE login = :login";
		   
		          $p_sql = Connection::getInstance()->prepare($sql);
		   
		          $p_sql->bindParam(":login",$chave,PDO::PARAM_STR);
		          $p_sql->execute();

		          $p_sql->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"User");
		          
		          $result = $p_sql->fetch();
		          if($result instanceof User)
		          	return $result;
		      	  else
		      	  	return null;
		         
		    } catch (Exception $e) {
		      //throw $e->getMessage();
		      return $e->getMessage();
		    }
		
	}
	public function update($obj){
		try {
		    $sql = "UPDATE user set
		     nome = :nome,
		     login = :login,
		     password = :password
		     WHERE code =:code";
		   
		    $p_sql = Connection::getInstance()->prepare($sql);
		    
		    $code = $obj->getCode();
		    $name = $obj->getName();
		    $login = $obj->getLogin(); 
		   	$password = $obj->getPassword();
		   	
		   	$p_sql->bindParam(":code",$code,PDO::PARAM_INT);
		    $p_sql->bindParam(":name",$name,PDO::PARAM_SRT);
		    $p_sql->bindParam(":login",$login,PDO::PARAM_SRT);
		    $p_sql->bindParam(":password",$password,PDO::PARAM_SRT);
		    
		    return $p_sql->execute();
   
		} catch (Exception $e) {
		   //throw $e->getMessage();
		   return $e->getMessage();
		}
	}
	public function delete($key) {
		try {

		    $sql = "DELETE FROM user WHERE code =:code";
		   
		    $p_sql = Connection::getInstance()->prepare($sql);
		    $p_sql->bindParam(":code",$key,PDO::PARAM_INT);
		   	
		   	return $p_sql->execute();
   
		} catch (Exception $e) {
		  //throw $e->getMessage();
		  return $e->getMessage();
		}
	}
 }
?>