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
		   
		          $p_sql->bindParam(":name", $obj->getName(),PDO::PARAM_STR);
		          $p_sql->bindParam(":login", $obj->getLogin(),PDO::PARAM_STR);
		          $p_sql->bindParam(":password", $obj->getPassword(),PDO::PARAM_STR);
		        
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

		   	$p_sql->bindParam(":code",$obj->getCode(),PDO::PARAM_INT);
		    $p_sql->bindParam(":name",$obj->getName(),PDO::PARAM_SRT);
		    $p_sql->bindParam(":login",$obj->getLogin(),PDO::PARAM_SRT);
		    $p_sql->bindParam(":password",$obj->getPassword(),PDO::PARAM_SRT);
		    
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