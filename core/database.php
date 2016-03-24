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


abstract class Database
{
	/**
	  * @since Jumbee 1.0
	  * Type variable
      *
      * @var $type
	  */
	private $type;
	
	/**
	  * @since Jumbee 1.0
	  * Query variable
      *
      * @var $query
	  */
	private $query = null;

	/**
	  * @since Jumbee 1.0
	  * Select variable
      *
      * @var $select
	  */
    private $select = array();
    
    /**
	  * @since Jumbee 1.0
	  * From variable
      *
      * @var $from
	  */
    private $from = array();
    
    /**
	  * @since Jumbee 1.0
	  * Where variable
      *
      * @var $where
	  */
    private $where = array();
    
    /**
	  * @since Jumbee 1.0 
	  * Match variable
      *
      * @var $match
	  */
    private $match = array();
    
    /**
	  * @since Jumbee 1.0
	  * Group By variable
      *
      * @var $group_by
	  */
    private $group_by = array();
    
    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    private $within_group_order_by = array();
    
    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    private $sort = array();
    
    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    private $offset = null;
    
    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    private $into = null;
    
    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    private $columns = array();
    
    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    private $values = array();
    
    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    private $set = array();
    
    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    private $options = array();

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
	abstract protected function connect();
	
	/**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
	abstract protected function disconnect();

	/**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
	abstract protected function prepare($query);

	/**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
	abstract protected function query();

	/**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
	abstract protected function fetch($object);	

	/**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
	protected static function getSelf(){
		if (self::$_instance === null){
            self::$_instance = new self;
        }

        return self::$_instance;
	}

	/**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
	public function select($columns = null){
		$this->reset();
		$this->type = 'select';
		 if (is_array($columns)) {
            $this->select = $columns;
        } else {
            $this->select = \func_get_args();
        }
        return $this;
	}

	/**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
	public function insert(){
        $this->reset();
        $this->type = 'insert';
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function replace(){
        $this->reset();
        $this->type = 'replace';
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function update($index){
        $this->reset();
        $this->type = 'update';
        $this->into($index);
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function delete(){
        $this->reset();
        $this->type = 'delete';
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function match($column, $value, $half = false){
        if ($column === '*' || (is_array($column) && in_array('*', $column))) {
            $column = array();
        }
        $this->match[] = array('column' => $column, 'value' => $value, 'half' => $half);
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function where($column, $operator, $value = null, $or = false){
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }
        $this->where[] = array(
            'ext_operator' => $or ? 'OR' : 'AND',
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        );
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function from($array = null){
        if (is_string($array)) {
            $this->from = \func_get_args();
        }
        if (is_array($array)) {
            $this->from = $array;
        }
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function groupBy($column){
        $this->group_by[] = $column;
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function orderBy($column, $direction = null){
        $this->order_by[] = array('column' => $column, 'direction' => $direction);
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function limit($offset, $limit = null){
        if ($limit === null) {
            $this->limit = (int) $offset;
            return $this;
        }
        $this->offset($offset);
        $this->limit = (int) $limit;
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function offset($offset){
        $this->offset = (int) $offset;
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function option($name, $value){
        $this->options[] = array('name' => $name, 'value' => $value);
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function into($index){
        $this->into = $index;
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function columns($array = array()){
        if (is_array($array)) {
            $this->columns = $array;
        } else {
            $this->columns = \func_get_args();
        }
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function values($array){
        if (is_array($array)) {
            $this->values[] = $array;
        } else {
            $this->values[] = \func_get_args();
        }
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function set($array){
        foreach ($array as $key => $item)
        {
            $this->value($key, $item);
        }
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function value($column, $value){
        if ($this->type === 'insert' || $this->type === 'replace') {
            $this->columns[] = $column;
            $this->values[0][] = $value;
        } else {
            $this->set[$column] = $value;
        }
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
	public function reset(){
		$this->query = null;
        $this->select = array();
        $this->from = array();
        $this->where = array();
        $this->match = array();
        $this->group_by = array();
        $this->within_group_order_by = array();
        $this->sort = array();
        $this->offset = null;
        $this->into = null;
        $this->columns = array();
        $this->values = array();
        $this->set = array();
        $this->options = array();
	}

	/**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
	public function resetWhere(){
        $this->where = array();
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function resetMatch(){
        $this->match = array();
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function resetGroupBy(){
        $this->group_by = array();
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function resetWithinGroupOrderBy(){
        $this->within_group_order_by = array();
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function resetOrderBy(){
        $this->order_by = array();
        return $this;
    }

    /**
	  * @since Jumbee 1.0
	  * Layouts Object
      *
      * @var 
	  */
    public function resetOptions(){
        $this->options = array();
        return $this;
    }
}
?>
