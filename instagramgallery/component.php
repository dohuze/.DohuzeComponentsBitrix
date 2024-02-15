	<?//print_r( $_SERVER ) ;
	if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
	if($_SERVER['SERVER_NAME'] == 'test.demo-clementin.ru') {
		//echo '<br>Результат копирования папки в папку модуля: ' . CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . '/bitrix/components/clementin/instagramgallery', $_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/clementin.instagramgallery/install/components/clementin/instagramgallery') . '<br>';
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . '/bitrix/components/clementin/instagramgallery', $_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/clementin.instagramgallery/install/components/clementin/instagramgallery');
	}

	/* if($USER->IsAdmin() && !empty($arParams['INSTAGRAM_LOGIN'])) {
		echo '<div style="background-color: #00ff00; padding: 15px; border: 2px solid #1E90FF;">Ссылка на JSON-файл инстаграм: <a target="_blank" href="https://www.instagram.com/' .$arParams['INSTAGRAM_LOGIN']. '/?__a=1">ОТКРЫТЬ</a><br>Файл открывается только в браузере, залогинившемся в инстаграм.<br>Нажмите "Скопировать" и вставьте содержимое буфера обмена в поле настроек компонента "JSON-файл инстаграм".<br>Далее- "Сохранить".<br></div>';
	} */

	require_once  $_SERVER['DOCUMENT_ROOT'] . $componentPath . '/functions.php';
	#\Bitrix\Main\UI\Extension::load("ui.dialogs.messagebox");

	$is_mobile_device = check_mobile_device();
	if($is_mobile_device){
		//echo "Вы зашли с мобильного устройства";
		$arResult['IS_MOBILE_DEVICE'] = 'Y';
	}else{
		//echo "Вы зашли с PC";
		$arResult['IS_MOBILE_DEVICE'] = 'N';
	}

	$arResult['ID_COMPONENT'] = $this->getEditAreaId($this->__currentCounter);
	$arResult['ID_COMPONENT_BX'] = $this->getEditAreaId($this->__currentCounter);

	// FONT
	if(!empty($arParams['INSTAGRAM_FONT'])) {
		if(count(explode("family=", $arParams['INSTAGRAM_FONT'])) == 1 || count(explode("fonts.googleapis.com", $arParams['INSTAGRAM_FONT'])) == 1) {
			$arResult['ERRORS'][] = 'Error: The font is not connected correctly<br>';
		} else {
			$arResult['FONT_FAMILY'] = "\n" . $arParams[INSTAGRAM_FONT] . "\n";
			$arResult['FONT_FAMILY_NAME'] = poisk_lev_prav__lev("family=", "&", $arParams[INSTAGRAM_FONT]);
			if(empty($arResult['FONT_FAMILY_NAME'])) {
				$arResult['ERRORS'][] = 'Error: The font is not connected correctly<br>';
				unset($arResult['FONT_FAMILY']);
				unset($arResult['FONT_FAMILY_NAME']);
			}
		}
		$font_style = array('serif', 'sans-serif', 'monospace', 'cursive', 'fantasy', 'system-ui', 'math', 'emoji', 'fangsong'); // дубль в .parametrs.php
		$arResult['INSTAGRAM_FONT_STYLE'] = $font_style[$arParams['INSTAGRAM_FONT_STYLE']];
	}

	$arResult['IS_CENTER_CAP'] = $arParams['IS_CENTER_CAP'];
	$arResult['INSTAGRAM_ICONKA'] = $arParams['INSTAGRAM_ICONKA'];
	$arResult['INSTAGRAM_ICONKA_CODE'] = $arParams['INSTAGRAM_ICONKA_CODE'];
	$arResult['INSTAGRAM_ICONKA_CDN'] = $arParams['INSTAGRAM_ICONKA_CDN'];


	if(empty($arParams['INSTAGRAM_LOGIN']) && empty($arParams['INSTAGRAM_TOKEN'])) {
		$arResult['ERRORS'][] = 'Error: login and Instagram token are not set<br>';
	} else {
		if(isset($arParams['INSTAGRAM_LOGIN']) && $arParams['IS_TOKEN_USED'] == 'N') {
			$arResult['ID_COMPONENT'] = $arResult['ID_COMPONENT'] . '_' . generateSlugFrom($arParams['INSTAGRAM_LOGIN']);
		}
		if(isset($arParams['INSTAGRAM_TOKEN']) && $arParams['IS_TOKEN_USED'] == 'Y') {
			$arResult['ID_COMPONENT'] = $arResult['ID_COMPONENT'] . '_' . generateSlugFrom($arParams['INSTAGRAM_TOKEN']);
		}
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include'))
			mkdir($_SERVER["DOCUMENT_ROOT"] . '/include');
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze'))
			mkdir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze');
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT']))
			mkdir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT']);
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/cookies'))
			mkdir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/cookies');
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/foto_320'))
			mkdir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/foto_320');
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/foto_640'))
			mkdir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/foto_640');
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/poster_320'))
			mkdir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/poster_320');
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/poster_640'))
			mkdir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/poster_640');
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/foto_po_tokenu'))
			mkdir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/foto_po_tokenu');
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/avatar'))
			mkdir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/avatar');
		if(!file_exists($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/time_token.txt') && isset($arParams['INSTAGRAM_TOKEN'])) {
			file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/time_token.txt', time()); //pervonachal`naya metka vremeni tokena
			file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/token.txt', $arParams['INSTAGRAM_TOKEN']); //pervonachal`ny`j token
		}
		if($arParams['SLIDE_COUNT'] > 12 && $arParams['IS_TOKEN_USED'] == 'N' && isset($arParams['INSTAGRAM_LOGIN']))
			$arParams[SLIDE_COUNT] = 12;
		if(!file_exists($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/time_cache.txt')) {
			$arParams[MIN_TC] = 0;
			file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/data_login_cache.txt', '');
			file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/data_token_cache.txt', '');
			file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/time_cache.txt', '');
		}
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . $componentPath . '/handler_ajax.php', $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/handler_ajax.php');
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . $componentPath . '/form_json.php', $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/form_json.php');
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . $componentPath . '/lang/ru/form_json_lang_ru.php', $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/form_json_lang_ru.php');

		$time_cache = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/time_cache.txt');
		if(!is_dir($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/google_fonts_instruction')) {
			CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . $componentPath . '/google_fonts_instruction', $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/google_fonts_instruction');
		}
		
		// posledniy token iz file
		if(!empty(file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/token.txt'))) {
			$arParams['INSTAGRAM_TOKEN'] = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/token.txt');
		}
		// avtoobnovlenie tokena
		if(isset($arParams['INSTAGRAM_TOKEN']) && $arParams['IS_TOKEN_AUTO'] == 'Y') {
			$time_token = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/time_token.txt');
			$period = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/expires_in.txt');
			$period = $period / 60 / 3;
			//$period = 0;
			if(time() - $time_token > $period) {
				$data = curl_get('https://graph.instagram.com/refresh_access_token' . '?grant_type=ig_refresh_token&access_token=' . $arParams['INSTAGRAM_TOKEN']);
				$data = json_decode($data, true);
				//echo "<pre>data: "; print_r($data); echo "</pre>";
				if(isset($data['error'] ['message']) ) {
					$arResult['ERRORS'][] = $data['error'] ['message'];
				}
				if(isset($data['access_token']) && isset($data['expires_in'])) {
					$arParams['INSTAGRAM_TOKEN'] = $data['access_token'];
					file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/expires_in.txt', $data['expires_in']);
					file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/token.txt', $arParams['INSTAGRAM_TOKEN']);
					file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/time_token.txt', time());
					$arParams['INSTAGRAM_TOKEN'] = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/token.txt');
				}
			}
		}
		?>

		<script>
			console.log("======================================================== instagram component ==================================================================");
			console.log("<?='ID_COMPONENT=' . $arResult['ID_COMPONENT']?>");
			var err_proverka_tokena = "";
			var errors_array = [];
		</script>

		<script>
			var itog = "N";
			var key, value, v;
			let stroka_get_<?=$arResult['ID_COMPONENT']?> = "";
			
			function POST_AJAX_STRING_<?=$arResult['ID_COMPONENT']?>(str, file_name) {
				const request = new XMLHttpRequest();
				request.open('POST', '<?=$componentPath?>' + '/handler_ajax.php?id_component=' + '<?=$arResult['ID_COMPONENT']?>', true);
				request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				request.addEventListener("readystatechange", () => {
					if(request.readyState === 4 && request.status === 200) {
						//alert(request.responseText);
						console.log(request.responseText);
						console.log("======================================================== /instagram component (tocken) =================================================================");
					}
				});
				request.send("str=" + encodeURIComponent(str) + "&file_name=" + encodeURIComponent(file_name));
			}
			
			function IsJsonString(str) {
				try {
					JSON.parse(str);
				} catch (e) {
					return false;
				}
				return true;
			}
			
			function isEmpty(str) {
				return (!str || 0 === str.length);
			}
		</script>
		
		<?
		if(
			isset($arParams['INSTAGRAM_LOGIN']) && 
			file_exists($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_login_' . $arParams['INSTAGRAM_LOGIN'] . '/json.txt') && 
			strlen(file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_login_' . $arParams['INSTAGRAM_LOGIN'] . '/json.txt')) > 10 && 
			$arParams['IS_JSON_STRING'] == 'Y' && 
			$arParams['IS_TOKEN_USED'] == 'N' 
		):
		?>
			<script>console.log("ZAPROS PO FILE json");</script>	
			<?
			$arResult['type_get_instagram'] = 'json_stroka';
			$json_arr = json_from_HTML_to_arr(file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_login_' . $arParams['INSTAGRAM_LOGIN'] . '/json.txt'));
			//echo '<pre>json_arr: '; print_r($json_arr); echo '</pre>';
			
			//cap
			$arResult['cap']['full_name'] = $json_arr['graphql']['user']['full_name'];
			$arResult['cap']['external_url'] = $json_arr['graphql']['user']['external_url'];
			$arResult['cap']['biography'] = $json_arr['graphql']['user']['biography'];
			$arResult['cap']['profile_pic_url'] = $json_arr['graphql']['user']['profile_pic_url'];
			$arResult['cap']['username'] = $json_arr['graphql']['user']['username'];
			$arResult['cap']['edge_owner_to_timeline_media'] = $json_arr['graphql']['user']['edge_owner_to_timeline_media']['count'];
			$arResult['cap']['edge_followed_by'] = $json_arr['graphql']['user']['edge_followed_by']['count'];
			$arResult['cap']['edge_follow'] = $json_arr['graphql']['user']['edge_follow']['count'];
			$arResult['cap']['id_component_login'] = $arResult['ID_COMPONENT_BX'] . '_' . generateSlugFrom($arParams['INSTAGRAM_LOGIN']);
			file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/json_cap.txt', json_encode($arResult['cap']));
			
			if(time() - $time_cache > $arParams['MIN_TC']) {
				$rez .= download_image($arResult['cap']['profile_pic_url'], $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/avatar/0');
			} else {
				$rez .= 'data from the cache';
			}
			
 			foreach($json_arr['graphql']['user']['edge_owner_to_timeline_media']['edges'] as $key => $value) {
				$v = $value['node'];
				//echo "<pre>$key: "; print_r($v); echo '</pre>';

				if($v['__typename'] == 'GraphVideo') {
					$url_foto_320 = $v['video_url'];
					//$url_foto_320 = 'https://www.instagram.com/p/' . $v['shortcode'];
				} else {
					$url_foto_320 = (!empty($v['thumbnail_resources'][2]['src']))?$v['thumbnail_resources'][2]['src']:'';
				}
				
				if($v['__typename'] == 'GraphVideo') {
					$url_foto_640 = $v['video_url'];
					//$url_foto_640 = 'https://www.instagram.com/p/' . $v['shortcode'];
				} else {
					$url_foto_640 = (!empty($v['thumbnail_resources'][4]['src']))?$v['thumbnail_resources'][4]['src']:$v['display_url'];
				}
				
				$poster_320 = (!empty($v['thumbnail_resources'][2]['src']))?$v['thumbnail_resources'][2]['src']:'';
				$poster_640 = (!empty($v['thumbnail_resources'][4]['src']))?$v['thumbnail_resources'][4]['src']:$v['display_url'];

				// fotos & posters
				$arResult['fotos']['data_foto_display_url_arr'][] = $v['display_url'];
				$arResult['fotos']['data_foto_taken_at_timestamp_arr'][] = date('d.m.Y', $v['taken_at_timestamp']);
				$arResult['fotos']['data_foto_shortcode_arr'][] = 'https://www.instagram.com/p/' . $v['shortcode'];
				$arResult['fotos']['data_foto_url_foto_320_arr'][] = "https://www.instagram.com/p/" . $url_foto_320 . '/';
				$arResult['fotos']['data_foto_url_foto_640_arr'][] = $url_foto_640;
				$arResult['posters']['data_poster_url_poster_320_arr'][] = "https://www.instagram.com/p/" . $poster_320 . '/';
				$arResult['posters']['data_poster_url_poster_640_arr'][] = $poster_640;
				$arResult['fotos']['media_type_arr'][] = $v['__typename'];
				$arResult['fotos']['data_foto_text_foto_arr'][] = mbCutString($v[edge_media_to_caption][edges][0][node][text] , $arParams[MESSAGE_SIZE], $postfix=' ...', $encoding='UTF-8');

				if(time() - $time_cache > $arParams['MIN_TC']) {
					$rez .= download_image($url_foto_320, $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/foto_320/' . $key);
					$rez .= download_image($poster_320, $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/poster_320/' . $key);
					
					if($key == 0) {
						$rez .= download_image($url_foto_640, $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/foto_640/0');
						$rez .= download_image($poster_640, $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/poster_640/0');
					}
					file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/time_cache.txt', time());
				}
			}
			
			echo '<script>console.log("' .$rez. '")</script>';
			echo '<script>console.log("======================================================== /instagram component (json_file) ============================================================")</script>';
			?>
		<?endif?>

		<?
		if
		(
		isset($arParams['INSTAGRAM_TOKEN']) && 
		$arParams['IS_TOKEN_USED'] == 'Y' && 
		$arParams['IS_JSON_STRING'] == 'N' && 
		time() - $time_cache > $arParams['MIN_TC']
		):
		?>
			<script>console.log("ZAPROS PO TOKENU");</script>
			<?$arResult[type_get_instagram] = 'token'?>
			<script>
				let promise_<?=$arResult['ID_COMPONENT']?> = new Promise((resolve, reject) => {
					var type_get_instagram = "token";
					var xhr_<?=$arResult['ID_COMPONENT']?> = new XMLHttpRequest();
					url = '<?= "https://graph.instagram.com/me/media?fields=id,media_type,media_url,caption,timestamp,thumbnail_url,permalink,username&limit=" . $arParams["SLIDE_COUNT"] . "&access_token=" . $arParams['INSTAGRAM_TOKEN'] ?>';
					xhr_<?=$arResult['ID_COMPONENT']?>.open("GET", url, true);
					xhr_<?=$arResult['ID_COMPONENT']?>.setRequestHeader("Content-type", "text/plain");
					xhr_<?=$arResult['ID_COMPONENT']?>.onload = function() {
						if(this.status == 200 && this.readyState === 4) {
							if(IsJsonString(xhr_<?=$arResult['ID_COMPONENT']?>.responseText)) {
								const result = JSON.parse(xhr_<?=$arResult['ID_COMPONENT']?>.responseText);
								//var result_arr = Object.entries(result);
								//console.log(result_arr);
								if(result.data.length > 0) {
									itog = "Y2";
									for(x in result.data) {
										//if(result.data[x].media_type == "IMAGE") {
											//console.log(x +"----->"+ result.data[x].media_type);
											//console.log(result.data[x]);
											stroka_get_<?=$arResult['ID_COMPONENT']?> += "type_get_instagram=" + "token" + "^dohuze^";
											if(result.data[x].caption) {
												stroka_get_<?=$arResult['ID_COMPONENT']?> += "text_foto=" + result.data[x].caption + "^dohuze^";
											}
											if(result.data[x].thumbnail_url) {
												stroka_get_<?=$arResult['ID_COMPONENT']?> += "thumbnail_url=" + result.data[x].thumbnail_url + "^dohuze^";
											}
											stroka_get_<?=$arResult['ID_COMPONENT']?> += "taken_at_timestamp=" + result.data[x].timestamp + "^dohuze^";
											stroka_get_<?=$arResult['ID_COMPONENT']?> += "media_url=" + result.data[x].media_url + "^dohuze^";
											stroka_get_<?=$arResult['ID_COMPONENT']?> += "permalink=" + result.data[x].permalink + "^dohuze^";
											stroka_get_<?=$arResult['ID_COMPONENT']?> += "media_type=" + result.data[x].media_type + "^dohuze^";
										//}
									}
								resolve("OK");
								} else {
									reject("ERROR result.data.length");
								}
							}
						} else {
							reject("ERROR: NO JSON");
							if(!isEmpty(err_proverka_tokena)) {
								document.getElementById("errors").innerHTML = document.getElementById("errors").innerHTML + err_proverka_tokena;
							}
							if(document.getElementById("errors")) {
								document.getElementById("errors").innerHTML = document.getElementById("errors").innerHTML + "<p>Error: no connection to Instagram<span style='display: none'>token</span></p>";
							}
						}
						console.log("connected " + url + " status:" + this.status + ", readyState:" + this.readyState);
					}
					xhr_<?=$arResult['ID_COMPONENT']?>.onerror = function() {
						reject(new Error("Network Error"));
					};
					xhr_<?=$arResult['ID_COMPONENT']?>.send(null);
				});
				
				promise_<?=$arResult['ID_COMPONENT']?>.then(
					result => {
						console.log("Fulfilled: " + result + " itog: " + itog + " ID_COMPONENT: " + '<?=$arResult['ID_COMPONENT']?>'); // result - argument resolve
						if(itog == "Y2") {
							POST_AJAX_STRING_<?=$arResult['ID_COMPONENT']?>(stroka_get_<?=$arResult['ID_COMPONENT']?>, "data_<?=$arResult[type_get_instagram]?>_cache.txt");
						}
						if(!isEmpty(err_proverka_tokena)) {
							document.getElementById("errors").innerHTML = document.getElementById("errors").innerHTML + err_proverka_tokena;
						}
					},
					error => {
						console.log("Rejected: " + error); // error - argument reject
					}
				);
			</script>
		<?endif?>
		
		<?
		if($arParams['IS_TOKEN_USED'] == 'Y' && $arParams['IS_JSON_STRING'] == 'N') {
			$data_token_cache = explode('^dohuze^', file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/data_token_cache.txt'));
			//echo "<pre>data_token_cache: "; print_r($data_token_cache); echo "</pre>";
			if(count($data_token_cache) > 1 && $arParams['IS_TOKEN_USED'] == 'Y') {
				for($i = 0; $i < count($data_token_cache); $i++) {
					if(count(explode('media_url=', $data_token_cache[$i])) > 1)
						$arResult[fotos][data_foto_display_url_arr][] = poisk_lev_prav__lev('media_url=', '^dohuze^', $data_token_cache[$i]);
					if(count(explode('taken_at_timestamp=', $data_token_cache[$i])) > 1) {
						list($x1) = explode('T', poisk_lev_prav__lev('taken_at_timestamp=', '^dohuze^', $data_token_cache[$i]));
						$arResult[fotos][data_foto_taken_at_timestamp_arr][] = $x1;
					}
					if(count(explode('thumbnail_url=', $data_token_cache[$i])) > 1)
						$arResult[fotos][thumbnail_url][] = poisk_lev_prav__lev('thumbnail_url=', '^dohuze^', $data_token_cache[$i]);
					if(count(explode('permalink=', $data_token_cache[$i])) > 1)
						$arResult[fotos][data_foto_shortcode_arr][] = poisk_lev_prav__lev('permalink=', '^dohuze^', $data_token_cache[$i]);
					if(count(explode('media_url=', $data_token_cache[$i])) > 1)
						$arResult[fotos][data_foto_url_foto_320_arr][] = poisk_lev_prav__lev('media_url=', '^dohuze^', $data_token_cache[$i]);
					if(count(explode('url_foto_640=', $data_token_cache[$i])) > 1)
						$arResult[fotos][data_foto_url_foto_640_arr][] = poisk_lev_prav__lev('url_foto_640=', '^dohuze^', $data_token_cache[$i]);
					if(count(explode('text_foto=', $data_token_cache[$i])) > 1)
						$arResult[fotos][data_foto_text_foto_arr][] = mbCutString(poisk_lev_prav__lev('text_foto=', '^dohuze^', $data_token_cache[$i]), $arParams[MESSAGE_SIZE], $postfix=' ...', $encoding='UTF-8');
					if(count(explode('media_type=', $data_token_cache[$i])) > 1)
						$arResult[fotos][media_type_arr][] = poisk_lev_prav__lev('media_type=', '^dohuze^', $data_token_cache[$i]);
				}		
			}
			
			if(isset($arParams['INSTAGRAM_LOGIN']) && file_exists($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT_BX'] . '_' . generateSlugFrom($arParams['INSTAGRAM_LOGIN']) . '/json_cap.txt') && $arParams['IS_CAP'] == 'Y') {
				$json_cap_arr = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT_BX'] . '_' . generateSlugFrom($arParams['INSTAGRAM_LOGIN']) . '/json_cap.txt'), true);
				$arResult['cap']['full_name'] = $json_cap_arr['full_name'];
				$arResult['cap']['external_url'] = $json_cap_arr['external_url'];
				$arResult['cap']['biography'] = $json_cap_arr['biography'];
				$arResult['cap']['profile_pic_url'] = $json_cap_arr['profile_pic_url'];
				$arResult['cap']['username'] = $json_cap_arr['username'];
				$arResult['cap']['edge_owner_to_timeline_media'] = $json_cap_arr['edge_owner_to_timeline_media'];
				$arResult['cap']['edge_followed_by'] = $json_cap_arr['edge_followed_by'];
				$arResult['cap']['edge_follow'] = $json_cap_arr['edge_follow'];
				$arResult['cap']['id_component_login'] = $arResult['ID_COMPONENT_BX'] . '_' . generateSlugFrom($arParams['INSTAGRAM_LOGIN']);
			}
		}
		?>

		<?
		$arResult['count_foto'] = MIN($arParams['SLIDE_COUNT'], count($arResult['fotos']['data_foto_display_url_arr']));
		for($i = 0; $i < $arResult['count_foto']; $i++) {
			if($arParams['IS_TOKEN_USED'] == 'N') {
				$arResult['fotos']['dir_foto'][$i] = 'foto_320';
			} else {
				$arResult['fotos']['dir_foto'][$i] = 'foto_po_tokenu';
			}
		}
		if($componentTemplate == '7blocks' && $arParams['IS_TOKEN_USED'] == 'N')
			$arResult['fotos']['dir_foto'][0] = 'foto_640';
			
	}

	//echo "<pre>arParams: "; print_r($arParams); echo "</pre>";
	//echo "<pre>arResult: "; print_r($arResult); echo "</pre>";

	$this->IncludeComponentTemplate();