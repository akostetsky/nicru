<?php
/** 
 * ����� ����������� ������ � API http://www.nic.ru/
 * @author Alexander Kostetsky
 * 
 */
class cNicApp {
	/**
	 * ��������� ������ HTTP_Request2
	 * @var HTTP_Request2
	 */
	protected $_httpClient;
	/**
	 * ����������� ��������� ������ HTTP_Request2
	 * @var unknown_type
	 */
	protected static $_staticHttpClient = null;
	/*
	 * ��������� URL API
	 */
	const sApiUrl = "https://www.nic.ru/dns/dealer";
	/*
	 * ��������� �������� ����� ��� ������ � API
	 */
	const sFormField = "SimpleRequest";
	 
	/**
	 * ������������� ������ � ���������� ������  HTTP_Request2
	 * @param unknown_type $client
	 */
	function __construct($client = null) {
		$this->setHttpClient($client);
	}
	/**
	 * ���������� ��������� ������ HTTP_Request2
	 */
 	public function getHttpClient() {
        return $this->_httpClient;
    }
    /**
     * ���������� ��� ������� ����������� ������ HTTP_Request2 
     * @param $client
     */
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
    /**
     * �������� ����������� ��������� ������ HTTP_Request2
     * @param HTTP_Request2 $httpClient
     */
    public static function setStaticHttpClient(HTTP_Request2 $httpClient)
    {
        self::$_staticHttpClient = $httpClient;
    }
    
	/**
	 * ���������� 
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
	public function getQuery($aData, $className='Feed')
    {
        return $this->importUrl($aData, $className);
    } // eof getQuery
    
    /**
     * ���������� ������� API
     * @param boolean $data - ������ API
     * @todo 
     *  <ol>
     *  <li>�������� �����������</li>
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
    /**
     * ������������ ������� � ��������� ������. 
     * @param array $aData - �������� ������
     * @param sting $className - ��� ������ ��� �������� ������
     */
	public function importUrl($aData, $className='Feed') {
		$response = $this->get($aData);
        $QueryContent = $response->getBody();
        if($this->getStatus($QueryContent)){
        	print_r($QueryContent);
        	throw new Exception("Unexpected API status");
        	return null;
        }
        $feed = self::importString($QueryContent, $className);
        return $feed;
    } // eof importUrl
	/**
	 * ��������� ������ � API, ��������� ��� � �������� �����
	 * @param $aData
	 */
    public function get($aData)
    {
        return $this->performHttpRequest($this->prepareRequest($aData));
    } // eof get
    /**
     * ��������� ������ � API ( ������ � ������ ) 
     * @param unknown_type $aData
     */
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
        var_dump($sRequestData);
        return $sRequestData ;
		
	} // eof prepareRequest
	/**
	 * ��������� ������ � API 
	 * @param unknown_type $sBody
	 */
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
    } // eof performHttpRequest
    /**
     * ������ ������ � ������
     * @param string $string - ������ ������ ���������� �������
     * @param string $className - ��� ������ ��� �������� ������
     */
	public static function importString($string, $className='Feed')
    {
        if (!class_exists($className, false)) {
          	include_once("iface/{$className}.php");
        }
	    $feed = new $className();
        $feed->transferFromString($string);
        return $feed;
    } // eof importString
    

}

?>