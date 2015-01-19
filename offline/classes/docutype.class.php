<?php
class docutype {
	private $docutypes;
	private $request;
	function __construct($type = 'html', $version = '5', $format = 'strict')
	{
		$this->docutypes['html<-->4.01'] = array(
			 "strict" => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">'
			,"transitional" => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">'
			,"frameset" => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">'
		);
		
		$this->docutypes['xhtml<-->1.0'] = array(
			 "strict" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'
			,"transitional" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
			,"frameset" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">'
		);
		
		$this->docutypes['xhtml<-->1.1'] = array(
			 "strict" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'
			,"transitional" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'
			,"frameset" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'
			,"DTD" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'
		);
		
		$this->docutypes['xhtml basic<-->1.1'] = array(
			 "strict" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">'
			,"transitional" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">'
			,"frameset" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">'
			,"DTD" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">'
		);
		
		$this->docutypes['html<-->5.0'] = array(
			 "strict" => '<!DOCTYPE HTML>'
			,"transitional" => '<!DOCTYPE HTML>'
			,"frameset" => '<!DOCTYPE HTML>'
			,"DTD" => '<!DOCTYPE HTML>'
			
		);
		
		$this->docutypes['html<-->5'] = array(
			 "strict" => '<!DOCTYPE HTML>'
			,"transitional" => '<!DOCTYPE HTML>'
			,"frameset" => '<!DOCTYPE HTML>'
			,"DTD" => '<!DOCTYPE HTML>'
		);
		$this->version($type, $version, $format);
	}
	
	public function version($type = 'html', $version = '5', $format = 'strict')
	{
		$this->version	= $version;
		$this->type		= $type;
		$this->format	= $format;
	}
	
	public function tostring()
	{
		$arrayname = $this->type.'<-->'.$this->version;
		$format = $this->format;
		if(isset($this->docutypes[$arrayname][$format]))
		{
			return $this->docutypes[$arrayname][$format]."\n";
		} else {
			return '<!DOCTYPE HTML>'.PHP_EOL.'<!--warning no docutype found!-->'."\n";
		}
	}
	
	public function __tostring()
	{
		return $this->tostring();
	}
}
?>