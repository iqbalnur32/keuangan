<?php

class Databese
{
	private $hostdb = "localhost";
	private $userdb = "inde5327_alwan";
	private $passdb = "kontol2712";
	private $namedb = "inde5327_keuangan-team";
	public $pdo;

	public function __construct(){
		if (!isset($this->pdo)) {
			try {
				$link = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb, $this->userdb, $this->passdb);
				$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$link->exec("SET CHARACTER SET utf8");
				$this->pdo = $link;
			} catch (PDOException $e) {
				die("Failed to connect with Databese".$e->getMessage());
			}
		}

	}
}

?>
