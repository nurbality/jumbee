<?php
class Input{
	public $Params;

	public function __construct(){
		$Params = $this->_loadParams();
	}

	private function _loadParams(){
		if(isset($_REQUEST)){
			$cleaned = array();
			$errors = 0;
			foreach($_REQUEST as $index => $param){
				$cleanedParam = strip_tags($param);
				if($cleanedParam == $param){
					$cleaned[$index] = $param;
				}else{
					$errors++;
				}
			}

			if($errors == 0){
				return $cleaned;
			}
		}
	}
}


?>