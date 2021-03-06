<?php
/*
Dan Vander Meer Code Sample
1452 Briers Dr
Stone Mountain GA 30083
dan@evilf11.com
843-245-8755
*/


class MSSQL extends Database
{
	private $connection,$query,$result,$config;

	public function connect()
	{
		self::_getConfig();
		$this->connection = new PDO("mssql:host=".$this->config['host'].";dbname=".$this->config['database']."", $this->config['username'], $this->config['password']);
		//$this->connection = new PDO("sybase:host=".$this->config['host'].";dbname=".$this->config['database']."", $this->config['username'], $this->config['password']);
		//$this->connection = new PDO("dblib:host=".$this->config['host'].";dbname=".$this->config['database']."", $this->config['username'], $this->config['password']);
	}

	private function _getConfig()
	{
		include('../application/config/database.php');
		$this->config = $config;
	}

	public function disconnect()
	{
		$this->connection->close();
	}

	public function prepare($query)
	{
		$this->query = $query;
		return true;
	}

	public function query()
	{
		if(isset($this->query))
		{
			$this->result = $this->connection->query($this->query);
			return true;
		}	
		return false;
	}

	public function fetch($type='object')
	{
		if(isset($this->result))
		{
			switch($type)
			{
				case "array":
					$row = $this->result->fetch_array();
				break;

				case 'object':

				default:
					$row = $this->result->fetch_object();
				break;
			}
			return $row;
		}
		return false;
	}

	public function escape($data)
	{
		return addslashes($data);
	}
}
?>
