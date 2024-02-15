

	$headers = array();
	$headers[] = 'Authority: scontent-arn2-1.cdninstagram.com';
	$headers[] = 'Sec-Ch-Ua: \" Not;A Brand\";v=\"99\", \"Google Chrome\";v=\"97\", \"Chromium\";v=\"97\"';
	$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
	$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
	$headers[] = 'Upgrade-Insecure-Requests: 1';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
	$headers[] = 'Sec-Fetch-Site: none';
	$headers[] = 'Sec-Fetch-Mode: navigate';
	$headers[] = 'Sec-Fetch-User: ?1';
	$headers[] = 'Sec-Fetch-Dest: document';
	$headers[] = 'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
/* $fp = fopen($path, 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_exec($ch);
fclose($fp); */


	if(isset($_POST["file_name"]) && isset($_POST["str"])) {
		file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/' . $_POST["file_name"], $_POST["str"]);
		file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/time_cache.txt', time());
	}

	$data_arr_post = explode('^dohuze^', $_POST["str"]);
	if(count(explode('type_get_instagram=', $data_arr_post[0])) > 1) {
		list(,$type_get_instagram) = explode('=', $data_arr_post[0]);
	}

	if($type_get_instagram == 'json_stroka') {
		for($i = 1; $i < count($data_arr_post); $i++) {
			if(count(explode('profile_pic_url=', $data_arr_post[$i])) > 1)
				$profile_pic_url = poisk_lev_prav__lev('profile_pic_url=', '^dohuze^', $data_arr_post[$i]);
			if(count(explode('url_foto_320=', $data_arr_post[$i])) > 1)
				$data_foto_url_foto_320_arr[] = poisk_lev_prav__lev('url_foto_320=', '^dohuze^', $data_arr_post[$i]);
			if(count(explode('url_foto_640=', $data_arr_post[$i])) > 1)
				$data_foto_url_foto_640_arr[] = poisk_lev_prav__lev('url_foto_640=', '^dohuze^', $data_arr_post[$i]);
			if(count(explode('url_poster_320=', $data_arr_post[$i])) > 1)
				$data_poster_url_poster_320_arr[] = poisk_lev_prav__lev('url_poster_320=', '^dohuze^', $data_arr_post[$i]);
			if(count(explode('url_poster_640=', $data_arr_post[$i])) > 1)
				$data_poster_url_poster_640_arr[] = poisk_lev_prav__lev('url_poster_640=', '^dohuze^', $data_arr_post[$i]);
		}

		for($i = 0; $i < count($data_foto_url_foto_320_arr); $i++) {
			download_image($data_foto_url_foto_320_arr[$i], $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/foto_320/' . $i);
		}
		for($i = 0; $i < count($data_poster_url_poster_320_arr); $i++) {
			download_image($data_poster_url_poster_320_arr[$i], $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/poster_320/' . $i);
		}

		download_image($data_foto_url_foto_640_arr[0], $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/foto_640/0');
		download_image($data_poster_url_poster_640_arr[0], $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/poster_640/0');
		download_image($profile_pic_url, $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/avatar/0');
	}

	?>
	
	<?
	$data_login_cache = explode('^dohuze^', file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/data_login_cache.txt'));
	//echo "<pre>data_login_cache: "; print_r($data_login_cache); echo "</pre>";
	if(count($data_login_cache) > 1) {
/* 		for($i = 0; $i < count($data_login_cache); $i++) {
			if(count(explode('full_name=', $data_login_cache[$i])) > 1)
				$arResult['cap'][full_name] = poisk_lev_prav__lev('full_name=', '^dohuze^', $data_login_cache[$i]);
			if(count(explode('external_url=', $data_login_cache[$i])) > 1)
				$arResult['cap'][external_url] = poisk_lev_prav__lev('external_url=', '^dohuze^', $data_login_cache[$i]);
			if(count(explode('biography=', $data_login_cache[$i])) > 1)
				$arResult['cap'][biography] = poisk_lev_prav__lev('biography=', '^dohuze^', $data_login_cache[$i]);
			if(count(explode('profile_pic_url=', $data_login_cache[$i])) > 1)
				$arResult['cap'][profile_pic_url] = poisk_lev_prav__lev('profile_pic_url=', '^dohuze^', $data_login_cache[$i]);
			if(count(explode('username=', $data_login_cache[$i])) > 1)
				$arResult['cap'][username] = poisk_lev_prav__lev('username=', '^dohuze^', $data_login_cache[$i]);
			if(count(explode('edge_owner_to_timeline_media=', $data_login_cache[$i])) > 1)
				$arResult['cap'][edge_owner_to_timeline_media] = poisk_lev_prav__lev('edge_owner_to_timeline_media=', '^dohuze^', $data_login_cache[$i]);
			if(count(explode('edge_followed_by=', $data_login_cache[$i])) > 1)
				$arResult['cap'][edge_followed_by] = poisk_lev_prav__lev('edge_followed_by=', '^dohuze^', $data_login_cache[$i]);
			if(count(explode('edge_follow=', $data_login_cache[$i])) > 1)
				$arResult['cap'][edge_follow] = poisk_lev_prav__lev('edge_follow=', '^dohuze^', $data_login_cache[$i]);
		} */
/* 		if($arParams['IS_TOKEN_USED'] == 'N') {
			for($i = 0; $i < count($data_login_cache); $i++) {
				if(count(explode('display_url=', $data_login_cache[$i])) > 1)
					$arResult[fotos][data_foto_display_url_arr][] = poisk_lev_prav__lev('display_url=', '^dohuze^', $data_login_cache[$i]);
				if(count(explode('taken_at_timestamp=', $data_login_cache[$i])) > 1)
					$arResult[fotos][data_foto_taken_at_timestamp_arr][] = date('d.m.Y', poisk_lev_prav__lev('taken_at_timestamp=', '^dohuze^', $data_login_cache[$i]));
				if(count(explode('shortcode=', $data_login_cache[$i])) > 1)
					$arResult[fotos][data_foto_shortcode_arr][] = 'https://www.instagram.com/p/' . poisk_lev_prav__lev('shortcode=', '^dohuze^', $data_login_cache[$i]);
				
				if(count(explode('url_foto_320=', $data_login_cache[$i])) > 1)
					$arResult[fotos][data_foto_url_foto_320_arr][] = "https://www.instagram.com/p/" . poisk_lev_prav__lev('url_foto_320=', '^dohuze^', $data_login_cache[$i]) . '/';
				if(count(explode('url_foto_640=', $data_login_cache[$i])) > 1)
					$arResult[fotos][data_foto_url_foto_640_arr][] = poisk_lev_prav__lev('url_foto_640=', '^dohuze^', $data_login_cache[$i]);
				
				if(count(explode('url_poster_320=', $data_login_cache[$i])) > 1)
					$arResult[posters][data_poster_url_poster_320_arr][] = "https://www.instagram.com/p/" . poisk_lev_prav__lev('url_poster_320=', '^dohuze^', $data_login_cache[$i]) . '/';

				if(count(explode('url_poster_640=', $data_login_cache[$i])) > 1)
					$arResult[posters][data_poster_url_poster_640_arr][] = poisk_lev_prav__lev('url_poster_640=', '^dohuze^', $data_login_cache[$i]);
				
				if(count(explode('__typename=', $data_login_cache[$i])) > 1)
					$arResult[fotos][media_type_arr][] = poisk_lev_prav__lev('__typename=', '^dohuze^', $data_login_cache[$i]);
				
				
				if(count(explode('text_foto=', $data_login_cache[$i])) > 1) {
					$str = poisk_lev_prav__lev('text_foto=', '^dohuze^', $data_login_cache[$i]);
					//$arResult[fotos][data_foto_text_foto_arr][] = (LANG_CHARSET == 'UTF-8') ? $str : mb_convert_encoding($str, "windows-1251");
					$arResult[fotos][data_foto_text_foto_arr][] = mbCutString($str, $arParams[MESSAGE_SIZE], $postfix=' ...', $encoding='UTF-8');
				}
			}
		} */
	}

	echo '<pre>image_url: '; print_r($image_url); echo '</pre>';
	echo '<pre>path: '; print_r($path); echo '</pre>';
	//sleep(0.5);

<?
		$str_file = "type_get_instagram=" . "json_stroka" . "^dohuze^";
		$str_file .= "full_name=" . $json_arr[graphql][user][full_name] . "^dohuze^";
		$str_file .= "external_url=" . $json_arr[graphql][user][external_url] . "^dohuze^";
		$str_file .= "biography=" . $json_arr[graphql][user][biography] . "^dohuze^";
		$str_file .= "profile_pic_url=" . $json_arr[graphql][user][profile_pic_url] . "^dohuze^";
		$str_file .= "username=" . $json_arr[graphql][user][username] . "^dohuze^";
		$str_file .= "edge_owner_to_timeline_media=" . $json_arr[graphql][user][edge_owner_to_timeline_media][count] . "^dohuze^";
		$str_file .= "edge_followed_by=" . $json_arr[graphql][user][edge_followed_by][count] . "^dohuze^";
		$str_file .= "edge_follow=" . $json_arr[graphql][user][edge_follow][count] . "^dohuze^";
		
		foreach($json_arr[graphql][user][edge_owner_to_timeline_media][edges] as $key => $value) {
			$v = $value[node];
			//echo '<pre>v: '; print_r($v); echo '</pre>';
			
			if($v[__typename] == 'GraphVideo') {
				$url_foto_320 = $v[video_url];
			} else {
				$url_foto_320 = (!empty($v[thumbnail_resources][2][src]))?$v[thumbnail_resources][2][src]:'';
			}
			
			if($v[__typename] == 'GraphVideo') {
				$url_foto_640 = $v[video_url];
			} else {
				$url_foto_640 = (!empty($v[thumbnail_resources][4][src]))?$v[thumbnail_resources][4][src]:$v.display_url;
			}
			
			$poster_320 = (!empty($v[thumbnail_resources][2][src]))?$v[thumbnail_resources][2][src]:'';
			$poster_640 = (!empty($v[thumbnail_resources][4][src]))?$v[thumbnail_resources][4][src]:$v.display_url;
			
			$str_file .= "display_url=" . $v[display_url] . "^dohuze^";
			$str_file .= "taken_at_timestamp=" . $v[taken_at_timestamp] . "^dohuze^";
			$str_file .= "shortcode=" . $v[shortcode] . "^dohuze^";
			$str_file .= "url_foto_320=" . $url_foto_320 . "^dohuze^";
			$str_file .= "url_foto_640=" . $url_foto_640 . "^dohuze^";
			$str_file .= "url_poster_320=" . $poster_320 . "^dohuze^";
			$str_file .= "url_poster_640=" . $poster_640 . "^dohuze^";
			$str_file .= "text_foto=" . $v[edge_media_to_caption][edges][0][node][text] . "^dohuze^";
			$str_file .= "__typename=" . $v[__typename] . "^dohuze^";
		}
		//echo '<pre>str_file: '; print_r($str_file); echo '</pre>';
		$headers = stream_context_create(array(
			'http' =>	array(
							'method' 	=> 'POST',
							'header' 	=> 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
							'content' 	=> 'str=' .urlencode($str_file). '&file_name=data_login_cache.txt'
						)
		));
		$rez = file_get_contents('http://' . $_SERVER["SERVER_NAME"] . '/include/dohuze/handler_ajax.php?id_component=' . $arResult['ID_COMPONENT'], false, $headers);
		//$rez = file_get_contents(siteURL() . $componentPath . '/handler_ajax.php?id_component=' . $arResult['ID_COMPONENT'], false, $headers);
		//echo '<pre>http_response_header: '.print_r($http_response_header, true).'</pre>';
		echo '<script>console.log("' .siteURL() . $componentPath . '/handler_ajax.php?id_component=' . $arResult['ID_COMPONENT']. '")</script>';
		echo '<script>console.log("' .'http://' . $_SERVER["SERVER_NAME"] . '/include/dohuze/handler_ajax.php?id_component=' . $arResult['ID_COMPONENT']. '")</script>';
		if($rez === FALSE) {
			echo '<script>console.log("Handle error: ' . __FILE__ .', '. __LINE__ . '")</script>';
			if(count($http_response_header) > 0) {
				$arResult['ERRORS'][] = 'Server response headers:';
				foreach($http_response_header as $v) {
					$arResult['ERRORS'][] = '---> ' . $v;
				}
			}
		} else {
			echo '<script>console.log("' .$rez. '")</script>';
			echo '<script>console.log("======================================================== /instagram component (json_file) =================================================================")</script>';
		}
?>




		

			echo '<pre>url_foto_320: '; print_r($url_foto_320); echo '</pre>';
			echo '<pre>url_foto_640: '; print_r($url_foto_640); echo '</pre>';
			echo '<pre>poster_320: '; print_r($poster_320); echo '</pre>';
			echo '<pre>poster_640: '; print_r($poster_640); echo '</pre>';

		$headers = stream_context_create(array(
			'http' =>	array(
							'user_agent' => 'Mozilla/5.0',
							'ignore_errors' => true,
							'method' 	=> 'POST',
							'header' 	=> 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
							'content' 	=> 'str=' .urlencode($str_file). '&file_name=data_login_cache.txt'
						)
		));
		$rez = file_get_contents('http://' . $_SERVER["SERVER_NAME"] . '/include/dohuze/handler_ajax.php', false, $headers);
		//echo '<pre>http_response_header: '.print_r($http_response_header, true).'</pre>';
		echo '<script>console.log("' .'http://' . $_SERVER["SERVER_NAME"] . '/include/dohuze/handler_ajax.php?id_component=' . $arResult['ID_COMPONENT']. '")</script>';
		if($rez === FALSE) {
			echo '<script>console.log("Handle error: ' . __FILE__ .', '. __LINE__ . '")</script>';
			if(count($http_response_header) > 0) {
				$arResult['ERRORS'][] = 'Server response headers:';
				foreach($http_response_header as $v) {
					$arResult['ERRORS'][] = '---> ' . $v;
				}
			}
		} else {
			echo '<script>console.log("' .$rez. '")</script>';
			echo '<script>console.log("======================================================== /instagram component (json_file) =================================================================")</script>';
		}
		
		

		$headers = stream_context_create(array(
			'http' =>	array(
							'method' 	=> 'POST',
							'header' 	=> 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
							'content' 	=> 'str=' .urlencode($str_file). '&file_name=data_login_cache.txt'
						)
		));
		$rez = file_get_contents('http://' . $_SERVER["SERVER_NAME"] . '/include/dohuze/handler_ajax.php?id_component=' . $arResult['ID_COMPONENT'], false, $headers);
		//echo '<pre>http_response_header: '.print_r($http_response_header, true).'</pre>';
		echo '<script>console.log("' .'http://' . $_SERVER["SERVER_NAME"] . '/include/dohuze/handler_ajax.php?id_component=' . $arResult['ID_COMPONENT']. '")</script>';
		if($rez === FALSE) {
			echo '<script>console.log("Handle error: ' . __FILE__ .', '. __LINE__ . '")</script>';
			if(count($http_response_header) > 0) {
				$arResult['ERRORS'][] = 'Server response headers:';
				foreach($http_response_header as $v) {
					$arResult['ERRORS'][] = '---> ' . $v;
				}
			}
		} else {
			echo '<script>console.log("' .$rez. '")</script>';
			echo '<script>console.log("======================================================== /instagram component (json_file) =================================================================")</script>';
		}


 && $arCurrentValues['IS_JSON_STRING'] == 'Y'
 
 		//if(time() - file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/time_token.txt') > $arParams['TOKEN_AUTO_TIME']) {

<?
$time_start = microtime(true);

if(empty($_GET["id_component"]))
	die('ERROR $_GET["id_component"]');
	
function poisk_lev_prav__lev($lev, $prav, $stroka) {
    $razbien_array = explode($lev, $stroka);
	//print_r($razbien_array);
    $razbien_array_1 = explode($prav, $razbien_array[1]);
    $iskom_stroka = trim($razbien_array_1[0]);
    return $iskom_stroka;
}

function download_image($image_url) {
	// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $image_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_WRITEFUNCTION, "curl_callback");
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
	curl_setopt($ch, CURLOPT_TIMEOUT, 3000);
	$headers = array();
	$headers[] = 'Authority: scontent-arn2-1.cdninstagram.com';
	$headers[] = 'Sec-Ch-Ua: \" Not;A Brand\";v=\"99\", \"Google Chrome\";v=\"97\", \"Chromium\";v=\"97\"';
	$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
	$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
	$headers[] = 'Upgrade-Insecure-Requests: 1';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
	$headers[] = 'Sec-Fetch-Site: none';
	$headers[] = 'Sec-Fetch-Mode: navigate';
	$headers[] = 'Sec-Fetch-User: ?1';
	$headers[] = 'Sec-Fetch-Dest: document';
	$headers[] = 'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
}

function curl_callback($ch, $bytes){
    global $fp;
    $len = fwrite($fp, $bytes);
    return $len;
}

if(isset($_POST["file_name"]) && isset($_POST["str"])) {
	file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/' . $_POST["file_name"], $_POST["str"]);
	file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/time_cache.txt', time());
}

$data_arr_post = explode('^dohuze^', $_POST["str"]);
if(count(explode('type_get_instagram=', $data_arr_post[0])) > 1) {
	list(,$type_get_instagram) = explode('=', $data_arr_post[0]);
}

if($type_get_instagram == 'json_stroka') {
	for($i = 1; $i < count($data_arr_post); $i++) {
		if(count(explode('profile_pic_url=', $data_arr_post[$i])) > 1)
			$profile_pic_url = poisk_lev_prav__lev('profile_pic_url=', '^dohuze^', $data_arr_post[$i]);
		if(count(explode('url_foto_320=', $data_arr_post[$i])) > 1)
			$data_foto_url_foto_320_arr[] = poisk_lev_prav__lev('url_foto_320=', '^dohuze^', $data_arr_post[$i]);
		if(count(explode('url_foto_640=', $data_arr_post[$i])) > 1)
			$data_foto_url_foto_640_arr[] = poisk_lev_prav__lev('url_foto_640=', '^dohuze^', $data_arr_post[$i]);
		if(count(explode('url_poster_320=', $data_arr_post[$i])) > 1)
			$data_poster_url_poster_320_arr[] = poisk_lev_prav__lev('url_poster_320=', '^dohuze^', $data_arr_post[$i]);
		if(count(explode('url_poster_640=', $data_arr_post[$i])) > 1)
			$data_poster_url_poster_640_arr[] = poisk_lev_prav__lev('url_poster_640=', '^dohuze^', $data_arr_post[$i]);
	}

	for($i = 0; $i < count($data_foto_url_foto_320_arr); $i++) {
		$fp = fopen($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/foto_320/' . $i, "w+");
		download_image($data_foto_url_foto_320_arr[$i]);
		fclose($fp);
	}
	for($i = 0; $i < count($data_poster_url_poster_320_arr); $i++) {
		$fp = fopen($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/poster_320/' . $i, "w+");
		download_image($data_poster_url_poster_320_arr[$i]);
		fclose($fp);
	}


	$fp = fopen($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/foto_640/0', "w+");
	download_image($data_foto_url_foto_640_arr[0]);
	fclose($fp);
	$fp = fopen($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/poster_640/0', "w+");
	download_image($data_poster_url_poster_640_arr[0]);
	fclose($fp);

	$fp = fopen($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/avatar/0', "w+");
	download_image($profile_pic_url);
	fclose($fp);
}

if($type_get_instagram == 'token') {
	for($i = 1; $i < count($data_arr_post); $i++) {
		if(count(explode('media_url=', $data_arr_post[$i])) > 1)
			$media_url_arr[] = poisk_lev_prav__lev('media_url=', '^dohuze^', $data_arr_post[$i]);
	}
	for($i = 0; $i < count($media_url_arr); $i++) {
		$fp = fopen($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/foto_po_tokenu/' . $i, "w+");
		download_image($media_url_arr[$i]);
		fclose($fp);
	}
}


$time_end = microtime(true);
$time = $time_end - $time_start;

echo "handler_ajax.php: обработчик работал $time секунд";
?>

	//mail('cron@clementin.ru', $image_url, ''); die();
/* 	$headers = array (
		"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*;q=0.8",
		"Accept-Language: ru,en-us;q=0.7,en;q=0.3",
		"Accept-Charset: windows-1251, utf-8;q=0.7,*;q=0.7"
	); */
    $ch = curl_init($image_url);
	mail();
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3000);
	//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; chromeframe/12.0.742.112)");
	//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	//curl_setopt($ch, CURLOPT_REFERER, "http://ya.ru");
	//curl_setopt($ch, CURLOPT_COOKIEFILE, $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/cookies/' . md5($_SERVER["REMOTE_ADDR"]) . ".txt");
	//curl_setopt($ch, CURLOPT_COOKIEJAR,  $_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_' . $_GET["id_component"] . '/cookies/' . md5($_SERVER["REMOTE_ADDR"]) . ".txt");
	curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_WRITEFUNCTION, "curl_callback");
    curl_exec($ch);
    curl_close($ch);


	echo '<pre>: '; print_r($_SERVER['DOCUMENT_ROOT'] . '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/time_cache.txt'); echo '</pre>';
	echo '<pre>time_cache: '; print_r($time_cache); echo '</pre>';



	<?if( isset($arParams['INSTAGRAM_LOGIN']) && $arParams['IS_TOKEN_USED'] == 'N' && $arParams['IS_JSON_STRING'] == 'N' && (time() - $time_cache > $arParams['MIN_TC']) ):?>
		<?$arResult[type_get_instagram] = 'login'?>
		<script>
			console.log("ZAPROS PO LOGINU");
			let promise_<?=$arResult['ID_COMPONENT']?> = new Promise((resolve, reject) => {
				var type_get_instagram = "login";
				var xhr_<?=$arResult['ID_COMPONENT']?> = new XMLHttpRequest();
				console.log("new XMLHttpRequest");
				xhr_<?=$arResult['ID_COMPONENT']?>.open("GET", 'https://www.instagram.com' + '/' + '<?= $arParams['INSTAGRAM_LOGIN'] ?>' + '/?__a=1', true);
				xhr_<?=$arResult['ID_COMPONENT']?>.setRequestHeader("Content-type", "text/plain");
				xhr_<?=$arResult['ID_COMPONENT']?>.send(null);
				if(xhr_<?=$arResult['ID_COMPONENT']?>.status == 200 && xhr_<?=$arResult['ID_COMPONENT']?>.readyState === 4) {
					console.log(xhr_<?=$arResult['ID_COMPONENT']?>.responseText);
					if(IsJsonString(xhr_<?=$arResult['ID_COMPONENT']?>.responseText)) {
						const result_xhr = JSON.parse(xhr_<?=$arResult['ID_COMPONENT']?>.responseText);
						//console.log(result_xhr);
						stroka_get_<?=$arResult['ID_COMPONENT']?> += "type_get_instagram=" + "login" + "^dohuze^";
						stroka_get_<?=$arResult['ID_COMPONENT']?> += "full_name=" + result_xhr.graphql.user.full_name + "^dohuze^";
						stroka_get_<?=$arResult['ID_COMPONENT']?> += "external_url=" + result_xhr.graphql.user.external_url + "^dohuze^";
						stroka_get_<?=$arResult['ID_COMPONENT']?> += "biography=" + result_xhr.graphql.user.biography + "^dohuze^";
						stroka_get_<?=$arResult['ID_COMPONENT']?> += "profile_pic_url=" + result_xhr.graphql.user.profile_pic_url + "^dohuze^";
						stroka_get_<?=$arResult['ID_COMPONENT']?> += "username=" + result_xhr.graphql.user.username + "^dohuze^";
						stroka_get_<?=$arResult['ID_COMPONENT']?> += "edge_owner_to_timeline_media=" + result_xhr.graphql.user.edge_owner_to_timeline_media.count + "^dohuze^";
						stroka_get_<?=$arResult['ID_COMPONENT']?> += "edge_followed_by=" + result_xhr.graphql.user.edge_followed_by.count + "^dohuze^";
						stroka_get_<?=$arResult['ID_COMPONENT']?> += "edge_follow=" + result_xhr.graphql.user.edge_follow.count + "^dohuze^";
						
						value = result_xhr.graphql.user.edge_owner_to_timeline_media.edges;
						
						for(key in value) {
							v = value[key].node
							//console.log(v.edge_media_to_caption.edges[0].node.shortcode);
							let text_foto = (v.edge_media_to_caption.edges[0] != undefined) ? v.edge_media_to_caption.edges[0].node.text : "";
							let url_foto_320 = (v.thumbnail_resources[2].src) ? v.thumbnail_resources[2].src : "";
							let url_foto_640 = (v.thumbnail_resources[4].src) ? v.thumbnail_resources[2].src : v.display_url;
							stroka_get_<?=$arResult['ID_COMPONENT']?> += "display_url=" + v.display_url + "^dohuze^";
							stroka_get_<?=$arResult['ID_COMPONENT']?> += "taken_at_timestamp=" + v.taken_at_timestamp + "^dohuze^";
							stroka_get_<?=$arResult['ID_COMPONENT']?> += "shortcode=" + v.shortcode + "^dohuze^";
							stroka_get_<?=$arResult['ID_COMPONENT']?> += "url_foto_320=" + url_foto_320 + "^dohuze^";
							stroka_get_<?=$arResult['ID_COMPONENT']?> += "url_foto_640=" + url_foto_640 + "^dohuze^";
							stroka_get_<?=$arResult['ID_COMPONENT']?> += "text_foto=" + text_foto + "^dohuze^";
						}
						itog = "Y1";
						resolve("OK");						
					} else {
						reject("ERROR: NO JSON");
						//alert("NO JSON, login");
					if(!isEmpty(err_proverka_tokena)) {
						document.getElementById("errors").innerHTML = document.getElementById("errors").innerHTML + err_proverka_tokena;
						//errors_array[0] = 
					}
					document.getElementById("errors").innerHTML = document.getElementById("errors").innerHTML + "<p>Error: no connection to Instagram<span style='display: none'>login</span></p>";
					}
				} else {
					console.log("status != 200 или readyState != 4");
				}

			});
		</script>
	<?endif?>
	
	
	<?if( (isset($arParams['INSTAGRAM_TOKEN']) && $arParams['IS_TOKEN_USED'] == 'Y')) && (time() - $time_cache > $arParams['MIN_TC']) && $arResult[type_get_instagram] != 'json_stroka' ):?>
		<script>
			promise_<?=$arResult['ID_COMPONENT']?>.then(
				result => {
					console.log("Fulfilled: " + result + " itog: " + itog + " ID_COMPONENT: " + '<?=$arResult['ID_COMPONENT']?>'); // result - argument resolve
					POST_AJAX_STRING_<?=$arResult['ID_COMPONENT']?>(stroka_get_<?=$arResult['ID_COMPONENT']?>, "data_<?=$arResult[type_get_instagram]?>_cache.txt");
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