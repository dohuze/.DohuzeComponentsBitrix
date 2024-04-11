<?	require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
	require_once($_SERVER["DOCUMENT_ROOT"] . '/dompdf/autoload.inc.php');
	use Dompdf\Dompdf;
	\Bitrix\Main\Loader::includeModule('iblock');
	
	function isJson($string) {
	   json_decode($string);
	   return json_last_error() === JSON_ERROR_NONE;
	}
		
	$data = json_decode(file_get_contents("php://input"), true);
	//echo '<pre>data: '; print_r($data); echo '</pre>';
	
	$iblock = \Bitrix\Iblock\IblockTable::getList([
		'filter' => [
			'=CODE' => 'sertificats'
		],
		'select' => ['ID'],
	])->fetch()['ID'];
	//echo '<pre>iblock: '; print_r($iblock); echo '</pre>'; die();
	
	$dbItems = \Bitrix\Iblock\ElementTable::getList(array(
		'select' => array('ID', 'NAME'),
		'filter' => array('IBLOCK_ID' => $iblock)
	));
	
	$ArrItems = $dbItems->fetchAll();
	//echo '<pre>ArrItems: '; print_r($ArrItems); echo '</pre>';

	foreach ($ArrItems as $v) {
		if ($data['number'] == $v['NAME']) {
			$res = \Bitrix\Iblock\Elements\ElementSertificatsTable::getByPrimary($v['ID'], [
				'select' => ['activations'],
			])->fetch();
			
			if (isJson($res['IBLOCK_ELEMENTS_ELEMENT_SERTIFICATS_activations_VALUE'])) {
				$arr = json_decode($res['IBLOCK_ELEMENTS_ELEMENT_SERTIFICATS_activations_VALUE'], true);
			}
			$arr[$data['userID']] = date('d-m-Y H:i:s', time());
			
			\CIBlockElement::SetPropertyValuesEx($v['ID'], false, array('activations' => json_encode($arr)));
			
			// PDF
			$html = 
			'<html lang=ru>
				<meta charset=utf-8>
				<meta http-equiv=X-UA-Compatible content="IE=edge">
				<body>
				<style type="text/css">
					* {box-sizing: border-box; margin: 0; padding: 0;}
					body {font-family: DejaVu Sans;}
					h1 {font-size: 25px; text-align: center;}
				</style>
				<h1>Сертификат: ' . $v['NAME'] . '</h1>
				<h1>Дата и время регистрации: ' . $arr[$data['userID']] . '</h1>
				</body>
			</html>';
			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);
			$dompdf->setPaper('a4', 'portrait');
			$dompdf->render();
			$output = $dompdf->output();
			file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/invoice/' . $v['NAME'] . '.pdf', $output);
			
			$user_mail = \Bitrix\Main\UserTable::getList([
				'select' => ['ID', 'EMAIL']
			])->fetch()['EMAIL'];
			//echo "<pre>user_mail: "; print_r($user_mail); echo "</pre>";
			
			// письмо, почтовое событие: SEND_ARTICLE_PDF_FILE
			\Bitrix\Main\Mail\Event::send(array(
				"EVENT_NAME" => "SEND_ARTICLE_PDF_FILE",
				"LID" => "s1",
				"C_FIELDS" => array(
					"PDF_NAME" => $v['NAME'],
					"USER_MAIL" => $user_mail
				),
			   "FILE" => array($_SERVER["DOCUMENT_ROOT"] . '/invoice/' . $v['NAME'] . '.pdf')
			));

			echo $arr[$data['userID']];
			die();
		}
	}
	echo 'ERROR';