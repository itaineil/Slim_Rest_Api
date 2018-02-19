<?php


require "../api/Slim/Slim.php";
require "CrudApplication.php";



\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/customers',function(){

$crud = new DbCrud();
$allCustomers = $crud->showAllCustomers();

});

$app->get('/customer/:id',function($id){


$crud = new DbCrud();
$singleCustomer = $crud->showSingleCustomer($id);


});

$app->delete('/customer/:id',function($id){

$crud = new DbCrud();
$deleteCustomer = $crud->deleteCustomer($id);

});

$app->post('/addCustomer',function(){

$app = new \Slim\Slim();
$name = $app->request->params('name');
$surname = $app->request->params('surname');
$email = $app->request->params('email');
$gender = $app->request->params('gender');


$crud = new DbCrud();

$addCustomer = $crud->addCustomer($name,$email,$surname,$gender);

});

$app->put('/updateCustomer',function(){

$app = new \Slim\Slim();

$id = $app->request->params('id');
$name = $app->request->params('name');
$surname = $app->request->params('surname');
$email = $app->request->params('email');
$gender = $app->request->params('gender');

$crud = new DbCrud();
$crud->updateCustomer($id,$name,$email,$surname,$gender);

});

$app->run();

?>