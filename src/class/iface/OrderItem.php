<?php
class OrderItem extends Entry {
	protected $_data = array();
	function __construct($data) {
		$this->_data = $data[0];
	}
}