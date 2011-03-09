<?php
/** 
 * @author alexkost
 * 
 * 
 */
class cNicApp {
	//TODO - Insert your code here
	protected $_httpClient;
	protected static $_staticHttpClient = null;
	const sApiUrl = "https://www.nic.ru/dns/dealer";
	const sFormField = "SimpleRequest";
	 
	function __construct($client = null) {
		$this->setHttpClient($client);
	}
 	public function getHttpClient() {
        return $this->_httpClient;
    }
    public function setHttpClient($client) {
        if ($client === null) {
            $client = new HTTP_Request2();
        }
        if (!$client instanceof HTTP_Request2) {
			 throw new Exception("Argument is not an instance of HTTP_Request2.");
        }
        $this->_httpClient = $client;
        self::setStaticHttpClient($client);
        return $this;
    }
    public static function setStaticHttpClient(HTTP_Request2 $httpClient)
    {
        self::$_staticHttpClient = $httpClient;
    }
    
	/**
	 * 
	 */
	function __destruct() {
		
	//TODO - Insert your code here
	} // eof __destruct
	public function __call($sMethod, $aArgs){
		if (preg_match('/^new(\w+)/', $sMethod, $aMatches)) {
			$sClass = $aMatches[1];
			$foundClassName = null;
            foreach ($this->_registeredPackages as $name) {
				try {
                     // Autoloading disabled on next line for compatibility
                     // with magic factories. See ZF-6660.
                     if (!class_exists($name . '_' . $sClass, false)) {
              			include_once("iface/{$sClass}.php");
                     }
                     $foundClassName = $sClass;
                     break;
                 } catch (Exception $e) {
                     // package wasn't here- continue searching
                 }
            }
            if ($foundClassName != null) {
                $reflectionObj = new ReflectionClass($foundClassName);
                $instance = $reflectionObj->newInstanceArgs($aArgs);
                if ($instance instanceof Zend_Gdata_App_FeedEntryParent) {
                    $instance->setHttpClient($this->_httpClient);

                    // Propogate version data
                    $instance->setMajorProtocolVersion(
                            $this->_majorProtocolVersion);
                    $instance->setMinorProtocolVersion(
                            $this->_minorProtocolVersion);
                }
                return $instance;
            } else {
                require_once 'Zend/Gdata/App/Exception.php';
                throw new Exception("Unable to find '${sClass}' in registered packages");
            }
        }else{
            throw new Exception("No such method ${sMethod}");
        }
	} // eof __call
	public function getQuery($aData, $className='Zend_Gdata_App_Feed')
    {
        return $this->importUrl($aData, $className);
    } // eof getQuery
    
    /**
     * 
     * @param boolean $data - статус API
     * @todo 
     *  <ol>
     *  <li>Добавить логирование</li>
     *  </ol> 
     */
    public function getStatus($data){
    	$aStatus = array();
    	$aData = explode("\n",$data);
    	foreach(array_slice($aData, 0, 2) as $value){
    		$aTemp = explode(":", $value);
    		$aStatus[$aTemp[0]] = trim($aTemp[1]);
    	}
    	return ($aStatus["State"]=="200 OK")?false:true;
    }
	public function importUrl($aData, $className='Zend_Gdata_App_Feed') {
		$response = $this->get($aData);
        $QueryContent = $response->getBody();
        if($this->getStatus($QueryContent)){
        	throw new Exception("Unexpected API status");
        	return null;
        }
        $feed = self::importString($QueryContent, $className);
        return $feed;
    } // eof importUrl
	
    public function get($aData)
    {
        return $this->performHttpRequest($this->prepareRequest($aData));
    } // eof get
	public function prepareRequest($aData){
		$sRequestData = "";
		$queryArray = array();
        foreach ($aData as $name => $value) {
            $queryArray[] = $name.':'.$value."\r\n";
        }
        if (count($queryArray) > 0) {
            $sRequestData .= implode('', $queryArray);
        } else {
            $sRequestData .= '';
        }
        return $sRequestData ;
		
	} // eof prepareRequest
	public function performHttpRequest($sBody)
    {
    	$this->_httpClient->setHeader("Content-Type","application/x-www-form-urlencoded");
    	$this->_httpClient->addPostParameter(self::sFormField,$sBody);
    	try {
    		$response = $this->_httpClient->send();
    		if (200 == $response->getStatus()) {
        		return $response;
    		} else {
        		echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
             	$response->getReasonPhrase();
    		}
		} catch (HTTP_Request2_Exception $e) {
    		echo 'Error: ' . $e->getMessage();
		}
    	return $response;
    }
	public static function importString($string, $className='Feed')
    {
        if (!class_exists($className, false)) {
          	include_once("iface/{$className}.php");
        }
	    $feed = new $className();
        $feed->transferFromString($string);
        return $feed;
    }
    

}

?>