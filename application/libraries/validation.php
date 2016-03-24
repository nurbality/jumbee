<?php
/*
Dan Vander Meer Code Sample
1452 Briers Dr
Stone Mountain GA 30083
dan@evilf11.com
843-245-8755
*/


class Validation
{
	private $messages;
	private $rules;
	private $params;
	private $maxLength;
	private $minLength;

	public function __construct()
	{
		$this->_loadRules();
	}
	
	private function _isRequired($key)
	{
		if(!empty($this->params[$key]['value']))
		{
			return true;
		}
		$this->messages[$this->params[$key]] = $this->params[$key].' is a required field';
		return false;
	}

	private function _isMinLength($key)
	{
		if(strlen($this->params[$key]) >= $this->minLength)
		{
			return true;
		}
		$this->messages[$this->params[$key]] = $this->params[$key].' is a required field';
		return false;
	}

	private function _isMaxLength($key)
	{
		if(strlen($this->params[$key]) >= $this->maxLength)
		{
			return true;
		}
		$this->messages[$this->params[$key]] = $this->params[$key].' is a required field';
		return false;
	}



	private function _isMatch($key,$key1)
	{
		if($this->params[$key]['value'] == $this->params[$key1]['value'])
		{
			return true;
		}
		$this->messages[$this->params[$key]] = $this->params[$key].' is mismatched with'.$key1.' field';
		return false;
	}

	private function _isEmail($key)
	{
		if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$this->params[$key]['value']))
		{
			$data = explode('@',$this->params[$key]['value']);
			$domain = $data[1];
				
			if(checkdnsrr($domain,'MX')) {
				return true;
			}
		}
		$this->messages[$this->params[$key]] = $this->params[$key].' is not a valid email';
		return false;
	}
	
	public function prepare($key,$value,$condition)
	{
		$this->params[$key]['value'] = $value;
		$this->params[$key]['validator'] = explode("|",$condition);
	}

	public function doValidate()
	{
		//Start Validation process
		foreach($this->params as $key=> $vars)
		{
			// Check if we are validating multiple
			if(count($vars['validator']) > 1)
			{
				//Load all Validation rules
				foreach($vars['validator'] as $validator)
				{
					// Check For special rule for is match
					if(strpos($validator,':') !== false)
					{
						$this->_splitCondtions($key,$validator);
					}
					else
					{
						if(array_key_exists($validator,$this->rules))
						{
							$this->_assignValidationRule($validator,$key);
						}	
					}
				}
			}
			else
			{
				if(strpos($vars['validator'][0],':') !== false)
				{
					$this->_splitCondtions($key,$vars['validator'][0]);
				}
				else
				{
					$this->_assignValidationRule($vars['validator'][0],$key);
				}
			}
			
		}

		if($this->messages == null)
		{
			return true;
		}
		else
		{
			return $this->messages;	
		}
	}

	public function getErrors()
	{
		return $this->messages();
	}

	public function setMaxLength($length)
	{
		$this->maxLenght = $lenght;
	}

	public function setMinLength($length)
	{
		$this->minLenght = $lenght;
	}
	
	private function _assignValidationRule($validator,$key)
	{
		$rule = $this->rules[$validator];
		$this->$rule($key);
	}

	private function _splitCondtions($key,$validator)
	{
		$condition = explode(":",$validator);
		if($condition[0] == "Match")
		{
			$this->_isMatch($key,$condition[1]);
		}
	}

	private function _loadRules()
	{
		include('../application/config/validation.php');		
		$this->rules = $rules;
	}
}
?>
