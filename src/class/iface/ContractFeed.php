<?php
include_once("Feed.php");

class ContractFeed extends Feed {
	protected $_entryClassName = 'ContractEntry';
	const _ContractHandler = "contract";
	/**
	 * GetContractsTotal
	 * Количество услуг, найденных по запросу в базе данных. 
	 */
	public function GetContractsTotal(){ return $this->contracts_list[0]["contracts_found"]; }
	/**
	 * GetContractsLimit
	 * Количество услуг, выданных по запросу. Соответствует затребованному количеству выдаваемых услуг.
	 */
	public function GetContractsLimit(){ return $this->contracts_list[0]["contracts_limit"]; }
	/**
	 * GetContractsFirst
	 * Порядковый номер услуги, начиная с которой (из числа найденных в базе данных) осуществляется выдача. 
	 * Соответствует затребованному порядковому номеру начальной услуги. 
	 */
	public function GetContractsFirst(){ return $this->contracts_list[0]["contracts_first"]; }
	public function transferFromString($data){
		parent::transferFromString($data, self::_ContractHandler);
	}
}

?>