<?php
abstract class htmlattributes
{
	public function getattributesource()
	{
		return $this->getjustattributesource().$this->getjustclasssource();
	}
	
	public function getattributearray()
	{
		return $this->attributes;
	}
	
	public function getclassarray()
	{
		return $this->classes;
	}
	
	public function getjustattributesource()
	{
		$attributes = '';
		if (count($this->attributes))
		{
			foreach($this->attributes as $attrnme => $attrval)
			{
				$attributes .= ' '.$attrnme.'="'.$attrval.'"';
			}
		}
		return $attributes;
	}
	
	public function getjustclasssource()
	{
		$classes = '';
		if (count($this->classes))
		{
			$classes .= ' class="';
			foreach($this->classes as $classname)
			{
				if (end($this->classes) == $classname){ $spacing = ''; } else { $spacing = ' '; }
				$classes .= $classname.$spacing;
			}
			$classes .= '"';
		}
		return $classes;
	}
	
		public function addattribute($attribute, $value)
	{
		$this->attributes[$attribute] = $value;
	}
	
	public function removeattribute($attribute)
	{
		unset($this->attributes[$attribute]);
	}
	
	public function editattribute($attribute, $value)
	{
		$this->attributes[$attribute] = $value;
	}
	
	public function addclass($classname)
	{
		$this->classes[] = $classname;
	}
	
	public function removeclass($classname)
	{
		foreach($this->classes as $classnum => $arrayclass)
		{
			if ($arrayclass == $classname)
			{
				unset($this->classes[$classnum]);
			}
		}
	}
}
?>