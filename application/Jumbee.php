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
 *
 * @method Jumbee __constuct()
 * @method Jumbee __autuload()
 * @method Jumbee GetVersionInfo()
 * @method Jumbee Run()
 * @method Jumbee App()
 * @method Jumbee Redirect(string $location)
 * @method Jumbee GetUrl(string $url)
 * @method Jumbee GetConfig()
 * @method Jumbee GetDataBaseDriver()
 *
 *
 *
 * @category    Core
 * @package     Jumbee
 * @author      Jumbee Core Team <core@nurbality.com>
 *
 */
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('BP', dirname(__FILE__));
define('RD', dirname(dirname(__FILE__)));

final class Jumbee{
	/**
     * Config Params
     *
     * @var array
     */

	public $config;
	/**
     * Models, Libraries, Helpers Path Params
     *
     * @var array
     */
	
	private static $paths;
	/**
     * Jumbee Instance object
     *
     * @var object
     */
	
	private static $_instance = null;
	/**
     * Models Object
     *
     * @var object
     */
	
	public $models = null;
	/**
     * Libraries Object
     *
     * @var object
     */
	
	public $libraries = null;
	/**
     * Helpers Object
     *
     * @var object
     */
	
	public $helpers = null;
	/**
     * Registry Object
     *
     * @var object
     */
	
	public static $registry = null;

	/**
     * Router Object
     *
     * @var object
     */
	
	public static $router = null;
	
	/**
     * Language Object
     *
     * @var objectdadasdas
     */
	public static $language = null;
	/**
     * Layouts Object
     *
     * @var objectdadasdas
     */
	public $layouts = null;

	/**
     * Version Object
     *
     * @var object
     */
	public $version = null;


	public function __construct(){}

	/**
	 * @since Jumbee 1.0
	 */
	public function autoLoad(){
		$Jumbee = self::getSelf();

		$directoryFilter = array(".","..");
		$files = array();
		foreach($Jumbee->config['Paths'] as $objectType => $directory){

			$dh  = opendir(BP. DS .$directory); 
			
			while (false !== ($namespace = readdir($dh))) {
				switch ($objectType) {
					case 'Models':
						if(is_dir(BP . DS . DS .$namespace)){
				    		if(!in_array($namespace, $directoryFilter)){
				    			$files[$objectType][$namespace][] = BP . DS . $directory . DS . $namespace;
				    		}
				    	}
					break;
					
					default:
						if(!is_dir(BP . DS . $directory . DS .$namespace)){
							$files[$objectType][] = BP . DS . $directory . DS . $namespace;
						}
					break;
				}
				
			}
			
		}

		foreach ($files as $objType => $paths) {
			switch ($objType) {
				case 'Models':
					foreach($paths as $namespace => $path){
						foreach($path as $directory){
							
							$dr  = opendir($directory);	
							while (false !== ($filename = readdir($dr))) {
								if(!is_dir($directory. DS .$filename)){
							 		include(BP . $directory . DS . $filename);
							 		$classes = get_declared_classes();
									$class = end($classes);
									$Jumbee->$objType->$namespace->$class = new $class;		
							 	}
							}
						}
					}
				break;
				
				default:
					foreach ($paths as $path) {
						include($path);
						$classes = get_declared_classes();
						$class = end($classes);
						$Jumbee->$objType->$class = new $class;
					}
				break;
			}
		}

		foreach($Jumbee->config['Core'] as $property => $file){
			require_once(RD . DS . 'core' . DS .$file);
			$lowerProp = strtolower($property);
			$Jumbee->$lowerProp = new $property();
		}
		
		$Jumbee->router->routes();
		
	}

	/**
     * Gets the detailed Jumbee version information
     * @link http://jumbee.nurbality.com/documentation/new-edition-release-process/
     *
     * @return array
     */
	public static function getVersionInfo()
    {
        return array(
            'major'     => '1',
            'minor'     => '0',
            'revision'  => '0',
            'patch'     => '1',
            'stability' => '0',
            'number'    => '0',
        );
    }

	/**
	 * Run the Core for Jumbee
	 * It loads in the Registry and Templates and Router
	 * @since Jumbee 1.0
	 */
	public static function run(){
		session_start();
		$Jumbee = self::getSelf();
		$Jumbee->getConfig();
		$Jumbee->version = self::getVersionInfo();
		$Jumbee->autoload();
		return $Jumbee;
	}


	protected static function getSelf(){
		if (self::$_instance === null){
            self::$_instance = new self;
        }

        return self::$_instance;
	}
	
	/**
	 * @since Jumbee 1.0
	 */
	public static function app(){
		$Jumbee = self::getSelf();
        return $Jumbee;
    }

    /**
	 * @since Jumbee 1.0
	 * @param type $location
	 */
	public function redirect($location){
		header("Location:" . $location);
	}
	
	/**
	 * @since Jumbee 1.0
	 * @param type $url
	 */
	public function getUrl($url){
		$Jumbee = self::getSelf();
		try{
			
			$router = null;
			foreach($Jumbee->config['Routes'] as $path=>$route)
			{
				if($route == $url)
				{
					$router = $path;
				}
			}
			if($router != null)
			{
				
				$finalURL = _base_url._base_dir . $router;
				return $finalURL;
			}
			else
			{
				throw new Exception('<table cellspacing="0" cellpadding="0" align="center"><tr><td style="width:800px;height:30px;font-family:arial;font-weight:900;background: #DC143C;color: #FFF8DC;border: 1px solid #DC143C;padding:10px;">Hub Framework Error </td></tr><tr><td style="border: 1px solid #DC143C;padding:10px;background:#FFC0CB;color: #800000;font-family:arial;">Jumbee Error:'.$url. ' route not found.</td></tr></table>');
			}
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	/**
	  * @since Jumbee 1.0
	  */
	public function getConfig(){
		$Jumbee = self::getSelf();
		include(BP.DS.'config'.DS.'config.php');
		$Jumbee->config = $config;
		
		date_default_timezone_set('America/Los_Angeles');
		
        return $Jumbee;
	}

	/**
	 * @since Jumbee 1.0
	 */
	public static function getDataBaseDriver(){
		$Jumbee = self::getSelf();
		// $Jumbee->Config[];
		return self::$config['driver'];
	}

	/**
	 * @since Jumbee 1.0
	 */
	public function loadDatabaseDriver(){
		require_once(BP . DS .'core'. DS .'database.php');
		$driver = self::getDataBaseDriver();
		include(BP . DS .'core'. DS .'database'.DS.'driver'. DS .$driver.'.php');
	}

	public function getBaseUrl(){
		$Jumbee = self::getSelf();
		return $Jumbee->config['Application']['base_url'];
	}

	private function getUserIP(){
		$apache = apache_request_headers();
		
		if(isset($apache['X-Forwarded-For'])){
			$remoteIp = explode(",",$apache['X-Forwarded-For']);
			return $remoteIp[0];
		}
		return $_SERVER['REMOTE_ADDR'];
	}
}
