<div class="header">
				
				<h1 class="page-title">Cadastrar-se</h1>

			</div>
            <div class="breadcrumbs">
				<i class="fa fa-home"></i> Home <i class="fa fa-caret-right"></i> Cadastrar
			</div>
<?php
if ($register_user == 1) {
$configs['regras'] = file_get_contents('pages/regras.txt');
?>
<div id="content_pages">

<br />
<!--[if IE]>
<link href="css/ie.css" media="screen" rel="stylesheet" type="text/css">
<![endif]-->
<div id="resultado"></div>
<div id="cadastro">
  <div class="box-out">
   	<div class="box-in">

	<div style='display:none; border-bottom:solid 1px #666666;' id='regras_inline'>
		<div id='inline_content' style="width:480px;">
        <style type="text/css">
		


textarea {
border:#333 solid 1px;
width:1000px;
margin:auto;
opacity:0.7;
padding:10px;
filter:alpha(opacity=70); /* For IE8 and earlier */
color:#000;
overflow-x:hidden;
font-family:Tahoma, Geneva, sans-serif;
font-size:12px;
}

textarea::-webkit-scrollbar {
    width: 10px;
}
 
/* Track */
textarea::-webkit-scrollbar-track {
    /*
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    -webkit-border-radius: 10px;
    border-radius: 0px;
*/
}
 
/* Handle */
textarea::-webkit-scrollbar-thumb {

    background: rgba(0,113,192,0.3); 
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
textarea::-webkit-scrollbar-thumb:window-inactive {
	background: rgba(255,0,0,0.3); 
}

#boxes .window {
  position:absolute;
  left:0;
  top:150;
margin:auto;
  width:1000px;
  height:400px;
  display:none;
  z-index:9999;
  padding:20px;
}

#boxes #dialog {
  width:1000px; 
  height:400px;
  padding:10px;
  position:fixed;
  margin:auto;
}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
margin:auto;
  display:none;
}
</style>
		
        <div id="regras_style" style=" margin-left:20px; margin-top:15px;">
        <textarea rows="15"  style="height:400px;"><?php echo $configs['regras']; ?></textarea></div>
         </div>
        <div style="text-align:center; padding:15px;"><a href="javascript:;" class="regras_aceito">Accept</a> | <a href="javascript:;" class="regras_nao">Decline</a></div>

	</div>         
    		<?php
            if($_POST) {

			
				$random = random(7);
			
				$login      = sql($_POST['username']);
				$senha      = sql($_POST['senha']);
				$senha2     = sql($_POST['senha2']);
				$email      = sql($_POST['email']);
				$termos     = sql($_POST['termos'], TRUE);
				$codigo     = sql($_POST['codigo']);
				
				$nome       = sql($_POST['nome']);
				
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
							
				$mail->AddAddress($email,$login);
				
				$mail->Subject = $configs['nome_servidor'] . ' - Account Data';
				  $mail->Body = '
				
				<table width="100%" border="0">
			  <tr>
				<td>Welcome <strong>'.$login.'</strong>, Lineage 2 KO</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>We performed a new registration on our site with this email, otherwise, please disregard it.</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>Login: <strong>'.$login.'</strong> </td>
			  </tr>
			  <tr>
				<td>Password: <strong>'.$senha.'</strong> </td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
              
  </tr>
			  <tr>
                
  </tr>
			  <tr>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><strong>Please do not reply to this email</strong> </td>
			  </tr>
			</table>

			';
				
				$erro .= empty($login)  ? 'Please enter your login<br>' : NULL;
				$erro .= empty($senha)  ? 'Please enter your password<br>' : NULL;
				$erro .= empty($senha2) ? 'Please enter the confirmation password<br>' : NULL;
				$erro .= empty($email)  ? 'Please enter your email address<br>' : NULL;
				$erro .= empty($nome)   ? 'Please enter your name<br>' : NULL;
				$erro .= empty($codigo) ? 'Please enter the security code<br>' : NULL;
				$erro .= empty($termos) ? 'You must agree to the <a href="javascript:;" class="regras">Terms, Conditions and Rules</a> of server<br>' : NULL;
	
				
				
				$erro .= (!empty($login)) && (verifica('login', 'accounts', $login) > 0) || (verifica('login', 'accounts', $login) > 0) ? 'This login is already used<br>' : NULL;

                                $erro .= (strlen($login) > 10) ? 'Use less than 10 characters in your Login' : NULL;
				
				$erro .= (!empty($email)) && (!eregi("^[-_a-z0-9]+(\\.[-_a-z0-9]+)*\\@([-a-z0-9]+\\.)*([a-z]{2,4})$", $email)) ? 'Please enter a valid email address<br>' : NULL;
				$erro .= (!empty($senha) && !empty($senha2)) && ($senha != $senha2) ? 'The password and confirmation password do not match<br>' : NULL;
				$erro .= (!empty($codigo)) && (!PhpCaptcha::Validate($codigo)) ? 'Security code does not match<br>' : NULL;	
				$erro .= (!empty($login)) && (!empty($ref)) && ($login == $ref) ? 'It is not even allowed to put you as a reference<br>' : NULL;
			
				if(empty($erro)) {
				$insert = "";
				//echo $insert;
					if($configs['registro']['enviar_email'] == 'TRUE' || $configs['registro']['enviar_email'] === TRUE) {
						if(!$mail->Send()) {
							echo $mail->ErrorInfo;
						}
					}
				
			
			mysql_query("INSERT INTO accounts (login, password, access_level, email) 
						   VALUES
						   ('".$login."', '".cod($senha)."', 0, '".$email."')") or die(mysql_error());
			
			?>
         <div class="alert alert-success">
         <button type='button' class='close' data-dismiss='alert'>&times;</button>
    			Your account has been created successfully
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
			
			if((!$_POST) || (!empty($erro))) {
			?>
            
        <form method="post" name="form2" autocomplete="off">
         
           
              <?php
			  /*
			if($_COOKIE['ref_sistema']) {
				echo "<input type=\"hidden\" name=\"ref\" value=\"".$_COOKIE['ref_sistema']."\">";
			}
			*/
			?>
            
          <div id="register_panel_index">
            <table width="700" border="0" align="center">
              <tr>
                <td height="30" colspan="4" align="center" class="breadcrumbs">Personal Informations</td>
              </tr>
              <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="28">Name :</td>
                <td><input name="nome" type="text" class="text" id="nome" value="<?php echo $nome; ?>" /></td>
                <td align="center">Email : </td>
                <td><input name="email" type="text" class="legenda" id="email" value="<?php echo $email; ?>" /></td>
              </tr>
               
              <tr>
                <td  colspan="4" align="center" >&nbsp;</td>
              </tr>
              <tr>
                <td height="32" colspan="4" align="center" class="breadcrumbs">Account Informations</td>
              </tr>
              <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Login :</td>
                <td><input name="username" type="text" class="legenda" id="username" value="<?php echo $login; ?>"  /></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Password : </td>
                <td><input name="senha" type="password" class="legenda" id="senha" value="<?php echo $senha; ?>" /></td>
                <td align="center">Repeat:</td>
                <td><input name="senha2" type="password" class="legenda" id="senha2" value="<?php echo $senha2; ?>" /></td>
              </tr>
              <tr>
                <td width="61" align="left" valign="top">&nbsp;</td>
                <td width="144">&nbsp;</td>
                <td width="78">&nbsp;</td>
                <td width="174">&nbsp;</td>
              </tr>
            </table>
          </div>
          <table width="700" border="0" align="center">
            <tr>
              <td height="24" align="center">Security Code :
              <input name="codigo" type="text" class="legenda" id="codigo" style="width:150px;" size="5" /></td>
            </tr>
            <tr>
              <td height="34" align="center"><img src="configs/img.php" alt="" id="codigo_seguranca" /><a href="javascript:;"><img src="img/refresh.png" alt="" width="16" height="16" id="regresh_codigo" /></a></td>
            </tr>
            <tr>
              <td height="21" align="center" >&nbsp;</td>
            </tr>
            <tr>
              <td height="42" align="justify">
                <p>Put the email no-reply@arkweb.com.br as trusted in your ANTI-SPAM, and also check your SPAM box after this operation. If this is not done, depending on the provider and the confirmation email data will not arrive.</p>
              <p>All registered email must be valid, the account is automatically activated Arkweb Comunication. The server sends an e-mail at the time of account creation with the data filled in the registration for any forgotten password or login. </p></td>
            </tr>
            <tr>
              <td height="20" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center"><input name="termos" type="checkbox" id="termos" value="1" />
              I agree with the <a href="javascript:;" class="regras"><span class="link_azul" style="color:#900;">Terms, Conditions and Rules</span></a> the lineage 2 server Arkweb.</td>
            </tr>
              
            <tr>
              <td height="78" align="center"><input type="submit" class="button_style" value="Register Now" id="button_form_submit" /></td>
            </tr>
          </table>
        </form>
            <?php
			}
			?>
   	  </div><!-- end div .box-in -->
    </div><!-- end div .box-out -->
</div><!-- end div #login -->
<!-- END LOGIN -->



</div>
<?php
}else {
echo "
<div id='content_pages'>
<br />
<div class='alert alert-info'>
 <button type='button' class='close' data-dismiss='alert'>&times;</button>
 <h4>Ops!</h4>
<span style='text-align:center; width:610px; margin:auto;'>Registration System Temporarily Off!</span>
</div>
</div>
";	
}
?>