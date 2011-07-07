<?php
/*
 * nicru.php - Registrar Module for WHMCS 4.5
 * Template: Registrar Module Development Kit for WHMCS 4.5
 * Release Date: 26/05/2011                                              *
 * Version 1.0 
 * Author: Alexander Kostetsky
 * Email: finster.seele@gmail.com       
 */
/**
 * Инклудим классы API
 */
include_once("class/cNic.php");
include_once("class/cClientLogin.php");
/*
 * Конфиг модуля
 */
function nicru_getConfigArray() {
     $configarray = array(
      "PartnerLogin" => array( "Type" => "text", "Size" => "20", "Description" => "Like: 370/NIC-REG/adm", ),
      "PartnerPassword" => array( "Type" => "text", "Size" => "20", "Description" => "Like: dogovor", ),
      "PartnerUrl" => array("Type" => "text", "Size" => "100", "Description" => "Like: https://www.nic.ru/dns/dealer", ),
      "TestMode" => array( "Type" => "yesno", ),
	 );
     return $configarray;
}
/*
 * Регистрация домена  
 */
function nicru_RegisterDomain($params) {
	error_log(" ". __METHOD__." ", 0);
	error_log(print_r($params, true), 0);
	error_log("START",0);
	
	$NicId = null;
	
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
	$regperiod = $params["regperiod"];
	$nameserver1 = $params["ns1"];
	$nameserver2 = $params["ns2"];
    $nameserver3 = $params["ns3"];
    $nameserver4 = $params["ns4"];
	# Registrant Details
	$RegistrantFirstName = $params["firstname"];
	$RegistrantLastName = $params["lastname"];
	$RegistrantAddress1 = $params["address1"];
	$RegistrantAddress2 = $params["address2"];
	$RegistrantCity = $params["city"];
	$RegistrantStateProvince = $params["state"];
	$RegistrantPostalCode = $params["postcode"];
	$RegistrantCountry = $params["country"];
	$RegistrantEmailAddress = $params["email"];
	$RegistrantPhone = $params["phonenumber"];
	// # Admin Details
	$AdminFirstName = $params["adminfirstname"];
	$AdminLastName = $params["adminlastname"];
	$AdminAddress1 = $params["adminaddress1"];
	$AdminAddress2 = $params["adminaddress2"];
	$AdminCity = $params["admincity"];
	$AdminStateProvince = $params["adminstate"];
	$AdminPostalCode = $params["adminpostcode"];
	$AdminCountry = $params["admincountry"];
	$AdminEmailAddress = $params["adminemail"];
	$AdminPhone = $params["adminphonenumber"];
	$NicId = $params['customfields1'];

	
	$url = $params["PartnerUrl"];
	$user = $params["PartnerLogin"];
	$pass = $params["PartnerPassword"];
	
	$aCreatedNIC = array();

	$client = cClientLogin::getHttpClient($user, $pass, $url);
	$service = new cNic($client, cNic::DebugFlag);
	
	
	if(empty($NicId)){
		$sPerson = $params["additionalfields"];
		$sPersonData = array(); 
		foreach ($sPerson as $key => $name){
			if(!empty($name)){
				preg_match('/^\<span style=display\:none\>(\w+)\<\/span\>/i', $key, $aMatches);
				$sPersonData[$aMatches[1]] = $name;
			}
		}
		// Search
		$query = $service->newcContract();
		$aData = array();
		$aData['contracts-limit'] = "10";
		$aData['contracts-first'] = "1";
		$aData['person-r']=$sPersonData['person_r'];
		$aData['passport']=$sPersonData['passport'];
		$aData['e-mail']=$RegistrantEmailAddress;

		$query->Search($aData);
		$data = $service->getNicQuery($query);
		if($data->GetContractsTotal() == 1){
			$oContact = $data->current();
			$NicId = $oContact->contract_num;
			insertNicIdToDb($NicId);
		}else{
			// нашли много что брать то?
			die("Error: more one");
		}
		unset($data);
		unset($query);
	}	
	if(empty($NicId)){	
		// Not found must create
		switch($sPersonData['reg_to']){
			case "Частное лицо(Physical person)":
				$query = $service->newcContract();
				$aData = array();
				$aData['password']="dk3wo2e";
				$aData['tech-password']="dk3wo2e";
				$aData['person']=translitIt($sPersonData['person_r']);
				$aData['person-r']=$sPersonData['person_r'];
				$aData['country']="RU";
				$aData['currency-id']="RUR";
				$aData['passport']=$sPersonData['passport'];
				$aData['birth-date']=$sPersonData['birth_date'];
				$aData['p-addr']=$sPersonData['residence'];
				$aData['phone']=$sPersonData['phone'];
				$aData['fax-no']=$sPersonData['fax'];
				$aData['e-mail']=$RegistrantEmailAddress;
				$aData['mnt-nfy']="admin@sl.ru";

				$query->CreatePrs($aData);
				$data = $service->getNicQuery($query);
				echo "\tlogin Prs: ".$data->login."\n";
				$NicId = $data->login;
				insertNicIdToDb($NicId);
				unset($data);
				unset($query);
				break;
			case "Организацию(Organization)":
				break;
			default:
				error_log(print_r($sPerson, true), 0);
				die("Error reg_to");
				break;
		}
		insertNicIdToDb($NicId);
    }

	$query = $service->newcDomain();
	$aData = array();
	$aData['subject-contract'] = $NicId;
	$aData['domain'] = 	$sld.".".$tld;
    $aData['e-mail'] = $RegistrantEmailAddress;
    $aData['phone'] = $RegistrantPhone;
    $aData['fax-no'] = $RegistrantPhone;
    $aData['nserver'][] = $nameserver1;
    $aData['nserver'][] = $nameserver2;
    $aData['nserver'][] = $nameserver3;
    $aData['nserver'][] = $nameserver4;

    $query->Order($aData);
	$data = $service->getNicQuery($query);
	$oDomainEntry = $data->current();
	foreach ($oDomainEntry->aGetData() as $key => $name){
		error_log("\t".$key.":".$name."\n", 0);
	}
	$iOrderId = $oDomainEntry->order_id;
	error_log("NIC RU OrderId ".$iOrderId, 0);
	unset($oDomainEntry);
	unset($data);
	unset($query);
	
	error_log(print_r($params, true), 0);
//	$values["error"] = $error;
	return $values;
}
/**
 * 
 * Продление доменов
 * @param array $params
 */
function nicru_RenewDomain($params) {
    error_log(" ". __METHOD__." ", 0);
    error_log(print_r($params, true), 0);
    $tld = $params["tld"];
    $sld = $params["sld"];
    //$regperiod = $params["regperiod"];
	$url = $params["PartnerUrl"];
	$user = $params["PartnerLogin"];
	$pass = $params["PartnerPassword"];
	
	$client = cClientLogin::getHttpClient($user, $pass, $url);
	$service = new cNic($client, cNic::DebugFlag);
/**
 * Поиск контакта по домену
 */
	$query = $service->newcContract();
    $aData = array();
    $aData['contracts-limit'] = "10";
    $aData['contracts-first'] = "1";
    $aData['domain'] = 	$sld.".".$tld;
    $query->Search($aData);
    $data = $service->getNicQuery($query);
    if($data->GetContractsTotal() == 1){
        $oContact = $data->current();
        $NicId = $oContact->contract_num;
        insertNicIdToDb($NicId);
    }else{
		// нашли много что брать то?
		die("Error: more one or not found.");
	}
	unset($data);
	unset($query);
/**
 * Запрос на продление домена 
 */	
	$query = $service->newcOrder();
	$aData = array();
	$aData['subject-contract'] = $NicId;
	$aData['domain'] = 	$sld.".".$tld;
	$query->Prolong($aData);
	$data = $service->getNicQuery($query);
	unset($data);
	unset($query);
    //TODO: Отобразить ошибку
    $values["error"] = $error;
    return $values;
}


/*
function nicru_GetNameservers($params) {
	error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
	# Put your code to get the nameservers here and return the values below
	$values["ns1"] = $nameserver1;
	$values["ns2"] = $nameserver2;
    $values["ns3"] = $nameserver3;
    $values["ns4"] = $nameserver4;
	# If error, return the error message in the value below
	$values["error"] = $error;
	return $values;
}

function nicru_SaveNameservers($params) {
	error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
    $nameserver1 = $params["ns1"];
	$nameserver2 = $params["ns2"];
    $nameserver3 = $params["ns3"];
	$nameserver4 = $params["ns4"];
	# Put your code to save the nameservers here
	# If error, return the error message in the value below
	$values["error"] = $error;
	return $values;
}

function nicru_GetRegistrarLock($params) {
	error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
	# Put your code to get the lock status here
	if ($lock=="1") {
		$lockstatus="locked";
	} else {
		$lockstatus="unlocked";
	}
	return $lockstatus;
}

function nicru_SaveRegistrarLock($params) {
	error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
	if ($params["lockenabled"]) {
		$lockstatus="locked";
	} else {
		$lockstatus="unlocked";
	}
	# Put your code to save the registrar lock here
	# If error, return the error message in the value below
	$values["error"] = $Enom->Values["Err1"];
	return $values;
}

function nicru_GetEmailForwarding($params) {
	error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
	# Put your code to get email forwarding here - the result should be an array of prefixes and forward to emails (max 10)
	foreach ($result AS $value) {
		$values[$counter]["prefix"] = $value["prefix"];
		$values[$counter]["forwardto"] = $value["forwardto"];
	}
	return $values;
}

function nicru_SaveEmailForwarding($params) {
	error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
	foreach ($params["prefix"] AS $key=>$value) {
		$forwardarray[$key]["prefix"] =  $params["prefix"][$key];
		$forwardarray[$key]["forwardto"] =  $params["forwardto"][$key];
	}
	# Put your code to save email forwarders here
}

function nicru_GetDNS($params) {
	error_log(" ". __METHOD__." ", 0);
    $username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
    # Put your code here to get the current DNS settings - the result should be an array of hostname, record type, and address
    $hostrecords = array();
    $hostrecords[] = array( "hostname" => "ns1", "type" => "A", "address" => "192.168.0.1", );
    $hostrecords[] = array( "hostname" => "ns2", "type" => "A", "address" => "192.168.0.2", );
	return $hostrecords;

}

function nicru_SaveDNS($params) {
    $username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
    # Loop through the submitted records
	foreach ($params["dnsrecords"] AS $key=>$values) {
		$hostname = $values["hostname"];
		$type = $values["type"];
		$address = $values["address"];
		# Add your code to update the record here
	}
    # If error, return the error message in the value below
	$values["error"] = $Enom->Values["Err1"];
	return $values;
}


function nicru_TransferDomain($params) {
	error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
	$regperiod = $params["regperiod"];
	$transfersecret = $params["transfersecret"];
	$nameserver1 = $params["ns1"];
	$nameserver2 = $params["ns2"];
	# Registrant Details
	$RegistrantFirstName = $params["firstname"];
	$RegistrantLastName = $params["lastname"];
	$RegistrantAddress1 = $params["address1"];
	$RegistrantAddress2 = $params["address2"];
	$RegistrantCity = $params["city"];
	$RegistrantStateProvince = $params["state"];
	$RegistrantPostalCode = $params["postcode"];
	$RegistrantCountry = $params["country"];
	$RegistrantEmailAddress = $params["email"];
	$RegistrantPhone = $params["phonenumber"];
	# Admin Details
	$AdminFirstName = $params["adminfirstname"];
	$AdminLastName = $params["adminlastname"];
	$AdminAddress1 = $params["adminaddress1"];
	$AdminAddress2 = $params["adminaddress2"];
	$AdminCity = $params["admincity"];
	$AdminStateProvince = $params["adminstate"];
	$AdminPostalCode = $params["adminpostcode"];
	$AdminCountry = $params["admincountry"];
	$AdminEmailAddress = $params["adminemail"];
	$AdminPhone = $params["adminphonenumber"];
	# Put your code to transfer domain here
	# If error, return the error message in the value below
	$values["error"] = $error;
	return $values;
}


function nicru_GetContactDetails($params) {
	error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
	# Put your code to get WHOIS data here
	# Data should be returned in an array as follows
	$values["Registrant"]["First Name"] = $firstname;
	$values["Registrant"]["Last Name"] = $lastname;
	$values["Admin"]["First Name"] = $adminfirstname;
	$values["Admin"]["Last Name"] = $adminlastname;
	$values["Tech"]["First Name"] = $techfirstname;
	$values["Tech"]["Last Name"] = $techlastname;
	return $values;
}

function nicru_SaveContactDetails($params) {
	error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
	# Data is returned as specified in the GetContactDetails() function
	$firstname = $params["contactdetails"]["Registrant"]["First Name"];
	$lastname = $params["contactdetails"]["Registrant"]["Last Name"];
	$adminfirstname = $params["contactdetails"]["Admin"]["First Name"];
	$adminlastname = $params["contactdetails"]["Admin"]["Last Name"];
	$techfirstname = $params["contactdetails"]["Tech"]["First Name"];
	$techlastname = $params["contactdetails"]["Tech"]["Last Name"];
	# Put your code to save new WHOIS data here
	# If error, return the error message in the value below
	$values["error"] = $error;
	return $values;
}

function nicru_GetEPPCode($params) {
    error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
    # Put your code to request the EPP code here - if the API returns it, pass back as below - otherwise return no value and it will assume code is emailed
    $values["eppcode"] = $eppcode;
    # If error, return the error message in the value below
    $values["error"] = $error;
    return $values;
}

function nicru_RegisterNameserver($params) {
    error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
    $nameserver = $params["nameserver"];
    $ipaddress = $params["ipaddress"];
    # Put your code to register the nameserver here
    # If error, return the error message in the value below
    $values["error"] = $error;
    return $values;
}

function nicru_ModifyNameserver($params) {
    error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
    $nameserver = $params["nameserver"];
    $currentipaddress = $params["currentipaddress"];
    $newipaddress = $params["newipaddress"];
    # Put your code to update the nameserver here
    # If error, return the error message in the value below
    $values["error"] = $error;
    return $values;
}

function nicru_DeleteNameserver($params) {
    error_log(" ". __METHOD__." ", 0);
	$username = $params["Username"];
	$password = $params["Password"];
	$testmode = $params["TestMode"];
	$tld = $params["tld"];
	$sld = $params["sld"];
    $nameserver = $params["nameserver"];
    # Put your code to delete the nameserver here
    # If error, return the error message in the value below
    $values["error"] = $error;
    return $values;
}
*/
/**
 * функция превода текста с кириллицы в траскрипт
 */
function translitIt($str) {
	$tr = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
        "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"
	);
    	return strtr($str,$tr);
}
/**
 * Положим NicId в базу в customfields1
 */
function insertNicIdToDb($sNicId){
	//TODO: А стоит ли?
}
?>