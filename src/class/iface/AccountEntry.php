<?php
include_once("Entry.php");
class AccountEntry extends Entry{
	protected $_data = array();
	const _handler = "[account]";
	function __construct($data) {
		$this->_data = $data[self::_handler];
	}
}

?>