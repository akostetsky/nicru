<?php
/*
 * ContractEntry.php - Класс ContractEntry
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
include_once("Entry.php");
class ContractEntry extends Entry{
	protected $_data = array();
	function __construct($data){
		if(count($data) == 1){
			$this->_data = $data[0];
		}else{
			$this->_data = $data;
		}
	}
}

?>