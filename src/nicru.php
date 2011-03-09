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

function nicru_getConfigArray() {
	$configarray = array ("Username" => array ("Type" => "text", "Size" => "20", "Description" => "Enter your username here" ), "Password" => array ("Type" => "password", "Size" => "20", "Description" => "Enter your password here" ), "TestMode" => array ("Type" => "yesno" ) );
	return $configarray;
} // nicru_getConfigArray

function nicru_GetNameservers($params) {
	echo "GetNameservers";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	//	# Put your code to get the nameservers here and return the values below
	$values ["ns1"] = $nameserver1;
	$values ["ns2"] = $nameserver2;
	$values ["ns3"] = $nameserver3;
	$values ["ns4"] = $nameserver4;
	//	# If error, return the error message in the value below
	$values ["error"] = $error;
	return $values;
} //nicru_GetNameservers

function nicru_SaveNameservers($params) {
	echo "SaveNameservers";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	$nameserver1 = $params ["ns1"];
	$nameserver2 = $params ["ns2"];
	$nameserver3 = $params ["ns3"];
	$nameserver4 = $params ["ns4"];
	# Put your code to save the nameservers here
	# If error, return the error message in the value below
	$values ["error"] = $error;
	return $values;
} // nicru_SaveNameservers

function nicru_GetRegistrarLock($params) {
	echo "GetRegistrarLock";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	# Put your code to get the lock status here
	if ($lock == "1") {
		$lockstatus = "locked";
	} else {
		$lockstatus = "unlocked";
	}
	return $lockstatus;
} // nicru_GetRegistrarLock

function nicru_SaveRegistrarLock($params) {
	echo "SaveRegistrarLock";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	if ($params ["lockenabled"]) {
		$lockstatus = "locked";
	} else {
		$lockstatus = "unlocked";
	}
	# Put your code to save the registrar lock here
	# If error, return the error message in the value below
	$values ["error"] = $Enom->Values ["Err1"];
	return $values;
} // nicru_SaveRegistrarLock

function nicru_GetEmailForwarding($params) {
	echo "GetEmailForwarding";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	# Put your code to get email forwarding here - the result should be an array of prefixes and forward to emails (max 10)
	foreach ( $result as $value ) {
		$values [$counter] ["prefix"] = $value ["prefix"];
		$values [$counter] ["forwardto"] = $value ["forwardto"];
	}
	return $values;
} // nicru_GetEmailForwarding

function nicru_SaveEmailForwarding($params) {
	echo "SaveEmailForwarding";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	foreach ( $params ["prefix"] as $key => $value ) {
		$forwardarray [$key] ["prefix"] = $params ["prefix"] [$key];
		$forwardarray [$key] ["forwardto"] = $params ["forwardto"] [$key];
	}
	# Put your code to save email forwarders here
} // nicru_SaveEmailForwarding

function nicru_GetDNS($params) {
	echo "GetDNS";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	# Put your code here to get the current DNS settings - the result should be an array of hostname, record type, and address
	$hostrecords = array ();
	$hostrecords [] = array ("hostname" => "ns1", "type" => "A", "address" => "192.168.0.1" );
	$hostrecords [] = array ("hostname" => "ns2", "type" => "A", "address" => "192.168.0.2" );
	return $hostrecords;
} // nicru_GetDNS

function nicru_SaveDNS($params) {
	echo "SaveDNS";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	# Loop through the submitted records
	foreach ( $params ["dnsrecords"] as $key => $values ) {
		$hostname = $values ["hostname"];
		$type = $values ["type"];
		$address = $values ["address"];
		# Add your code to update the record here
	}
	# If error, return the error message in the value below
	$values ["error"] = $Enom->Values ["Err1"];
	return $values;
} // nicru_SaveDNS

function nicru_RegisterDomain($params) {
	
	require("/var/www/virtual/cp.sl.ru/htdocs/configuration.php");
	require_once "HTTP/Request.php";
	include_once("/var/www/virtual/cp.sl.ru/htdocs/modules/servers/ispmanager/xml2array.php");


//$_sSql="select  type, registrationdate, domain  from tbldomains where registrationdate = curdate();";
//$_sSql = "select  type, registrationdate, dom.domain, hosting.username from tbldomains as dom LEFT JOIN tblhosting as hosting USING(userid) where registrationdate = curdate();";
$_sSql = "SELECT * FROM whmcs.tblclients WHERE id='4'";
require_once 'MDB2.php';

echo "mysql://".$db_username.":".$db_password."@".$db_host."/".$db_name;

$mdb2 =& MDB2::connect("mysql://".$db_username.":".$db_password."@".$db_host."/".$db_name);
if (PEAR::isError($mdb2)) {
    die($mdb2->getMessage());
}

#$mdb2->query("set names 'utf8'");
$res =& $mdb2->query($_sSql);

if (PEAR::isError($res)) {
    die($res->getMessage());
}



while (($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC))) {


//<---->nCreateDNS($row["domain"], $row["username"]);
//<---->sleep(5);
    var_dump($row);
}



if (PEAR::isError($res)) {
    die($res->getMessage());
}

$mdb2->disconnect();
	
	
	
	//setlocale(LC_ALL, "ru_RU.UTF8");
	var_dump(setlocale(LC_ALL,0));
	var_dump(iconv('UTF-8', 'UTF-8//TRANSLIT',$params ["firstname"]));
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	$regperiod = $params ["regperiod"];
	$nameserver1 = $params ["ns1"];
	$nameserver2 = $params ["ns2"];
	$nameserver3 = $params ["ns3"];
	$nameserver4 = $params ["ns4"];
	# Registrant Details
	$RegistrantFirstName = $params ["firstname"];
	$RegistrantLastName = $params ["lastname"];
	$RegistrantAddress1 = $params ["address1"];
	$RegistrantAddress2 = $params ["address2"];
	$RegistrantCity = $params ["city"];
	$RegistrantStateProvince = $params ["state"];
	$RegistrantPostalCode = $params ["postcode"];
	$RegistrantCountry = $params ["country"];
	$RegistrantEmailAddress = $params ["email"];
	$RegistrantPhone = $params ["phonenumber"];
	# Admin Details
	$AdminFirstName = $params ["adminfirstname"];
	$AdminLastName = $params ["adminlastname"];
	$AdminAddress1 = $params ["adminaddress1"];
	$AdminAddress2 = $params ["adminaddress2"];
	$AdminCity = $params ["admincity"];
	$AdminStateProvince = $params ["adminstate"];
	$AdminPostalCode = $params ["adminpostcode"];
	$AdminCountry = $params ["admincountry"];
	$AdminEmailAddress = $params ["adminemail"];
	$AdminPhone = $params ["adminphonenumber"];
	die(var_dump($params));
//	1) ѕоиск анкеты
//  2) ≈сли нет создать анкету	
// 2.1) ≈сли есть то получить 
	# Put your code to register domain here
	# If error, return the error message in the value below
	$values ["error"] = $error;
	die("RegisterDomain");
	return $values;
} // nicru_RegisterDomain

function nicru_TransferDomain($params) {
	echo "TransferDomain";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	$regperiod = $params ["regperiod"];
	$transfersecret = $params ["transfersecret"];
	$nameserver1 = $params ["ns1"];
	$nameserver2 = $params ["ns2"];
	# Registrant Details
	$RegistrantFirstName = $params ["firstname"];
	$RegistrantLastName = $params ["lastname"];
	$RegistrantAddress1 = $params ["address1"];
	$RegistrantAddress2 = $params ["address2"];
	$RegistrantCity = $params ["city"];
	$RegistrantStateProvince = $params ["state"];
	$RegistrantPostalCode = $params ["postcode"];
	$RegistrantCountry = $params ["country"];
	$RegistrantEmailAddress = $params ["email"];
	$RegistrantPhone = $params ["phonenumber"];
	# Admin Details
	$AdminFirstName = $params ["adminfirstname"];
	$AdminLastName = $params ["adminlastname"];
	$AdminAddress1 = $params ["adminaddress1"];
	$AdminAddress2 = $params ["adminaddress2"];
	$AdminCity = $params ["admincity"];
	$AdminStateProvince = $params ["adminstate"];
	$AdminPostalCode = $params ["adminpostcode"];
	$AdminCountry = $params ["admincountry"];
	$AdminEmailAddress = $params ["adminemail"];
	$AdminPhone = $params ["adminphonenumber"];
	# Put your code to transfer domain here
	# If error, return the error message in the value below
	$values ["error"] = $error;
	return $values;
} //nicru_TransferDomain

function nicru_RenewDomain($params) {
	echo "RenewDomain";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	$regperiod = $params ["regperiod"];
	# Put your code to renew domain here
	# If error, return the error message in the value below
	$values ["error"] = $error;
	return $values;
} //nicru_RenewDomain

function nicru_GetContactDetails($params) {
	echo "GetContactDetails";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	# Put your code to get WHOIS data here
	# Data should be returned in an array as follows
	$values ["Registrant"] ["First Name"] = $firstname;
	$values ["Registrant"] ["Last Name"] = $lastname;
	$values ["Admin"] ["First Name"] = $adminfirstname;
	$values ["Admin"] ["Last Name"] = $adminlastname;
	$values ["Tech"] ["First Name"] = $techfirstname;
	$values ["Tech"] ["Last Name"] = $techlastname;
	return $values;
} //nicru_GetContactDetails

function nicru_SaveContactDetails($params) {
	echo "SaveContactDetails";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	# Data is returned as specified in the GetContactDetails() function
	$firstname = $params ["contactdetails"] ["Registrant"] ["First Name"];
	$lastname = $params ["contactdetails"] ["Registrant"] ["Last Name"];
	$adminfirstname = $params ["contactdetails"] ["Admin"] ["First Name"];
	$adminlastname = $params ["contactdetails"] ["Admin"] ["Last Name"];
	$techfirstname = $params ["contactdetails"] ["Tech"] ["First Name"];
	$techlastname = $params ["contactdetails"] ["Tech"] ["Last Name"];
	# Put your code to save new WHOIS data here
	# If error, return the error message in the value below
	$values ["error"] = $error;
	return $values;
} //nicru_SaveContactDetails

function nicru_GetEPPCode($params) {
	echo "GetEPPCode";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	# Put your code to request the EPP code here - if the API returns it, pass back as below - otherwise return no value and it will assume code is emailed
	$values ["eppcode"] = $eppcode;
	# If error, return the error message in the value below
	$values ["error"] = $error;
	return $values;
} //nicru_GetEPPCode

function nicru_RegisterNameserver($params) {
	echo "RegisterNameserver";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	$nameserver = $params ["nameserver"];
	$ipaddress = $params ["ipaddress"];
	# Put your code to register the nameserver here
	# If error, return the error message in the value below
	$values ["error"] = $error;
	return $values;
} // nicru_RegisterNameserver

function nicru_ModifyNameserver($params) {
	echo "ModifyNameserver";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	$nameserver = $params ["nameserver"];
	$currentipaddress = $params ["currentipaddress"];
	$newipaddress = $params ["newipaddress"];
	# Put your code to update the nameserver here
	# If error, return the error message in the value below
	$values ["error"] = $error;
	return $values;
} // nicru_ModifyNameserver

function nicru_DeleteNameserver($params) {
	echo "DeleteNameserver";
	$username = $params ["Username"];
	$password = $params ["Password"];
	$testmode = $params ["TestMode"];
	$tld = $params ["tld"];
	$sld = $params ["sld"];
	$nameserver = $params ["nameserver"];
	# Put your code to delete the nameserver here
	# If error, return the error message in the value below
	$values ["error"] = $error;
	return $values;
} // nicru_DeleteNameserver

?>
