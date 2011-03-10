<?php
include_once("class/cNic.php");
include_once("class/cClientLogin.php");

$url = "https://www.nic.ru/dns/dealer";
$user = "370/NIC-REG/adm";
$pass = "dogovor";

$client = cClientLogin::getHttpClient($user, $pass, $url);
$service = new cNic($client);
/*
$query = $service->redeleg_online_lose();
$query = $service->redeleg_online_gain();
$query = $service->order_pickup_domain_ru_su();
$query = $service->domain_net_com();
*/
$query = $service->newcContract();

$aData = array();
$aData['password']="123password123";
$aData['tech-password']="123techpassword123";
$aData['org']="Joint Stock Company";
$aData['org-r']="Закрытое Акционерное Общество";
$aData['code']="1234567894";
$aData['kpp']="123456789";
$aData['country']="RU";
$aData['currency-id']="RUR";
$aData['address-r']="123456, Москва, ул. Йобачкина, д.13а";
$aData['p-addr']="123456, Москва, ул. Йобачкина, д.13а";
$aData['d-addr']="123456, Москва, ул. Йобачкина, д.13а";
$aData['phone']="+7 495 1234567";
$aData['fax-no']="+7 495 1234567";
$aData['e-mail']="finster.seele@gmail.com"; 
$aData['mnt-nfy']="alexk@sl.ru"; 

$query->CreateOrg($aData);
$data = $service->getNicQuery($query);
foreach ($data->entries as $entry) {
	echo "login Org: ".$entry->login."\n";
}

$aData = array();
$aData['password']="123password123";
$aData['code']="500100732259";
$aData['tech-password']="123techpassword123";
$aData['person']="Sidor S Sidorov";
$aData['person-r']="ИП Сидоров Сидор Сидорович";
$aData['country']="RU";
$aData['currency-id']="RUR";
$aData['passport']="XXX-AB 123456 выдан 123 отделением милиции г.Москвы, 30.01.1990 зарегистрирован по адресу: Москва, ул.Кошкина, д.15, кв.4";
$aData['address-r']="123456 Москва, ул.Собачкина, д.13а, кв.78";
$aData['birth-date']="11.11.1965";
$aData['p-addr']="123456, Москва, ул.Кошкина, д.15, кв.4 Сидорову Сидору Сидоровичу";
$aData['d-addr']="123456, Москва, ул.Кошкина, д.15, кв.4 ";
$aData['phone']="+7 495 1234567";
$aData['fax-no']="+7 495 1234560";
$aData['e-mail']="finster.seele@gmail.com";
$aData['mnt-nfy']="alexk@sl.ru";

$query->CreatePbul($aData);
$data = $service->getNicQuery($query);
foreach ($data->entries as $entry) {
	echo "login Pbul: ".$entry->login."\n";
}



$query->CreatePrs();
$data = $service->getNicQuery($query);
foreach ($data->entries as $entry) {
	echo "login Prs: ".$entry->login."\n";
}

die("not yet!"); 


$query->Search();
$data = $service->getNicQuery($query);

$query->Get();
$data = $service->getNicQuery($query);

$query = $service->contract_update_org();
$query = $service->contract_update_pbul();
$query = $service->contract_update_prs();

$query = $service->contract_id();
$query = $service->contract_delete();
/*
$query = $service->objects_search();
$query = $service->services_search();
$query = $service->domain_search();
$query = $service->order_new_domain_ru(); 
$query = $service->order_new_domain_su();
$query = $service->order_new_domain_geo();
$query = $service->domain_net_com();
$query = $service->back_order_domain();
$query = $service->order_new_mobilizer();
$query = $service->order_new_domain_name();
$query = $service->order_new_primary_auto();
$query = $service->order_new_primary_standard(); 
$query = $service->order_new_secondary(); 
$query = $service->order_new_domain_redirection(); 
$query = $service->order_new_mailforwarding(); 
$query = $service->order_new_hosting();
$query = $service->order_update_domain_ru();
$query = $service->order_update_domain_su();
$query = $service->order_update_domain_geo();
$query = $service->order_update_primary_standard();
$query = $service->order_update_secondary(); 
$query = $service->order_update_webforwarding();
$query = $service->order_update_domain_redirection(); 
$query = $service->order_update_mailforwarding(); 
$query = $service->order_update_hosting();
$query = $service->order_upgrade_hosting();
$query = $service->services_prolong();
$query = $service->order_prolong();
$query = $service->orders_search(); 
$query = $service->orders_get();
$query = $service->order_delete();
*/

$query = $service->newcAccount();
$query->Get();
$data = $service->getNicQuery($query);
foreach ($data->entries as $entry) {
	echo "payments: ".$entry->payments."\n";
	echo "blockable: ".$entry->blockable."\n";
}

?>