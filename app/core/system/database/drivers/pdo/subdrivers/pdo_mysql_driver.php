<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_DB_pdo_mysql_driver extends CI_DB_pdo_driver {

	public $subdriver = 'mysql';
	public $compress = FALSE;
	public $stricton;
	protected $_escape_char = '`';

	public function __construct($params)
	{
		parent::__construct($params);

		if (empty($this->dsn))
		{
			$this->dsn = 'mysql:host='.(empty($this->hostname) ? '127.0.0.1' : $this->hostname);
			empty($this->port) OR $this->dsn .= ';port='.$this->port;
			empty($this->database) OR $this->dsn .= ';dbname='.$this->database;
			empty($this->char_set) OR $this->dsn .= ';charset='.$this->char_set;
		}
		elseif ( ! empty($this->char_set) && strpos($this->dsn, 'charset=', 6) === FALSE)
		{
			$this->dsn .= ';charset='.$this->char_set;
		}
	}

	public function db_connect($persistent = FALSE)
	{
		return parent::db_connect($persistent);
	}

	public function db_select($database = '')
	{
		if ($database === '')
		{
			$database = $this->database;
		}

		if (FALSE !== $this->simple_query('USE '.$this->escape_identifiers($database)))
		{
			$this->database = $database;
			$this->data_cache = array();
			return TRUE;
		}

		return FALSE;
	}

	protected function _trans_begin()
	{
		$this->conn_id->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
		return $this->conn_id->beginTransaction();
	}

	protected function _trans_commit()
	{
		if ($this->conn_id->commit())
		{
			$this->conn_id->setAttribute(PDO::ATTR_AUTOCOMMIT, TRUE);
			return TRUE;
		}

		return FALSE;
	}

	protected function _trans_rollback()
	{
		if ($this->conn_id->rollBack())
		{
			$this->conn_id->setAttribute(PDO::ATTR_AUTOCOMMIT, TRUE);
			return TRUE;
		}

		return FALSE;
	}

	protected function _list_tables($prefix_limit = FALSE)
	{
		$sql = 'SHOW TABLES FROM '.$this->_escape_char.$this->database.$this->_escape_char;

		if ($prefix_limit === TRUE && $this->dbprefix !== '')
		{
			return $sql." LIKE '".$this->escape_like_str($this->dbprefix)."%'";
		}

		return $sql;
	}

	protected function _list_columns($table = '')
	{
		return 'SHOW COLUMNS FROM '.$this->protect_identifiers($table, TRUE, NULL, FALSE);
	}

	public function field_data($table)
	{
		if (($query = $this->query('SHOW COLUMNS FROM '.$this->protect_identifiers($table, TRUE, NULL, FALSE))) === FALSE)
		{
			return FALSE;
		}
		$query = $query->result_object();

		$retval = array();
		for ($i = 0, $c = count($query); $i < $c; $i++)
		{
			$retval[$i] = new stdClass();
			$retval[$i]->name = $query[$i]->Field;
			sscanf($query[$i]->Type, '%[a-z](%d)', $retval[$i]->type, $retval[$i]->max_length);
			$retval[$i]->default = $query[$i]->Default;
			$retval[$i]->primary_key = (int) ($query[$i]->Key === 'PRI');
		}

		return $retval;
	}

	protected function _truncate($table)
	{
		return 'TRUNCATE '.$table;
	}

	protected function _from_tables()
	{
		if ( ! empty($this->qb_join) && count($this->qb_from) > 1)
		{
			return '('.implode(', ', $this->qb_from).')';
		}

		return implode(', ', $this->qb_from);
	}
}
