<?php

include("funcoes.php");
include("classes/class.image.php");

$servidor_mysql = 'localhost';	// MySQL HOST
$usuario_mysql  = 'root';			// MySQL Login
$senha_mysql    = '';				// MySQL Senha
$db_mysql       = 'lineage2';				// L2JDB

$con = mysql_connect($servidor_mysql, $usuario_mysql, $senha_mysql);
$de_select = mysql_select_db($db_mysql, $con);

//Configuraçoes sistema:
$configs['nome_servidor'] = 'Arkweb Comunication';
$configs['titulo_site'] = 'Arkweb Comunication';


/*
SMTP:
*/

$configs['phpmailer']['servidor'] = 'mail.arkweb.com.br';
$configs['phpmailer']['usuario']  = 'contato@arkweb.com.br';
$configs['phpmailer']['senha']    = '123456789';
$configs['registro']['enviar_email'] = TRUE;

/*
REGISTRO
*/
$register_user = '1';


?>