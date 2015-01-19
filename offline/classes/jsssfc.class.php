<?php
if (isset($_REQUEST['isjsssfc']))
{
	$dl  = new datalayer();
	$requestdata = $dl->loaddata('ajaxrequest:'.$_REQUEST['isjsssfc']);
	$functionname	= $requestdata['phpfunction'];
	$numArgs 		= $requestdata['numArgs'];
	$args			= '';
	for ($i = 1; $i <= $numArgs; $i++)
	{
		if($i != 1){ $args .= ', '; }
		$args .= '$_REQUEST[\'jsssfcArg'.$i.'\']';
	}
	$code = 'echo json_encode('.$functionname.'('.$args.'));';
	//echo '"'.$code.'"';
	$result = eval($code);
	echo $result;
	//exit so the script doesnt send extra data with the ajax request
	exit();
}

class jsssfc
{
	public function __construct($phpfunction, $jsfunction, $numArgs = 0)
	{
		$this->phpfunction = $phpfunction;
		$this->jsfunctionname = preg_replace("[^A-Za-z0-9]", "", $jsfunction);
		$this->numArgs = preg_replace("[^0-9]", "", $numArgs);
		$this->requestname = md5(rand()+rand());
		$this->jsruncode = '';
		$this->functionfile = $_SERVER['PHP_SELF'];
	}
	
	public function setjscode($newcode)
	{
		$this->jsruncode = $newcode;
	}
	
	public function addjscode($newcode)
	{
		$this->jsruncode = $this->jsruncode.PHP_EOL.$newcode;
	}
	
	public function setfunctionfile($file)
	{
		$this->functionfile = $file;
	}
	
	protected function generateargs($for)
	{
		$result = '';
		for ($i = 1; $i <= $this->numArgs; $i++)
		{
			if ($for == 'post')		{ $result .= ', jsssfcArg'.$i.' : arg'.$i; }
			if ($for == 'function')	{ $result .= 'arg'.$i.', '; }
		}
	if ($for == 'function')	{ $result = substr($result, 0, -2); }
	return $result;
	}
	
	protected function saveinfo()
	{
		$dl = new datalayer();
		$data['numArgs'] = $this->numArgs;
		$data['phpfunction'] = $this->phpfunction;
		$dl -> savedata($data, 'ajaxrequest:'.$this->requestname);
	}
	
	public function __tostring()
	{
		$functionargs = $this->generateargs('function');
		$postargs = $this->generateargs('post');
		$this->saveinfo();
		$jscode = '
		function '.$this->jsfunctionname.'('.$functionargs.')
			{
				$.post("'.$_SERVER['PHP_SELF'].'", { isjsssfc: "'.$this->requestname.'"'.$postargs.' },
				function(responce){
					'.$this->jsruncode.'
				}, "json");
			}
		';
		return $jscode;
	}
}
?>