<?php

 /**
  * @description Classe per Gestire il Database
  * @author Concetto Vecchio - info@cvsolutions.it
  * @version 1.0
  * @copyright 2012

  */

 class SQLManager {

 	private $host = '';
 	private $user = '';
 	private $pass = '';
 	private $db = '';

 	private $debug = false;
 	public $connect; // risorsa del db

 	/**
 	 * SQLManager::__construct()
 	 * 
 	 * @return
 	 */
 	function __construct() {
 		try {
 			$this->connect = mysql_connect($this->host, $this->user, $this->pass);
 			mysql_select_db($this->db, $this->connect);
 			if (! $this->connect) {
 				throw new Exception('MySQL Connection Database Error: ' . mysql_error());
 			}
 			else {
 				return true;
 			}
 		}
 		catch (Exception $e) {
 			printf('ERROR: %s', $e->getMessage());
 			exit();
 		}
 	}

 	/**
 	 * SQLManager::array_implode()
 	 * 
 	 * @param mixed $data
 	 * @param mixed $separated
 	 * @return
 	 */
 	private function array_implode($data = array(), $separated) {
 		$fields = array_keys($data);
 		$values = array_values(array_map('mysql_escape_string', $data));
 		$i = 0;
 		while($fields[$i]) {
 			if ($i > 0) $string .= $separated;
 			$string .= sprintf("%s = '%s'", $fields[$i], $values[$i]);
 			$i++;
 		}
 		return $string;
 	}

 	/**
 	 * SQLManager::query_mysql()
 	 * 
 	 * @param mixed $sql
 	 * @return
 	 */
 	public function query_mysql($sql) {
 		if ($this->debug === false) {
 			try {
 				$result = mysql_query($sql, $this->connect);
 				if ($result === false) {
 					throw new Exception('MySQL Query Error: ' . mysql_error());
 				}
 				return $result;
 			}
 			catch (Exception $e) {
 				printf('ERROR: %s', $e->getMessage());
 				exit();
 			}
 		}
 		else {
 			printf('<textarea>%s</textarea>', $sql);
 		}
 	}

 	/**
 	 * SQLManager::rows_mysql()
 	 * 
 	 * @param mixed $result
 	 * @return
 	 */
 	public function rows_mysql($result) {
 		return mysql_num_rows($result);
 	}

 	/**
 	 * SQLManager::array_mysql()
 	 * 
 	 * @param mixed $result
 	 * @return
 	 */
 	public function array_mysql($result) {
 		$row = mysql_fetch_array($result, MYSQL_ASSOC);
 		return $row;
 	}

 	/**
 	 * SQLManager::insert_mysql()
 	 * 
 	 * @param mixed $table
 	 * @param mixed $data
 	 * @return void
 	 */
 	public function insert_mysql($table, $data = array()) {
 		$fields = implode(', ', array_keys($data));
 		$values = implode('", "', array_map('mysql_escape_string', $data));
 		$query = sprintf('INSERT INTO %s (%s) VALUES ("%s")', $table, $fields, $values);
 		return $this->query_mysql($query);
 	}

 	/**
 	 * SQLManager::update_mysql()
 	 * 
 	 * @param mixed $table
 	 * @param mixed $data
 	 * @param mixed $where
 	 * @return void
 	 */
 	public function update_mysql($table, $data = array(), $where = array()) {
 		$fields = $this->array_implode($data, ', ');
 		$condition = $this->array_implode($where, ' AND ');
 		$query = sprintf('UPDATE %s SET %s WHERE %s', $table, $fields, $condition);
 		return $this->query_mysql($query);
 	}

 	/**
 	 * SQLManager::delete_mysql()
 	 * 
 	 * @param mixed $table
 	 * @param mixed $where
 	 * @return void
 	 */
 	public function delete_mysql($table, $where = array()) {
 		$condition = $this->array_implode($where, ' AND ');
 		$query = sprintf('DELETE FROM %s WHERE %s', $table, $condition);
 		return $this->query_mysql($query);
 	}

 	/**
 	 * SQLManager::close_mysql()
 	 * 
 	 * @return
 	 */
 	public function close_mysql() {
 		return mysql_close($this->connect);
 	}

 }

?>