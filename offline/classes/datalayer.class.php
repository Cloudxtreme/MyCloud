<?php
class datalayer
{	
	public function savedata($data, $name, $accses = FALSE)
	{
		global $tmpdir;
		if (!$accses){ $accses = $this->browsersession(); }
		$varid = base64_encode($accses).'!!!!>><<!!!!'.base64_encode($name);
		$filename = md5(base64_encode($varid)).'.data';
		if(file_put_contents($tmpdir.$filename, serialize($data)))
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function loaddata($name, $accses = FALSE)
	{
		global $tmpdir;
		if (!$accses){ $accses = $this->browsersession(); }
		$varid = base64_encode($accses).'!!!!>><<!!!!'.base64_encode($name);
		$filename = md5(base64_encode($varid)).'.data';
		if (file_exists($tmpdir.$filename))
		{
			return unserialize(file_get_contents($tmpdir.$filename));
		} else {
			return FALSE;
		}
	}
	
	public function browsersession()
	{
		if (!isset($_COOKIE['datalayerbrowsersession'])){
			$id = md5(rand()*rand()+rand());
			$expire=time()+60*60*24*2;
			setcookie("datalayerbrowsersession", $id, $expire, "/");
			return $id;
		} else {
			return $_COOKIE['datalayerbrowsersession'];
		}
	}
	
	public function unsetdata($name, $accses = FALSE)
	{
		global $tmpdir;
		if (!$accses){ $accses = $this->browsersession(); }
		$varid = base64_encode($accses).'!!!!>><<!!!!'.base64_encode($name);
		$filename = md5(base64_encode($varid)).'.data';
		if (file_exists($tmpdir.$filename))
		{
			return unlink($tmpdir.$filename);
		} else {
			return $filename;
		}
	}
	
	public function datastring($data)
	{
		return serialize($data);
	}
	
	public function fromstring($data)
	{
		return unserialize($data);
	}
	
	
}
?>
