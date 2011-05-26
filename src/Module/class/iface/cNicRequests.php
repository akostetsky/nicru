<?php
/*
 * cNicRequests.php - Класс cNicRequests
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */

class cNicRequests {
	protected $_params = array(
		"lang" => '',
		"login" => '',
		"password" => '',
		"request" => '',
		"operation" => '',
		"request-id" => ''
	);
	function __construct() { 
		$this->_params["request-id"]=date("YmdHis").".1"."@cp.sl.ru";
	}
	public function SetAuth($sLogin, $sPassword, $sLang = "ru"){
		$this->_params["lang"] = $sLang;
		$this->_params["login"]= $sLogin;
		$this->_params["password"] = $sPassword;
	}
	public function getQueryString() {
      return $this->_params;
    }	
}

?>