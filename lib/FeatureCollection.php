<?php

class lib_FeatureCollection
{
	var $type;
	var $features;
	
	function lib_FeatureCollection()
	{
		$this->type = "FeatureCollection";
		$this->features = array();
	}
	
	function addFeature($feature) {
		array_push($this->features,$feature);
	} 
}

?>