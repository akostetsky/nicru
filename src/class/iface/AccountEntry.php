<?php
include_once("Entry.php");
class AccountEntry extends Entry{
	protected $_data = array();
	function __construct($data) {
		$this->_data = $data[0];
	}
}

?>