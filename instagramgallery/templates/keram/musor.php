<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
echo '<pre>arParams: '; print_r($arParams); echo '</pre>';
echo '<pre>arResult: '; print_r($arResult); echo '</pre>';
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<? if ($arResult["IS_MOBILE_DEVICE"] != "Y") : ?>
	<div class="instGallery">
		<div class="instGallery__headline" style="justify-content: <? if ($arResult["IS_CENTER_CAP"] == 0) : ?>flex-start<? elseif ($arResult["IS_CENTER_CAP"] == 1) : ?>center<? elseif ($arResult["IS_CENTER_CAP"] == 2) : ?>flex-end<? endif; ?>;">
			<? if ($arResult["INSTAGRAM_ICONKA"] == "Y") : ?><?echo htmlspecialchars_decode($arResult["INSTAGRAM_ICONKA_CODE"], ENT_HTML5);?><? endif; ?><p class="instGallery__p" style="font-family: <?= $arResult[FONT_FAMILY_NAME] ?>, <?= $arResult[INSTAGRAM_FONT_STYLE] ?>;"><?= $arParams['BLOCK_TITLE'] ?></p>
		</div>
		<? if (!empty($arResult[ERRORS]) && $USER->IsAdmin()) : ?>
			<? foreach ($arResult[ERRORS] as $err) : ?>
				<div id="errors" style="background-color: red; font-size: 32px; margin-bottom: 20px; padding-left: 5px;"><?= $err ?></div>
			<? endforeach ?>
		<? endif ?>

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

		<div class="instGallery__img">
			<? for ($i = 0; $i < $arResult[count_foto]; $i++) : ?>
				<? if ($arResult[fotos][media_type_arr][$i] == "GraphVideo" || $arResult[fotos][media_type_arr][$i] == "VIDEO") : ?>
					<a id="a_<?= $i ?>" class="instGallery__img_nopoint">
						<video class="videoInst" src="/include/dohuze/instagram_<?= $arResult['ID_COMPONENT'] ?>/<?= $arResult[fotos][dir_foto][$i] ?>/<?= $i ?>" muted autoplay></video>
						<button class="playVideoInst">
							<img src="<?= $templateFolder ?>/img/play2.png" alt="">
						</button>
					</a>
				<? else : ?>
					<a data-test="<?= $arResult[fotos][media_type_arr][$i] ?>" id="a_<?= $i ?>" href="<?= $arResult[fotos][data_foto_shortcode_arr][$i] ?>" style="background-image: url(&quot;/include/dohuze/instagram_<?= $arResult['ID_COMPONENT'] ?>/<?= $arResult[fotos][dir_foto][$i] ?>/<?= $i ?>&quot;);" target="_blank">
						<div class="instGallery__img__block">
							<p class="instagram-vidget__description instagram-vidget__date"><?= $arResult[fotos][data_foto_taken_at_timestamp_arr][$i] ?></p>
							<p class="mess"><?= $arResult[fotos][data_foto_text_foto_arr][$i] ?></p>
						</div>
					</a>
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
						<? if ($arResult["INSTAGRAM_ICONKA"] == "Y") : ?><?echo htmlspecialchars_decode($arResult["INSTAGRAM_ICONKA_CODE"], ENT_HTML5);?><? endif; ?><p class="instGallery__p" style="font-family: <?= $arResult[FONT_FAMILY_NAME] ?>, <?= $arResult[INSTAGRAM_FONT_STYLE] ?>;"><?= $arParams['BLOCK_TITLE'] ?></p>
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
									<video class="videoInst" poster="<?= $poster ?>" muted autoplay>
										<source src="/include/dohuze/instagram_<?= $arResult['ID_COMPONENT'] ?>/<?= $arResult[fotos][dir_foto][$i] ?>/<?= $i ?>" type="video/mp4">
									</video>
									<button class="playVideoInst">
										<img src="<?= $templateFolder ?>/img/play2.png" alt="">
									</button>
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

<script>
	let width = document.getElementById("a_0").offsetWidth;
	let size = width * 18 / 290;
	for (let el of document.getElementsByClassName("mess")) {
		el.style.fontSize = size + "px";
	}
	for (let el of document.getElementsByClassName("instagram-vidget__description")) {
		el.style.fontSize = size * <?=$arParams['FONT_PERCENT']?> + "px";
	}
</script>

<script>
	let instWidth = document.querySelector(".instagram-vidget__item").offsetWidth;
	let instSize = instWidth * 18 / 290;

	for (let el of document.getElementsByClassName("instagram-vidget__description")) {
		el.style.fontSize = instSize + "px";
	}
	for (let el of document.getElementsByClassName("instagram-vidget__date")) {
		el.style.fontSize = instSize * <?=$arParams['FONT_PERCENT']?> + "px";
	}

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

	console.log("======================================================== instagram template =============================================================");
</script>