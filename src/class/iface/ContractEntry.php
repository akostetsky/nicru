<?php
include_once("Entry.php");
class ContractEntry extends Entry{
	protected $_ContractsListData = array();
	protected $_ContractData = array();
	protected $_data = array();
	const _ContractsListHandler = "contracts_list";
	const _ContractHandler = "contract";
	function __construct($data){
		$this->_ContractData = $data[self::_ContractHandler];
		$this->_ContractsListData = $data[self::_ContractsListHandler];
//		$this->_data = $data;
		$this->_data = $this->_ContractData;
	}
}

?>