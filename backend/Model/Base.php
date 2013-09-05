<?php 
abstract class Base
{
	/**
	 *@var PDO
	 */
	protected $_pdo = null;
	
	/**
	 * @param Database $database
	 */
	public function __construct(Database $database)
	{
		$registry = Registry::getInstance();
		$this->_pdo = $database->connect(
				$registry->get('host'),
				$registry->get('dbname'),
				$registry->get('user'),
				$registry->get('pass')
		);
	}
}
?>