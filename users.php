<?php
use \locarsis\PageAdmin;
#use \Slim\Slim;
use \locarsis\Model\User;

$app->get("/admin/users/:iduser/delete",function($iduser){
	
     User::verifylogin();

     $user = new User();

     $user->get((int)$iduser);

     $user->delete();

     header("Location: /admin/users");
     exit;

});

$app->get("/admin/users",function(){

	User::verifylogin();

	
	$pageAdmin = new PageAdmin();
	
	$users = User::listAll();

	//var_dump($users);

	$pageAdmin->setTpl("users",["users"=>$users]);
});


$app->get("/admin/users/create",function(){

	User::verifylogin();
	
	$pageAdmin = new PageAdmin();

	

	$pageAdmin->setTpl("users-create");

});


$app->get("/admin/users/:iduser",function($iduser){

	User::verifylogin();
	
	$pageAdmin = new PageAdmin();

	$user = new User();

	$user->get((int)$iduser);

	

	$pageAdmin->setTpl("users-update",array(
		"user"=>$user->getValues()
	));
});


$app->post("/admin/users/create",function(){

     User::verifylogin();

     $user = new User();

     $_POST['inadmin'] = (isset($_POST["inadmin"]))?1:0;

     $user->setData($_POST);

     $user->save();

     header("Location: /admin/users");
     exit;



});

$app->post("/admin/users/:iduser",function($iduser){
	
     User::verifylogin();

     $user = new User();

     $user->get((int)$iduser);

     $_POST['inadmin'] = (isset($_POST["inadmin"]))?1:0;

     $user->setData($_POST);

     $user->update();

     header("Location: /admin/users");
     exit;



});

?>