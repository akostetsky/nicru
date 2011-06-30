<?php
/*
 * cNic.php - Класс cNic
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
include_once("cNicApp.php");
/**
 * 
 * Класс взаимодействия с системой оказания услуг RU-CENTER передачи запросов и ответов через HTTP-шлюз.
 * @author Alexander Kostetsky
 *
 */
class cNic extends cNicApp {
	/**
	 * Флаг отладки
	 * @var const string
	 */
	const DebugFlag = TRUE;
	/*
	 * Конструктор
	 * @param obj $client - класс cClientLogin
	 * @param boolean $bDebug - флаг отладки
	 */
	function __construct($oClient=null, $bDebug=false){
		parent::__construct($oClient, $bDebug);
	}
    /*
     * Выполнение запроса к системе оказания услуг RU-CENTER
     * @param obj $oLocation - объект запроса
     */
	public function getNicQuery($oLocation = null)
    {
    	$aAuth = $this->_httpClient->getAuth();
		$oLocation->setAuth($aAuth["user"], $aAuth["password"]);
    	$aQueryData = $oLocation->getQueryData();
        return parent::getQuery($aQueryData, $oLocation->sGetFeed());
    }
} /* end class cNic */

?>