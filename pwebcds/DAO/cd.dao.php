<?php
class DAOCD implements IDAO{
	public function create($obj){
		try {
		    $sql = "INSERT INTO cd(
		      	code,  
		        title,
		        photo,
		        release_year,
		      	singer)
		       VALUES (
		        null,
		        :title,
		        :photo,
		        :release_year,
		        :singer)";
		   
		    $p_sql = Connection::getInstance()->prepare($sql);
		   
		    $p_sql->bindParam(":title",$obj->getTitle(),PDO::PARAM_STR);
		    $p_sql->bindParam(":photo",$obj->getPhoto(),PDO::PARAM_STR);
		    $p_sql->bindParam(":release_year",$obj->getReleaseYear(),PDO::PARAM_STR);
		    $p_sql->bindParam(":singer",$obj->getSinger(),PDO::PARAM_INT);
		        
		  return $p_sql->execute();      

		} catch (Exception $e) {
		  //throw $e->getMessage();
		  return $e->getMessage();
		}
	}
	public function read($key=""){
		try {

		        $sql = "SELECT 
		        cd.code,
		        cd.title,
		        cd.photo,
		        cd.release_year,
		        singer.name as singer_name,
		        singer.code as singer_code
				FROM cd INNER JOIN singer
				ON cd.singer=singer.code WHERE 
				LOWER(singer.name) LIKE LOWER(:key) OR LOWER(cd.title) LIKE LOWER(:key) OR LOWER(cd.release_year) LIKE LOWER(:key) ORDER BY cd.code";
		   
		        $p_sql = Connection::getInstance()->prepare($sql);
		   		
		        $p_sql->bindValue(":key","%$key%");
		        $p_sql->execute();
  				
  				$result = $p_sql->fetchAll();

  				$cds = array();	
		        foreach ($result as $row) {
		        	$cd = new CD();
		        	$cd->setCode($row['code']);
		        	$cd->setTitle($row['title']);
		        	$cd->setPhoto($row['photo']);
		        	$cd->setReleaseYear($row['release_year']);
		        	$cd->setSinger(new Singer($row['singer_name'],$row['singer_code']));
		        	array_push($cds,$cd);	
		        }
		        return $cds;
		         
		} catch (Exception $e) {
		   //throw $e->getMessage();
		   return $e->getMessage();
		}
	}
	public function  readAll(){
		try {
		        $sql = "SELECT 
		        cd.code,
		        cd.title,
		        cd.photo,
		        cd.release_year,
		        singer.name as singer_name,
		        singer.code as singer_code
				FROM cd INNER JOIN singer
				ON cd.singer = singer.code";
		   
		        $p_sql = Connection::getInstance()->prepare($sql);
		        $p_sql->execute();

		        $result = $p_sql->fetchAll();

  				$cds = [];	
		        foreach ($result as $row) {
		        	$cd = new CD();
		        	$cd->setCode($row['code']);
		        	$cd->setTitle($row['title']);
		        	$cd->setPhoto($row['photo']);
		        	$cd->setReleaseYear($row['release_year']);
		        	$cd->setSinger(new Singer($row['singer_name'],$row['singer_code']));
		        	array_push($cds,$cd);
		        }
		        return $cds;
		         
		} catch (Exception $e) {
		   //throw $e->getMessage();
		   return $e->getMessage();
		}
	}
	public function readByCode($code) {
		try {

		        $sql = "SELECT * FROM cd WHERE code = :code";
		   
		        $p_sql = Connection::getInstance()->prepare($sql);
		   		
		        $p_sql->bindParam(":code",$code,PDO::PARAM_STR);
		        $p_sql->execute();

		        $p_sql->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"CD");
		          
		        $result = $p_sql->fetchAll();
		        
		        if(count($result) > 0)
		        	return $result[0];
		      	else
		      	 	return null;
		         
		} catch (Exception $e) {
		   throw $e->getMessage();
		}
	}
	public function  update($obj){
		try {
		    $sql = "UPDATE cd set 
			    title = :title,
			    photo = :photo,
			    release_year = :release_year,
			    singer = :singer
		     WHERE code =:code";

		   $p_sql = Connection::getInstance()->prepare($sql);  

		   $p_sql->bindParam(":code", $obj->getCode(),PDO::PARAM_INT);
		   $p_sql->bindParam(":title", $obj->getTitle(),PDO::PARAM_STR);
		   $p_sql->bindParam(":photo", $obj->getPhoto(),PDO::PARAM_STR);
		   $p_sql->bindParam(":release_year",$obj->getReleaseYear(),PDO::PARAM_STR);
		   
		   if($obj->getSinger() instanceof Singer)
		   		$p_sql->bindParam(":singer",$obj->getSinger()->getCode(),PDO::PARAM_INT);
		   else if($obj->getSinger() != null){
		   		$p_sql->bindParam(":singer",$obj->getSinger(),PDO::PARAM_INT);
		   }else{
		  		$p_sql->bindValue(":singer",0); 
		   }
		   
		   return $p_sql->execute();
   
		} catch (Exception $e) {
		   //throw $e->getMessage();
		   return $e->getMessage();
		}		
	}

	public function delete($key) {
		try {

		    $sql = "DELETE FROM cd WHERE code =:code";
		   
		    $p_sql = Connection::getInstance()->prepare($sql);

		    $p_sql->bindValue(":code",$key);
		   	
		   	return $p_sql->execute();
   
		} catch (Exception $e) {
		  //throw $e->getMessage();
		  return $e->getMessage();
		}
	}

}
?>