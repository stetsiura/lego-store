<?php

namespace Engine\Core\Database;

class QueryBuilder
{
	/**
	 * @var array
	 */
	protected $sql = [];

	/**
	 * @var array
	 */
	public $values = [];

	/**
	 * @param string $fields
	 */
	public function select($fields = '*')
	{
		$this->reset();

		$this->sql['select'] = "SELECT {$fields} ";

		return $this;
	}

	/**
	 * @param string $table
	 */
	public function from($table)
	{
		$this->sql['table'] = "FROM `{$table}` ";

		return $this;
	}

	/**
	 * @param string $column
	 * @param mixed $value
	 * @param string $operator
	 */
	public function where($column, $value, $operator = '=')
	{
		$this->sql['where'][] = "{$column} {$operator} ? ";
		$this->values[] = $value;

		return $this;
	}
	
	/**
	 * @param string $column
	 * @param mixed $value
	 * @param string $operator
	 */
	public function orWhere($column, $value, $operator, $bracket = '')
	{
	    $openBracket = '';
	    $closeBracket = '';

	    switch($bracket) {
            case '(':
                $openBracket = '(';
                $closeBracket = '';
                break;
            case ')':
                $openBracket = '';
                $closeBracket = ')';
                break;
        }
		$this->sql['or'][] = "OR {$openBracket} {$column} {$operator} ? {$closeBracket} ";
		$this->values[] = $value;
		
		return $this;
	}

    public function andWhere($column, $value, $operator, $bracket = '')
    {
        $openBracket = '';
        $closeBracket = '';

        switch($bracket) {
            case '(':
                $openBracket = '(';
                $closeBracket = '';
                break;
            case ')':
                $openBracket = '';
                $closeBracket = ')';
                break;
        }
        $this->sql['and'][] = "AND {$openBracket} {$column} {$operator} ? {$closeBracket} ";
        $this->values[] = $value;

        return $this;
    }
	
	/**
	 * @param string $column
	 */
	public function whereIsNull($column)
	{
		$this->sql['where'][] = "{$column} IS NULL ";

		return $this;
	}
	
	/**
	 * @param string $column
	 */
	public function whereIsNotNull($column)
	{
		$this->sql['where'][] = "{$column} IS NOT NULL ";

		return $this;
	}
	
	/**
	 * @param string $column
	 * @param string $values
	 */
	public function whereIn($column, $values)
	{
		$this->sql['where'][] = "{$column} IN ({$values}) ";
		
		return $this;
	}

	/**
	 * @param string $field
	 * @param string $order
	 */
	public function orderBy($field, $order)
	{
		$this->sql['order_by'] = "ORDER BY {$field} {$order} ";

		return $this;
	}

	/**
	 * @param int $number
	 */
	public function limit($number)
	{
		$this->sql['limit'] = "LIMIT {$number} ";

		return $this;
	}
	
	/**
	 * @param int $offset
	 * @param int $number
	 */
	public function limitOffset($offset, $number)
	{
		$this->sql['limit'] = "LIMIT {$offset}, {$number} "; 
		
		return $this;
	}

	/**
	 * @param string $table
	 */
	public function update($table)
	{
		$this->reset();

		$this->sql['update'] = "UPDATE `{$table}` ";

		return $this;
	}

	/**
	 * @param string $table
	 */
	public function insert($table)
	{
		$this->reset();

		$this->sql['insert'] = "INSERT INTO `{$table}` ";

		return $this;
	}

    public function delete($table)
    {
        $this->reset();

        $this->sql['delete'] = "DELETE FROM `{$table}` ";

        return $this;
    }

	/**
	 * @param array $data
	 */
	public function set($data = [])
	{
		$this->sql['set'] = "SET ";

		if (!empty($data))
		{
			$count = count($data);
			$elementNumber = 0;
			foreach($data as $key => $value)
			{
				$this->sql['set'] .= "{$key} = ? ";

				if ($elementNumber < $count - 1)
				{
					$this->sql['set'] .= ", ";
				}

				$this->values[] = $value;
				
				$elementNumber++;
			}
		}

		return $this;
	}
	
	public function innerJoin($table, $leftFileld, $rightField)
	{
		$this->sql['inner_join'][] = "INNER JOIN `{$table}` ON {$leftFileld} = {$rightField} ";
		
		return $this;
	}

	/**
	 * @return string
	 */
	public function sql()
	{
		$queryString = '';

		if (!empty($this->sql))
		{
			foreach($this->sql as $key => $value)
			{
//				if ($key == 'where')
//				{
//					$queryString .= " WHERE ";
//
//					foreach($value as $where)
//					{
//						$queryString .= $where;
//
//						if (count($value) > 1 && next($value))
//						{
//							$queryString .= ' AND ';
//						}
//					}
//				} else if ($key == 'inner_join') {
//					foreach($value as $join) {
//						$queryString .= $join;
//					}
//				} else if ($key == 'or') {
//					foreach($value as $or) {
//						$queryString .= $or;
//					}
//                } else if ($key == 'and') {
//                    foreach($value as $and) {
//                        $queryString .= $and;
//                    }
//                }
//				else
//				{
//					$queryString .= $value;
//				}

				switch($key) {
                    case 'where':
                        $queryString .= " WHERE ";

                        foreach($value as $where)
                        {
                            $queryString .= $where;

                            if (count($value) > 1 && next($value))
                            {
                                $queryString .= ' AND ';
                            }
                        }
                        break;
                    case 'inner_join':
                        foreach($value as $join) {
                            $queryString .= $join;
                        }
                        break;
                    case 'or':
                        foreach($value as $or) {
                            $queryString .= $or;
                        }
                        break;
                    case 'and':
                        foreach($value as $and) {
                            $queryString .= $and;
                        }
                        break;
                    default:
                        $queryString .= $value;
                }
			}
		}

		return $queryString;
	}

	/**
	 * @return void
	 */
	public function reset()
	{
		$this->sql    = [];
		$this->values = [];
	}
}
