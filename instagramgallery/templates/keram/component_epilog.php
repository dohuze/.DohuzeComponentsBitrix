<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?
echo htmlspecialchars_decode($arResult["FONT_FAMILY"], ENT_HTML5);

if (!empty($arResult["INSTAGRAM_ICONKA_CDN"])) {
	echo htmlspecialchars_decode($arResult["INSTAGRAM_ICONKA_CDN"], ENT_HTML5);
} else {
	$arResult["INSTAGRAM_ICONKA_CDN"] = '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">';
	echo htmlspecialchars_decode($arResult["INSTAGRAM_ICONKA_CDN"], ENT_HTML5);
}
?>