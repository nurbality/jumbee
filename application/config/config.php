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
 * @category	Config
 * @copyright   Copyright (c) 2015 Nurbality LLC. (http://www.nurbality.com)
 * @license     http://jumbee.nurbality.com/license/mit
 */

$config = array(
	'Application' => array(
			'Name' => 'Jumbee Example Project',
			'Title' => 'Jumbee::Run()',
			'Version' => '1',
			'base_url' => 'http://light.nurbality.com/'
			),
	'Database' => array(
			'MySQL' => array(
				'enabled' => true,
				'driver'=>'Mysql',				// Driver Options MySQL, Postgres, SQLite, MSSQL
				'host'=>'localhost',			// MySQL, Postgres host;
				'username'=>'root',				// MySQL, Postgres Username;
				'password'=> 'Keih9ocai',		// MySQL, Postgres Password;
				'database'=>'crappy_reindeer',	// MySQL, Postgres Database Name;
				'database_path' => '',			// SQLite database file location
				),
			// 'Postgres' = array(
			// 	'enabled' => false,
			// 	'host'=>'localhost',			// MySQL, Postgres host;
			// 	'username'=>'root',				// MySQL, Postgres Username;
			// 	'password'=> 'Keih9ocai',		// MySQL, Postgres Password;
			// 	'database'=>'crappy_reindeer',	// MySQL, Postgres Database Name;
			// 	'database_path' => '',			// SQLite database file location
			// 	),
			// 'SQLite' = array(
			// 	'enabled' => false,
			// 	'host'=>'localhost',			// MySQL, Postgres host;
			// 	'username'=>'root',				// MySQL, Postgres Username;
			// 	'password'=> 'Keih9ocai',		// MySQL, Postgres Password;
			// 	'database'=>'crappy_reindeer',	// MySQL, Postgres Database Name;
			// 	'database_path' => '',			// SQLite database file location
			// 	),
			// 'MSSQL' = array(
			// 	'enabled' => false,
			// 	'host'=>'localhost',			// MySQL, Postgres host;
			// 	'username'=>'root',				// MySQL, Postgres Username;
			// 	'password'=> 'Keih9ocai',		// MySQL, Postgres Password;
			// 	'database'=>'crappy_reindeer',	// MySQL, Postgres Database Name;
			// 	'database_path' => '',			// SQLite database file location
			// 	),
			),
	'Caching' => array(
				'page_caching' => array(
					'enabled' => false,
					'cache_directory' => 'application/cache',
					'cache_life' => 600,
					'ignore_list'=> array(
							// Examples of how to ignore routes
							// '',
       						// '',
						),
					'cache_post_request' => false,
					'cache_partials' => true
				),
				// 'memcache'=> array(
				// 	'enabled' => false,
				// 	'host'=>'localhost',
				// 	'port'=>'11211',
				// 	),
				// 'redis'=> array(
				// 	'enabled' => false,
				// 	'host' => 'localhost',
				// 	'port' => '6379',
				// 	),
			),
	'Locale' => 'en_US',
	'Paths' => array(
				'Models'=>'model',
				'Libraries'=>'libraries',
				'Helpers' => 'helper',
			),
	
	'Core' => array(
			'Registry' => 'registry.php',
			'Layouts' => 'template.php',
			'Router' => 'router.php',
			'Language' => 'language.php'
			),
	'Salt_Shaker' => 'fdfac5931b8e65cfe3f78a19c353382f',
	
);