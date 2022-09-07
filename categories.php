<?php
use locarsis\PageAdmin;
use locarsis\Page;
use locarsis\Model\User;
Use locarsis\Model\Category;
Use locarsis\Model\Producty;

$app->get("/admin/categories",function(){

       User::verifylogin();

       $categories = Category::listAll();

       $pageAdmin = new PageAdmin();


       $pageAdmin->setTpl("categories",["categories"=>$categories]);


});

$app->get("/admin/categories/:idcategory/delete",function($idcategory){

       
       User::verifylogin();

       $category = new Category();

       $category->get((int)$idcategory);

       $category->delete();

       header("Location: /admin/categories");
       exit;


});

$app->get("/admin/categories/create",function(){

       User::verifylogin();

       

       $pageAdmin = new PageAdmin();


       $pageAdmin->setTpl("categories-create");


});

$app->post("/admin/categories/create",function(){
   
     User::verifylogin();

     $category = new Category();

     $category->setData($_POST);

     $category->save();

     header("Location: /admin/categories");
     exit;
});

$app->get("/admin/categories/:idcategory",function($idcategory){
    
    User::verifylogin();

    $category = new Category();

    $category->get((int)$idcategory);
    
    $pageAdmin = new PageAdmin();


    $pageAdmin->setTpl("categories-update",["category"=>$category->getValues()]);

});

$app->post("/admin/categories/:idcategory",function($idcategory){
       
   User::verifylogin();

   $category = new Category();

   $category->get((int)$idcategory);

   $category->setData($_POST);

   $category->save();

   header("Location: /admin/categories");
   exit;



});









$app->get("/admin/categories/:idcategory/products",function($idcategory){
  User::verifylogin();

  $category = new Category();

  $category->get((int)$idcategory);
    
  $pageAdmin = new PageAdmin();
  $pageAdmin->setTpl("categories-products",[
    "category"=>$category->getValues(),
    "productsNotRelated" => $category->getProducts(false),
    "productsRelated"=>$category->getProducts()]);


 
});

$app->get("/admin/categories/:idcategory/products/:idproducty/add",function($idcategory,$idproduct){

  User::verifylogin();

  $category = new Category();

  $category->get((int)$idcategory);

  $product = new Producty();

  $product->get((int)$idproduct);

  $category->addProduct($product);

  header("Location: /admin/categories/".$idcategory."/products");
  exit;

});

$app->get("/admin/categories/:idcategory/products/:idproducty/remove",function($idcategory,$idproduct){

  User::verifylogin();

  $category = new Category();

  $category->get((int)$idcategory);

  $product = new Producty();

  $product->get((int)$idproduct);

  $category->removeproduct($product);

   header("Location: /admin/categories/".$idcategory."/products");
  exit;

});




?>