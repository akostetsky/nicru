<?php
/*
 * OrderEntry.php - Класс OrderEntry
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
include_once("Entry.php");
class OrderEntry extends Entry{
	protected $_data = array();
	function __construct($data) {
		$this->_data = $data[0];
	}
}
?>