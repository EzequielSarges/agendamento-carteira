<?php
require 'phpmailer/PHPMailerAutoload.php';
//require "../Util/FabricaConnection.php";

/*
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$nome = $_POST['nome'];
$email = $_POST['email'];
$registro = $_POST['nRegistro'];
$expedicao = $_POST['dataExpedicao'];
$processo = $_POST['processo'];
$confirmado = $_POST['conf'];
$retirada = $_POST['retirada'];

print_r($nome);..
*/

class Email{

	public function enviar($email, $nome, $registro){

		//$conexao->query("INSERT INTO teste SET nome = '$nome', email='$email', senha='$senha'");
		//$conexao = FabricaConnection::conectar();

		//$id = $conexao->lastInsertId();


		$link = "http://10.150.150.26/agendamento_eventos/index.php?h=".$registro;

		//Inicia a classe PHPMailer

		$Mailer = new PHPMailer();
		
		//Define que será usado SMTP
		$Mailer->IsSMTP();
		
		//Enviar e-mail em HTML
		$Mailer->isHTML(true);
		
		//Aceitar carasteres especiais
		$Mailer->CharSet = 'UTF-8';
		
		//Configurações
		$Mailer->SMTPAuth = true;
		$Mailer->SMTPSecure = 'tls';
		
		//nome do servidor
		$Mailer->Host = 'smtp.creadf.org.br';
		//Porta de saida de e-mail 
		$Mailer->Port = 587;
		
		//Dados do e-mail de saida - autenticação
		$Mailer->Username = 'ezequielsarges@creadf.org.br';
		$Mailer->Password = 'leik1170';
		
		//E-mail remetente (deve ser o mesmo de quem fez a autenticação)
		$Mailer->From = 'ezequielsarges@creadf.org.br';
		
		//Nome do Remetente
		$Mailer->FromName = 'Crea-DF';
		
		//Assunto da mensagem
		$Mailer->Subject = 'SOLENIDADE DE ENTREGA DE CARTEIRAS PROFISSIONAIS CREA-DF';

		//$conteudo_email = '<img width="70px" src="cid:logo"/>';
		//$Mailer->AddEmbeddedImage('convite.jpg','logo','logo');
		$corpoEmail = "Prezado.</br>";
		//Corpo da Mensagem
		$Mailer->Body = utf8_decode($corpoEmail).$link."
				<img src='cid:convite'><br>
		";
		
		$Mailer->AddEmbeddedImage(dirname(__FILE__).'/convite.jpg','convite');


		//Corpo da mensagem em texto
		$Mailer->AltBody = 'E-mail automatico por favor não responda.';

	
		
		//Destinatario 
		$Mailer->AddAddress($email,'CREA-DF');

		//$Mailer->SMTPDebug = 2;
		
		if($Mailer->Send()){
			echo "E-mail enviado com sucesso";
		}else{
			echo "Erro no envio do e-mail: " . $Mailer->ErrorInfo;
		}
	}
}


?>