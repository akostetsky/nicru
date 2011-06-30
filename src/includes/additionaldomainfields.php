<?php

/*
******************************************
***** WHMCS DOMAIN ADDITIONAL FIELDS *****
******************************************
This file defines the additional fields of
data that need to be collected for certain
TLDs.
******************************************
******************************************
*/


## RU & SU DOMAINS REQUIREMENTS ##

$additionaldomainfields[".ru"][] = array(
"Name" => "<b>Данные регистратора доменного имени</b>",
"Type" => "",
"Size" => "0",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".ru"][] = array(
"Name" => "<span style=display:none>descr</span><br />Описание домена по-английски",
"Type" => "text",
"Size" => "50",
"Default" => "project",
"Required" => false,
);

$additionaldomainfields[".ru"][] = array(
"Name" => "<span style=display:none>reg_to</span><br />Регистрировать домен на",
"Type" => "dropdown",
"Options" => "Частное лицо(Physical person),Организацию(Organization)",
"Required" => true,
);

$additionaldomainfields[".ru"][] = array(
"Name" => "<span style=display:none>private_person</span><br />Использовать Private person ?",
"Type" => "dropdown",
"Options" => "No,Yes",
"Required" => false,
);

$additionaldomainfields[".ru"][] = array(
"Name" => "<span style=display:none>person_r</span><br />Фамилия, имя, отчество по-русски<br /><font size=1><i>Пример: Сидоров Иван Сидорович</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".ru"][] = array(
"Name" => "<span style=display:none>residence</span>Почтовый адрес.<br />Если у Вас нет номера квартиры, тогда после номера дома Вы должны указать частный дом.<br /><font size=1><i>Пример: 123456, г.Москва, ул.Кошкина, д.15, кв.4</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".ru"][] = array(
"Name" => "<span style=display:none>passport</span>Паспортные данные.<br /><font size=1><i>Пример: 31 02 651241 выдан 48 о/м г.Москвы 26.12.1990</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,

);
$additionaldomainfields[".ru"][] = array(
"Name" =>"<span style=display:none>birth_date</span>Дата рождения<br><font size=1><i>Пример: 07.11.1917</i></font>",
"Type" => "text",
"Size" => "50",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".ru"][] = array(
"Name" => "<span style=display:none>phone</span>Телефон<br /><font size=1><i>Пример: +7 095 8102233</i></font>",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".ru"][] = array(
"Name" => "<span style=display:none>fax</span>Факс<br /><font size=1><i>Пример: +7 095 8102233</i></font>",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".ru"][] = array(
"Name" => "<span style=display:none>code</span>ИНН. Поле заполняется только в случае, если Администратор домена выступает в качестве ИП или организации<br><font size=1><i>Пример: 7701107259</i></font>",
"Type" => "text",
"Size" => "50",
"Default" => "",
"Required" => false,
);


$additionaldomainfields[".ru"][] = array(
	"Name" =>"<span style=display:none>org_r</span>Полное название организации на русском.<br><font size=1><i>Закрытое Акционерное Общество Новое время</i></font>",
	"Type" => "text",
	"Size" => "50",
	"Default" => "",
	"Required" => false,
	);

$additionaldomainfields[".ru"][] = array(
	"Name" =>"<span style=display:none>kpp</span>КПП организации (для Российских организаций). Необязательное поле.<br><i>при регистрации на организацию</i><br><font size=1><i>632946014</i></font>",
	"Type" => "text",
	"Size" => "50",
	"Default" => "",
	"Required" => false,
	);

	$additionaldomainfields[".ru"][] = array(
	"Name" =>"<span style=display:none>address_r</span>Юридический адрес организации в соответствии с учредительными документами.<br><i>при регистрации на организацию</i><br><font size=1><i>101000, Москва, ул.Пупкина, 1, стр. 2</i></font>",
	"Type" => "text",
	"Size" => "50",
	"Default" => "",
	"Required" => false,
	);

$additionaldomainfields[".su"] = $additionaldomainfields[".ru"];
$additionaldomainfields[".test"] = $additionaldomainfields[".su"];

/*
## COM, NET DOMAINS REQUIREMENTS ##


$additionaldomainfields[".com"][] = array(
"Name" => "<b>Данные регистратора доменного имени</b>",
"Type" => "",
"Size" => "0",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".com"][] = array(
"Name" => "<span style=display:none>private_person</span><br />В названии организации - владельца домена указывать Private person?",
"Type" => "dropdown",
"Options" => "No,Yes",
"Required" => false,
);

$additionaldomainfields[".com"][] = array(
"Name" => "<span style=display:none>fax</span>Факс<br /><font size=1><i>Пример: +7 095 8102233</i></font>",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".info"]=$additionaldomainfields[".com"];
$additionaldomainfields[".biz"]=$additionaldomainfields[".com"];
$additionaldomainfields[".mobi"]=$additionaldomainfields[".com"];
$additionaldomainfields[".org"]=$additionaldomainfields[".com"];
$additionaldomainfields[".net"]=$additionaldomainfields[".com"];
*/

## .KZ, .UZ, .TJ DOMAINS REQUIREMENTS ##


$additionaldomainfields[".uz"][] = array(
"Name" => "<b>Данные регистратора доменного имени</b>",
"Type" => "",
"Size" => "0",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>person_r</span><br />Фамилия, имя по-русски<br /><font size=1><i>Пример: Сидоров Иван</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_nick</span><br />Идентификатор контакта (цифры и латинские символы)",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);



$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_phone</span><br>Телефон<br><font size=1><i>Пример: +7 095 8102233</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);


$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_fax</span>Факс<br /><font size=1><i>Пример: +7 095 8102233</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);





$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_addr</span>Адрес владельца домена: улица, дом, офис (квартира). Поле заполняется по-русски. Если у Вас нет номера квартиры, укажите частный дом.<font size=1><i>Пример: ул.Кошкина, д.15, кв.4</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_city</span><br />Адрес владельца домена: город. Поле заполняется по-русски.<br /><font size=1><i>Пример: Москва</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);



$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_state</span><br />Адрес владельца домена: область/край/штат. Поле заполняется по-русски. Необязательное поле.",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_postcode</span><br />Почтовый индекс владельца домена.",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);


$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_company</span><br />Полное название организации на русском (при регистрации домена на юридическое лицо).<br><font size=1><i>Закрытое Акционерное Общество Новое время</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);



$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_code</span><br />ИНН(при регистрации домена на юридическое лицо)",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);


$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_bank</span><br />Наименование банка(при регистрации домена на юридическое лицо)",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_bank_account</span><br />Номер расчётного счёта(при регистрации домена на юридическое лицо)",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_mfo</span><br />МФО (БИК)(при регистрации домена на юридическое лицо)",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".uz"][] = array(
"Name" => "<span style=display:none>o_okonh</span><br />ОКОНХ(при регистрации домена на юридическое лицо)",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".tj"]=$additionaldomainfields[".uz"];




##  .ASIA DOMAINS REQUIREMENTS ##



$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_first_name</span><br />Имя контактного лица",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_last_name</span><br />Фамилия контактного лица",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_company</span><br />Название организации - владельца домена. Указывать Private person в случае, если владельцем является частное лицо.",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_phone</span>Телефон<br /><font size=1><i>Пример: +7 095 8102233</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_fax</span>Факс<br /><font size=1><i>Пример: +7 095 8102233</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_addr</span>Aдрес администратора домена на русском языке(улица, дом, офис (квартира))",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_city</span>Aдрес администратора домена на русском языке(город).",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_state</span>Адрес владельца домена: область/край/штат. Необязательное поле",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_postcode</span>Почтовый индекс владельца домена",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);



$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>default_ced</span><br />Использовать CED-контакт ООО Регтайм (в этом случае все остальные поля этой секции опускаются)?",
"Type" => "dropdown",
"Options" => "Yes,No",
"Required" => false,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_cclocality</span>Код страны из Азиатско-Тихоокеанского региона, где зарегистрирован CED-контакт",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_entity_type</span>Тип CED-контакта",
"Type" => "dropdown",
"Options" => "naturalPerson,corporation,cooperative,partnership,government,politicalParty,society,institution,other",
"Required" => true,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_ident_form</span>Форма идентификации",
"Type" => "dropdown",
"Options" => "passport,certificate,legislation,societiesRegistry,politicalPartyRegistry,other",
"Required" => true,
);

$additionaldomainfields[".asia"][] = array(
"Name" => "<span style=display:none>asia_ident_number</span>Идентификационный номер",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);




## OTHER DOMAINS REQUIREMENTS ##





$additionaldomainfields[".be"][] = array(
"Name" => "<span style=display:none>be_first_name</span><br />Имя контактного лица",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".be"][] = array(
"Name" => "<span style=display:none>be_last_name</span><br />Фамилия контактного лица",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".be"][] = array(
"Name" => "<span style=display:none>be_company</span><br />Название организации - владельца домена. Указывать Private person в случае, если владельцем является частное лицо.",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".be"][] = array(
"Name" => "<span style=display:none>be_phone</span>Телефон<br /><font size=1><i>Пример: +7 095 8102233</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".be"][] = array(
"Name" => "<span style=display:none>be_fax</span>Факс<br /><font size=1><i>Пример: +7 095 8102233</i></font>",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".be"][] = array(
"Name" => "<span style=display:none>be_addr</span>Aдрес администратора домена на русском языке(улица, дом, офис (квартира))",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".be"][] = array(
"Name" => "<span style=display:none>be_city</span>Aдрес администратора домена на русском языке(город).",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".be"][] = array(
"Name" => "<span style=display:none>be_state</span>Адрес владельца домена: область/край/штат. Необязательное поле",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".be"][] = array(
"Name" => "<span style=display:none>be_postcode</span>Почтовый индекс владельца домена",
"Type" => "text",
"Size" => "80",
"Default" => "",
"Required" => true,
);




$additionaldomainfields[".".chr(240).chr(243)]=$additionaldomainfields['.be'];
$additionaldomainfields[".".chr(234).chr(238).chr(236)]=$additionaldomainfields['.be'];
$additionaldomainfields[".".chr(237).chr(229).chr(242)]=$additionaldomainfields['.be'];
$additionaldomainfields['.cc']=$additionaldomainfields['.be'];
$additionaldomainfields['.tv']=$additionaldomainfields['.be'];


//------for edit domine contact -----

    // for ru domines
	$contact_field[e_mail]="<span style=display:none>e_mail</span>e-mail адрес";
    $contact_field[country]="<span style=display:none>country</span>Двухбуквенный ISO-код страны";
    $contact_field[descr]="<span style=display:none>descr</span>Описание домена. Заполняется по-английски.";
    $contact_field[p_addr]="<span style=display:none>p_addr</span>Почтовый адрес администратора домена на русском языке.";
    $contact_field[private_person]="<span style=display:none>private_person</span>Использовать Private person ?<br /><font size=1><i>0-Нет 1-Да</i></font>";
    $contact_field[residence]="<span style=display:none>residence</span>Почтовый адрес. Поле заполняется по-русски. Если у Вас нет номера квартиры, тогда после номера дома Вы должны указать частный дом.<br /><font size=1><i>Пример: 123456, г.Москва, ул.Кошкина, д.15, кв.4</i></font>";
    $contact_field[phone]="<span style=display:none>phone</span>Телефон<br /><font size=1><i>Пример: +7 095 8102233</i></font>";
    $contact_field[fax]="<span style=display:none>fax</span>Факс<br /><font size=1><i>Пример: +7 095 8102233</i></font>";
    $contact_field[org]="<span style=display:none>org</span>* Полное название организации транслитом.<br><font size=1><i>ROGA I KOPYTA</i></font>";
    $contact_field[kpp]="<span style=display:none>kpp</span>КПП организации (для Российских организаций). Необязательное поле.<br><i>при регистрации на организацию</i><br><font size=1><i>632946014</i></font>";

	//for com, net domines
	$contact_field[o_company]="<span style=display:none>o_company</span>Название организации - владельца домена. Указывать Private person в случае, если владельцем является частное лицо.";
	$contact_field[o_first_name]="<span style=display:none>o_first_name</span>Имя контактного лица";
	$contact_field[o_last_name]="<span style=display:none>o_last_name</span>Фамилия контактного лица";
	$contact_field[o_email]="<span style=display:none>o_email</span>Контактный email-адрес владельца домена.";
	$contact_field[o_phone]="<span style=display:none>o_phone</span>Номер телефона владельца домена в международном формате (Пример: +7.4952171179).";
	$contact_field[o_fax]="<span style=display:none>o_fax</span>Номер факса владельца домена в международном формате (Пример: +7.4952171179). Необязательное поле.";
	$contact_field[o_addr]="<span style=display:none>o_addr</span>Адрес владельца домена: улица, дом, офис (квартира)";
	$contact_field[o_city]="<span style=display:none>o_city</span>Адрес владельца домена: город";
	$contact_field[o_state]="<span style=display:none>o_state</span>Адрес владельца домена: область/край/штат. Необязательное поле";
	$contact_field[o_postcode]="<span style=display:none>o_postcode</span>Почтовый индекс владельца домена";
	$contact_field[o_country_code]="<span style=display:none>o_country_code</span>Двухбуквенный ISO-код страны владельца домена.";

    //for kz, tj domine


	$contact_field[tj_name]="<span style=display:none>tj_name</span>Имя и фамилия контактного лица по-русски";
	$contact_field[tj_mail]="<span style=display:none>tj_mail</span>Контактный email-адрес владельца домена.";
	$contact_field[tj_nick]="<span style=display:none>tj_nick</span>Идентификатор контакта (цифры и латинские символы)";
	$contact_field[tj_phone]="<span style=display:none>tj_phone</span>Номер телефона владельца домена в международном формате (Пример: +7.4952171179).";
	$contact_field[tj_fax]="<span style=display:none>tj_fax</span>Номер факса владельца домена в международном формате (Пример: +7.4952171179). Необязательное поле.";
	$contact_field[tj_addr]="<span style=display:none>tj_addr</span>Адрес владельца домена: улица, дом, офис (квартира)";
	$contact_field[tj_city]="<span style=display:none>tj_city</span>Адрес владельца домена: город";
	$contact_field[tj_state]="<span style=display:none>tj_state</span>Адрес владельца домена: область/край/штат. Необязательное поле";
	$contact_field[tj_postcode]="<span style=display:none>tj_postcode</span>Почтовый индекс владельца домена";
	$contact_field[tj_country_code]="<span style=display:none>tj_country_code</span>Двухбуквенный ISO-код страны владельца домена.";

	$contact_field[tj_company]="<span style=display:none>tj_company</span>Название организации - владельца домена - по-русски.";
    $contact_field[tj_code]="<span style=display:none>tj_code</span>ИНН";
    $contact_field[tj_bank]="<span style=display:none>tj_bank</span>Наименование банка";
    $contact_field[tj_bank_account]="<span style=display:none>tj_bank_account</span>Номер расчётного счёта";
	$contact_field[tj_mfo]="<span style=display:none>tj_mfo</span>МФО (БИК)";
	$contact_field[tj_okonh]="<span style=display:none>tj_okonh</span>ОКОНХ";

	//for asia domains

	$contact_field[asia_company]="<span style=display:none>asia_company</span>Название организации - владельца домена. Указывать Private person в случае, если владельцем является частное лицо.";
	$contact_field[asia_first_name]="<span style=display:none>asia_first_name</span>Имя контактного лица";
	$contact_field[asia_last_name]="<span style=display:none>asia_last_name</span>Фамилия контактного лица";
	$contact_field[asia_email]="<span style=display:none>asia_email</span>Контактный email-адрес владельца домена.";
	$contact_field[asia_phone]="<span style=display:none>asia_phone</span>Номер телефона владельца домена в международном формате (Пример: +7.4952171179).";
	$contact_field[asia_fax]="<span style=display:none>asia_fax</span>Номер факса владельца домена в международном формате (Пример: +7.4952171179). Необязательное поле.";
	$contact_field[asia_addr]="<span style=display:none>asia_addr</span>Адрес владельца домена: улица, дом, офис (квартира)";
	$contact_field[asia_city]="<span style=display:none>asia_city</span>Адрес владельца домена: город";
	$contact_field[asia_state]="<span style=display:none>asia_state</span>Адрес владельца домена: область/край/штат. Необязательное поле";
	$contact_field[asia_postcode]="<span style=display:none>asia_postcode</span>Почтовый индекс владельца домена";
	$contact_field[asia_country_code]="<span style=display:none>asia_country_code</span>Двухбуквенный ISO-код страны владельца домена.";
	$contact_field[asia_default_ced]="<span style=display:none>asia_default_ced</span><br />Если указано значение on - использовать CED-контакт ООО Регтайм";
	$contact_field[asia_cclocality]="<span style=display:none>asia_cclocality</span>Код страны из Азиатско-Тихоокеанского региона, где зарегистрирован CED-контакт";
	$contact_field[asia_entity_type]="<span style=display:none>asia_entity_type</span>Тип CED-контакта (возможные значения: naturalPerson, corporation, cooperative, partnership, government, politicalParty, society, institution, other))";
	$contact_field[asia_ident_form]="<span style=display:none>asia_ident_form</span>Форма идентификации (возможные  варианты : passport,certificate, legislation, societiesRegistry, politicalPartyRegistry, other)";
	$contact_field[asia_ident_number]="<span style=display:none>asia_ident_number</span>Идентификационный номер";

    //for other domines

    $contact_field[be_company]="<span style=display:none>be_company</span>Название организации - владельца домена. Указывать Private person в случае, если владельцем является частное лицо.";
	$contact_field[be_first_name]="<span style=display:none>be_first_name</span>Имя контактного лица";
	$contact_field[be_last_name]="<span style=display:none>be_last_name</span>Фамилия контактного лица";
	$contact_field[be_email]="<span style=display:none>be_email</span>Контактный email-адрес владельца домена.";
	$contact_field[be_phone]="<span style=display:none>be_phone</span>Номер телефона владельца домена в международном формате (Пример: +7.4952171179).";
	$contact_field[be_fax]="<span style=display:none>be_fax</span>Номер факса владельца домена в международном формате (Пример: +7.4952171179). Необязательное поле.";
	$contact_field[be_addr]="<span style=display:none>be_addr</span>Адрес владельца домена: улица, дом, офис (квартира)";
	$contact_field[be_city]="<span style=display:none>be_city</span>Адрес владельца домена: город";
	$contact_field[be_state]="<span style=display:none>be_state</span>Адрес владельца домена: область/край/штат. Необязательное поле";
	$contact_field[be_postcode]="<span style=display:none>be_postcode</span>Почтовый индекс владельца домена";
	$contact_field[be_country_code]="<span style=display:none>be_country_code</span>Двухбуквенный ISO-код страны владельца домена.";



## AU DOMAINS REQUIREMENTS ##

$additionaldomainfields[".com.au"][] = array(
"Name" => "Registrant Name",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".com.au"][] = array(
"Name" => "Registrant ID",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".com.au"][] = array(
"Name" => "Registrant ID Type",
"Type" => "dropdown",
"Options" => "ABN,ACN,Business Registration Number",
"Default" => "ABN",
);

$additionaldomainfields[".com.au"][] = array(
"Name" => "Eligibility Name",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".com.au"][] = array(
"Name" => "Eligibility ID",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".com.au"][] = array(
"Name" => "Eligibility ID Type",
"Type" => "dropdown",
"Options" => ",Australian Company Number (ACN),ACT Business Number,NSW Business Number,NT Business Number,QLD Business Number,SA Business Number,TAS Business Number,VIC Business Number,WA Business Number,Trademark (TM),Other - Used to record an Incorporated Association number,Australian Business Number (ABN)",
"Default" => "",
);

$additionaldomainfields[".com.au"][] = array(
"Name" => "Eligibility Type",
"Type" => "dropdown",
"Options" => "Charity,Citizen/Resident,Club,Commercial Statutory Body,Company,Incorporated Association,Industry Body,Non-profit Organisation,Other,Partnership,Pending TM Owner  ,Political Party,Registered Business,Religious/Church Group,Sole Trader,Trade Union,Trademark Owner,Child Care Centre,Government School,Higher Education Institution,National Body,Non-Government School,Pre-school,Research Organisation,Training Organisation",
"Default" => "Company",
);

$additionaldomainfields[".com.au"][] = array(
"Name" => "Eligibility Reason",
"Type" => "radio",
"Options" => "Domain name is an Exact Match Abbreviation or Acronym of your Entity or Trading Name.,Close and substantial connection between the domain name and the operations of your Entity.",
"Default" => "Domain name is an Exact Match Abbreviation or Acronym of your Entity or Trading Name.",
);

$additionaldomainfields[".net.au"] = $additionaldomainfields[".com.au"];

// org.au / asn.au

$additionaldomainfields[".org.au"][] = array(
"Name" => "Registrant Name",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".org.au"][] = array(
"Name" => "Registrant ID",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".org.au"][] = array(
"Name" => "Registrant ID Type",
"Type" => "dropdown",
"Options" => "ABN,ACN,N/A",
"Default" => "N/A",
);

$additionaldomainfields[".org.au"][] = array(
"Name" => "Eligibility Name",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".org.au"][] = array(
"Name" => "Eligibility ID",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".org.au"][] = array(
"Name" => "Eligibility ID Type",
"Type" => "dropdown",
"Options" => ",Australian Company Number (ACN),ACT Business Number,NSW Business Number,NT Business Number,QLD Business Number,SA Business Number,TAS Business Number,VIC Business Number,WA Business Number,Trademark (TM),Other - Used to record an Incorporated Association number,Australian Business Number (ABN)",
"Default" => "",
);

$additionaldomainfields[".org.au"][] = array(
"Name" => "Eligibility Type",
"Type" => "dropdown",
"Options" => "Charity,Citizen/Resident,Club,Commercial Statutory Body,Company,Incorporated Association,Industry Body,Non-profit Organisation,Other,Partnership,Pending TM Owner,Political Party,Registered Business,Religious/Church Group,Sole Trader,Trade Union,Trademark Owner,Child Care Centre,Government School,Higher Education Institution,National Body,Non-Government School,Pre-school,Research Organisation,Training Organisation",
"Default" => "Charity",
);

$additionaldomainfields[".org.au"][] = array(
"Name" => "Eligibility Reason",
"Type" => "radio",
"Options" => "Domain name is an Exact Match Abbreviation or Acronym of your Entity or Trading Name.,Close and substantial connection between the domain name and the operations of your Entity.",
"Default" => "Domain name is an Exact Match Abbreviation or Acronym of your Entity or Trading Name.",
);

$additionaldomainfields[".asn.au"] = $additionaldomainfields[".org.au"];


// id.au

$additionaldomainfields[".id.au"][] = array(
"Name" => "Registrant Name",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".id.au"][] = array(
"Name" => "Eligibility Type",
"Type" => "dropdown",
"Options" => "Citizen/Resident",
"Default" => "Citizen/Resident",
);

$additionaldomainfields[".id.au"][] = array(
"Name" => "Eligibility Reason",
"Type" => "radio",
"Options" => "Domain name is an Exact Match Abbreviation or Acronym of your Entity or Trading Name.",
"Default" => "Domain name is an Exact Match Abbreviation or Acronym of your Entity or Trading Name.",
);

## US DOMAIN REQUIREMENTS ##

$additionaldomainfields[".us"][] = array(
"Name" => "Nexus Category",
"Type" => "dropdown",
"Options" => "C11,C12,C21,C31,C32",
"Default" => "C11",
);

$additionaldomainfields[".us"][] = array(
"Name" => "Nexus Country",
"Type" => "text",
"Size" => "20",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".us"][] = array(
"Name" => "Application Purpose",
"Type" => "dropdown",
"Options" => "Business use for profit,Non-profit business,Club,Association,Religious Organization,Personal Use,Educational purposes,Government purposes",
"Default" => "Business use for profit",
);

## CA DOMAIN REQUIREMENTS ##

$additionaldomainfields[".ca"][] = array(
"Name" => "Legal Type",
"Type" => "dropdown",
"Options" => "Corporation,Canadian Citizen,Permanent Resident of Canada,Government,Canadian Educational Institution,Canadian Unincorporated Association,Canadian Hospital,Partnership Registered in Canada,Trade-mark registered in Canada,Canadian Trade Union,Canadian Political Party,Canadian Library Archive or Museum,Trust established in Canada,Aboriginal Peoples,Legal Representative of a Canadian Citizen,Official mark registered in Canada",
"Default" => "Corporation",
);

$additionaldomainfields[".ca"][] = array(
"Name" => "Registrant Name",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".ca"][] = array(
"Name" => "Trademark Number",
"Type" => "text",
"Size" => "50",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".ca"][] = array(
"Name" => "Organization Registered Location",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => false,
);

## UK DOMAIN REQUIREMENTS ##

$additionaldomainfields[".co.uk"][] = array(
"Name" => "Legal Type",
"Type" => "dropdown",
"Options" => "Individual,UK Limited Company,UK Public Limited Company,UK Partnership,UK Limited Liability Partnership,Sole Trader,UK Registered Charity,UK Entity (other),Foreign Organization,Other foreign organizations",
"Default" => "Individual",
);

$additionaldomainfields[".co.uk"][] = array(
"Name" => "Company ID Number",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => false,
);

$additionaldomainfields[".co.uk"][] = array(
"Name" => "Registrant Name",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".co.uk"][] = array(
"Name" => "WHOIS Opt-out",
"Type" => "tickbox",
);

$additionaldomainfields[".org.uk"] = $additionaldomainfields[".co.uk"];
$additionaldomainfields[".me.uk"] = $additionaldomainfields[".co.uk"];

## .PLC.UK DOMAIN REQUIREMENTS ##

$additionaldomainfields[".plc.uk"][] = array(
"Name" => "Legal Type",
"Type" => "dropdown",
"Options" => "UK Public Limited Company",
"Default" => "UK Public Limited Company",
);

$additionaldomainfields[".plc.uk"][] = array(
"Name" => "Company ID Number",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".plc.uk"][] = array(
"Name" => "Company Name",
"Type" => "text",
"Size" => "64",
"Default" => "",
"Required" => true,
);

## .LTD.UK DOMAIN REQUIREMENTS ##

$additionaldomainfields[".ltd.uk"][] = array(
"Name" => "Legal Type",
"Type" => "dropdown",
"Options" => "UK Limited Company,UK Limited Liability Partnership",
"Default" => "UK Limited Company",
);

$additionaldomainfields[".ltd.uk"][] = array(
"Name" => "Company ID Number",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => true,
);

$additionaldomainfields[".ltd.uk"][] = array(
"Name" => "Company Name",
"Type" => "text",
"Size" => "64",
"Default" => "",
"Required" => true,
);

?>
