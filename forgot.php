<?php
use locarsis\PageAdmin;
use \locarsis\Model\User;



$app->get("/admin/forgot",function()
{
	$pageAdmin = new PageAdmin(['header'=>false,'footer'=>false]);
	$pageAdmin->setTpl('forgot');

});
// 

$app->post("/admin/forgot",function()
{
	
 $user = user::getForgot($_POST["email"]);

 header("Location: /admin/forgot-sent");
 exit;
});
// 

$app->get("/admin/forgot-sent",function()
{
	$pageAdmin = new PageAdmin(['header'=>false,'footer'=>false]);
	$pageAdmin->setTpl('forgot-sent');

});

$app->get("/admin/forgot/reset",function(){

$user = User::validForgotDecrypt($_GET["code"]);

 $pageAdmin = new PageAdmin(['header'=>false,'footer'=>false]);

 $pageAdmin->setTpl('forgot-reset',
		["name"=>$user["desperson"],"code"=>$_GET["code"]]);
});

$app->post("/admin/forgot/reset",function(){


$forgot = User::validForgotDecrypt($_POST["code"]);

User::setForgotUsed($forgot["idrecovery"]);
    
    $user = new User();
    
    $user->get((int)$forgot["iduser"]);

    $user->setPassword($_POST["password"]);
   

   
   $pageAdmin = new PageAdmin(['header'=>false,'footer'=>false]);

 $pageAdmin->setTpl('forgot-reset-success');


});



?>