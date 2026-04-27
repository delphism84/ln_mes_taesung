<?
error_reporting(E_ALL);
ini_set("display_errors", 1);


require('class/BCGFontFile.php');
require('class/BCGColor.php');
require('class/BCGDrawing.php');
require('class/BCGcode128.barcode.php');

$font = new BCGFontFile('./font/Arial.ttf', 18);
$colorFront = new BCGColor(0, 0, 0);
$colorBack = new BCGColor(255, 255, 255);

// Barcode Part
$code = new BCGcode128();
$code->setScale(2);
$code->setThickness(30);
$code->setForegroundColor($colorFront);
$code->setBackgroundColor($colorBack);
$code->setFont($font);
$code->setStart(NULL);
$code->setTilde(true);
$code->parse('a123');

// Drawing Part
$drawing = new BCGDrawing('', $colorBack);
$drawing->setBarcode($code);
$drawing->draw();


header('Content-Type: image/png');

$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>