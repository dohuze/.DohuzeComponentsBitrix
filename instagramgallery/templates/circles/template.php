<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
// echo "<pre>arParams: "; print_r($arParams); echo "</pre>";
// echo "<pre>arResult: "; print_r($arResult); echo "</pre>";
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<? if ($arResult["IS_MOBILE_DEVICE"] != "Y") : ?>
	<div class="instGallery">
		<div class="instGallery__headline" style="justify-content: <? if ($arResult["IS_CENTER_CAP"] == 0) : ?>flex-start<? elseif ($arResult["IS_CENTER_CAP"] == 1) : ?>center<? elseif ($arResult["IS_CENTER_CAP"] == 2) : ?>flex-end<? endif; ?>;">
			<? if ($arResult["INSTAGRAM_ICONKA"] == "Y") : ?><? echo htmlspecialchars_decode($arResult["INSTAGRAM_ICONKA_CODE"], ENT_HTML5); ?><? endif; ?><p class="instGallery__p" style="font-family: <?= $arResult[FONT_FAMILY_NAME] ?>, <?= $arResult[INSTAGRAM_FONT_STYLE] ?>;"><?= $arParams['BLOCK_TITLE'] ?></p>
		</div>
		<? if (!empty($arResult[ERRORS]) && $USER->IsAdmin()) : ?>
			<? foreach ($arResult[ERRORS] as $err) : ?>
				<div style="background-color: red; font-size: 32px; margin-bottom: 20px; padding-left: 5px;"><?= $err ?></div>
			<? endforeach ?>
		<? endif ?>

		<div id="errors" style="background-color: red; font-size: 32px; margin-bottom: 20px; padding-left: 5px;"></div>

		<? if ($arParams['IS_CAP'] == 'Y') : ?>
			<div class="instGallery__profile">
				<div class="instGallery__profile__photo">
					<a id="instGallery__profile__photo_tag_a" href="https://www.instagram.com/<?= $arResult[cap][username] ?>/" target="_blank">
						<img id="instGallery__profile__photo_avatarka" src="/include/dohuze/instagram_<?= $arResult['cap']['id_component_login'] ?>/avatar/0">
					</a>
				</div>

				<div class="instGallery__profile__text">
					<a id="full_name" href="https://www.instagram.com/<?= $arResult[cap][username] ?>/" target="_blank"><?= $arResult[cap][full_name] ?></a>

					<div class="instGallery__profile__text__date">
						<div class="instGallery__profile__text__date__block">
							<p><span id="edge_owner_to_timeline_media"><?= $arResult[cap][edge_owner_to_timeline_media] ?></span> публикаций</p>
						</div>

						<div class="instGallery__profile__text__date__block">
							<p><span id="edge_followed_by"><?= $arResult[cap][edge_followed_by] ?></span> подписчиков</p>
						</div>

						<div class="instGallery__profile__text__date__block">
							<p><span id="edge_follow"><?= $arResult[cap][edge_follow] ?></span> подписок</p>
						</div>
					</div>

					<p id="biography"><?= $arResult[cap][biography] ?></p>
				</div>
			</div>
		<? endif; ?>

		<div class="instGallery__img">
			<? for ($i = 0; $i < $arResult[count_foto]; $i++) : ?>
				<? if ($i < 4) : ?>
					<? if ($arResult[fotos][media_type_arr][$i] == "GraphVideo" || $arResult[fotos][media_type_arr][$i] == "VIDEO") : ?>
						<a id="a_<?= $i ?>" class="instGallery__img_nopoint">
							<video class="videoInst" src="/include/dohuze/instagram_<?= $arResult['ID_COMPONENT'] ?>/<?= $arResult[fotos][dir_foto][$i] ?>/<?= $i ?>" controlsList="nodownload" disablePictureInPicture></video>
							<button class="playVideoInst">
								<img src="<?= $templateFolder ?>/img/play2.png" alt="">
							</button>
							<!-- eсли светлый вид, то дополнительно прописываем класс instGallery__likeWhite -->

							<!-- eсли выбрано расположение сверху,то дополнительно прописываем класс instGallery__likeTop -->

							<div class="instGallery__like">
								<svg viewBox="0 -28 512.001 512" xmlns="http://www.w3.org/2000/svg">
									<path d="m256 455.515625c-7.289062 0-14.316406-2.640625-19.792969-7.4375-20.683593-18.085937-40.625-35.082031-58.21875-50.074219l-.089843-.078125c-51.582032-43.957031-96.125-81.917969-127.117188-119.3125-34.644531-41.804687-50.78125-81.441406-50.78125-124.742187 0-42.070313 14.425781-80.882813 40.617188-109.292969 26.503906-28.746094 62.871093-44.578125 102.414062-44.578125 29.554688 0 56.621094 9.34375 80.445312 27.769531 12.023438 9.300781 22.921876 20.683594 32.523438 33.960938 9.605469-13.277344 20.5-24.660157 32.527344-33.960938 23.824218-18.425781 50.890625-27.769531 80.445312-27.769531 39.539063 0 75.910156 15.832031 102.414063 44.578125 26.191406 28.410156 40.613281 67.222656 40.613281 109.292969 0 43.300781-16.132812 82.9375-50.777344 124.738281-30.992187 37.398437-75.53125 75.355469-127.105468 119.308594-17.625 15.015625-37.597657 32.039062-58.328126 50.167969-5.472656 4.789062-12.503906 7.429687-19.789062 7.429687zm-112.96875-425.523437c-31.066406 0-59.605469 12.398437-80.367188 34.914062-21.070312 22.855469-32.675781 54.449219-32.675781 88.964844 0 36.417968 13.535157 68.988281 43.882813 105.605468 29.332031 35.394532 72.960937 72.574219 123.476562 115.625l.09375.078126c17.660156 15.050781 37.679688 32.113281 58.515625 50.332031 20.960938-18.253907 41.011719-35.34375 58.707031-50.417969 50.511719-43.050781 94.136719-80.222656 123.46875-115.617188 30.34375-36.617187 43.878907-69.1875 43.878907-105.605468 0-34.515625-11.605469-66.109375-32.675781-88.964844-20.757813-22.515625-49.300782-34.914062-80.363282-34.914062-22.757812 0-43.652344 7.234374-62.101562 21.5-16.441406 12.71875-27.894532 28.796874-34.609375 40.046874-3.453125 5.785157-9.53125 9.238282-16.261719 9.238282s-12.808594-3.453125-16.261719-9.238282c-6.710937-11.25-18.164062-27.328124-34.609375-40.046874-18.449218-14.265626-39.34375-21.5-62.097656-21.5zm0 0"></path>
								</svg>
								<span>10</span>

								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
									<path d="M401.625,325.125h-191.25c-10.557,0-19.125,8.568-19.125,19.125s8.568,19.125,19.125,19.125h191.25 c10.557,0,19.125-8.568,19.125-19.125S412.182,325.125,401.625,325.125z M439.875,210.375h-267.75 c-10.557,0-19.125,8.568-19.125,19.125s8.568,19.125,19.125,19.125h267.75c10.557,0,19.125-8.568,19.125-19.125 S450.432,210.375,439.875,210.375z M306,0C137.012,0,0,119.875,0,267.75c0,84.514,44.848,159.751,114.75,208.826V612 l134.047-81.339c18.552,3.061,37.638,4.839,57.203,4.839c169.008,0,306-119.875,306-267.75C612,119.875,475.008,0,306,0z M306,497.25c-22.338,0-43.911-2.601-64.643-7.019l-90.041,54.123l1.205-88.701C83.5,414.133,38.25,345.513,38.25,267.75 c0-126.741,119.875-229.5,267.75-229.5c147.875,0,267.75,102.759,267.75,229.5S453.875,497.25,306,497.25z"></path>
								</svg>
								<span>11</span>
							</div>
						</a>
					<? else : ?>
						<a data-test="<?= $arResult[fotos][media_type_arr][$i] ?>" id="a_<?= $i ?>" href="<?= $arResult[fotos][data_foto_shortcode_arr][$i] ?>" style="background-image: url(&quot;/include/dohuze/instagram_<?= $arResult['ID_COMPONENT'] ?>/<?= $arResult[fotos][dir_foto][$i] ?>/<?= $i ?>&quot;);" target="_blank">
							<div class="instGallery__img__block">
								<p class="instagram-vidget__description instagram-vidget__date"><?= $arResult[fotos][data_foto_taken_at_timestamp_arr][$i] ?></p>
								<p class="mess"><?= $arResult[fotos][data_foto_text_foto_arr][$i] ?></p>
							</div>
							<!-- eсли светлый вид, то дополнительно прописываем класс instGallery__likeWhite -->

							<!-- eсли выбрано расположение сверху,то дополнительно прописываем класс instGallery__likeTop -->

							<div class="instGallery__like">
								<svg viewBox="0 -28 512.001 512" xmlns="http://www.w3.org/2000/svg">
									<path d="m256 455.515625c-7.289062 0-14.316406-2.640625-19.792969-7.4375-20.683593-18.085937-40.625-35.082031-58.21875-50.074219l-.089843-.078125c-51.582032-43.957031-96.125-81.917969-127.117188-119.3125-34.644531-41.804687-50.78125-81.441406-50.78125-124.742187 0-42.070313 14.425781-80.882813 40.617188-109.292969 26.503906-28.746094 62.871093-44.578125 102.414062-44.578125 29.554688 0 56.621094 9.34375 80.445312 27.769531 12.023438 9.300781 22.921876 20.683594 32.523438 33.960938 9.605469-13.277344 20.5-24.660157 32.527344-33.960938 23.824218-18.425781 50.890625-27.769531 80.445312-27.769531 39.539063 0 75.910156 15.832031 102.414063 44.578125 26.191406 28.410156 40.613281 67.222656 40.613281 109.292969 0 43.300781-16.132812 82.9375-50.777344 124.738281-30.992187 37.398437-75.53125 75.355469-127.105468 119.308594-17.625 15.015625-37.597657 32.039062-58.328126 50.167969-5.472656 4.789062-12.503906 7.429687-19.789062 7.429687zm-112.96875-425.523437c-31.066406 0-59.605469 12.398437-80.367188 34.914062-21.070312 22.855469-32.675781 54.449219-32.675781 88.964844 0 36.417968 13.535157 68.988281 43.882813 105.605468 29.332031 35.394532 72.960937 72.574219 123.476562 115.625l.09375.078126c17.660156 15.050781 37.679688 32.113281 58.515625 50.332031 20.960938-18.253907 41.011719-35.34375 58.707031-50.417969 50.511719-43.050781 94.136719-80.222656 123.46875-115.617188 30.34375-36.617187 43.878907-69.1875 43.878907-105.605468 0-34.515625-11.605469-66.109375-32.675781-88.964844-20.757813-22.515625-49.300782-34.914062-80.363282-34.914062-22.757812 0-43.652344 7.234374-62.101562 21.5-16.441406 12.71875-27.894532 28.796874-34.609375 40.046874-3.453125 5.785157-9.53125 9.238282-16.261719 9.238282s-12.808594-3.453125-16.261719-9.238282c-6.710937-11.25-18.164062-27.328124-34.609375-40.046874-18.449218-14.265626-39.34375-21.5-62.097656-21.5zm0 0"></path>
								</svg>
								<span>10</span>

								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
									<path d="M401.625,325.125h-191.25c-10.557,0-19.125,8.568-19.125,19.125s8.568,19.125,19.125,19.125h191.25 c10.557,0,19.125-8.568,19.125-19.125S412.182,325.125,401.625,325.125z M439.875,210.375h-267.75 c-10.557,0-19.125,8.568-19.125,19.125s8.568,19.125,19.125,19.125h267.75c10.557,0,19.125-8.568,19.125-19.125 S450.432,210.375,439.875,210.375z M306,0C137.012,0,0,119.875,0,267.75c0,84.514,44.848,159.751,114.75,208.826V612 l134.047-81.339c18.552,3.061,37.638,4.839,57.203,4.839c169.008,0,306-119.875,306-267.75C612,119.875,475.008,0,306,0z M306,497.25c-22.338,0-43.911-2.601-64.643-7.019l-90.041,54.123l1.205-88.701C83.5,414.133,38.25,345.513,38.25,267.75 c0-126.741,119.875-229.5,267.75-229.5c147.875,0,267.75,102.759,267.75,229.5S453.875,497.25,306,497.25z"></path>
								</svg>
								<span>11</span>
							</div>
						</a>
					<? endif; ?>
				<? endif; ?>
			<? endfor ?>
		</div>
	</div>
<? endif; ?>

<? if ($arResult["IS_MOBILE_DEVICE"] == "Y") : ?>
	<section class="instagram-vidget">
		<div class='container'>
			<div class="instagram-vidget__container">
				<div class="instagram-vidget__title">
					<div class="instGallery__headline" style="justify-content: <? if ($arResult["IS_CENTER_CAP"] == 0) : ?>flex-start<? elseif ($arResult["IS_CENTER_CAP"] == 1) : ?>center<? elseif ($arResult["IS_CENTER_CAP"] == 2) : ?>flex-end<? endif; ?>;">
						<? if ($arResult["INSTAGRAM_ICONKA"] == "Y") : ?><? echo htmlspecialchars_decode($arResult["INSTAGRAM_ICONKA_CODE"], ENT_HTML5); ?><? endif; ?><p class="instGallery__p" style="font-family: <?= $arResult[FONT_FAMILY_NAME] ?>, <?= $arResult[INSTAGRAM_FONT_STYLE] ?>;"><?= $arParams['BLOCK_TITLE'] ?></p>
					</div>
					<? if ($USER->IsAdmin()) : ?><div id="errors" style="background-color: red; font-size: 32px; margin-bottom: 20px; padding-left: 5px;"><?= $arResult[ERRORS] ?></div><? endif ?>

					<? if ($arParams['IS_CAP'] == 'Y') : ?>
						<div class="instGallery__profile">
							<div class="instGallery__profile__photo">
								<a id="instGallery__profile__photo_tag_a" href="https://www.instagram.com/<?= $arResult[cap][username] ?>/" target="_blank">
									<img id="instGallery__profile__photo_avatarka" src="/include/dohuze/instagram_<?= $arResult['ID_COMPONENT'] ?>/avatar/0">
								</a>
							</div>

							<div class="instGallery__profile__text">
								<a id="full_name" href="https://www.instagram.com/<?= $arResult[cap][username] ?>/" target="_blank"><?= $arResult[cap][full_name] ?></a>

								<div class="instGallery__profile__text__date">
									<div class="instGallery__profile__text__date__block">
										<p><span id="edge_owner_to_timeline_media"><?= $arResult[cap][edge_owner_to_timeline_media] ?></span> публикаций</p>
									</div>

									<div class="instGallery__profile__text__date__block">
										<p><span id="edge_followed_by"><?= $arResult[cap][edge_followed_by] ?></span> подписчиков</p>
									</div>

									<div class="instGallery__profile__text__date__block">
										<p><span id="edge_follow"><?= $arResult[cap][edge_follow] ?></span> подписок</p>
									</div>
								</div>

								<p id="biography"><?= $arResult[cap][biography] ?></p>
							</div>
						</div>
					<? endif; ?>
				</div>
				<div class="instagram-vidget__slider">
					<? for ($i = 0; $i < $arResult[count_foto]; $i++) : ?>
						<div id="instagram-vidget__slider_<?= $i ?>">
							<? if ($arResult[fotos][media_type_arr][$i] == "GraphVideo" || $arResult[fotos][media_type_arr][$i] == "VIDEO") : ?>
								<? $poster = (!empty($arResult[fotos][thumbnail_url][$i]) && $arResult[type_get_instagram] == 'token') ? $arResult[fotos][thumbnail_url][$i] : '/include/dohuze/instagram_' . $arResult['ID_COMPONENT'] . '/poster_320/' . $i ?>
								<a id="a_<?= $i ?>" class="instGallery__img_nopoint instagram-vidget__item">
									<video class="videoInst" poster="<?= $poster ?>" controlsList="nodownload" disablePictureInPicture>
										<source src="/include/dohuze/instagram_<?= $arResult['ID_COMPONENT'] ?>/<?= $arResult[fotos][dir_foto][$i] ?>/<?= $i ?>" type="video/mp4">
									</video>
									<button class="playVideoInst">
										<img src="<?= $templateFolder ?>/img/play2.png" alt="">
									</button>
									<!-- eсли светлый вид, то дополнительно прописываем класс instGallery__likeWhite -->

									<!-- eсли выбрано расположение сверху,то дополнительно прописываем класс instGallery__likeTop -->

									<div class="instGallery__like">
										<svg viewBox="0 -28 512.001 512" xmlns="http://www.w3.org/2000/svg">
											<path d="m256 455.515625c-7.289062 0-14.316406-2.640625-19.792969-7.4375-20.683593-18.085937-40.625-35.082031-58.21875-50.074219l-.089843-.078125c-51.582032-43.957031-96.125-81.917969-127.117188-119.3125-34.644531-41.804687-50.78125-81.441406-50.78125-124.742187 0-42.070313 14.425781-80.882813 40.617188-109.292969 26.503906-28.746094 62.871093-44.578125 102.414062-44.578125 29.554688 0 56.621094 9.34375 80.445312 27.769531 12.023438 9.300781 22.921876 20.683594 32.523438 33.960938 9.605469-13.277344 20.5-24.660157 32.527344-33.960938 23.824218-18.425781 50.890625-27.769531 80.445312-27.769531 39.539063 0 75.910156 15.832031 102.414063 44.578125 26.191406 28.410156 40.613281 67.222656 40.613281 109.292969 0 43.300781-16.132812 82.9375-50.777344 124.738281-30.992187 37.398437-75.53125 75.355469-127.105468 119.308594-17.625 15.015625-37.597657 32.039062-58.328126 50.167969-5.472656 4.789062-12.503906 7.429687-19.789062 7.429687zm-112.96875-425.523437c-31.066406 0-59.605469 12.398437-80.367188 34.914062-21.070312 22.855469-32.675781 54.449219-32.675781 88.964844 0 36.417968 13.535157 68.988281 43.882813 105.605468 29.332031 35.394532 72.960937 72.574219 123.476562 115.625l.09375.078126c17.660156 15.050781 37.679688 32.113281 58.515625 50.332031 20.960938-18.253907 41.011719-35.34375 58.707031-50.417969 50.511719-43.050781 94.136719-80.222656 123.46875-115.617188 30.34375-36.617187 43.878907-69.1875 43.878907-105.605468 0-34.515625-11.605469-66.109375-32.675781-88.964844-20.757813-22.515625-49.300782-34.914062-80.363282-34.914062-22.757812 0-43.652344 7.234374-62.101562 21.5-16.441406 12.71875-27.894532 28.796874-34.609375 40.046874-3.453125 5.785157-9.53125 9.238282-16.261719 9.238282s-12.808594-3.453125-16.261719-9.238282c-6.710937-11.25-18.164062-27.328124-34.609375-40.046874-18.449218-14.265626-39.34375-21.5-62.097656-21.5zm0 0"></path>
										</svg>
										<span>10</span>

										<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
											<path d="M401.625,325.125h-191.25c-10.557,0-19.125,8.568-19.125,19.125s8.568,19.125,19.125,19.125h191.25 c10.557,0,19.125-8.568,19.125-19.125S412.182,325.125,401.625,325.125z M439.875,210.375h-267.75 c-10.557,0-19.125,8.568-19.125,19.125s8.568,19.125,19.125,19.125h267.75c10.557,0,19.125-8.568,19.125-19.125 S450.432,210.375,439.875,210.375z M306,0C137.012,0,0,119.875,0,267.75c0,84.514,44.848,159.751,114.75,208.826V612 l134.047-81.339c18.552,3.061,37.638,4.839,57.203,4.839c169.008,0,306-119.875,306-267.75C612,119.875,475.008,0,306,0z M306,497.25c-22.338,0-43.911-2.601-64.643-7.019l-90.041,54.123l1.205-88.701C83.5,414.133,38.25,345.513,38.25,267.75 c0-126.741,119.875-229.5,267.75-229.5c147.875,0,267.75,102.759,267.75,229.5S453.875,497.25,306,497.25z"></path>
										</svg>
										<span>11</span>
									</div>
								</a>
							<? else : ?>
								<a class="instagram-vidget__item" href="<?= $arResult[fotos][data_foto_shortcode_arr][$i] ?>" target="_blank">
									<img class="instagram-vidget__image" src="/include/dohuze/instagram_<?= $arResult['ID_COMPONENT'] ?>/<?= $arResult[fotos][dir_foto][$i] ?>/<?= $i ?>" alt="<?= $arResult[fotos][data_foto_text_foto_arr][$i] ?>">
									<div class="instagram-vidget__description-container">
										<div class="instagram-vidget__description-text">
											<p class="instagram-vidget__description instagram-vidget__date"><?= $arResult[fotos][data_foto_taken_at_timestamp_arr][$i] ?></p>
											<p class="instagram-vidget__description"><?= $arResult[fotos][data_foto_text_foto_arr][$i] ?></p>
										</div>
									</div>
									<!-- eсли светлый вид, то дополнительно прописываем класс instGallery__likeWhite -->

									<!-- eсли выбрано расположение сверху,то дополнительно прописываем класс instGallery__likeTop -->

									<div class="instGallery__like">
										<svg viewBox="0 -28 512.001 512" xmlns="http://www.w3.org/2000/svg">
											<path d="m256 455.515625c-7.289062 0-14.316406-2.640625-19.792969-7.4375-20.683593-18.085937-40.625-35.082031-58.21875-50.074219l-.089843-.078125c-51.582032-43.957031-96.125-81.917969-127.117188-119.3125-34.644531-41.804687-50.78125-81.441406-50.78125-124.742187 0-42.070313 14.425781-80.882813 40.617188-109.292969 26.503906-28.746094 62.871093-44.578125 102.414062-44.578125 29.554688 0 56.621094 9.34375 80.445312 27.769531 12.023438 9.300781 22.921876 20.683594 32.523438 33.960938 9.605469-13.277344 20.5-24.660157 32.527344-33.960938 23.824218-18.425781 50.890625-27.769531 80.445312-27.769531 39.539063 0 75.910156 15.832031 102.414063 44.578125 26.191406 28.410156 40.613281 67.222656 40.613281 109.292969 0 43.300781-16.132812 82.9375-50.777344 124.738281-30.992187 37.398437-75.53125 75.355469-127.105468 119.308594-17.625 15.015625-37.597657 32.039062-58.328126 50.167969-5.472656 4.789062-12.503906 7.429687-19.789062 7.429687zm-112.96875-425.523437c-31.066406 0-59.605469 12.398437-80.367188 34.914062-21.070312 22.855469-32.675781 54.449219-32.675781 88.964844 0 36.417968 13.535157 68.988281 43.882813 105.605468 29.332031 35.394532 72.960937 72.574219 123.476562 115.625l.09375.078126c17.660156 15.050781 37.679688 32.113281 58.515625 50.332031 20.960938-18.253907 41.011719-35.34375 58.707031-50.417969 50.511719-43.050781 94.136719-80.222656 123.46875-115.617188 30.34375-36.617187 43.878907-69.1875 43.878907-105.605468 0-34.515625-11.605469-66.109375-32.675781-88.964844-20.757813-22.515625-49.300782-34.914062-80.363282-34.914062-22.757812 0-43.652344 7.234374-62.101562 21.5-16.441406 12.71875-27.894532 28.796874-34.609375 40.046874-3.453125 5.785157-9.53125 9.238282-16.261719 9.238282s-12.808594-3.453125-16.261719-9.238282c-6.710937-11.25-18.164062-27.328124-34.609375-40.046874-18.449218-14.265626-39.34375-21.5-62.097656-21.5zm0 0"></path>
										</svg>
										<span>10</span>

										<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="612px" height="612px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
											<path d="M401.625,325.125h-191.25c-10.557,0-19.125,8.568-19.125,19.125s8.568,19.125,19.125,19.125h191.25 c10.557,0,19.125-8.568,19.125-19.125S412.182,325.125,401.625,325.125z M439.875,210.375h-267.75 c-10.557,0-19.125,8.568-19.125,19.125s8.568,19.125,19.125,19.125h267.75c10.557,0,19.125-8.568,19.125-19.125 S450.432,210.375,439.875,210.375z M306,0C137.012,0,0,119.875,0,267.75c0,84.514,44.848,159.751,114.75,208.826V612 l134.047-81.339c18.552,3.061,37.638,4.839,57.203,4.839c169.008,0,306-119.875,306-267.75C612,119.875,475.008,0,306,0z M306,497.25c-22.338,0-43.911-2.601-64.643-7.019l-90.041,54.123l1.205-88.701C83.5,414.133,38.25,345.513,38.25,267.75 c0-126.741,119.875-229.5,267.75-229.5c147.875,0,267.75,102.759,267.75,229.5S453.875,497.25,306,497.25z"></path>
										</svg>
										<span>11</span>
									</div>
								</a>
							<? endif; ?>
						</div>
					<? endfor ?>
				</div>
			</div>
		</div>
	</section>
<? endif; ?>

<? if ($arResult["IS_MOBILE_DEVICE"] == "Y") : ?>
	<? CJSCore::Init(array('jquery')) ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" />

	<script>
		$(".instagram-vidget__slider").slick({
			arrows: true,
			infinite: false,
			speed: 300,
			slidesToShow: 2,
			slidesToScroll: 1,
		});
	</script>
<? endif; ?>

<style>
	.instagram-vidget__container .slick-prev:hover,
	.instagram-vidget__container .slick-next:hover {
		background-color: <?= $arParams["SLIDER_COLOR"] ?> !important;
	}
</style>

<? if ($arParams["IS_TEXT_VISIBLE"] == "N") : ?>
	<style>
		.instagram-vidget__description-container {
			position: unset;
			height: unset;
			background-color: #ffffff;
			color: #000000;
		}

		/* .slick-slide img{
			height: 260px;
		} */
		.instagram-vidget__item {
			background: #ffffff;
			height: unset;
			outline: none;
		}
	</style>
<? endif ?>

<? if ($arResult['count_foto'] > 0) : ?>
	<script>
		if (document.getElementById("a_0")) {
			let width = document.getElementById("a_0").offsetWidth;
			let size = width * 18 / 290;
			for (let el of document.getElementsByClassName("mess")) {
				el.style.fontSize = size + "px";
			}
			for (let el of document.getElementsByClassName("instagram-vidget__description")) {
				el.style.fontSize = size * <?= $arParams['FONT_PERCENT'] ?> + "px";
			}
		}
	</script>

	<script>
		if (document.querySelector(".instagram-vidget__item")) {
			let instWidth = document.querySelector(".instagram-vidget__item").offsetWidth;
			let instSize = instWidth * 18 / 290;

			for (let el of document.getElementsByClassName("instagram-vidget__description")) {
				el.style.fontSize = instSize + "px";
			}
			for (let el of document.getElementsByClassName("instagram-vidget__date")) {
				el.style.fontSize = instSize * <?= $arParams['FONT_PERCENT'] ?> + "px";
			}
		}
		if (document.querySelectorAll(".playVideoInst")) {
			let playVideo = document.querySelectorAll(".playVideoInst");
			let video = document.querySelectorAll(".videoInst");

			for (let i = 0; i < playVideo.length; i++) {
				playVideo[i].addEventListener("click", () => {
					playVideo[i].previousElementSibling.style.cursor = "pointer";
					playVideo[i].previousElementSibling.play();
					playVideo[i].style.display = "none";
				})
			}

			for (let i = 0; i < video.length; i++) {
				video[i].removeAttribute("autoplay");

				video[i].addEventListener("click", () => {
					console.log(1);
					if (getComputedStyle(video[i].nextElementSibling).getPropertyValue("display") == "none") {
						video[i].nextElementSibling.style.display = "block";
						video[i].style.cursor = "default";
						video[i].pause();
					}
				})
			}
		}
	</script>
<? endif ?>