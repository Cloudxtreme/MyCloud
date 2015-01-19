<?php
class namesplit	{
	function __construct($name)
	{
		$this->sentname  = $name;
		if ($this->numwords($this->sentname) != 2)
		{
			$this->firstname  = $this->splitname($name, 0);
			$this->middlename = $this->splitname($name, 1);
			$this->lastname   = $this->endname($name);
		} else {
			$this->firstname = $this->splitname($name, 0);
			$this->middlename = FALSE;
			$this->lastname  = $this->splitname($name, 1);
		}
	}
	
	protected function splitname($name, $part)
	{
		$endname = explode(' ', $name);
		return $endname[$part];
	}
	
	protected function endname($name)
	{
		$endname = explode(' ', $name);
		return end($endname);
	}
	
	protected function numwords($text)
	{
		$num = explode(' ', $text);
		return count($num);
	}
	
	public function __tostring()
	{
		return($this->sentname);
	}
	

}
?>