<?php
/*
*************************************************************************
*                                                                       *
* Модулль NIC.RU для автоматической регистрации доменов                 *
* Используеся как плагин к WHMCS                                        *
* Release Date: 09/09/2009                                              *
* Version 0.0.1                                                         *
*                                                                       *
*************************************************************************
*                                                                       *
* Email: finster.seele@gmail.com                                        *
*                                                                       *
*************************************************************************
* Основной 
*************************************************************************
*/
require_once 'HTTP/Request2.php';

class cClientLogin {
	const DEFAULT_API_URL = "https://www.nic.ru/dns/dealer";
	/**
	 * 
	 */
	public static function getHttpClient($sUser, $sPassword, $sApiUrl = self::DEFAULT_API_URL){
	  if (! ($sUser && $sPassword)) {
            throw new Exception("Please set your Google credentials before trying to authenticate");
	  }
	  try {
	  	$client = new HTTP_Request2($sApiUrl,HTTP_Request2::METHOD_POST);
	  } catch (HTTP_Request2_Exception $e) {
	  	throw new Exception($e->getMessage());
	  }
	  $client->setAuth($sUser,$sPassword);
	  return $client;				
	} // eof getHttpClient
} // eof class cClientLogin
?>