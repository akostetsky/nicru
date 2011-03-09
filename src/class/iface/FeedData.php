<?php

class FeedData {
	protected $_aFeedData = array();
	function __construct($aData = array()){
		$this->_aFeedData = $aData;
	}
	public function	transferFromString($sData){
	    $aStatus = array();
    	$aData = array();
    	
	    $aTmpData = explode("\n",$sData);
		
	    foreach($aTmpData as $key => $val){
			if(!trim($val)) unset($aTmpData[$key]);
		}
	    $this->_aFeedData = $this->aRecursionArray($aTmpData);
	}
	private function aRecursionArray(&$aTmpData){
		foreach($aTmpData as $key => $value){
    		$aTemp = explode(":", $value);
    		if(count($aTemp) == 1 ){  			
    			$aStatus[strtolower($value)] = $this->aRecursionArray(array_slice($aTmpData,$key));
    		}else{
    			$aStatus[strtolower($aTemp[0])] = trim($aTemp[1]);
    		}	
    	}
    	return $aStatus;
	}
	public function transferFromArray($aData){
		
	}
}

?>