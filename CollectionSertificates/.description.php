<?	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); 
	$arComponentDescription = array(
		"NAME" => GetMessage("Сертификаты"),
		"DESCRIPTION" => GetMessage("Управление сертификатами"),
		"PATH" => array(
			"ID" => "dv_components",
			"CHILD" => array(
				"ID" => "CollectionSertificates",
				"NAME" => "Сертификаты"
			)
	),
	"ICON" => "/images/icon.gif",
	);