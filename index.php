<?php 
session_start();
require_once("vendor/autoload.php");
use \locarsis\Page;
use \locarsis\PageAdmin;
use \Slim\Slim;
use \locarsis\Model\User;
use \locarsis\Model\Category;

$app = new Slim();

require_once("site.php");
require_once("users.php");
require_once("forgot.php");
require_once("categories.php");
require_once("products.php");
require_once("functions.php");

$app->config('debug', true);

$app->get('/', function() {
    
    $page = new Page();
    $page->setTpl("index");

});

$app->get("/admin",function(){

	User::verifylogin();

	$pageAdmin = new PageAdmin();
	$pageAdmin->setTpl("index");
});

$app->get("/admin/login",function(){
	$pageAdmin = new PageAdmin(["header"=>false,"footer"=>false]);
	$pageAdmin->setTpl("login");
});


$app->post("/admin/login",function(){
  
  User::login($_POST["login"],$_POST["password"]);

  header("Location: /admin");
  exit;
});

$app->get("/admin/logout",function()
{
	User::logout();
	header("Location: /admin/login");
	exit;
});







$app->run();

 ?>