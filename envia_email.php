<?php
// Inclui o arquivo class.phpmailer.php localizado na pasta lib/PHPMailer
require_once("lib/PHPMailer/class.phpmailer.php");
 
// Inicia a classe PHPMailer
$mail = new PHPMailer(true);
 
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->IsSMTP(); // Define que a mensagem será SMTP
 $mail->SMTPDebug  = 0;

try {
	 $dados = 0;
	 
	 $nome  = (isset($_POST['contact-name'])    ? $_POST['contact-name']    : null);
	 $email = (isset($_POST['contact-email'])   ? $_POST['contact-email']   : null);
	 $fone  = (isset($_POST['contact-phone'])   ? $_POST['contact-phone']   : null);
	 $msg   = (isset($_POST['contact-message']) ? $_POST['contact-message'] : null);
	 
     $mail->Host = 'smtp.guimaraespinturas.com.br'; // Endereço do servidor SMTP
     $mail->SMTPAuth   = true;  					// Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
     $mail->Port       = 587; 						// Usar 587 porta SMTP
     $mail->Username = 'contato@guimraespinturas.com.br'; 						// Usuário do servidor SMTP (endereço de email)
     $mail->Password = 'P4$$w0rd1'; 						// Senha do servidor SMTP (senha do email usado)
 
     //Define o remetente
     // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
     $mail->SetFrom ('contato@guimaraespinturas.com.br', 'Contato WebSite'); 	//E-mail do dominio (Obrigatório)
     $mail->AddReplyTo ($email, $nome); 							//Seu e-mail
     $mail->Subject = utf8_decode('[Contato Web] - Guimarães Pintura');						//Assunto do e-mail
 
     //Define os destinatário(s)
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     $mail->AddAddress ('redirect@guimaraespinturas.com.br', 'Guimarães Pintura'); // E-mail Principal
 
     //Campos abaixo são opcionais 
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     //$mail->AddBCC('guimaraespinturas30@gmail.com', 'Guimarães Pintura'); // Cópia Oculta
     //$mail->AddAttachment('ANEXO');      									// Adicionar um anexo
	
	 $html  = '<p>De: '.$nome.' ['.$email.']';
	 $html .= '<br/>Contato: '. $fone .'</p>';
	 $html .= '<hr>';
	 $html .= '<br/>';
	 $html .= nl2br($msg);
	 $html .= '</p><br/><br/>';
	 $html .= '--';
	 $html .= '<br/>';
	 $html .= 'Este e-mail foi enviado através do Contato em Guimarães Pintura (http://www.guimaraespinturas.com.br)';
 
     //Define o corpo do email
     $mail->MsgHTML($html); 
 
     ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
 
     //$mail->Send();
     //header("Location: contato.html");
     //echo "Mensagem enviada com sucesso</p>\n";
	 
	 echo "<p align=center>$nome, sua mensagem foi enviada com sucesso!</p>";
	 echo "<p align=center>Estaremos retornando em breve.</p>";
	 
	 $mail->ClearAllRecipients();
	 $mail->ClearAttachments();
 
    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {
      echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
}
?>