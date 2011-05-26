<?php
/*
 * cClientLogin.php - Класс cClientLogin
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
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