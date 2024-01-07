<?php
ini_set('max_execution_time', 300);

class DataBase {
	public function __construct(){
		/*try{
			parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
			$this->query("SET NAMES 'utf8'");
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
		*/
	}

	function connect() {
		try {
			$conection = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET;
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_EMULATE_PREPARES => false,
			];
			$pdo = new PDO($conection, DB_USER, DB_PASS, $options);
			return $pdo;
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}

?>