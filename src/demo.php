<?php
include_once("class/cNic.php");
include_once("class/cClientLogin.php");

$url = "https://www.nic.ru/dns/dealer";
$user = "370/NIC-REG/adm";
$pass = "dogovor";
$aCreatedNIC = array();

$client = cClientLogin::getHttpClient($user, $pass, $url);
$service = new cNic($client);
/*
$query = $service->redeleg_online_lose();
$query = $service->redeleg_online_gain();
$query = $service->order_pickup_domain_ru_su();
$query = $service->domain_net_com();
*/

/**
 * Создание анкеты клиента
 */
echo "=>CreateOrg start\n";
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
echo "\tlogin Org: ".$data->login."\n";
$aCreatedNIC[] = $data->login;
unset($data);
unset($query);
echo "CreateOrg  end\n\n";

/**
 * Тест на создание анкеты клиента для индивидуального предпринимателя (ИП)
 */
echo "=>CreatePbul start\n";
$query = $service->newcContract();
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
echo "\tlogin Pbul: ".$data->login."\n";
$aCreatedNIC[] = $data->login;
unset($data);
unset($query);
echo "CreatePbul end\n\n";

/**
 * тест на создание анкеты клиента для физического лица
 */
echo "=>CreatePrs\n";
$query = $service->newcContract();
$aData = array();
$aData['password']="123password123";
$aData['tech-password']="123techpassword123";
$aData['person']="Sidor S Sidorov";
$aData['person-r']="ИП Сидоров Сидор Сидорович";
$aData['country']="RU";
$aData['currency-id']="RUR";
$aData['passport']="XXX-AB 123456 выдан 123 отделением милиции г.Москвы, 30.01.1990 зарегистрирован по адресу: Москва, ул.Кошкина, д.15, кв.4";
$aData['birth-date']="11.11.1965";
$aData['p-addr']="123456, Москва, ул.Кошкина, д.15, кв.4 Сидорову Сидору Сидоровичу";
$aData['phone']="+7 495 1234567";
$aData['fax-no']="+7 495 1234560";
$aData['e-mail']="finster.seele@gmail.com";
$aData['mnt-nfy']="alexk@sl.ru";

$query->CreatePrs($aData);
$data = $service->getNicQuery($query);
echo "\tlogin Prs: ".$data->login."\n";
$aCreatedNIC[] = $data->login;
unset($data);
unset($query);
echo "CreatePrs end\n\n";

/**
 * Тест на поиск анкет клиентов
 */
echo "=>Contract Search start\n";
$query = $service->newcContract();
$aData = array();
$aData['contracts-limit'] = "10";
$aData['contracts-first'] = "1";

$aData['contract-num'] = $aCreatedNIC[0];
//$aData['e-mail'] = "finster.seele@gmail.com";
//$aData['domain'] = "yandex.ru";
//$aData['identity'] = "identified";
//$aData['is-resident'] = "YES";

//$aData['org'] = "Sony";
//$aData['org-r'] = "Сони";
//$aData['code'] = "500100732259";

//$aData['person'] = "Sidorov";
//$aData['person-r'] = "Иван";
//$aData['passport'] = "123456";

$query->Search($aData);
$data = $service->getNicQuery($query);
echo "\tcontracts-found ".$data->GetContractsTotal()."\r\n";
echo "\tcontracts-limit: ".$data->GetContractsLimit()."\r\n";
foreach ($data->entries as $entry) {
	foreach ($entry->aGetData() as $key => $name){
		echo "\t".$key.":".$name."\n";
	}
}
unset($data);
unset($query);
echo "Contract Search end\n\n";

/*
 * Получение данных из анкеты клиента
 */
echo "=>Get Contract Data start\n";
$query = $service->newcContract();
$query->Get($aCreatedNIC[0]);
$data = $service->getNicQuery($query);
$oContactEntry = $data->current();
foreach ($oContactEntry->aGetData() as $key => $name){
	echo "\t".$key.":".$name."\n";
}
echo "Get Contract Data end\n\n";
unset($oContactEntry);
unset($data);
unset($query);

/*
$query = $service->contract_update_org();
$query = $service->contract_update_pbul();
$query = $service->contract_update_prs();

$query = $service->contract_id();
*/



/*
 * Удаление анкеты клиента удаление анкеты
*/
echo "=>Delete Contract Data start\n";
$query = $service->newcContract();
$query->Delete($aCreatedNIC[0]);
try {
	$data = $service->getNicQuery($query);
} catch (Exception $e) {
    echo "\tCaught exception: ",  $e->getMessage(), "\n";
}
echo "Delete Contract Data end\n";


/*
echo "=>Search Services\n";
$query = $service->objects_search();
$query = $service->services_search();
$query = $service->domain_search();
*/

/*
 * Заказ на регистрацию домена в доменах RU, РФ или SU
 */
echo "=>Order New Domain\n";
$query = $service->newcDomain();
$aData = array();
$aData['subject-contract'] = $aCreatedNIC[0];
$aData['domain'] = "test".date("YmdHis").".ru";
//$aData['domain'] = "test.su";
$aData['descr'] = "Domain for test purpose";
$aData['e-mail'] = "finster.seele@gmail.com";
$aData['phone'] = "+7 495 1234567";
$aData['fax-no'] = "+7 495 1234568";
// TODO: Чойта ns не принимаются
$aData['nserver'][] = "ns1.sl.ru";
$aData['nserver'][] = "ns4.sl.ru";

$query->Order($aData);
$data = $service->getNicQuery($query);
$oDomainEntry = $data->current();
foreach ($oDomainEntry->aGetData() as $key => $name){
	echo "\t".$key.":".$name."\n";
}
$iOrderId = $oDomainEntry->order_id;
unset($oDomainEntry);
unset($data);
unset($query);



/*
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
*/


/*
 * 
 *$query = $service->services_prolong();
$query = $service->order_prolong();
*/
/*
 * Получение данных о заказах
 */
/*
 * поиск сделанных заказов
 */
echo "=>Order Search start\n";
$query = $service->newcOrder();
$aData = array();
$aData['subject-contract'] = "1167161/NIC-D";
$aData['order_id']=$iOrderId;
//$aData['submitted']="";
//$aData['total']="";
//$aData['state']="";
//$aData['domain']="";
//$aData['service']="";
//$aData['orders-limit']="";
//$aData['orders-first']=""; 
$query->Search($aData);
$data = $service->getNicQuery($query);
echo "\tGetOrdersLimit: ".$data->GetOrdersLimit()."\n";
echo "\tGetOrdersFound: ".$data->GetOrdersFound()."\n";
echo "\tGetOrdersFirst: ".$data->GetOrdersFirst()."\n\n";
foreach ($data->entries as $entry) {
	foreach ($entry->aGetData() as $key => $name){
		echo "\t".$key.":".$name."\n";
	}
}
unset($data);
unset($query);
echo "Order Search end\n";

/*
 * получение информации о заказе
 */ 
echo "=>Order Get start\n";
$query = $service->newcOrder();
$query->Get($iOrderId);
$data = $service->getNicQuery($query);
foreach ($data->entries as $entry) {
	foreach ($entry->aGetData() as $key => $name){
		echo "\t".$key.":".$name."\n";
	}
}

$oOrderItem = $data->GetOrderItem();
echo "\n\n\tOrderItem dump\n";
foreach ($oOrderItem->aGetData() as $key => $name){
		echo "\t".$key.":".$name."\n";
}
unset($data);
unset($query);
echo "Order Get end\n";

/*
 * удаление заказа
 */
echo "=>Order Delete start\n";
$query = $service->newcOrder();
$query->Delete($iOrderId);
try{
	$data = $service->getNicQuery($query);
} catch (Exception $e) {
    echo "\tCaught exception: ",  $e->getMessage(), "\n";
}
unset($data);
unset($query);
echo "=>Order Delete end\n";
/*
 * Баланс личного счета получении информации о балансе
 */
echo "=>Get Account start\n";
$query = $service->newcAccount();
$query->Get();
$data = $service->getNicQuery($query);
$oAccountEntry = $data->current();
foreach ($oAccountEntry->aGetData() as $key => $name){
		echo "\t".$key.":".$name."\n";
}
unset($oAccountEntry);
unset($data);
unset($query);
echo "Get Account end\n\n";
?>