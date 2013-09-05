<?php 
class Database
{
	private static $instance;

	private function __construct()
	{
	}

	// singleton pattern
	static function getInstance()
	{
		if(!self::$instance)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * 
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 * @param string $dbName
	 */
	public function connect($host, $dbName, $user, $pass)
	{
		$pdo = new PDO(
			"mysql:host=$host;dbname=$dbName", 
			"$user", 
			"$pass", 
			array(PDO::ATTR_PERSISTENT => true)
		);
		return $pdo;
		
	}
}
?>