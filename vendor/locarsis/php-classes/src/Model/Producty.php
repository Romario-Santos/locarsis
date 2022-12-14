<?php
namespace locarsis\Model;
use \locarsis\DB\Sql;
use \locarsis\Model;
use \locarsis\Mailer;
/**
 * 
 */
class Producty extends Model
{


	

	public static function listAll()
	{
		$sql = new Sql();
		return  $sql->select("SELECT * FROM tb_products ORDER BY desproduct");

	}

	public function save()
	{
		$sql = new Sql();

		$result = $sql->select("CALL sp_products_save(:idproduct,:desproduct,:vlprice,:vlwidth,:vlheight,:vllength,:vlweight,:desurl,:desns,:desfornecedor,:desstatus,:desram,:desprocessador,:destipodisco,:destamanhodisco)",array(
			":idproduct"=>$this->getidproduct(),
			":desproduct"=>$this->getdesproduct(),
			":vlprice"=>$this->getvlprice(),
			":vlwidth"=>$this->getvlwidth(),
			":vlheight"=>$this->getvlheight(),
			":vllength"=>$this->getvllength(),
			":vlweight"=>$this->getvlweight(),
			":desurl"=>$this->getdesurl(),
			":desns"=>$this->getdesns(),
			":desfornecedor"=>$this->getdesfornecedor(),
			":desstatus"=>$this->getdesstatus(),
			":desram"=>$this->getdesram(),
			":desprocessador"=>$this->getdesprocessador(),
			":destipodisco"=>$this->getdestipodisco(),
			":destamanhodisco"=>$this->getdestamanhodisco()

		));

		$this->setData($result[0]);

		
	}
    
    public static function checkList($list)
    {
    	foreach ($list as &$row) {
    		$p = new Producty();
    		$p->setData($row);
    		$row = $p->getValues();
    	}

    	return $list;
    }

	public function get($idproduct)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_products where idproduct = :idproduct",array(
			":idproduct"=>$idproduct));

		$this->setData($result[0]);

	}

	public function delete()
	{
		$sql = new Sql();

		$sql->query("DELETE FROm tb_products WHERE idproduct = :idproduct",array(
			":idproduct"=>$this->getidproduct()));

		
	}

	public function checkPhoto()
	{
		if(file_exists($_SERVER['DOCUMENT_ROOT'].
		 DIRECTORY_SEPARATOR . "res" . 
		 DIRECTORY_SEPARATOR . "site" . 
		 DIRECTORY_SEPARATOR . "img" . 
		 DIRECTORY_SEPARATOR . "products" .
		 DIRECTORY_SEPARATOR .
		 $this->getidproduct(). ".jpg")){
			$url = "/res/site/img/products/". $this->getidproduct() . ".jpg";
		}else
		{
			$url = "/res/site/img/products/pro.jpg";
		}

		return $this->setdesphoto($url);
	}


    public function getValues()
    {
    	$this->checkPhoto();

    	$values = parent::getValues();

        return $values;
    }
	

	public function setPhoto($file)
{  


	$extension = explode(".",$file["name"]);
	$extension = end($extension);


	switch($extension)
	{
		case "jpg":
		case "jpeg":
		$image = imagecreatefromjpeg($file["tmp_name"]);
		break;
		case "gif" :
		$image = imagecreatefromgif($file["tmp_name"]);
		break;
		case "webp" :
		$image = imagecreatefrompng($file["tmp_name"]);
		break;
		case "png" :
		$image = imagecreatefrompng($file["tmp_name"]);
		break;
	
	}

    $destino = $_SERVER['DOCUMENT_ROOT'].
		 DIRECTORY_SEPARATOR . "res" . 
		 DIRECTORY_SEPARATOR . "site" . 
		 DIRECTORY_SEPARATOR . "img" . 
		 DIRECTORY_SEPARATOR . "products" .
		 DIRECTORY_SEPARATOR . $this->getidproduct() . ".jpg";

	imagejpeg($image,$destino);

	imagedestroy($image);

	$this->checkPhoto();

}

public function addProduct(Producty $producty)
{
	
}

}



?>