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

$query->CreateOrg();
$data = $service->getNicQuery($query);
foreach ($data->entries as $entry) {
	echo "login Org: ".$entry->login."\n";
}

$query->CreatePbul();
$data = $service->getNicQuery($query);
foreach ($data->entries as $entry) {
	echo "login Pbul: ".$entry->login."\n";
}

$query->CreatePrs();
$data = $service->getNicQuery($query);
foreach ($data->entries as $entry) {
	echo "login Prs: ".$entry->login."\n";
}

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