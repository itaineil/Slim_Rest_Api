<?php
//class that will handle all the crud applications
require "Config.php";
require "Customer.php";

class DbCrud{

public $db;
public $conn;

public function __construct(){

$this->db = new DbConn();
$this->conn = $this->db->connect();

}

//function to show all customers from the database


public function showAllCustomers(){

try{

$stmnt = $this->conn->prepare("select * from customers");
$stmnt->execute();
$result = $stmnt->fetchAll(PDO::FETCH_ASSOC);

if($result)

	$response = array();
	$response["status"] = "success";
	$response["customers"] = $result;
	echo json_encode($response);

}catch(PDOException $e){

	echo $e->getMessage();
}
}

//function to show a single customer from the database

public function showSingleCustomer($id){

	try{
	$stmnt = $this->conn->prepare("select * from customers where id = :id");
	$stmnt->bindParam(":id",$id);
    $stmnt->execute();
    $result = $stmnt->fetch(PDO::FETCH_ASSOC);

	if($result){

		$response = array();
		$response["status"] = "Success";
		$response["single_customer"] = $result;

		echo json_encode($response);
	}else{

		$response = array();
		$response["status"] = "Error";
		$response["message"] = "cannot get customer with that id";

		echo json_encode($response);
	}

}catch(PDOException $e){

	echo $e->getMessage();
}

}

//function to add a customer to the database
public function addCustomer($name,$email,$surname,$gender){

$customer = new Customer();
$customer->setName($name);
$customer->setEmail($email);
$customer->setSurname($surname);
$customer->setGender($gender);

try{

$stmnt = $this->conn->prepare("insert into customers(name,email,surname,gender)values(:name,:email,:surname,:gender)");
$stmnt->bindParam(":name",$customer->getName());
$stmnt->bindParam(":email",$customer->getEmail());
$stmnt->bindParam(":surname",$customer->getSurname());
$stmnt->bindParam(":gender",$customer->getGender());

$result = $stmnt->execute();

if($result){

	$response = array();
	$response["status"] = "Success";
	$response["message"] = "Customer Data Inserted Successfully";
	echo json_encode($response);	

}else{

	$response = array();
	$response["status"] = "Error";
	$response["message"] = "Cannot Insert Customer into the Database";
	echo json_encode($response);
}

}catch(PDOException $e){

echo $e->getMessage();

}

}

//function to delete the customer from the database

public function deleteCustomer($id){

	$customer = new Customer();
	$customer->setId($id);

	try{

	$stmnt = $this->conn->prepare("delete from customers where id = :id");
	$stmnt->bindParam(":id",$customer->getId());
	$result = $stmnt->execute();
	if($result){

		$response = array();
		$response["status"] = "Success";
		$response["message"] = "Customer Deleted Successfully";
		echo json_encode($response);
	}else{

		$response = array();
		$response["status"] = "Error";
		$response["message"] = "Cannot Delete Customer";
		echo json_encode($response);
	}

	}catch(PDOException $e){

		echo $e->getMessage();

	}
}

//function to update a single customer

public function updateCustomer($id,$name,$email,$surname,$gender){

$customer = new Customer();
$customer->setId($id);
$customer->setName($name);
$customer->setEmail($email);
$customer->setSurname($surname);
$customer->setGender($gender);

try{

$stmnt = $this->conn->prepare("update customers set name = :name,email = :email,surname = :surname,gender = :gender where id = :id");
$stmnt->bindParam(":name",$customer->getName());
$stmnt->bindParam(":email",$customer->getEmail());
$stmnt->bindParam(":surname",$customer->getSurname());
$stmnt->bindParam(":gender",$customer->getGender());
$stmnt->bindParam(":id",$customer->getId());

$result = $stmnt->execute();

if($result){

	$response = array();
	$response["status"] = "Success";
	$response["message"] = "Customer updated Successfully";
	echo json_encode($response);
}else{

	$response = array();
	$response["status"] = "Error";
	$response["message"] = "Cannot update Customer";
	echo json_encode($response);
}

}catch(PDOException $e){


	echo $e->getMessage();
}


}

}

?>