<?php
/** 
 *
 *	The MIT License (MIT)
 *	
 *	Copyright (c) 2015 Nurbality LLC
 *	
 *	Permission is hereby granted, free of charge, to any person obtaining a copy
 *	of this software and associated documentation files (the "Software"), to deal
 *	in the Software without restriction, including without limitation the rights
 *	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *	copies of the Software, and to permit persons to whom the Software is
 *	furnished to do so, subject to the following conditions:
 *	
 *	The above copyright notice and this permission notice shall be included in all
 *	copies or substantial portions of the Software.
 *	
 *	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *	SOFTWARE.
 *	
 *	 
 *	DISCLAIMER
 *	Do not edit or add to this file if you wish to upgrade Jumbee to newer
 *	versions in the future. If you wish to customize Jumbee for your
 *	needs please refer to http://mvc.nurbality.com/documentation for more information. 
 *
 * Jumbee 
 *
 * @package     Jumbee
 * @copyright   Copyright (c) 2015 Nurbality LLC. (http://www.nurbality.com)
 * @license     http://jumbee.nurbality.com/license/mit
 */



class Registry
{
	protected $_vars;
	private static $instance = NULL;
	public function __construct(){ }
	public function __clone(){ }
	static public function getInstance()
	{
		if(self::$instance == NULL)
		{
			self::$instance = new self;
			return self::$instance;
		}
	}
	public function set($key,$value)
	{
		$this->_vars[$key] = $value;
	}

	public function get($key)
	{
		return $this->_vars[$key];
	}

	public function delete($key)
	{
		unset($this->_vars[$key]);
	}
}
?>
