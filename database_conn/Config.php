<?php

//class that has the basic connection to the database


class DbConn{

	
	public $hostname = "localhost";
	public $username = "root";
	public $password = "";
	public $dbname = "my_customers";

	public function __construct(){

		
	}

public function connect(){

	$dbconn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname",$this->username,$this->password);
	return $dbconn;
}
}
?>


