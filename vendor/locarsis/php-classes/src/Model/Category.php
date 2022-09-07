<?php
namespace locarsis\Model;
use \locarsis\DB\Sql;
use \locarsis\Model;
use \locarsis\Mailer;
/**
 * 
 */
class Category extends Model
{


	

	public static function listAll()
	{
		$sql = new Sql();
		return  $sql->select("SELECT * FROM tb_categories ORDER BY descategory");

	}

	public function save()
	{
		$sql = new Sql();

		$result = $sql->select("CALL sp_categories_save(:idcategory,:descategory)",array(
			":idcategory"=>$this->getidcategory(),
			":descategory"=>$this->getdescategory()));

		$this->setData($result[0]);

		Category::updateFile();
	}


	public function get($idcategory)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_categories where idcategory = :idcategory",array(
			":idcategory"=>$idcategory));

		$this->setData($result[0]);

	}

	public function delete()
	{
		$sql = new Sql();

		$sql->query("DELETE FROm tb_categories WHERE idcategory = :idcategory",array(
			":idcategory"=>$this->getidcategory()));

		Category::updateFile();
	}

	public static function updateFile()
	{
		$categories = Category::listall();

		$html = [];

		foreach ($categories as $row) {
			array_push($html, "<li><a href='/categories/".$row["idcategory"]."'>".$row["descategory"]."</a></li>");
		}
//pega o arquivo categorie-menu.html e adiciona o conteudo vindo do array $html, antes transformamos o array em string
		file_put_contents($_SERVER["DOCUMENT_ROOT"]. DIRECTORY_SEPARATOR . "views".DIRECTORY_SEPARATOR."categories-menu.html", implode("", $html));
	}


    public function getProducts($related = true)
    {
    	$sql = new Sql();

    	if($related === true)
    	{
    	return $sql->select("select * from tb_products where idproduct in(
select a.idproduct
from tb_products a
inner join tb_productscategories b on a.idproduct = b.idproduct
where b.idcategory = :idcategory
);",array(
	":idcategory"=>$this->getidcategory()));
    	}else{
    		return $sql->select("select * from tb_products where idproduct not in(
select a.idproduct
from tb_products a
inner join tb_productscategories b on a.idproduct = b.idproduct
where b.idcategory = :idcategory
);",array(
	":idcategory"=>$this->getidcategory()));
    	}
    }

 

    public function addProduct(Producty $producty)
{

  $sql = new Sql();

  $sql->query("INSERT INTO tb_productscategories (idcategory,idproduct) VALUES (:idcategory,:idproduct)",array(
  	"idcategory"=>$this->getidcategory(),
  	":idproduct"=>$producty->getidproduct()));
	
}


public function removeProduct(Producty $producty)
{

	$sql = new Sql();

  $sql->query("DELETE FROM tb_productscategories WHERE idcategory = :idcategory AND idproduct = :idproduct",array(
  	"idcategory"=>$this->getidcategory(),
  	":idproduct"=>$producty->getidproduct()));
	
}
	






}



?>