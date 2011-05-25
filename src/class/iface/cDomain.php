<?php
/*
 * cDomain.php - Класс cDomain
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
include_once("cNicRequests.php");
class cDomain extends cNicRequests {
	const sFeed = "DomainFeed";
	const sDataBlock = 'order-item';
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
	public function Order($aData){
		$this->_params["subject-contract"] = $aData['subject-contract'];
		$this->_params["operation"]="create";
		unset($aData['subject-contract']);
		
		$this->__GetServiceAndTemplate($aData['domain']);
		$this->_aParam["action"]="new";
		$this->_aParam = array_merge($this->_aParam,$aData);
		}
	public function getQueryData(){
    	$aParam = array();
		$aParam = array_merge($aParam, $this->getQueryString());
		$aParam[self::sDataBlock] = $this->_aParam;
		return $aParam;
    }
    private function __GetServiceAndTemplate($sDomain){
    	if (preg_match('/^[-a-z0-9]+\.([a-z]{2,6})$/', strtolower($sDomain), $aMatches)){
			$sRoot = $aMatches[1];
    		switch($sRoot){
    			case 'ru':
    				$this->_aParam['service']='domain_ru';
    				$this->_aParam['template']='client_ru';
    				break;
    			case 'su':
    				$this->_aParam['service']='domain_su';
    				$this->_aParam['template']='client_ru';
    				break;
    			case 'рф':
    				$this->_aParam['service']='domain_rf';
    				$this->_aParam['template']='domain_rf';
    				break;
    			default:
    				throw new Exception("No TLD found ${sRoot}");
    				break;
    		}
    	}else{
    		 throw new Exception("No parse domain  ${sDomain}");
    	}
    }
}
?>