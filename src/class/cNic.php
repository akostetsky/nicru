<?php
include_once("cNicApp.php");
class cNic extends cNicApp {
	protected $_registeredPackages = array(
    	'Zend_Gdata_Kind',
        'Zend_Gdata_Extension',
        'Zend_Gdata',
        'Zend_Gdata_App_Extension',
        'Zend_Gdata_App'
	);
	
	//TODO - Insert your code here
	function __construct($client = null) {
		parent::__construct($client);
	//TODO - Insert your code here
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