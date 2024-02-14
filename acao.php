<?php
class Conexao
{
	private static $con;

	public static function getConexao()
	{
		if (self::$con == null) {
			//self::$con = new PDO("mysql:host=sql208.epizy.com;dbname=epiz_27557936_sms", 'epiz_27557936', 'tq8rhsKupqlxc');
			self::$con = new PDO("mysql:host=127.0.0.1;dbname=sms", 'root', '');
		}
		return self::$con;
	}
}
$sql = "INSERT INTO fenix( nome, email, assunto, sms, utilizador) VALUES (:nome, :email, :assunto, :sms, :utilizador)" ;
//var_dump(Conexao::getConexao());
$find = Conexao::getConexao()->prepare($sql);
$find->bindValue(":nome",$_POST['name']);
$find->bindValue(":email",$_POST['email']);
$find->bindValue(":utilizador","fenix");
$find->bindValue(":assunto",$_POST['subject']);
$find->bindValue(":sms",$_POST['message']);
echo $find->execute();

header("Location:index.html#contact?message");
?>
