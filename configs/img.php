<?php

// Incluímos a Classe 

require_once 'class.captcha.php';

// Definimos as fontes a serem usadas nas images por meio de um array

$aFonts			=	array( '../fonts/VeraBd.ttf', '../fonts/VeraIt.ttf', '../fonts/Vera.ttf', '../fonts/VeraMono.ttf' );

// Instanciamos a classe, criando uma nova imagem

$oVisualCaptcha	=	new PhpCaptcha( $aFonts, 180, 30 );	

$oVisualCaptcha -> Create();

?>