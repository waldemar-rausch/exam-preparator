<?php 
/**
 * Registry class to pass global variables between classes.
 */
class Registry
{
	/**
	 * Object registry provides storage for shared objects
	 *
	 * @var array
	 */
	private static $registry = array();
	
	/**
	 * @var Registry
	 */
	private static $instance = null;
	
	private function __construct(){}
	
	/**
	 * @return null
	 */
	public static function getInstance() 
	{
		if(is_null(self::$instance)) {
			self::$instance = new self();
		}
	
		return self::$instance;
	}

	/**
	 * Adds a new variable to the Registry.
	 *
	 * @param string $key Name of the variable
	 * @param mixed $value Value of the variable
	 * @throws Exception
	 * @return bool
	 */
	public function set($key, $value) {
		if ( ! self::has($key) ) {
			self::$registry[$key] = $value;
			return true;
		} else {
			throw new Exception('Unable to set variable `' . $key . '`. It was already set.');
		}
	}
		
	/**
	 * Tests if given $key exists in registry
	 *
	 * @param string $key
	 * @return bool
	 */
	public function has($key)
	{
		if ( isset( self::$registry[$key] ) ) {
			return true;
		}
			
		return false;
	}
		
	/**
	 * Returns the value of the specified $key in the Registry.
	 *
	 * @param string $key Name of the variable
	 * @return mixed Value of the specified $key
	 */
	public function get($key)
	{
		if ( self::has($key) ) {
			return self::$registry[$key];
		}
		return null;
	}
		
	/**
	 * Returns the whole Registry as an array.
	 *
	 * @return array Whole Registry
	 */
	public function getAll()
	{
		return self::$registry;
	}

	/**
	 * Removes a variable from the Registry.
	 *
	 * @param string $key Name of the variable
	 * @return bool
	 */
	public function remove($key)
	{
		if ( self::has($key) ) {
			unset(self::$registry[$key]);
			return true;
		}
		return false;
	}

	/**
	 * Removes all variables from the Registry.
	 *
	 * @return void
	 */
	public function removeAll()
	{
		self::$registry = array();
		return;
	}
}
?>