<?php
class DAOSinger implements IDAO{
	public function create($obj){
		try {
		    $sql = "INSERT INTO singer(
		      	code,  
		        name)
		       VALUES (
		        null,
		        :name)";
		   
		    $p_sql = Connection::getInstance()->prepare($sql);
		   	$name = $obj->getName();
		    $p_sql->bindParam(":name",$name,PDO::PARAM_STR);  

		  	return $p_sql->execute();      

		} catch (PDOException $e) {
		  //throw $e->getMessage();
			return $e->getMessage();
		}
	}
	public function read($key){
		try {

		        $sql = "SELECT * FROM singer WHERE name = :name";
		   
		        $p_sql = Connection::getInstance()->prepare($sql);
		   		
		        $p_sql->bindParam(":name",$key,PDO::PARAM_STR);
		        $p_sql->execute();

		        $p_sql->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"Singer");
		          
		        $result = $p_sql->fetchAll();
		        
		        if(count($result) > 0)
		        	return $result[0];
		      	else
		      	 	return null;
		         
		} catch (Exception $e) {
		   throw $e->getMessage();
		}
	}
	public function  readAll(){
		try {
		        $sql = "SELECT * FROM singer";
		   
		        $p_sql = Connection::getInstance()->prepare($sql);
		        $p_sql->execute();

		        return $p_sql->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"Singer");
		         
		} catch (Exception $e) {
		   //throw $e->getMessage();
			return $e->getMessage();
		}
	}
	public function  update($obj){
		try {
		    $sql = "UPDATE singer set 
			    name = :name
		     WHERE code =:code";

		   $p_sql = Connection::getInstance()->prepare($sql);
		   $code = $obj->getCode();
		   $name = $obj->getName();
		   $p_sql->bindParam(":code", $code,PDO::PARAM_INT);
		   $p_sql->bindParam(":name",$name,PDO::PARAM_STR);
		   
		   return $p_sql->execute();
   
		} catch (Exception $e) {
		   //throw $e->getMessage();
		   return $e->getMessage();
		}		
	}
	public function delete($key) {
		try {

		    $sql = "DELETE FROM singer WHERE code =:code OR name = :name";
		   
		    $p_sql = Connection::getInstance()->prepare($sql);
		    
		    if($key instanceof Singer){
		    	
		    	$code = $key->getCode();
		    	$key->getName();

		    	$p_sql->bindValue(":code",$code);
		   		$p_sql->bindValue(":name",$name);
		    }else{
		    	$p_sql->bindValue(":code",$key);
		   		$p_sql->bindValue(":name",$key);
		    }

		   	return $p_sql->execute();
   
		} catch (Exception $e) {
		  //throw $e->getMessage();
		  return $e->getMessage();
		}
	}
}
?>