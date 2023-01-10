<div class="header">
				
				<h1 class="page-title">Recuperar Conta</h1>

			</div>
            <div class="breadcrumbs">
				<i class="fa fa-home"></i> Home <i class="fa fa-caret-right"></i> Recuperando Conta
			</div>
<div id="content_pages">
<br /><br />
<!--[if IE]>
<link href="css/ie.css" media="screen" rel="stylesheet" type="text/css">
<![endif]-->


<div id="cadastro">
    <div class="box-out">
      <div class="box-in">
        
<?php
if($_POST) {
	
	$email = sql($_POST['email']);
	$login = sql($_POST['login']);
	$codigo = sql($_POST['codigo']);

	if( !empty($login) ) {
		$where = "login = '".$login."'";
	}elseif( !empty($email) ) {
		$where = "email = '".$email."'";
	}else{
		$where = "login = '".$login."' AND email = '".$email."'";
	}
	
	$sql = mysql_query("SELECT * FROM accounts WHERE ".$where) or die(mysql_error());
	$c = mysql_fetch_array($sql);
		
	$erro .= empty($email) && empty($login) ? 'Informe o login ou email!<br>' : NULL;
	$erro .= !empty($login) && empty($email) && mysql_num_rows($sql) == 0 ? 'Nenhuma conta com este login!<br>' : NULL;
	$erro .= !empty($email) && empty($login) && mysql_num_rows($sql) == 0 ? 'Nenhuma conta com este email!<br>' : NULL;
	$erro .= !empty($login) && !empty($email) && mysql_num_rows($sql) == 0 ? 'Nenhuma conta com este login e email!<br>' : NULL;
	
	$erro .= empty($codigo)  ? 'Digite o código de confirmação<br>' : NULL;
	$erro .= (!empty($codigo)) && (!PhpCaptcha::Validate($codigo)) ? 'Código de seguranca não confere!<br>' : NULL;	
	$erro .= (!empty($email)) && (!eregi("^[-_a-z0-9]+(\\.[-_a-z0-9]+)*\\@([-a-z0-9]+\\.)*([a-z]{2,4})$", $email)) ? 'Email invalido!<br>' : NULL;
	
	if(empty($erro)) {
		$nova_senha = random(5);
		
		mysql_query("UPDATE accounts SET `password` = '".cod($nova_senha)."' WHERE ".$where) or die(mysql_error());
		
		$mail = new PHPMailer();
		$mail->SetLanguage("br");
		$mail->IsHTML(true); // envio como HTML se 'true'
		$mail->WordWrap = 50; // Defini&#65533;&#65533;o de quebra de linha
		$mail->IsSMTP(); // send via SMTP
		$mail->SMTPAuth = true; // 'true' para autentica&#65533;&#65533;o
		$mail->Mailer = "smtp"; //Usando protocolo SMTP
		$mail->Host = $configs['phpmailer']['servidor']; //seu servidor SMTP
		$mail->Username = $configs['phpmailer']['usuario']; //Username
		$mail->Password = $configs['phpmailer']['senha']; // senha de SMTP
		$mail->From = $configs['phpmailer']['usuario'];
		$mail->FromName = $configs['nome_servidor'];
					
		$mail->AddAddress($c['email'],$c['login']);
		$mail->Subject = $configs['nome_servidor'] . ' - Nova senha';
		
		$mail->Body = '<table width="100%" border="0">
			  <tr>
				<td>Prezado <strong>'.$c['login'].'</strong> </td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>Foi solicidado uma nova senha para sua conta. Caso n&atilde;o foi voc&ecirc; que solicitou, desconsidere este email.</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>Login: <strong>'.$c['login'].'</strong> </td>
			  </tr>
			  <tr>
				<td>Nova senha: <strong>'.$nova_senha.'</strong> </td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><strong>OBS: N&atilde;o responda esse email.</strong> </td>
			  </tr>
			</table>';
				
		if(!$mail->Send()) {
			echo utf8_encode($mail->ErrorInfo);
		}
?>
      <div class="alert alert-success">
         <button type='button' class='close' data-dismiss='alert'>&times;</button>
    			Conta recuperada com Sucesso, dados foram enviados ao seu email 
   		  </div><!-- end div .notification info -->     
<?php
	}else{
		
		?>
        <div class="alert alert-danger" style="margin-top:15px; margin-bottom:5px;">
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
    			<?php echo $erro; ?>
    		</div><!-- end div .notification info --><br />
            
            <?php
	}
}		


?>
        
		<form method="post" name="form3">
        <center>
 <table width="700" border="0">
  <tr>
    <td colspan="2"> Ao inserir seu login ou email corretamente e enviar a nova senha, ela será enviada ao seu email, então não esqueça de adicionar nosso email : suporte@klaviron.com em sua lista de emails confiáveis, para ter certeza de que irá receber sem problemas !</td>
    </tr>
  <tr>
    <td width="245">&nbsp;</td>
    <td width="208" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>   		
    <label>Login</label>
    		<input type="text" class="legenda" name="login" />
            <div style="text-align:center; font-size:15px; padding:10px; margin-top:13px;">OU</div>
    		<label>E-mail</label>
    		<input type="text" class="legenda" name="email" id="email" /> 
</td>
    <td align="center">
            <label>Código de Confirmação</label>
    		<input name="codigo" type="text" class="legenda" id="codigo" style="width:150px;"/>
    		<br /><img src="configs/img.php" id="codigo_seguranca" />
			<img src="img/refresh.png" alt="" width="16" height="16" id="regresh_codigo" style="cursor:pointer" />    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
   		
          		<p><br />
          		  <input type="submit" class="button_style" value="Enviar" id="button_form_submit" />
       		  </p></td>
    </tr>
</table>
</center>
   		</form>
    	</div><!-- end div .box-in -->
    </div><!-- end div .box-out -->
</div><!-- end div #login -->



</div>
