<?php
	class CD{
		
		public $code;
		public $title;
		public $photo;
		public $release_year;
		public $singer;

		public function __construct($title=null,$photo=null,$release_year=null,$singer=null){
			$this->title = $title;
			$this->photo = $photo;
			$this->release_year = $release_year;
			$this->singer = $singer;
		}

		public function getPhoto(){
			return $this->photo;
		}

		public function setPhoto($photo){
			$this->photo = $photo;
		}

		public function getCode(){
			return $this->code;
		}

		public function setCode($code){
			$this->code = $code;
		}

		public function getTitle(){
			return $this->title;
		}

		public function setTitle($title){
			$this->title = $title;
		}

		public function getReleaseYear(){
			return $this->release_year;
		}

		public function setReleaseYear($release_year){
			$this->release_year = $release_year;
		}
		public function getSinger(){
			return $this->singer;
		}

		public function setSinger($singer){
			$this->singer = $singer;
		}
	}
?>