<?php 
class Frontdend_View_Exampreparation
{
	/**
	 * 
	 * @var string
	 */
	private $_content = '';
	
	/**
	 * 
	 * @param string $content
	 */
	public function set($content)
	{
		$this->_content = $content;
	}
	
	/**
	 * @return null
	 */
	public function display()
	{
		echo $this->_content;
	}
}
?>