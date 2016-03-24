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
 *	needs please refer to http://jumbee.nurbality.com/documentation for more information. 
 *
 * Jumbee Core
 *
 * @package     Jumbee
 * @copyright   Copyright (c) 2015 Nurbality LLC. (http://www.nurbality.com)
 * @license     http://jumbee.nurbality.com/license/mit
 */

class Router
{
	private $controller,$action,$routes,$route;
	public $registry;
	static $_instance;
	public function __construct(){
		$this->_getRoutes();
		$controller = isset($_GET['request'])? explode('/',trim($_GET['request'],'/')) : '';
		$this->route = !empty($controller[0])? strtolower($controller[0]) : 'default';

		$this->action = !empty($controller[1])? $controller[1] : 'index';
	}

	public function Routes()
	{
		
		$registry = Jumbee::app()->registry->set('routes',$this->routes);
		require_once("controller.php");	
		
		$controllerFile = lcfirst(@$this->routes[$this->route]);
		$file = BP . DS .'controller'. DS . $controllerFile .'.php';
		
		
		if(!isset($this->routes[$this->route])){
			include(BP . DS .'controller'. DS .'errors'. DS .'404Controller.php');
			$class = 'Error404Controller';
		}else{
			if(is_readable($file)){
				include($file);
				$class = $this->routes[$this->route];
			}else{
				include(BP . DS .'controller'. DS .'errors'. DS .'404Controller.php');
				$class = 'Error404Controller';
			}
		}

		$class = ucfirst($class);
		$controller = new $class;
		$action = 'index';
		
		if($this->_actionExist($class, $this->action.'Action')){
			$action = $this->action."Action";
			$controller->$action();	
		}else{
			$action = 'indexAction';

			$controller->$action();	
		}
	}

	private function _actionExist($route, $action){
		if(method_exists($route, $action)){
			return true;
		}else{
			return false;
		}
	}

	private function _getRoutes(){
		$directoryFilter = array(".","..");
		$controllers = BP. DS . 'controller';
		$dh = opendir($controllers);
		$controllerClasses = array();
		while (false !== ($controller = readdir($dh))) {
			if(!is_dir($controllers . DS . $controller)){
				$file = $controllers . DS . $controller;
				$fp = fopen($file, 'r');
				$class = $buffer = '';
				$frontname = null;
				$i = 0;
				while (!$class) {
				    if (feof($fp)) break;

				    $buffer .= fread($fp, 512);
				   	@$tokens = token_get_all($buffer);

				    if (strpos($buffer, '{') === false) continue;

				    for (;$i<count($tokens);$i++) {
				        if ($tokens[$i][0] === T_CLASS) {
				            for ($j=$i+1;$j<count($tokens);$j++) {
				            	
				                if ($tokens[$j] === '{') {
				                    $class = $tokens[$i+2][1];
				                }
				            }

				        }else{

				        	@$frontNamePos = strpos((string)$tokens[$i][1], '@frontname = ');
				        	if($frontNamePos !== false){
				        		$frontnameExp = explode('= ', str_replace(array('// ','/* ','/** ','*/'), '', $tokens[$i][1]));
				        		$frontname = @trim($frontnameExp[1]);
				        	}

				        	@$frontNameDefaultPos = strpos((string)$tokens[$i][1], '@frontname_default = ');
				        	if($frontNameDefaultPos !== false){
				        		$frontname = 'default';
				        	}else{

				        	}
				        	
				        }
				    }

				    if(empty($frontname)){
				    	$frontname = strtolower(str_replace('Controller', '', $class));
				    	
				    }

				    $controllerClasses[] = array($frontname =>$class);
				}
			}
		}
		
		$controllers = array();
		foreach($controllerClasses as $class){
			$this->routes[key($class)] = end($class);
		
		}
		
	}
}
?>
