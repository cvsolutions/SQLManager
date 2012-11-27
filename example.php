<?php

 /**
  * @author Concetto Vecchio
  * @copyright 2012

  */

 require_once ('SQLManager.class.php');

 $SQL = new SQLManager();

 // $SQL->insert_mysql('nomi', array('value' => 'ciao mondo', 'tag' => '1,2,3,4,5'));
 // $SQL->update_mysql('nomi', array('value' => 'ciao mondo', 'tag' => '12345'), array('id' => 5));
 // $SQL->delete_mysql('nomi', array('id' => 5));

 // $query = $SQL->query_mysql('SELECT * FROM nomi WHERE id = 6');
 // $result = $SQL->array_mysql($query);
 // print_r($result);

 // $data = array();
 // $result = $SQL->query_mysql('SELECT * FROM nomi');
 // while($row = $SQL->array_mysql($result)) {
 // $data[] = $row;
 // }
 // print_r($data);

 $SQL->close_mysql();

?>