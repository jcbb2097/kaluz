<?php
include_once __DIR__."/../../../../../../source/dao/clases/Config1.php";
	
class ConexionPDO extends PDO
{
	public function __construct()
	{
		try
		{
			parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
			$this->query("SET NAMES 'utf8'");
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

?>