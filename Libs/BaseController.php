<?php 
require_once '/'.$_SERVER['DOCUMENT_ROOT'] . '/backend/Model/Database.php';
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/backend/Model/Registry.php';
abstract class Libs_BaseController
{	
	/**
	 * @var Database
	 */
	protected $_database = null;
	
	public function index()
	{
		$this->_database = Database::getInstance();
		$registry = Registry::getInstance();
		$registry->set('host', 'yourhost');
		$registry->set('dbname', 'yourdbname');
		$registry->set('user', 'user');
		$registry->set('pass', 'pass');
	}
	
	/**
	 *
	 * @param string $page
	 */
	protected function reDirectTo($page)
	{
		header("Location: " . $page);
	}
}
?>
