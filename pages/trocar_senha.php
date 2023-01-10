<div class="header">
				
				<h1 class="page-title">Trocar Senha</h1>

			</div>
            <div class="breadcrumbs">
				<i class="fa fa-home"></i> Home <i class="fa fa-caret-right"></i> Trocando Senha
			</div>

<div class="content_pages">

 

    		<div class="box-content">



<?php



if($_POST) {

	$login = sql($_POST['login']);

	$senha_atual = sql($_POST['senha_atual']);

	$nova_senha  = sql($_POST['nova_senha']);

	$nova_senha2 = sql($_POST['nova_senha2']);

	
	$erro .= empty($login) ? 'Digite um Login\n' : NULL;

	$erro .= empty($senha_atual) ? 'Digite a Senha Atual\n' : NULL;

	$erro .= empty($nova_senha)  ? 'Informe a nova Senha\n' : NULL;

	$erro .= empty($nova_senha2) ? 'Digite a confirmacao da Senha\n' : NULL;
	
	$seleciona_user = mysql_query("SELECT * FROM accounts WHERE login = '".$login."'");
	$senha_user = mysql_fetch_array($seleciona_user);

	$erro .= ((!empty($senha_atual) && !empty($nova_senha) && !empty($nova_senha2)) && cod($senha_atual) != $senha_user['password']) ? 'Senha atual incorreta\n' : NULL;

	$erro .= !empty($nova_senha) && !empty($nova_senha2) && ($nova_senha != $nova_senha2) ? 'Confirmacao de senhas nao conferem\n' : NULL;

	

	if(empty($erro)) {

		$_SESSION['senha_session'] = cod($nova_senha);

		mysql_query("UPDATE accounts SET `password` = '".cod($nova_senha)."' WHERE login = '".$login."'") or die(mysql_error());


		echo "<script>alert('Senha alterada com Sucesso');</script>";

		echo "<script>window.location='index.php?ir=pages/trocar_senha';</script>";

		

		

		}else{

		echo "<script>alert('".utf8_encode($erro)."');</script>";

		echo "<script>window.location='index.php?ir=painel/editar_dados';</script>";

	}

}

?>

<form action="" method="post" class="form">
<center><br /><br />
<table width="556" border="0" align="center">

  <tr>

    <td width="165" align="right" style="padding-right:10px; font-weight:bold">Login:</td>

    <td width="381"><input name="login" type="text" /></td>

  </tr>

  <tr>

    <td align="right" style="padding-right:10px; font-weight:bold">Senha Atual:</td>

    <td><input name="senha_atual" type="password" class="text" id="senha_atual"></td>

  </tr>

  <tr>

    <td align="right" style="padding-right:10px; font-weight:bold">Nova Senha:</td>

    <td><input name="nova_senha" type="password" class="text" id="nova_senha"></td>

  </tr>

  <tr>

    <td align="right" style="padding-right:10px; font-weight:bold">Repita a Nova Senha:</td>

    <td><input name="nova_senha2" type="password" class="text" id="nova_senha2"></td>

  </tr>

  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>

    <td align="right">&nbsp;</td>

    <td><input type="submit" class="button_style" name="button" id="button_form_submit" value="Alterar Senha"></td>

  </tr>

  <tr>

    <td align="right">&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

</table>

</center>

</form>

    		</div><!-- end div .box-content -->

</div><!-- end div .box-in -->