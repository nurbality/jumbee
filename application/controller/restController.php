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
 * Jumbee Example Controller
 *
 * @package     Jumbee
 * @category	Controller
 * @copyright   Copyright (c) 2015 Nurbality LLC. (http://www.nurbality.com)
 * @license     http://jumbee.nurbality.com/license/mit
 *
 **/

/**
 *
 * Do not delete the @frontname or @frontname_default below. It is required for the 
 * auto registering of controllers and actions in Jumbee. It specifies the frontname 
 * uri for the given controller. To generate new controllers please use the ./routes tool
 * found in the tools directory. If the tags are not present the class name will be used 
 * for the frontend namespace for the controller
 *
 **/


/* @frontname = rest */

class RestController extends Controller
{

	private $routes,$model,$namespace,$action,$deviceId,$data,$method;

	public function __construct()
	{
		//Nurb::App()->Libraries->Twitter->awesome();		

		$request = explode("=",$_SERVER['REQUEST_URI']);
		$uri = explode("/",$request[1]);
		$this->namespace = $uri[1];
		$this->action = $uri[2];
		$this->deviceId = $uri[3];
		if(isset($uri[4])){
			$this->data = $uri[4];
		}
		$method = $this->action.ucfirst($this->namespace).'Action';
		
		$this->$method();

	}

	public function indexAction(){}

	private function getAction(){}
	private function setScoreAction(){}
	private function setUniqiedAction(){}
	private function getUniqidAction(){
		$id = Jumbee::App()->Models->CrappyReindeer->Scores->GetId($this->deviceId);
		if(!empty($id)){
			echo json_encode(array("response"=>array('status'=>true)));
		}else{
			echo json_encode(array("response"=>array('status'=>false)));
		}
	}
	public function getRankAction(){}
}

?>
