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


abstract class Controller extends Router{
	
	private $_data = array();
	protected $request = array();
	protected $helpers;
	public function __construct(){
		$this->helpers = Jumbee::app()->helpers;
		$this->libraries = Jumbee::app()->libraries;
		$this->models = Jumbee::app()->models;
	}

	abstract function indexAction();


	public function setData($var,$data){
		$this->_data[$var] = $data;
	}

	public function renderLayout($layout){
		$this->_data['lang'] = Jumbee::app()->language;
		$this->_data['baseUrl'] = Jumbee::App()->getBaseUrl();
		$this->_data['head'] = Jumbee::app()->layouts->getPartial('page/head',$this->_data);
		$this->_data['header'] = Jumbee::app()->layouts->getPartial('page/header',$this->_data);
		$this->_data['footer'] = Jumbee::app()->layouts->getPartial('page/footer',$this->_data);
		Jumbee::app()->layouts->getLayout('main/index',$this->_data);
	}

	public function isAjax(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			if($_SERVER['HTTP_X_REQUESTED_WITH'] =="XMLHttpRequest"){
					return true;
			}else{
					return false;
			}
		}else{
				return false;
		}
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
			}else{
				// log malicious stuff
			}
		}
	}

	public function getRequest(){
		return $this->_loadParams();
	}
}

?>
