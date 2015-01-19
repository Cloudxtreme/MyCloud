<?php
class cssstyle
{
	public function addstyle($element, $style)
	{
		$this->csscode .= $element.' { '.$style.' }'.PHP_EOL;
	}
	
	public function __tostring()
	{
		return '<style type="text/css" media="screen">'.PHP_EOL.$this->csscode.'</style>';
	}
}
?>