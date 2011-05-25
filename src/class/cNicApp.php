<?php
/*
 * cNicApp.php - Класс cNicApp
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
/** 
 * Класс реализующий работу с API RU-CENTER
 * @author Alexander Kostetsky
 * 
 */
class cNicApp {
	const sFrom = "KOI8-R";
	const sTo = "UTF-8";
	private $bDebug = FALSE;
	/**
	 * Экземпляр класса HTTP_Request2
	 * @var HTTP_Request2
	 */
	protected $_httpClient;
	/**
	 * Статический экземпляр класса HTTP_Request2
	 * @var unknown_type
	 */
	protected static $_staticHttpClient = null;
	/*
	 * Константа URL API
	 */
	const sApiUrl = "https://www.nic.ru/dns/dealer";
	/*
	 * Константа название формы для работы с API
	 */
	const sFormField = "SimpleRequest";
	 
	/**
	 * Инициализация класса и сохранение класса  HTTP_Request2
	 * @param unknown_type $client
	 */
	function __construct($client = null, $bDebug = FALSE) {
		$this->bDebug = $bDebug;
		$this->setHttpClient($client);
	}
	/**
	 * Возвращает экземпляр класса HTTP_Request2
	 */
 	public function getHttpClient() {
        return $this->_httpClient;
    }
    /**
     * Сохранияет или создает экземплярпы класса HTTP_Request2 
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
     * Сораняет статический экземпляр класса HTTP_Request2
     * @param HTTP_Request2 $httpClient
     */
    public static function setStaticHttpClient(HTTP_Request2 $httpClient)
    {
        self::$_staticHttpClient = $httpClient;
    }
    
	/**
	 * Удаляльщик 
	 */
	function __destruct() {	} // eof __destruct
	public function __call($sMethod, $aArgs){
		if (preg_match('/^new(\w+)/', $sMethod, $aMatches)){
			$sClass = $aMatches[1];
			$foundClassName = null;
 				try {
                     // Autoloading disabled on next line for compatibility
                     // with magic factories. See ZF-6660.
                     if (!class_exists($sClass, false)) {
              			include_once("iface/{$sClass}.php");
                     }
                     $foundClassName = $sClass;
                     
                 } catch (Exception $e) {
                     // package wasn't here- continue searching
                 }
            if ($foundClassName != null){
                $reflectionObj = new ReflectionClass($foundClassName);
                $instance = $reflectionObj->newInstanceArgs($aArgs);
                if ($instance instanceof Zend_Gdata_App_FeedEntryParent) {
                    $instance->setHttpClient($this->_httpClient);
                }
                return $instance;
            } else {
                require_once 'Zend/Gdata/App/Exception.php';
                throw new Exception("Unable to find '${sClass}' in registered packages");
            }
        } else {
            throw new Exception("No such method ${sMethod}");
        }
	} // eof __call
	public function getQuery($aData, $className='Feed')
    {
        return $this->importUrl($aData, $className);
    } // eof getQuery
    
    /**
     * Возвращает статутс API
     * @param boolean $data - статус API
     * @todo 
     *  <ol>
     *  <li>Добавить логирование</li>
     *  </ol> 
     */
    public function getStatus($data){
    	$aStatus = array();
    	trim($data);
    	$aData = explode("\n",$data);
    	foreach(array_slice($aData, 0, 2) as $value){
    		if(empty($value)) continue;
    		$aTemp = explode(":", $value);
    		$aStatus[$aTemp[0]] = trim($aTemp[1]);
    	}
    	return ($aStatus["State"]=="200 OK")?false:true;
    }
    /**
     * Формирование запроса и обработка ответа. 
     * @param array $aData - входящие данные
     * @param sting $className - имя класса для маппинга данных
     */
	public function importUrl($aData, $className='Feed') {
		$response = $this->get($aData);
        $QueryContent = $response->getBody();
        $QueryContent = iconv(self::sFrom,self::sTo,$QueryContent);
       //echo "\n\n\nRSP:\n";
       //print_r($QueryContent);
       //echo "\n\n[eof]\n\n";
        if($this->getStatus($QueryContent)){
        	throw new Exception(print_r($QueryContent,true));
        	return null;
        }
        $feed = self::importString($QueryContent, $className);
        return $feed;
    } // eof importUrl
	/**
	 * Формирует запрос к API, выполянет его и получает ответ
	 * @param $aData
	 */
    public function get($aData)
    {
        return $this->performHttpRequest($this->prepareRequest($aData));
    } // eof get
    /**
     * Формирует запрос к API ( массив в строку ) 
     * @param unknown_type $aData
     */
	public function prepareRequest($aData){
		$sRequestData = "";
		$queryArray = array();
        foreach ($aData as $name => $value) {
    		if(is_array($value)) {
    			$queryArray[] = "\r\n[".$name."]\r\n";
    			foreach ($value as $sName => $sValue) {	
    				if(is_array($sValue)){
    					foreach ($sValue as $sSubValue) {
    						$queryArray[] = $sName.':'.$sSubValue."\r\n";
    					}
    				}else{
    					$queryArray[] = $sName.':'.$sValue."\r\n";
    				}
    			}
    		} else {
            	$queryArray[] = $name.':'.$value."\r\n";
    		}
    	}
        if (count($queryArray) > 0) {
            $sRequestData .= implode('', $queryArray);
        } else {
            $sRequestData .= '';
        }
        if($this->bDebug){ var_dump($sRequestData); }
        return iconv(self::sTo,self::sFrom,$sRequestData);
	} // eof prepareRequest
	/**
	 * Выполняет запрос к API 
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
     * Разбор ответа в классы
     * @param string $string - строка ответа удаленного сервера
     * @param string $className - имя класса для маппинга данных
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