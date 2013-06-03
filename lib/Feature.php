<?php
class lib_Feature
{
	var $type;
	var $geometry;
	var $id;
	var $properties;
	
	function lib_Feature($id,$geom,$properties) {
		$this->type = "Feature";
		$this->geometry = $geom;
		$this->id = $id;
		$this->properties = $properties;
	}
}
?>