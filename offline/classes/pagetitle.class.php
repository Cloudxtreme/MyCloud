<?php
class pagetitle
{
	private $titlearray;
	function __construct($senttitle = FALSE)
	{
		$this->pagetitle = $senttitle;
		if ($this->pagetitle != FALSE)
		{
			$this->titlearray = array($senttitle);
		} else {
			$this->titlearray = array();
		}
		$this->seperator(' - ');
	}
	
	public function addtitle($text, $position = 'auto')
	{
		if ($position == 'start')
		{
			array_unshift($this->titlearray, $text);
		}
		
		if ($position == 'auto')
		{
			$tmparray = $this->titlearray;
			$numinarray = count($tmparray)-1;
			$end = $tmparray[$numinarray];
			unset($tmparray[$numinarray]);
			$tmparray[] = $text;
			$tmparray[] = $end;
			$this->titlearray = $tmparray;
		}
		
		if ($position == 'end')
		{
			$this->titlearray[] = $text;
		}
	}
	
	public function seperator($seperate)
	{
		$this->seperator = $seperate;
	}
	
	public function htmlchars()
	{
		return htmlspecialchars($this->__tostring());
	}
	
	public function __tostring()
	{
		if (isset($this->titlearray))
		{
			$implodetitle = implode($this->seperator, $this->titlearray);
			return $implodetitle;
		} else {
			return '';
		}
	}
	
	public function fullhtml()
	{
		return '<title>'.$this->htmlchars().'</title>'.PHP_EOL;
	}
	
}
?>