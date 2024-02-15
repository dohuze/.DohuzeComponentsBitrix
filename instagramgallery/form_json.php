<?require  'form_json_lang_ru.php'?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?=$MESS["JSON_STROKA"]?></title>
  </head>
  <body>
    <form action="#" method="post">
      <p><b><?=$MESS["VVEDITE"]?>:</b></p>
      <p>
        <textarea
          rows="10"
          cols="85"
          name="json-stroka"
        ></textarea>
      </p>
      <p><input type="submit" value="<?=$MESS["KNOPKA"]?>" /></p>
    </form>
  </body>
</html>

<?
if(isset($_POST['json-stroka']) && isset($_GET['loin_instagram'])) {
	$bits = file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/include/dohuze/instagram_login_' . $_GET['loin_instagram'] . '/json.txt', $_POST['json-stroka']);
	echo '<br>' . $bits . '</br>';
}
