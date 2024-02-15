<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/* echo '<pre>arParams: '; print_r($arParams); echo '</pre>';
echo '<pre>arResult: '; print_r($arResult); echo '</pre>'; */

if($arResult['type_get_instagram'] == 'json_stroka') $dob = 'foto_320';
if($arResult['type_get_instagram'] == 'token') $dob = 'foto_po_tokenu';
?>
<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->

<div class="block inst">
	<div class="block__title">
		<?=$arParams['BLOCK_TITLE']?>
	</div>
	<div class="inst__body">
		<a href="<?=$arResult['fotos']['data_foto_shortcode_arr'][0]?>" class="inst__item" target="_blank">
			<div class="inst__img">
				<img src="/include/dohuze/instagram_<?=$arResult['ID_COMPONENT']?>/<?=$dob?>/0">
			</div>
			<div class="inst__prev" style="padding: 10px;">
				<?=$arResult['fotos']['data_foto_text_foto_arr'][0]?>
			</div>
		</a>
		<a href="<?=$arResult['fotos']['data_foto_shortcode_arr'][1]?>" class="inst__item" target="_blank">
			<div class="inst__img">
				<img src="/include/dohuze/instagram_<?=$arResult['ID_COMPONENT']?>/<?=$dob?>/1">
			</div>
			<div class="inst__prev" style="padding: 10px;">
				<?=$arResult['fotos']['data_foto_text_foto_arr'][1]?>
			</div>
		</a>
		<a href="<?=$arResult['fotos']['data_foto_shortcode_arr'][2]?>" class="inst__item" target="_blank">
			<div class="inst__img">
				<img src="/include/dohuze/instagram_<?=$arResult['ID_COMPONENT']?>/<?=$dob?>/2">
			</div>
			<div class="inst__prev" style="padding: 10px;">
				<?=$arResult['fotos']['data_foto_text_foto_arr'][2]?>
			</div>
		</a>
		<a href="<?=$arResult['fotos']['data_foto_shortcode_arr'][3]?>" class="inst__item" target="_blank">
			<div class="inst__img">
				<img src="/include/dohuze/instagram_<?=$arResult['ID_COMPONENT']?>/<?=$dob?>/3">
			</div>
			<div class="inst__prev" style="padding: 10px;">
				<?=$arResult['fotos']['data_foto_text_foto_arr'][3]?>
			</div>
		</a>
		<a href="<?=$arResult['fotos']['data_foto_shortcode_arr'][4]?>" class="inst__item" target="_blank">
			<div class="inst__img">
				<img src="/include/dohuze/instagram_<?=$arResult['ID_COMPONENT']?>/<?=$dob?>/4">
			</div>
			<div class="inst__prev" style="padding: 10px;">
				<?=$arResult['fotos']['data_foto_text_foto_arr'][4]?>
			</div>
		</a>
	</div>
</div>

