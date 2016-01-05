<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 5.1.2016
 * Time: 10:16
 */

function getRandomWord($len = 5) {
    $word = array_merge(range('0', '9'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

$ranStr = $_SESSION["mojaVarnost"];
//$_SESSION["vercode"] = $ranStr;

$height = 50; //CAPTCHA image height
$width = 180; //CAPTCHA image width
$font_size = 24; //CAPTCHA Font size

$image_p = imagecreate($width, $height);
$graybg = imagecolorallocate($image_p, 245, 245, 245);
$textcolor = imagecolorallocate($image_p, 34, 34, 34);

imagefttext($image_p, $font_size, -2, 15, 26, $textcolor,
    'static/pacifico/Pacifico.ttf', $ranStr);
imagepng($image_p);
