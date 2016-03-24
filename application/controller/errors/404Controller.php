<?php
/*
Dan Vander Meer Code Sample
20-20 Seagirt Blvd., Apt BB, Far Rockaway, NY, 11691
dan@evilf11.com
843-245-8755

This code example is a basic MVC Framework that uses 
EAV Database design patterns, and Singleton Methods for 
the database.

This example includes a working: 
	User Registration
	User Login
*/

class Error404Controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function indexAction()
	{

		$this->setData('title','Jumbee Framework 404: Oops something went wrong!');
		
		$this->setData('content','Th');
		$this->renderLayout('errors/404');
	}
}

?>
