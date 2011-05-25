<?php

include_once("cNicRequests.php");
class cOrder extends cNicRequests {
	const sFeed = "OrderFeed";
	const sDataBlock = 'order';
	/*
	 * Статус заказа.
	 * Ожидает подписания договора или оплаты
	 */
	const StateWaiting = "waiting";
	/*
	 * Статус заказа.
	 * В обработке
	 */
	const StateRunningg = "running";
	/*
	 * Статус заказа.
	 * Выполнен (успешно или неуспешно)
	 */
	const StateCompleted = "completed";
	/*
	 * Статус заказа.
	 * Отозван клиентом (партнером)
	 */
	const StateDeleted = "deleted";
	
	var $_aParam = array();
	public function __construct() {
		$this->_params["request"]="order";
		parent::__construct();
	}
	
	public function sGetFeed(){
		return self::sFeed;
	}
	function __call($m,$aParam){
		echo __CLASS__."->".$m."(".print_r($aParam,true).") not yet!\n";
	}
	public function getQueryData(){
    	$aParam = array();
		$aParam = array_merge($aParam, $this->getQueryString());
		$aParam[self::sDataBlock] = $this->_aParam;
		return $aParam;
    }
    public function Search($aData = array()) {
    	$this->_params["operation"]="search";
    	
    	$this->_params["subject-contract"] = $aData['subject-contract'];
    	unset($aData['subject-contract']);

    	$this->_aParam = array_merge($this->_aParam,$aData);
		
    }
    public function Get($iOrder){
    	$this->_params["operation"]="get";
    	$aData['order_id'] = $iOrder;
    	$this->_aParam = array_merge($this->_aParam,$aData);
    }
    public function Delete($iOrder){
    	$this->_params["operation"]="delete";
    	$aData['order_id'] = $iOrder;
    	$this->_aParam = array_merge($this->_aParam,$aData);
    }
}


?>