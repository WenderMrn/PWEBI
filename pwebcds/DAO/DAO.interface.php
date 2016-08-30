<?php 
	interface IDAO{
		public function create($obj);
		public function read($chave);
		public function update($obj);
		public function delete($obj);	
	}
?>