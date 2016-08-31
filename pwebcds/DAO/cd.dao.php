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
		   
		    $p_sql->bindParam(":title", $obj->getTitle(),PDO::PARAM_STR);
		    $p_sql->bindParam(":photo", $obj->getPhoto(),PDO::PARAM_STR);
		    $p_sql->bindParam(":release_year",$obj->getReleaseYear(),PDO::PARAM_STR);
		    $p_sql->bindParam(":singer",$obj->getSinger(),PDO::PARAM_INT);
		        
		  return $p_sql->execute();      

		} catch (Exception $e) {
		  //throw $e->getMessage();
		  return $e->getMessage();
		}
	}
	public function read($key1="",$key2="",$key3=""){
		try {

		        $sql = "SELECT 
		        cd.code,
		        cd.title,
		        cd.photo,
		        cd.release_year,
		        singer.name as singer_name,
		        singer.code as singer_code
				FROM cd LEFT OUTER JOIN singer
				ON cd.singer=singer.code WHERE 
				(singer.name = :key1 OR cd.title = :key1 OR cd.release_year = :key1) OR
				(singer.name LIKE '%:key2%' AND cd.title LIKE '%:key1%' AND cd.release_year LIKE '%:key3%') ORDER BY cd.code";
		   
		        $p_sql = Connection::getInstance()->prepare($sql);
		   		
		        $p_sql->bindValue(":key1",$key1);
		        $p_sql->bindValue(":key2",$key2);
		        $p_sql->bindValue(":key3",$key3);
		        $p_sql->execute();
  				
  				$result = $p_sql->fetchAll();

  				$cd = null;	
		        foreach ($result as $row) {
		        	$cd = new CD();
		        	$cd->setCode($row['code']);
		        	$cd->setTitle($row['title']);
		        	$cd->setPhoto($row['photo']);
		        	$cd->setReleaseYear($row['release_year']);
		        	$cd->setSinger(new Singer($row['singer_name'],$row['singer_code']));
		        	return $cd;	
		        }
		        return $cd;
		         
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
		   
		   if($obj->getSinger() != null)
		   		$p_sql->bindParam(":singer",$obj->getSinger()->getCode(),PDO::PARAM_INT);
		   else
		  		$p_sql->bindValue(":singer",0); 
		   
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