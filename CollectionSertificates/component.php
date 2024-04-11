<?	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
	\Bitrix\Main\Loader::includeModule('iblock');
	
	$iblock = \Bitrix\Iblock\IblockTable::getList([
		'filter' => [
			'=CODE' => 'sertificats'
		],
		'select' => ['ID'],
	])->fetch()['ID'];
	//echo '<pre>iblock: '; print_r($iblock); echo '</pre>'; die();

	if (CIBlock::GetElementCount($iblock) == 0) {
		for ($i = 0; $i < 20; $i++) {
			$number =	\Bitrix\Main\Security\Random::getStringByCharsets(2, '123456789') . 
						\Bitrix\Main\Security\Random::getStringByCharsets(2, 'ABCDEFGHIKLMNOPQRSTVXYZ') . 
						'-' . 
						\Bitrix\Main\Security\Random::getStringByCharsets(2, '123456789') . 
						\Bitrix\Main\Security\Random::getStringByCharsets(2, 'ABCDEFGHIKLMNOPQRSTVXYZ');
			$number = strtoupper($number);

			$el = new CIBlockElement;
			$arLoadProductArray = Array(
				"IBLOCK_ID"      => $iblock,
				"NAME"           => $number,
				"ACTIVE"         => "Y",
			);
			if($PRODUCT_ID = $el->Add($arLoadProductArray))
				echo "New ID: " . $PRODUCT_ID . '<br>';
			else
				echo "Error: " . $el->LAST_ERROR . '<br>';
		}
	}
	
	$arResult['UserId'] = \Bitrix\Main\Engine\CurrentUser::get()->getId();
	
	$dbItems = \Bitrix\Iblock\ElementTable::getList(array(
		'select' => array('ID', 'NAME'),
		'filter' => array('IBLOCK_ID' => $iblock, 'ACTIVE' => 'Y'),
		'order' => array('SORT' => 'ASC'),
	))->fetchAll();
	//echo "<pre>dbItems: "; print_r($dbItems); echo "</pre>";
	
	$arResult['dbItems'] = $dbItems;
	
	foreach ($dbItems as $k => $v) {
		$res = \Bitrix\Iblock\Elements\ElementSertificatsTable::getByPrimary($v['ID'], [
			'select' => ['activations'],
		])->fetch();
		
		if ($res['IBLOCK_ELEMENTS_ELEMENT_SERTIFICATS_activations_VALUE']) {
			$arResult['dbItems'][$k]['activations_json'] = $res['IBLOCK_ELEMENTS_ELEMENT_SERTIFICATS_activations_VALUE'];
			
			foreach (json_decode($res['IBLOCK_ELEMENTS_ELEMENT_SERTIFICATS_activations_VALUE'], true) as $kk => $vv) {
				if ($kk == $arResult['UserId']) {
					$arResult['dbItems'][$k]['is_activation'] = 'Y';
					$arResult['dbItems'][$k]['activations_date'] = 'Дата и время активации:<br>' . $vv;
				}
			}
			
		}
	}
	
	//echo "<pre>arParams: "; print_r($arParams); echo "</pre>";
	//echo "<pre>arResult: "; print_r($arResult); echo "</pre>";
	
	$this->IncludeComponentTemplate();