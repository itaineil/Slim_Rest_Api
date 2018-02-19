<?php

//model class for each customer

class Customer{

	public $name;
	public $surname;
	public $email;
	public $gender;
	public $id;

	public function __construct(){

	
	}

	public  function setId($id){

		$this->id = $id;
	}

	public function getId(){

		return $this->id;
	}

	public function setName($name){

		$this->name = $name;
	}
	public  function getName(){

		return $this->name;
	}

	public function setSurname($surname){

		$this->surname = $surname;

	}

	public function getSurname(){

		return $this->surname;

	}

	public function setGender($gender){

		$this->gender = $gender;
	}

	public  function getGender(){

		return $this->gender;
	
	}

	public function setEmail($email){

		$this->email = $email;
	}
	public function getEmail(){

		return $this->gender;
	}


}

?>