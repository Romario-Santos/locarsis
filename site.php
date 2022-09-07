<?php
use locarsis\Page;
use locarsis\Model\Producty;
use locarsis\Model\Category;

$app->get('/', function() {

	$product =  Producty::listAll();
    
    $page = new Page();
    $page->setTpl("index",["products"=>Producty::checkList($product)]);

});

$app->get("/categories/:idcategory",function($idcategory){
    
$category = new Category();

$category->get((int)$idcategory);

$page = new Page();

$page->setTpl("category",[
	"category"=>$category->getValues(),
	"products"=>Producty::checkList($category->getProducts())
]
);

});

?>