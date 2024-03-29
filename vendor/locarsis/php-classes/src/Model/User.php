<?php
namespace locarsis\Model;
use \locarsis\DB\Sql;
use \locarsis\Model;
use \locarsis\Mailer;
/**
 * 
 */
class User extends Model
{
	const SESSION = "User";

	const SECRET = "HcodePhp7_Secret";
	const SECRET_IV = "HcodePhp7_Secret_IV";

	public static function login($login,$password)
	{
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :deslogin",array(
        	":deslogin"=>$login));

        if(count($results) === 0 )
        {
        	throw new \Exception("Usuario inexistente ou senha Invalido");
        	
        }

        $data = $results[0];

        if(password_verify($password, $data["despassword"]))
        {
          $user = new User();

          $user->setData($data);

          $_SESSION[User::SESSION] = $user->getValues();

          return $user;

        }else
        {

        	throw new \Exception("Usuario inexistente ou senha Invalido");

        }
	}


	public static function verifylogin($inadmin = true)
	{
		if(
           !isset($_SESSION[User::SESSION]) 
           || 
           !$_SESSION[User::SESSION] 
           ||
           !(int)$_SESSION[User::SESSION]["iduser"] > 0 
           ||
           (bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin
		)
		{
          header("Location: /admin/login");
          exit;
		}
	}

	public static function logout()
	{
		$_SESSION[User::SESSION] = NULL;
	}

	public static function listAll()
	{
		$sql = new Sql();
		return  $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) ORDER BY b.desperson");

	}

	public function save()
	{
		$sql = new Sql();

		$result =  $sql->select("CALL sp_users_save(:desperson,:deslogin,:despassword,:desemail,:pnrphone,:inadmin)",array(
			":desperson"=>$this->getdesperson(),
			":deslogin"=>$this->getdeslogin(),
			":despassword"=>$this->getPasswordHash($this->getdespassword()),
			":desemail"=>$this->getdesemail(),
			":pnrphone"=>$this->getnrphone(),
			":inadmin"=>$this->getinadmin()));

		$this->setData($result[0]);

	}

	public function get($iduser)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) where a.iduser = :iduser",array(
			":iduser"=>$iduser));

		$this->setData($result[0]);

	}

	public function update()
	{
		$sql = new Sql();

		$result = $sql->select("CALL sp_usersupdate_save(:iduser,:desperson,:deslogin,:despassword,:desemail,:nrphone,:inadmin)",array(
			"iduser"=>$this->getiduser(),
			":desperson"=>$this->getdesperson(),
			":deslogin"=>$this->getdeslogin(),
			":despassword"=>$this->getdespassword(),
			":desemail"=>$this->getdesemail(),
			":nrphone"=>$this->getnrphone(),
			":inadmin"=>$this->getinadmin()
		));

		$this->setData($result[0]);


	}

	public function delete()
	{
		$sql = new Sql();

		$sql->query("CALL sp_users_delete(:iduser)",array(
			":iduser"=>$this->getiduser()));
	}

	public static function getForgot($email)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_persons a INNER JOIN tb_users  b USING(idperson) WHERE a.desemail = :email",
			array(
			":email"=>$email));

		if(count($result) === 0)
{
	throw new \Exception("Não foi possivel recuperar a senha");
	
	}else
	{
		$data =  $result[0];

		$sql = new Sql();
		$result2 = $sql->select("CALL sp_userspasswordsrecoveries_create(:iduser,:desip)",array(
			":iduser"=>$data["iduser"],
			":desip"=>$_SERVER["REMOTE_ADDR"])
	);
		
		if(count($result2) === 0)
		{
			throw new \Exception("Não foi possivel recuperar a senha");
			
		}else
		{

			$dataRecovery = $result2[0];

			$code = openssl_encrypt($dataRecovery['idrecovery'], 'AES-128-CBC', pack("a16", User::SECRET), 0, pack("a16", User::SECRET_IV));

				$code = base64_encode($code);

				$link = "http://www.lojateste2.com.br/admin/forgot/reset?code=$code";

				$mailer = new Mailer($data["desemail"],$data["desperson"],"Redefinir senha da Loja teste","forgot",array("name"=>$data["desperson"],
					"link"=>$link));

				$mailer->send();

				return $data;

		}
	}
}

public static function validForgotDecrypt($code)
{
	
	$idrecovery = openssl_decrypt(base64_decode($code), 'AES-128-CBC', pack("a16", User::SECRET), 0, pack("a16", User::SECRET_IV));

	//esse id existe, ele e valido aind anao foi usado, esta dentro de 1 hora
	$sql = new Sql();
	$result = $sql->select("SELECT * FROM tb_userspasswordsrecoveries a
INNER JOIN tb_users b USING(iduser)
INNER JOIN tb_persons c USING(idperson)
WHERE
a.idrecovery = :idrecovery
AND
a.dtrecovery IS NULL
AND
DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();",array(
":idrecovery"=>$idrecovery));


	if(count($result) === 0 )
	{
		throw new \Exception("Não foi possivel Recupera a senha");
		
	}
	else
	{
      return $result[0];
	}
}


public static function setForgotUsed($idrecovery)
{

	$sql = new Sql();

	$sql->query("UPDATE tb_userspasswordsrecoveries SET dtrecovery = NOW() WHERE idrecovery = :idrecovery",array(":idrecovery"=>$idrecovery));


}


public function setPassword($password)
{

	$sql = new Sql();


	$sql->query("UPDATE tb_users SET despassword = :despassword WHERE iduser = :iduser",array(":despassword"=>$this->getPasswordHash($password),
        ":iduser"=>$this->getiduser()));
}


public static function getPasswordHash($password)
	{

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

	}


}

?>