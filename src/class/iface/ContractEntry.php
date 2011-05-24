<?php
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