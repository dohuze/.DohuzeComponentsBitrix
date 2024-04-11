Компонент "CollectionSertificates" устанавливается в коде следующим образом:
<?
	$APPLICATION->IncludeComponent(
		"dohuze:CollectionSertificates", 
		"",
		array(
		),
		false
	);
?>

На сайте http://dohuze.dtsvet47.beget.tech/ компонент размещён прямо на индексной странице.
Файлы компонента находятся в папке local корня сайта.
Письма с pdf-файлами генерируются при помощи библиотеки dompdf.
