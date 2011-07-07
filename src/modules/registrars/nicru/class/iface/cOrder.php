<?php
/*
 * cOrder.php - Класс cOrder
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
include_once("cNicRequests.php");
/**
 * 
 * Enter description here ...
 * @author alexkost
 *
 */
class cOrder extends cNicRequests {
	const sFeed = "OrderFeed";
	const sDataBlock = 'order';
	const sProlongDataBlock = 'order-item';
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
	var $_sAction = null;
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
		switch ($this->_sAction){
			case 'Prolong':
				//TODO: Сделать обработку нескольких ордеров за один запрос
				$aParam[self::sProlongDataBlock] = $this->_aParam;
				break;
			default:
				$aParam[self::sDataBlock] = $this->_aParam;
				break;
		}
        return $aParam;
    }
    public function Prolong($aData = array()){
    	$this->_sAction=__FUNCTION__;
    	$this->_params["operation"]="create";
    	$this->_params["subject-contract"] = $aData['subject-contract'];
    	unset($aData['subject-contract']);
    	
    	//TODO: Сделать обработку нескольких ордеров за один запрос
    	// Добавляем поля по-дефолту
    	$aData['action'] = 'prolong';
    	$this->__GetServiceAndTemplate($aData['domain']);
    	$this->_aParam = array_merge($this->_aParam,$aData);
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
    private function __GetServiceAndTemplate($sDomain){
    	$this->_aParam['template']='prolong';
    	if (preg_match('/^[-a-z0-9]+\.([a-z]{2,6})$/', strtolower($sDomain), $aMatches)){
			$sRoot = $aMatches[1];
    		switch($sRoot){
    			case 'ru':
    				$this->_aParam['service']='domain_ru';
    				break;
    			case 'su':
    				$this->_aParam['service']='domain_su';
    				break;
    			case 'рф':
    				$this->_aParam['service']='domain_rf';
    				break;
    			default:
    				throw new Exception("No TLD found: ${sRoot}");
    				break;
    		}
    	}else{
    		 throw new Exception("No parse domain  ${sDomain}");
    	}
    }
}


?>