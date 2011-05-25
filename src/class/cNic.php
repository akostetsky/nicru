<?php
include_once("cNicApp.php");
class cNic extends cNicApp {
	const DebugFlag = TRUE;
	//TODO - Insert your code here
	function __construct($client=null, $bDebug=false){
		parent::__construct($client,$bDebug);
	}
	
	/**
	 * 
	 */
	function __destruct() {
		
	//TODO - Insert your code here
	}
    
	public function getNicQuery($location = null)
    {
    	$aAuth = $this->_httpClient->getAuth();
		$location->setAuth($aAuth["user"], $aAuth["password"]);
    	$aQueryData = $location->getQueryData();
        return parent::getQuery($aQueryData, $location->sGetFeed());
    }
} /* end class cNic */

?>