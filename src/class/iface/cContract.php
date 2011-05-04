<?php
include_once("cNicRequests.php");

/** 
 * @author alexkost
 * 
 * 
 */
class cContract extends cNicRequests {
	const sFeed = "ContractFeed";
	const sDataBlock = 'contract';
	var $_aParam = array();

	/**
	 * 
	 */
	public function __construct() {
		$this->_params["request"]="contract";
		parent::__construct();
	}
	
	/**
	 * 
	 */
	function __destruct() {
		
	}
	private function Create($aData = array()){
		$this->_aParam = array_merge($this->_aParam,$aData);
		$this->_params["operation"]="create";
	}
	/**
	 * Создание анкеты клиента для индивидуального предпринимателя  (ИП)
	 * @param $aData
	 */
	public function CreatePbul($aData = array()){
		$this->_aParam['contract-type']='PRS';
		$this->Create($aData);
	} // eof CreatePbul
	/**
	 * Создание анкеты клиента для юридического лица
	 */
	public function CreateOrg($aData = array()){
		$this->_aParam['contract-type']='ORG';
		$this->Create($aData);
	} // eof CreateOrg
	/**
	 * Создание анкеты клиента для физического лица
	 * @param unknown_type $aData
	 */
	public function CreatePrs($aData = array()){
		$this->_aParam['contract-type']='PRS';
		$this->Create($aData);
	} // eof CreatePrs
	public function getQueryData()
    {
    	$aParam = array();
		$aParam = array_merge($aParam, $this->getQueryString());
		$aParam[self::sDataBlock] = $this->_aParam;
		return $aParam;
    }
    public function Search($aData = array()) {
    	$this->_aParam = array_merge($this->_aParam,$aData);
		$this->_params["operation"]="search";
    }
	public function sGetFeed(){
		return self::sFeed;
	}
}

?>