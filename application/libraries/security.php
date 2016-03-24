<?php
class Security{

	public function Sanitize($string){
		$cleaned = strip_tags($string);
		if($cleaned == $string){
			return $string;
		}else{
			return false;
		}
	}
}
?>
