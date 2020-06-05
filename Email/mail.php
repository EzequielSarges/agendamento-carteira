<?php
require 'phpmailer/PHPMailerAutoload.php';

class Email{

	public function enviar($email, $nome, $registro){



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
		$Mailer->Subject = 'ENTREGA DE CARTEIRAS PROFISSIONAIS CREA-DF';

		//$conteudo_email = '<img width="70px" src="cid:logo"/>';
		//$Mailer->AddEmbeddedImage('convite.jpg','logo','logo');
		$corpoEmail = 'Prezado '.$nome.', acesse o link para agendar sua entrega de carteira profissional, que acontecerá nos dia 06 e 08/06/2020';
		//Corpo da Mensagem
		$Mailer->Body = utf8_decode($corpoEmail).$link."
				<img src='cid:convite'><br>
		";
		
		$Mailer->AddEmbeddedImage(dirname(__FILE__).'/convite.jpg','convite');


		//Corpo da mensagem em texto
		$Mailer->AltBody = 'Prezado '.$nome.', acesse o link para agendar sua entrega de carteira profissional, que acontecerá nos dia 06 e 08/06/2020';

	
		
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