<?php

 /**
  * @author Concetto Vecchio
  * @copyright 2012

  */

 require_once ('SQLManager.class.php');

 $SQL = new SQLManager();

 /** insert mysql database */
 $SQL->insert_mysql('table', array(
 	'id' => '12345', 
 	'name' => 'Concetto'
 	));

 /** update mysql database */
 $SQL->update_mysql('table', array(
 	'name' => 'Concetto', 
 	'email' => 'user@localhost'
 	), array('id' => '12345'));

 /** delete mysql database */
 $SQL->delete_mysql('table', array(
 	'id' => '12345'
 	));

 /** mysql query to single array */
 $query = $SQL->query_mysql('SELECT * FROM table WHERE id = 6 LIMIT 0,1');
 $result = $SQL->array_mysql($query);
 // print_r($result);

 /** mysql query to loop array */
 $data = array();
 $result = $SQL->query_mysql('SELECT * FROM table ORDER BY id DESC');
 while($row = $SQL->array_mysql($result)) {
 	$data[] = $row;
 }
 // print_r($data);

 $SQL->close_mysql();

?>