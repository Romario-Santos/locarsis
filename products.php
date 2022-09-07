<?php
use locarsis\PageAdmin;
//use locarsis\Page;
use locarsis\Model\User;
Use locarsis\Model\Producty;


$app->get("/admin/products",function(){

       User::verifylogin();

       $products = Producty::listAll();

       $pageAdmin = new PageAdmin();


       $pageAdmin->setTpl("products",["products"=>$products]);


});



$app->get("/admin/products/:idproducty/delete",function($idproducty){

       
       User::verifylogin();

       $producty = new Producty();

       $producty->get((int)$idproducty);

       $producty->delete();

       header("Location: /admin/products");
       exit;


});



$app->get("/admin/products/create",function(){
User::verifylogin();

$pageAdmin = new PageAdmin();

$pageAdmin->setTpl("products-create");
});





$app->post("/admin/products/create",function(){
   
     User::verifylogin();

     $producty = new Producty();

     //var_dump($_POST);
     

     $producty->setData($_POST);

     $producty->save();

     header("Location: /admin/products");
     exit;
});

$app->get("/admin/products/:idproducty",function($idproducty){
    
    User::verifylogin();

    $producty = new Producty();

    $producty->get((int)$idproducty);
    
    $pageAdmin = new PageAdmin();


    $pageAdmin->setTpl("products-update",["product"=>$producty->getValues()]);

});

$app->post("/admin/products/:idproducty",function($idproducty){
       
   User::verifylogin();

   $producty = new Producty();

   $producty->get((int)$idproducty);

   $producty->setData($_POST);


   $producty->save();

  if(empty($_FILES['file']['size']) != true)
   $producty->setPhoto($_FILES["file"]);

   header("Location: /admin/products");
   exit;



});





?>