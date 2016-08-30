<?php
class User{
	public $code;
	public $name;
	public $login;
	public $password;

	public function __construct($name=null, $login=null, $password=null)
	{
		$this->name = $name;
		$this->login = $login;
		$this->password = $password;
	}

    public function getCode(){
        return $this->code;
    }

    public function setCode($code){
        $this->code = $code;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

   
    public function getLogin(){
        return $this->login;
    }
    
    public function setLogin($login){
        $this->login = $login;
    }

    public function getPassword(){
        return $this->password;
    }
   
    public function setPassword($password){
        $this->password = $password;
    }
}
?>